<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index()
{
    try {
        // Obtener todos los empleados
        $empleados = Empleado::with('usuario')->get();

        return response()->json($empleados, 200);

    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al obtener la lista de empleados: ' . $e->getMessage()], 500);
    }
}
    
    public function show($id)
{
    try {
        // Buscar el empleado por su ID
        $empleado = Empleado::with('usuario')->findOrFail($id);

        return response()->json($empleado, 200);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Si el empleado no se encuentra, devolver un error 404
        return response()->json(['message' => 'Empleado no encontrado.'], 404);
    } catch (\Exception $e) {
        // Otros  errores
        return response()->json(['message' => 'Error al obtener el empleado: ' . $e->getMessage()], 500);
    }
}

    public function store(Request $request)
{
    // Reglas de validación para los datos del empleado
    $rules = [
        'DNI' => 'required|string|size:9|regex:/^\d{8}[A-Z]$/',
        'apellidos' => 'required|string|max:255',
        'tlf' => 'required|unique:empleados,tlf|digits_between:9,15|regex:/^\+?\d+$/',
        'direccion' => 'required|string|max:255',
        'municipio' => 'required|string|max:255',
        'provincia' => 'required|string|max:255',
        'anos_experiencia' => 'required|integer|max:80',
        'nombre' => 'sometimes|required|string|max:255', 
        'nombreUsuario' => 'sometimes|required|string|max:255|unique:usuarios,nombreUsuario', 
        'email' => 'sometimes|required|email|unique:usuarios,email', 
        'contrasena' => 'sometimes|required|string|min:8', 
    ];

    // Mensajes de error
    $messages = [
        'DNI.required' => 'El DNI es obligatorio.',
        'DNI.size' => 'El DNI debe tener 9 caracteres.',
        'DNI.regex' => 'El formato del DNI no es válido.',
        'apellidos.required' => 'Los apellidos son obligatorios.',
        'tlf.required' => 'El número de teléfono es obligatorio.',
        'tlf.unique' => 'Este número de teléfono ya está en uso.',
        'tlf.digits_between' => 'El número de teléfono debe tener entre 9 y 15 dígitos.',
        'tlf.regex' => 'El formato del número de teléfono no es válido.',
        'direccion.required' => 'La dirección es obligatoria.',
        'municipio.required' => 'El municipio es obligatorio.',
        'provincia.required' => 'La provincia es obligatoria.',
        'anos_experiencia.required' => 'Los años de experiencia son obligatorios.',
        'anos_experiencia.integer' => 'Los años de experiencia deben ser un número entero.',
        'anos_experiencia.max' => 'Los años de experiencia no pueden ser superiores a 80.',
        'nombre.required' => 'El nombre es obligatorio si se crea un nuevo usuario.',
        'nombreUsuario.required' => 'El nombre de usuario es obligatorio si se crea un nuevo usuario.',
        'nombreUsuario.unique' => 'Este nombre de usuario ya está en uso.',
        'email.required' => 'El email es obligatorio si se crea un nuevo usuario.',
        'email.email' => 'El email debe ser un email válido.',
        'email.unique' => 'Este email ya está en uso.',
        'contrasena.required' => 'La contraseña es obligatoria si se crea un nuevo usuario.',
        'contrasena.min' => 'La contraseña debe tener al menos 8 caracteres si se crea un nuevo usuario.',
    ];

    // Validación de los datos
    $validatedData = $request->validate($rules, $messages);

    DB::beginTransaction();

    try {
        // Buscamos al usuario por su DNI
        $existingUser = Usuario::where('dni', $validatedData['DNI'])->first();

        if ($existingUser) {
            // Si el usuario existe, se asocia el empleado a este usuario
            $empleado = Empleado::create([
                'usuario_id' => $existingUser->id,
                'nombre' => $existingUser->nombre,
                'apellidos' => $validatedData['apellidos'],
                'tlf' => $validatedData['tlf'],
                'direccion' => $validatedData['direccion'],
                'municipio' => $validatedData['municipio'],
                'provincia' => $validatedData['provincia'],
                'DNI' => $validatedData['DNI'],
                'anos_experiencia' => $validatedData['anos_experiencia'],
            ]);
        } else {
            // Si el usuario no existe, crear el usuario
            $request->validate([
                'nombre' => 'required|string|max:255',
                'nombreUsuario' => 'required|string|max:255|unique:usuarios,nombreUsuario',
                'email' => 'required|email|unique:usuarios,email',
                'contrasena' => 'required|string|min:8',
            ], $messages);

            $usuario = Usuario::create([
                'nombre' => $validatedData['nombre'],
                'nombreUsuario' => $validatedData['nombreUsuario'],
                'email' => $validatedData['email'],
                'contrasena' => bcrypt($validatedData['contrasena']),
            ]);

            // Crear el empleado asociado al nuevo usuario
            $empleado = Empleado::create([
                'usuario_id' => $usuario->id,
                'nombre' => $validatedData['nombre'],
                'apellidos' => $validatedData['apellidos'],
                'tlf' => $validatedData['tlf'],
                'direccion' => $validatedData['direccion'],
                'municipio' => $validatedData['municipio'],
                'provincia' => $validatedData['provincia'],
                'DNI' => $validatedData['DNI'],
                'anos_experiencia' => $validatedData['anos_experiencia'],
            ]);
        }


        DB::commit();

        return response()->json($empleado->load('usuario'), 201);

    } catch (\Exception $e) {
        // Rollback en caso de error
        DB::rollBack();
        return response()->json(['message' => 'Error al crear/asociar el empleado: ' . $e->getMessage()], 500);
    }
}

public function update(Request $request, $id)
{
    // Reglas de validación para los datos del empleado
    $rules = [
        'DNI' => 'required|string|size:9|regex:/^\d{8}[A-Z]$/',
        'apellidos' => 'sometimes|required|string|max:255',
        'tlf' => 'sometimes|required|unique:empleados,tlf,' . $id . '|digits_between:9,15|regex:/^\+?\d+$/',
        'direccion' => 'sometimes|required|string|max:255',
        'municipio' => 'sometimes|required|string|max:255',
        'provincia' => 'sometimes|required|string|max:255',
        'anos_experiencia' => 'sometimes|required|integer|max:80',
        'nombre' => 'sometimes|required|string|max:255',
        'nombreUsuario' => 'sometimes|required|string|max:255|unique:usuarios,nombreUsuario',
        'email' => 'sometimes|required|email|unique:usuarios,email',
    ];

    // Mensajes de error
    $messages = [
        'DNI.required' => 'El DNI es obligatorio.',
        'DNI.size' => 'El DNI debe tener 9 caracteres.',
        'DNI.regex' => 'El formato del DNI no es válido.',
        'tlf.unique' => 'Este número de teléfono ya está en uso.',
        'nombreUsuario.unique' => 'Este nombre de usuario ya está en uso.',
        'email.unique' => 'Este email ya está en uso.',
    ];

    // Validar los datos de la solicitud
    $validatedData = $request->validate($rules, $messages);

    DB::beginTransaction();

    try {
        // Se verifica que exista el empleado que se va a actualizar
        $empleado = Empleado::findOrFail($id);
        $oldDNI = $empleado->DNI;
        $userId = $empleado->usuario_id;

        // Buscamos el usuario asociado al empleado
        $user = Usuario::findOrFail($userId);

        // Comprobamos si el DNI ha cambiado
        if ($validatedData['DNI'] !== $oldDNI) {
            // Comprobamos si ya existe otro usuario con el nuevo DNI
            $existingUserWithNewDNI = Usuario::where('dni', $validatedData['DNI'])->where('id', '!=', $userId)->first();

            if ($existingUserWithNewDNI) {
                return response()->json(['message' => 'Ya existe otro usuario con este DNI.'], 409); // Conflict
            }

            // Se actualizar el DNI del usuario asociado
            $user->update(['dni' => $validatedData['DNI']]);
        }

        // Se actualizar los datos del empleado
        $empleado->update($validatedData);

        // Se actualizar los datos del usuario si se proporcionan y son diferentes
        $userDataToUpdate = [];
        if (isset($validatedData['nombre']) && $user->nombre !== $validatedData['nombre']) {
            $userDataToUpdate['nombre'] = $validatedData['nombre'];
        }
        if (isset($validatedData['nombreUsuario']) && $user->nombreUsuario !== $validatedData['nombreUsuario']) {
            $userDataToUpdate['nombreUsuario'] = $validatedData['nombreUsuario'];
        }
        if (isset($validatedData['email']) && $user->email !== $validatedData['email']) {
            $userDataToUpdate['email'] = $validatedData['email'];
        }

        if (!empty($userDataToUpdate)) {
            $user->update($userDataToUpdate);
        }

        DB::commit();

        return response()->json($empleado->load('usuario'), 200);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        DB::rollBack();
        return response()->json(['message' => 'Empleado no encontrado.'], 404);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'Error al actualizar el empleado: ' . $e->getMessage()], 500);
    }
}

    public function destroy($id)
    //Eliminamos al empleado, no al usuario
    {
        try {
            $empleado = Empleado::findOrFail($id);
            $empleado->delete();
            return response()->json(null, 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Empleado no encontrado.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el empleado: ' . $e->getMessage()], 500);
        }
    }
}