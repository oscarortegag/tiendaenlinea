<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table = 'detalles_ordenes'; 

    protected $fillable = [
        'cantidad',
        'precio',
        'producto_id',
    ];

  
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

   
}