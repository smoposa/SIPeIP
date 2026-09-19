<?php

namespace Tests\Unit;

use App\Models\Proyecto;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class ProyectoModelTest extends TestCase
{
    public function test_proyecto_pertenece_a_un_programa(): void
    {
        $proyecto = new Proyecto();

        $this->assertInstanceOf(
            BelongsTo::class,
            $proyecto->programa()
        );
    }

    public function test_proyecto_pertenece_a_una_entidad(): void
    {
        $proyecto = new Proyecto();

        $this->assertInstanceOf(
            BelongsTo::class,
            $proyecto->entidad()
        );
    }

    public function test_proyecto_pertenece_a_un_subsector(): void
    {
        $proyecto = new Proyecto();

        $this->assertInstanceOf(
            BelongsTo::class,
            $proyecto->subsector()
        );
    }

    public function test_proyecto_tiene_un_responsable(): void
    {
        $proyecto = new Proyecto();

        $this->assertInstanceOf(
            BelongsTo::class,
            $proyecto->responsable()
        );
    }

    public function test_proyecto_pertenece_a_un_usuario(): void
    {
        $proyecto = new Proyecto();

        $this->assertInstanceOf(
            BelongsTo::class,
            $proyecto->usuario()
        );
    }
}