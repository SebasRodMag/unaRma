<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\SpecialtyController;
use App\Http\Controllers\Api\EmployeeSpecialtyController;

// Ruta de ejemplo para la API
Route::get('register', [AuthController::class, 'register']);

// Otra ruta de ejemplo
Route::middleware('api')->post('/data', function (Request $request) {
    return response()->json(['received' => $request->all()]);
});

// Ruta para obtener la lista de empleados
Route::get('/empleados', [EmployeeController::class, 'index'])->name('empleados.index');

// Ruta para obtener un empleado por ID
Route::get('/empleados/{id}', [EmployeeController::class, 'show'])->name('empleados.show');

// Ruta para crear un nuevo empleado
Route::post('/empleados', [EmployeeController::class, 'store'])->name('empleados.store');

// Ruta para actualizar un empleado existente
Route::put('/empleados/{id}', [EmployeeController::class, 'update'])->name('empleados.update');

// Ruta para eliminar un empleado
Route::delete('/empleados/{id}', [EmployeeController::class, 'destroy'])->name('empleados.destroy');

// Ruta para obtener todas las especialidades
Route::get('/especialidades', [SpecialtyController::class, 'index'])->name('especialidades.index');

// Ruta para obtener una especialidad por ID
Route::get('/especialidades/{id}', [SpecialtyController::class, 'show'])->name('especialidades.show');

// Ruta para crear una nueva especialidad
Route::post('/especialidades', [SpecialtyController::class, 'store'])->name('especialidades.store');

// Ruta para actualizar una especialidad existente
Route::put('/especialidades/{id}', [SpecialtyController::class, 'update'])->name('especialidades.update');

// Ruta para eliminar una especialidad
Route::delete('/especialidades/{id}', [SpecialtyController::class, 'destroy'])->name('especialidades.destroy');

// Ruta para asignar un especialidad a un empleado
Route::post('/empleados/{empleadoId}/especialidades/{especialidadId}', [EmployeeSpecialtyController::class, 'asignarEspecialidad']);

// Ruta para eliminar una especialidad de un empleado
Route::delete('/empleados/{empleadoId}/especialidades/{especialidadId}', [EmployeeSpecialtyController::class, 'eliminarEspecialidad']);

// Ruta para obtener las especialidades de un empleado
Route::get('/empleados/{empleadoId}/especialidades', [EmployeeSpecialtyController::class, 'obtenerEspecialidadesEmpleado']);
