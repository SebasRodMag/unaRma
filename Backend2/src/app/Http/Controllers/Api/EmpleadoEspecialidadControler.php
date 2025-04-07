<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmpleadoEspecilidad;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Especialidad;

class EmpleadoEspecialidadControler extends Controller{
    public function asignarEspecialidad($empleadoId, $especialidadId){
        $empleado = Empleado::find($empleadoId);
        $especialidad = Especialidad::find($especialidadId);
        //No me gusta como se ha quedado esta función, pero no quiero perder mucho tiempo en esto.
        if(!$empleado){
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }

        if(!$especialidad){
            return response()->json(['message' => 'Especialidad no encontrada'], 404);
        }
        
        $empleadoEspecialidad = EmpleadoEspecilidad::create([
            'empleado_id' => $empleadoId,
            'especialidad_id' => $especialidadId
        ]);

        return response()->json($empleadoEspecialidad, 201)??response()->json(['message' => 'Error al asignar especialidad'], 500);
    }

    public function eliminarEspecialidad($empleadoId, $especialidadId){
        $empleado = Empleado::find($empleadoId);
        $especialidad = Especialidad::find($especialidadId);

        if(!$empleado){
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }

        if(!$especialidad){
            return response()->json(['message' => 'Especialidad no encontrada'], 404);
        }

        $empleadoEspecialidad = EmpleadoEspecilidad::where('empleado_id', $empleadoId)->where('especialidad_id', $especialidadId)->first();

        if(!$empleadoEspecialidad){
            return response()->json(['message' => 'No existe la relación entre empleado y especialidad'], 404);
        }

        $empleadoEspecialidad->delete();

        return response()->json(['message' => 'Especialidad eliminada del empleado'], 200)??response()->json(['message' => 'Error al eliminar especialidad'], 500);
    }
    public function listarEspecialidades($empleadoId){
        $empleado = Empleado::find($empleadoId);
        if(!$empleado){
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }

        $especialidades = $empleado->especialidades()->get();

        return response()->json($especialidades, 200)??response()->json(['message' => 'Error al listar especialidades'], 500);
    }
}