<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Producto extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categorias_id');
    }
    public function imagenes()
    {
        return $this->hasMany(ImagenProducto::class, 'productos_id');
    }   


    protected $table = 'productos';

    protected $fillable = [
        'name',
        'descripcion',
        'categorias_id',
        'slug',
        'precio',
        'stock',
    ];
    

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($producto) {
            $producto->slug = Str::slug($producto->name);
        });

        static::deleting(function ($producto) {
            $producto->imagenes->each->delete();
        });
    }

    public function cartItems()
    {
    return $this->hasMany(CartItem::class, 'productos_id');
    }

    public function isTortaEntera()
    {
        return $this->categorias_id == 1;
    }

    

}
