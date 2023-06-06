<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('frontend.home', compact('productos'));
    }

    public function productos(Request $request)
    {
        $filtro = $request->input('filtro');
    
        if ($filtro === 'todos') {
            $productos = Producto::all();
        } else {
            $productos = Producto::where('stock', '>', 0)->get();
        }
    
        return view('frontend.productos', compact('productos'));
    }

}
