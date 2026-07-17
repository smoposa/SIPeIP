<?php

namespace Tests\Unit;

use App\Models\Objetivo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class ObjetivoModelTest extends TestCase
{
    public function test_objetivo_pertenece_a_un_plan(): void
    {
        $objetivo = new Objetivo();

        $this->assertInstanceOf(
            BelongsTo::class,
            $objetivo->plan()
        );
    }

    public function test_objetivo_pertenece_a_un_pnd(): void
    {
        $objetivo = new Objetivo();

        $this->assertInstanceOf(
            BelongsTo::class,
            $objetivo->pnd()
        );
    }

    public function test_objetivo_pertenece_a_un_ods(): void
    {
        $objetivo = new Objetivo();

        $this->assertInstanceOf(
            BelongsTo::class,
            $objetivo->ods()
        );
    }

    public function test_objetivo_pertenece_a_un_usuario(): void
    {
        $objetivo = new Objetivo();

        $this->assertInstanceOf(
            BelongsTo::class,
            $objetivo->usuario()
        );
    }

    public function test_objetivo_tiene_muchas_metas(): void
    {
        $objetivo = new Objetivo();

        $this->assertInstanceOf(
            HasMany::class,
            $objetivo->metas()
        );
    }

    public function test_objetivo_tiene_muchos_programas(): void
    {
        $objetivo = new Objetivo();

        $this->assertInstanceOf(
            BelongsToMany::class,
            $objetivo->programas()
        );
    }
}