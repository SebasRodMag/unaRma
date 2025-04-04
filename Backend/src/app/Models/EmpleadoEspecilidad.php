<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoEspecilidad extends Model
{
    use HasFactory;

    protected $table = 'empleado_especialidad';
    public $fillable = [
        'empleado_id',
        'especialidad_id'
    ];
}
