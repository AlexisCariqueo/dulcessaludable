<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenProducto extends Model
{
    use HasFactory;

    protected $table = 'imagen_productos';

    protected $fillable = [
        'productos_id',
        'ruta_imagen',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'productos_id');
    }

}
