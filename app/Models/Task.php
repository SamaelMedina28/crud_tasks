<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'titulo',
        'descripcion',
        'estado',
        'fecha_limite',
    ];
    protected $casts = [
        'fecha_limite' => 'date',
    ];


}
