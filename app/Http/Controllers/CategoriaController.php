<?php

namespace App\Http\Controllers;

use App\Models\Categoria; 
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $categorias = Categoria::all(); // Obtener todas las categorías

    return Inertia::render('Categorias/Index', [
        'categorias' => $categorias,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return Inertia::render('Categorias/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'descripcion' => 'required|string|max:255',
    ]);

    Categoria::create([
        'descripcion' => $request->descripcion,
    ]);

    return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
{
    $categoria = Categoria::findOrFail($id);
    return Inertia::render('Categorias/Edit', [
        'categoria' => $categoria,
    ]);
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validar los datos recibidos
    $request->validate([
        'descripcion' => 'required|string|max:255',
    ]);

    // Buscar la categoría a actualizar
    $categoria = Categoria::findOrFail($id);

    // Actualizar la descripción
    $categoria->descripcion = $request->descripcion;
    $categoria->save();

    // Redirigir a la lista de categorías con mensaje de éxito
    return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
}

    /**
     * Remove the specified resource from storage.
     */
  public function destroy($id)
{
    $categoria = Categoria::findOrFail($id);
    $categoria->delete();

    return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente.');
}
}
