<?php

namespace Tests\Unit;

use App\Models\Meta;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class MetaModelTest extends TestCase
{
    public function test_meta_pertenece_a_un_objetivo(): void
    {
        $meta = new Meta();

        $this->assertInstanceOf(
            BelongsTo::class,
            $meta->objetivo()
        );
    }

    public function test_meta_tiene_un_responsable(): void
    {
        $meta = new Meta();

        $this->assertInstanceOf(
            BelongsTo::class,
            $meta->responsable()
        );
    }

    public function test_meta_pertenece_a_un_usuario(): void
    {
        $meta = new Meta();

        $this->assertInstanceOf(
            BelongsTo::class,
            $meta->usuario()
        );
    }

    public function test_meta_tiene_muchos_indicadores(): void
    {
        $meta = new Meta();

        $this->assertInstanceOf(
            HasMany::class,
            $meta->indicadores()
        );
    }
}