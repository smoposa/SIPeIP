<?php

namespace Tests\Feature;

use App\Models\AgendaOds;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CatalogosMigracionTest extends TestCase
{
    // Probar ALTER TABLE sin una transacción externa, como se ejecuta al desplegar.
    // Cada prueba inicia su propia base de pruebas; no se modifican migraciones aplicadas.
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh', ['--force' => true]);
    }

    protected function tearDown(): void
    {
        RefreshDatabaseState::$migrated = false;
        RefreshDatabaseState::$inMemoryConnections = [];
        parent::tearDown();
    }

    public function test_migracion_asocia_los_ods_existentes_sin_cambiar_sus_ids(): void
    {
        $migration = require database_path('migrations/2026_10_11_160100_create_ods_agendas_table.php');
        $migration->down();
        DB::table('ods')->insert(['id' => 75, 'codigo' => 'ODS-01', 'nombre' => 'Existente', 'descripcion' => 'Descripción', 'estado' => 'Activo']);
        DB::table('ods_metas')->insert(['id' => 90, 'ods_id' => 75, 'codigo' => '1.1', 'nombre' => 'Meta existente', 'estado' => 'Activo']);
        $migration->up();
        $agenda = AgendaOds::query()->firstOrFail();
        $this->assertDatabaseHas('ods', ['id' => 75, 'agenda_id' => $agenda->id]);
        $this->assertDatabaseHas('ods_metas', ['id' => 90, 'ods_id' => 75]);
    }

    public function test_migracion_mantiene_las_claves_foraneas_activas(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            $this->assertSame(1, (int) DB::scalar('PRAGMA foreign_keys'));
        }
        $this->expectException(\Illuminate\Database\QueryException::class);
        DB::table('ods_metas')->insert([
            'ods_id' => 99999, 'codigo' => '99.1', 'nombre' => 'Meta sin padre', 'estado' => 'Activo',
        ]);
    }
}
