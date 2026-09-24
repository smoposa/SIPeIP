<?php
namespace App\Http\Controllers;

use App\Enums\PeriodoSeguimiento;
use App\Http\Requests\Reportes\ReporteRequest;
use App\Models\User;
use App\Services\ReporteService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReporteController extends Controller
{
    public function __construct(private readonly ReporteService $service) {}

    public function index(ReporteRequest $request): View
    {
        $this->autorizar('reportes');
        $filtros = $request->validated();
        $tipo = $filtros['tipo'] ?? 'planes';
        return view('reportes.index', [
            'tipos' => $this->service->tipos(),
            'tipo' => $tipo,
            'filtros' => $filtros,
            'periodos' => PeriodoSeguimiento::values(),
            'proyectos' => $this->service->proyectos($this->usuario()),
            'columnas' => $this->service->columnas($tipo),
            'registros' => $this->service->listado($this->usuario(), $tipo, $filtros),
            'service' => $this->service,
        ]);
    }

    public function pdf(ReporteRequest $request): Response
    {
        $this->autorizar('reportes');
        $filtros = $request->validated();
        $tipo = $filtros['tipo'] ?? 'planes';
        $usuario = $this->usuario();
        $registros = $this->service->exportacion($usuario, $tipo, $filtros, 500);
        return Pdf::loadView('reportes.pdf', [
            'titulo' => $this->service->tipos()[$tipo],
            'entidad' => $usuario->entidad?->nombre ?? '',
            'columnas' => $this->service->columnas($tipo),
            'filas' => $registros->map(fn ($r) => $this->service->fila($tipo, $r)),
            'filtros' => $filtros,
        ])->setPaper('a4', 'landscape')
          ->stream('sipeip-'.$tipo.'-'.now()->format('Ymd-His').'.pdf');
    }

    public function excel(ReporteRequest $request): Response
    {
        $this->autorizar('reportes');
        $filtros = $request->validated();
        $tipo = $filtros['tipo'] ?? 'planes';
        $usuario = $this->usuario();
        $registros = $this->service->exportacion($usuario, $tipo, $filtros, 5000);
        $libro = new Spreadsheet();
        $hoja = $libro->getActiveSheet();
        $hoja->setTitle('Reporte');
        $columnas = $this->service->columnas($tipo);
        $hoja->setCellValue('A1', 'SIPeIP | '.$this->service->tipos()[$tipo]);
        $hoja->setCellValue('A2', 'Entidad: '.($usuario->entidad?->nombre ?? ''));
        $hoja->setCellValue('A3', 'Generado: '.now()->format('Y-m-d H:i'));
        foreach ($columnas as $i => $titulo) {
            $hoja->setCellValue([$i + 1, 5], $titulo);
        }
        $hoja->getStyle([1, 5, count($columnas), 5])->getFont()->setBold(true);
        $hoja->getStyle([1, 5, count($columnas), 5])->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('C9D5E2');
        $fila = 6;
        foreach ($registros as $registro) {
            foreach ($this->service->fila($tipo, $registro) as $i => $valor) {
                // Texto explícito impide que los códigos o nombres se interpreten como fórmulas.
                if (is_int($valor) || is_float($valor)) {
                    $hoja->setCellValue([$i + 1, $fila], $valor);
                } else {
                    $hoja->setCellValueExplicit([$i + 1, $fila], (string) ($valor ?? ''), DataType::TYPE_STRING);
                }
            }
            $fila++;
        }
        foreach (range(1, count($columnas)) as $col) {
            $hoja->getColumnDimensionByColumn($col)->setWidth(25);
        }
        $hoja->freezePane('A6');
        $hoja->setAutoFilter([1, 5, count($columnas), max(5, $fila - 1)]);
        $archivo = tempnam(sys_get_temp_dir(), 'sipeip-reporte-');
        abort_if($archivo === false, 500);
        try {
            (new Xlsx($libro))->save($archivo);
            $bytes = file_get_contents($archivo);
            abort_if($bytes === false, 500);
        } finally {
            $libro->disconnectWorksheets();
            @unlink($archivo);
        }
        return response($bytes, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="sipeip-'.$tipo.'-'.now()->format('Ymd-His').'.xlsx"',
        ]);
    }

    private function usuario(): User
    {
        $usuario = Auth::user();
        abort_unless($usuario instanceof User, 401);
        return $usuario;
    }
}
