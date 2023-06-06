<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categoria::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Categoria::all();
        return view('admin.productos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:categories|max:255',
            'descripcion' => 'required',
        ]);

        $category = new Categoria;
        $category->nombre = $request->nombre;
        $category->descripcion = $request->descripcion;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Categoría creada exitosamente');
    }

    public function edit($id)
    {
        $category = Categoria::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|unique:categories|max:255',
            'descripcion' => 'required',
        ]);

        $category = Categoria::findOrFail($id);
        $category->nombre = $request->nombre;
        $category->descripcion = $request->descripcion;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Categoría actualizada exitosamente');
    }

    public function destroy($id)
    {
        $category = Categoria::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Categoría eliminada exitosamente');
    }
}