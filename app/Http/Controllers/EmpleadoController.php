<?php

namespace App\Http\Controllers;

use App\Models\Empleado; 
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $empleados = Empleado::all();
        return inertia('Empleados/Index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           return inertia('Empleados/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
      public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados,email',
            'puesto' => 'required|string|max:255',
        ]);

        Empleado::create($request->only('nombre', 'email', 'puesto'));

        return redirect()->route('empleados.index')->with('success', 'Empleado creado correctamente.');
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
        $empleado = Empleado::findOrFail($id);
        return inertia('Empleados/Edit', compact('empleado'));
    }

    // Actualizar empleado
    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados,email,' . $empleado->id,
            'puesto' => 'required|string|max:255',
        ]);

        $empleado->update($request->only('nombre', 'email', 'puesto'));

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente.');
    }


   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente.');
    }
}
