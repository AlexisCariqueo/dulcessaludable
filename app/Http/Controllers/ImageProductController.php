<?php

namespace App\Http\Controllers;

use App\Models\ImagenProducto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageProductController extends Controller
{
    public function index()
    {
        $imagenesProductos = ImagenProducto::all();
        return view('imagenes_productos.index', compact('imagenesProductos'));
    }

    public function create()
    {
        return view('imagenes_productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
        ]);
    
        $imagenProducto = new ImagenProducto;
        $imagenProducto->producto_id = $request->producto_id;
    
        if ($request->hasFile('ruta_imagen')) {
            $ruta_imagen = $request->file('ruta_imagen')->store('public/imagenes_productos');
            $imagenProducto->ruta_imagen = $ruta_imagen;
        }
    
        $imagenProducto->save();
    
        return redirect()->route('imagenes_productos.index')->with('success', 'Imagen de producto creada exitosamente');
    }

    public function edit($id)
    {
        $imagenProducto = ImagenProducto::findOrFail($id);
        return view('imagenes_productos.edit', compact('imagenProducto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'ruta_imagen' => 'image', 
        ]);

        $imagenProducto = ImagenProducto::findOrFail($id);
        $imagenProducto->producto_id = $request->producto_id;

        if ($request->hasFile('ruta_imagen')) {
            $ruta_imagen = $request->file('ruta_imagen')->store('public/imagenes_productos');
            $imagenProducto->ruta_imagen = $ruta_imagen;
        }

        $imagenProducto->save();

        return redirect()->route('imagenes_productos.index')->with('success', 'Imagen de producto actualizada exitosamente');
    }

    public function destroy($productId, $imageId)
    {
        $image = ImagenProducto::where('id', $imageId)->where('producto_id', $productId)->first();
    
        if ($image) {
            Storage::delete($image->ruta_imagen);
            $image->delete();
            return redirect()->route('admin.productos.edit', $productId)->with('success', 'Imagen eliminada con éxito.');
        } else {
            return back()->withErrors(['message' => 'Image not found or does not belong to the specified product.']);
        }
    }
}

