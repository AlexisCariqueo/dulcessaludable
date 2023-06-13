<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'total',
        'estado',
        'paypal_order_id', 
        'transfer_proof',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function products()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    

    // Comentario: En el caso de que tu aplicación utilice una tabla 'payments' para guardar pagos.
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'order_items', 'order_id', 'productos_id')->withPivot('cantidad', 'precio');
    }

    protected static function booted()
    {
        static::deleting(function ($order) {
            foreach ($order->orderItems as $item) {
                $product = $item->producto;
                $product->stock += $item->cantidad;
                $product->save();
            }
        });
    }




}
