<?php

namespace Tests\Unit;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class PlanModelTest extends TestCase
{
    /**
     * Verifica que un Plan pertenece a una Entidad.
     */
    public function test_plan_pertenece_a_una_entidad(): void
    {
        $plan = new Plan();

        $this->assertInstanceOf(
            BelongsTo::class,
            $plan->entidad()
        );
    }

    /**
     * Verifica que un Plan pertenece a un Usuario.
     */
    public function test_plan_pertenece_a_un_usuario(): void
    {
        $plan = new Plan();

        $this->assertInstanceOf(
            BelongsTo::class,
            $plan->usuario()
        );
    }

    /**
     * Verifica que un Plan tiene muchos Objetivos.
     */
    public function test_plan_tiene_muchos_objetivos(): void
    {
        $plan = new Plan();

        $this->assertInstanceOf(
            HasMany::class,
            $plan->objetivos()
        );
    }
}