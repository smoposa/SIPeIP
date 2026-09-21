<?php

namespace Tests\Feature;

use App\Models\Entidad;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeguimientoAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autorizado_puede_acceder_a_avances_y_presupuestos(): void
    {
        $usuario = $this->crearUsuario('DIRECTOR_INVERSION', 'Director de Inversión Pública');

        $this->actingAs($usuario)->get(route('avances.listar'))->assertOk();
        $this->actingAs($usuario)->get(route('presupuestos.listar'))->assertOk();
    }

    public function test_usuario_sin_permiso_no_puede_acceder_a_seguimiento(): void
    {
        $usuario = $this->crearUsuario('ADMIN_INSTITUCIONAL', 'Administrador Institucional');

        $this->actingAs($usuario)->get(route('avances.listar'))->assertForbidden();
        $this->actingAs($usuario)->get(route('presupuestos.listar'))->assertForbidden();
    }

    private function crearUsuario(string $codigoRol, string $nombreRol): User
    {
        $entidad = Entidad::factory()->create(['estado' => 'Activo']);
        $rol = Rol::query()->firstOrCreate(
            ['codigo' => $codigoRol],
            ['nombre' => $nombreRol, 'descripcion' => 'Rol para pruebas.', 'estado' => 'Activo']
        );

        return User::factory()->create([
            'rol_id' => $rol->id,
            'entidad_id' => $entidad->id,
            'estado' => 'Activo',
        ]);
    }
}
