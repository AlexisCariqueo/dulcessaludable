<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'productos_id', 'cantidad', 'precio'];

    // Relación con la tabla Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relación con la tabla Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'productos_id');
    }


}
