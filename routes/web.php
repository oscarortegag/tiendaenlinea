<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DetalleController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\OrdenController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');
Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{id}', [CategoriaController::class, 'show'])->name('categorias.show');
Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/{id}', [ClienteController::class, 'show'])->name('clientes.show');
Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
Route::get('/empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
Route::post('/empleados', [EmpleadoController::class, 'store'])->name('empleados.store');
Route::get('/empleados/{id}', [EmpleadoController::class, 'show'])->name('empleados.show');
Route::get('/empleados/{id}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit');
Route::put('/empleados/{id}', [EmpleadoController::class, 'update'])->name('empleados.update');
Route::delete('/empleados/{id}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');

Route::get('/detalles-orden', [DetalleController::class, 'index'])->name('detalles.index');
Route::get('/detalles-orden/create', [DetalleController::class, 'create'])->name('detalles.create');
Route::post('/detalles-orden', [DetalleController::class, 'store'])->name('detalles.store');
Route::get('/detalles-orden/{id}', [DetalleController::class, 'show'])->name('detalles.show');
Route::get('/detalles-orden/{id}/edit', [DetalleController::class, 'edit'])->name('detalles.edit');
Route::put('/detalles-orden/{id}', [DetalleController::class, 'update'])->name('detalles.update');
Route::delete('/detalles-orden/{id}', [DetalleController::class, 'destroy'])->name('detalles.destroy');


Route::get('/ordenes/historial', [OrdenController::class, 'historial'])->name('ordenes.historial');
Route::get('/ordenes', [OrdenController::class, 'index'])->name('ordenes.index');
Route::get('/ordenes/create', [OrdenController::class, 'create'])->name('ordenes.create');
Route::get('/ordenes/{id}', [OrdenController::class, 'show'])->name('ordenes.show');
Route::post('/ordenes', [OrdenController::class, 'store'])->name('ordenes.store');
Route::get('/ordenes/{id}/edit', [OrdenController::class, 'edit'])->name('ordenes.edit');
Route::put('/ordenes/{id}', [OrdenController::class, 'update'])->name('ordenes.update');
Route::delete('/ordenes/{id}', [OrdenController::class, 'destroy'])->name('ordenes.destroy');


require __DIR__.'/auth.php';
