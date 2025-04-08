<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class Especialidad extends Model
{
    protected $table = 'especialidades';
    protected $fillable = [
        'nombre',
    ];
    use HasFactory, Notifiable;
    /**
     * The empleados that belong to the Especialidad
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function empleados(): BelongsToMany
    {
        return $this->belongsToMany(Empleado::class, 'empleado_especialidad', 'especialidad_id', 'empleado_id');
    }
}
