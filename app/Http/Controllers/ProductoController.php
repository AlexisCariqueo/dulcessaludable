<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\ImagenProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $searchName = $request->get('searchName');
        $searchPrice = $request->get('searchPrice');
        $searchStock = $request->get('searchStock');
        $searchCategory = $request->get('searchCategory');
    
        $productos = Producto::query();
    
        if($searchName != ''){
            $productos = $productos->where('name', 'like', '%' . $searchName . '%');
        }
    
        if($searchPrice != ''){
            $productos = $productos->where('precio', $searchPrice);
        }
    
        if($searchStock != ''){
            if($searchStock == 'con'){
                $productos = $productos->where('stock', '>', 0);
            }
            if($searchStock == 'sin'){
                $productos = $productos->where('stock', 0);
            }
        }
        
        if($searchCategory != ''){
            $productos = $productos->whereHas('categoria', function ($query) use ($searchCategory) {
                $query->where('nombre', $searchCategory);
            });
        }
        
    
        $productos = $productos->paginate(10);
    
        return view('admin.productos.index', compact('productos'));
    }
    


    public function create()
    {
        $categorias = Categoria::all(); 
        return view('admin.productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'descripcion' => 'required',
            'categorias_id' => 'required|exists:categorias,id',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'imagenes' => 'nullable|array',
        ]);
    
        $producto = new Producto($request->only('name', 'descripcion', 'categorias_id', 'precio', 'stock'));
        $producto->save();
    
        $this->storeProductImages($request, $producto);
    
        return redirect()->route('admin.productos.index')->with(['message' => 'Producto creado exitosamente', 'alert-type' => 'success']);
    }
        

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        $imagenes = $producto->imagenes;

        return view('admin.productos.show', compact('producto', 'imagenes'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        
        $categorias = Categoria::all(); 
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
    
        $request->validate([
            'name' => 'required',
            'descripcion' => 'required',
            'categorias_id' => 'required|exists:categorias,id',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);
    
        $this->updateProductImages($request, $producto);
        $producto->update($request->all());
    
        return redirect()->route('admin.productos.index')->with(['message' => 'Producto actualizado exitosamente', 'alert-type' => 'warning']);
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('admin.productos.index')->with(['message' => 'Producto eliminado exitosamente', 'alert-type' => 'danger']);
    }

    private function storeProductImages(Request $request, Producto $producto)
    {
        if ($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');
            $numImages = count($producto->imagenes);
            $maxImages = 3;

            foreach ($imagenes as $imagen) {
                if ($numImages >= $maxImages) {
                    break;
                }

                $ruta_imagen = $imagen->store('public/imagenes_productos');

                $imagenProducto = new ImagenProducto; 
                $imagenProducto->productos_id = $producto->id;
                $imagenProducto->ruta_imagen = $ruta_imagen;
                $imagenProducto->save();

                $numImages++;
            }
        }
    }

    public function frontendShow($producto)
    {
        $producto = Producto::with('imagenes')->findOrFail($producto);
        $imagenes = $producto->imagenes;
        return view('frontend.show', compact('producto', 'imagenes'));
    }

    public function deleteImage(Producto $producto, $imageId)
    {
       
        $image = ImagenProducto::find($imageId);
    
        if ($image && $image->productos_id == $producto->id) {
            
            Storage::delete($image->ruta_imagen);
    
           
            $image->delete();
        }
    
        return redirect()->route('admin.productos.edit', $producto->id)->with('success', 'Imagen eliminada con éxito.');
    }

    private function updateProductImages(Request $request, Producto $producto)
    {
        $deleteImages = $request->input('delete_images', []);
        foreach ($deleteImages as $imageId) {
            $image = ImagenProducto::find($imageId);
            if ($image && $image->productos_id == $producto->id) {
                Storage::delete($image->ruta_imagen);
                $image->delete();
            }
        }

    
        $this->storeProductImages($request, $producto);
    }

    public function frontendIndex()
    {
    }
    
    
}
