<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index()
    {
        $especialidades = Especialidad::all();
        if(!$especialidades) {
            $respuesta = response()->json(['message' => 'No hay especialidades'], 404);
        }else{
            $respuesta = response()->json($especialidades, 200);
        }
        return $respuesta;
    }
    
    public function show($id)
    {
        $especialidad = Especialidad::find($id);
        return $especialidad??response()->json(['message' => 'Especialidad no encontrada'], 404);    
    }

    public function store(Request $request)
    {
        $especialidad = Especialidad::create($request->all());
        return response()->json($especialidad, 201)??response()->json(['message' => 'Error al crear la especialidad'], 500);

    }

    public function update(Request $request, $id)
    {
        $especialidad = Especialidad::find($id);
        if (!$especialidad) {
            return response()->json(['message' => 'Especialidad no encontrada'], 404);
        }
        $especialidad->update($request->all());
        return response()->json($especialidad, 200);
    }

    public function destroy($id)
    {
        $especialidad = Especialidad::find($id);
        if (!$especialidad) {
            return response()->json(['message' => 'Especialidad no encontrada'], 404);
        }
        $especialidad->delete();
        return response()->json(['message' => 'Especialidad eliminada'], 200);
    }
}