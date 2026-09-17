<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Objetivo extends Model
{
    use HasFactory;

    protected $table = 'objetivos';

    protected $fillable = [
        'plan_id',
        'pnd_id',
        'pnd_politica_id',
        'ods_id',
        'ods_meta_id',
        'codigo',
        'nombre',
        'descripcion',
        'estado',
        'usuario_id',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function pnd(): BelongsTo
    {
        return $this->belongsTo(
            PndObjetivo::class,
            'pnd_id'
        );
    }

    public function politicaPnd(): BelongsTo
    {
        return $this->belongsTo(
            PndPolitica::class,
            'pnd_politica_id'
        );
    }

    public function ods(): BelongsTo
    {
        return $this->belongsTo(Ods::class);
    }

    public function metaOds(): BelongsTo
    {
        return $this->belongsTo(
            OdsMeta::class,
            'ods_meta_id'
        );
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'usuario_id'
        );
    }

    public function metas(): HasMany
    {
        return $this->hasMany(Meta::class);
    }

    public function programas(): BelongsToMany
    {
        return $this->belongsToMany(
            Programa::class,
            'programa_objetivo'
        );
    }
}