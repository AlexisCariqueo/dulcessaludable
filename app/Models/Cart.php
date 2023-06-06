<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'productos_id', 'quantity', 'user_id'];

    public function product()
    {
        return $this->belongsTo(Producto::class, 'productos_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'productos_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
