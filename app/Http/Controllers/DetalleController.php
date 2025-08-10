<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Detalle;
use App\Models\Producto;

class DetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $detalles = Detalle::with('producto')->get();

    return inertia('Detalles/Index', [
        'detalles' => $detalles
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        return inertia('Detalles/Create', [
            'productos' => $productos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
      public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($producto->stock < $request->cantidad) {
            return back()->withErrors([
                'cantidad' => 'Stock insuficiente para este producto'
            ]);
        }

        $precioTotal = $producto->precio * $request->cantidad;

        Detalle::create([
            'producto_id' => $producto->id,
            'cantidad' => $request->cantidad,
            'precio' => $precioTotal
        ]);

        $producto->stock -= $request->cantidad;
        $producto->save();

        return redirect()->route('detalles.index')->with('success', 'Detalle registrado correctamente.');
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
    $detalle = Detalle::findOrFail($id);
    $productos = Producto::all();

    return inertia('Detalles/Edit', [
        'detalle' => $detalle,
        'productos' => $productos
    ]);
}

public function update(Request $request, $id)
{
    $detalle = Detalle::findOrFail($id);

    $request->validate([
        'producto_id' => 'required|exists:productos,id',
        'cantidad' => 'required|integer|min:1'
    ]);

    $producto = Producto::findOrFail($request->producto_id);

    // Si el producto es diferente o la cantidad cambió, verificamos el stock
    if ($detalle->producto_id != $producto->id || $detalle->cantidad != $request->cantidad) {
        // Si es un cambio de cantidad, devolvemos el stock anterior antes de validar
        $producto->stock += $detalle->cantidad;

        if ($producto->stock < $request->cantidad) {
            return back()->withErrors([
                'cantidad' => 'Stock insuficiente para este producto'
            ]);
        }

        // Reducimos el stock según la nueva cantidad
        $producto->stock = $producto->stock - $request->cantidad;
        $producto->save();
    }

    $precioTotal = $producto->precio * $request->cantidad;

    $detalle->update([
        'producto_id' => $producto->id,
        'cantidad' => $request->cantidad,
        'precio' => $precioTotal
    ]);

    return redirect()->route('detalles.index')->with('success', 'Detalle actualizado correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $detalle = Detalle::findOrFail($id);

    // Al eliminar, devolvemos el stock al producto
    $producto = Producto::findOrFail($detalle->producto_id);
    $producto->stock += $detalle->cantidad;
    $producto->save();

    $detalle->delete();

    return redirect()->route('detalles.index')->with('success', 'Detalle eliminado correctamente.');
}
}
