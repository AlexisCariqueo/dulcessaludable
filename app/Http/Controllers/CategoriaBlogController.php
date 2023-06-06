<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaBlog;


class CategoriaBlogController extends Controller
{
    public function index()
{
    $categorias = CategoriaBlog::all();
    return view('admin.categorias-blog.index', compact('categorias'));
}

public function create()
{
    return view('admin.categorias-blog.create');
}

public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|max:255|unique:categoria_blog',
    ]);

    $categoria = new CategoriaBlog([
        'nombre' => $request->get('nombre'),
    ]);

    $categoria->save();

    return redirect('/admin/categorias-blog')->with('success', 'Categoría creada correctamente');
}

public function edit($id)
{
    $categoria = CategoriaBlog::find($id);
    return view('admin.categorias-blog.edit', compact('categoria'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|max:255|unique:categoria_blog,nombre,' . $id,
    ]);

    $categoria = CategoriaBlog::find($id);
    $categoria->nombre = $request->get('nombre');
    $categoria->save();

    return redirect('/admin/categorias-blog')->with('success', 'Categoría actualizada correctamente');
}

public function destroy($id)
{
    $categoria = CategoriaBlog::find($id);
    $categoria->delete();

    return redirect('/admin/categorias-blog')->with('success', 'Categoría eliminada correctamente');
}
}
