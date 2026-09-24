<!doctype html>
<html lang="es"><head><meta charset="utf-8"><style>
@page { margin: 25px; }
body { font-family: DejaVu Sans, sans-serif; color: #243247; font-size: 9px; }
h1 { color: #024687; font-size: 19px; margin: 0 0 8px; }
p { margin: 4px 0; }
table { width: 100%; border-collapse: collapse; margin-top: 16px; table-layout: fixed; }
th { background: #c9d5e2; color: #173450; }
th,td { border: 1px solid #dce3e9; padding: 6px; text-align: left; word-wrap: break-word; }
thead { display: table-header-group; }
tr { page-break-inside: avoid; }
</style></head><body>
<h1>SIPeIP | {{ $titulo }}</h1>
<p><strong>Entidad:</strong> {{ $entidad }}</p>
<p><strong>Generado:</strong> {{ now()->format('d/m/Y H:i') }}
@if(!empty($filtros['anio'])) · <strong>Año:</strong> {{ $filtros['anio'] }} @endif
@if(!empty($filtros['periodo'])) · <strong>Período:</strong> {{ $filtros['periodo'] }} @endif
</p>
<p><strong>Total:</strong> {{ $filas->count() }} registros</p>
<table><thead><tr>@foreach($columnas as $columna)<th>{{ $columna }}</th>@endforeach</tr></thead>
<tbody>@forelse($filas as $fila)<tr>@foreach($fila as $valor)<td>{{ is_float($valor) ? number_format($valor, 2, ',', '.') : ($valor ?? '—') }}</td>@endforeach</tr>
@empty<tr><td colspan="{{ count($columnas) }}">Sin registros para los filtros seleccionados.</td></tr>@endforelse</tbody></table>
</body></html>
