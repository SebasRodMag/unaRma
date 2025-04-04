<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{

    public function index()
    {
        $empleados = Empleado::all();
        return response()->json($empleados, 200)??response()->json(['message' => 'No hay empleados'], 404);
    }
    
    public function show($id)
    {
        $empleado = Empleado::find($id);
        if (!$empleado) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
        return $empleado;
    }

    public function store(Request $request)
    {
        $empleado = Empleado::create($request->all());
        return response()->json($empleado, 201);
    }

    public function update(Request $request, $id)
    {
        $empleado = Empleado::find($id);
        if (!$empleado) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
        $empleado->update($request->all());
        return response()->json($empleado, 200);
    }

    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        if (!$empleado) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
        $empleado->delete();
        return response()->json(['message' => 'Empleado eliminado'], 200);
    }
}