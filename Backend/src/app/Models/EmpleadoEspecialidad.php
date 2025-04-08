<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoEspecialidad extends Model
{
    use HasFactory;

    protected $table = 'empleado_especialidades';

    protected $fillable = [
        'empleado_id',
        'especialidad_id'
    ];
}
