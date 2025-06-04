<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'plataforma_id',
    ];
}
