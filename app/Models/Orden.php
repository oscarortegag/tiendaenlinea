<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'ordenes_compra';

    protected $fillable = [
        'producto_id',
        'cliente_id',
        'empleado_id',
        'detalle_id'
    ];

    // Relación con Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relación con Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

 // Relación con detalles_ordenes
    public function detalle()
    {
        return $this->belongsTo(Detalle::class);
    }

   
}