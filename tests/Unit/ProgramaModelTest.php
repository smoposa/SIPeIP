<?php

namespace Tests\Unit;

use App\Models\Programa;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class ProgramaModelTest extends TestCase
{
    public function test_programa_pertenece_a_una_entidad(): void
    {
        $programa = new Programa();

        $this->assertInstanceOf(
            BelongsTo::class,
            $programa->entidad()
        );
    }

    public function test_programa_tiene_un_responsable(): void
    {
        $programa = new Programa();

        $this->assertInstanceOf(
            BelongsTo::class,
            $programa->responsable()
        );
    }

    public function test_programa_pertenece_a_un_usuario(): void
    {
        $programa = new Programa();

        $this->assertInstanceOf(
            BelongsTo::class,
            $programa->usuario()
        );
    }

    public function test_programa_tiene_objetivos_asociados(): void
    {
        $programa = new Programa();

        $this->assertInstanceOf(
            BelongsToMany::class,
            $programa->objetivos()
        );
    }

    public function test_programa_tiene_muchos_proyectos(): void
    {
        $programa = new Programa();

        $this->assertInstanceOf(
            HasMany::class,
            $programa->proyectos()
        );
    }
}