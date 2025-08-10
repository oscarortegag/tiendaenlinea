<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Orden;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Detalle;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $ordenes = Orden::with(['producto', 'cliente', 'empleado', 'detalle'])->get();

        return Inertia::render('Ordenes/Index', [
            'ordenes' => $ordenes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $clientes = Cliente::all();
        $empleados = Empleado::all();
        $detalles = Detalle::with('producto')->get();


        return Inertia::render('Ordenes/Create', [
            'productos' => $productos,
            'clientes' => $clientes,
            'empleados' => $empleados,
            'detalles' => $detalles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'empleado_id' => 'required|exists:empleados,id',
        'detalle_id' => 'required|exists:detalles_ordenes,id',
    ]);

    
    $detalle = Detalle::findOrFail($request->detalle_id);
    $producto_id = $detalle->producto_id;

    Orden::create([
        'cliente_id' => $request->cliente_id,
        'empleado_id' => $request->empleado_id,
        'detalle_id' => $request->detalle_id,
        'producto_id' => $producto_id,
    ]);

    return redirect()->route('ordenes.index')->with('success', 'Orden creada correctamente.');
}

    /**
     * Display the specified resource.
     */
   public function show(string $id)
{
    $orden = Orden::with(['detalle.producto', 'cliente', 'empleado'])
        ->findOrFail($id);

    return Inertia::render('Ordenes/Show', [
        'orden' => $orden,
    ]);
}

    /**
     * Show the form for editing the specified resource.
     */
  public function edit($id)
{
    $orden = Orden::with(['producto', 'cliente', 'empleado', 'detalle'])->findOrFail($id);
    $productos = Producto::all();
    $clientes = Cliente::all();
    $empleados = Empleado::all();
    $detalles = Detalle::with('producto')->get();  

    return Inertia::render('Ordenes/Edit', [
        'orden' => $orden,
        'productos' => $productos,
        'clientes' => $clientes,
        'empleados' => $empleados,
        'detalles' => $detalles,
    ]);
}

public function historial()
{
    $ordenes = Orden::with(['detalle.producto', 'cliente', 'empleado'])->get();

    return Inertia::render('Ordenes/Historial', [
        'ordenes' => $ordenes,
    ]);
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cliente_id' => 'required|exists:clientes,id',
            'empleado_id' => 'required|exists:empleados,id',
            'detalle_id' => 'required|exists:detalles_ordenes,id',
        ]);

        $orden = Orden::findOrFail($id);
        $orden->update($request->all());

        return redirect()->route('ordenes.index')->with('success', 'Orden actualizada correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
     public function destroy($id)
    {
        $orden = Orden::findOrFail($id);
        $orden->delete();

        return redirect()->route('ordenes.index')->with('success', 'Orden eliminada correctamente.');
    }
}
