<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PndPolitica extends Model
{
    protected $table = 'pnd_politicas';

    protected $fillable = [
        'pnd_id',
        'codigo',
        'nombre',
        'descripcion',
        'estado'
    ];

    public function pnd()
    {
        return $this->belongsTo(Pnd::class);
    }
}