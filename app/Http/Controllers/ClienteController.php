<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Inertia\Inertia;



class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $clientes = Cliente::all();
        return inertia('Clientes/Index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Clientes/Create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
        ]);

        Cliente::create($request->only('nombre', 'email', 'telefono', 'direccion'));

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
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
        $cliente = Cliente::findOrFail($id);
        return inertia('Clientes/Edit', compact('cliente'));
    }
    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
        ]);

        $cliente->update($request->only('nombre', 'email', 'telefono', 'direccion'));

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
     public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
