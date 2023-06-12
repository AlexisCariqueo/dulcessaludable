<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function index()
    {
        $productos = Producto::paginate(1);
        return view('frontend.home', compact('productos'));
    }
    
    public function productos(Request $request)
    {
        $filtro = $request->input('filtro');
    
        if ($filtro === 'todos') {
            $productos = Producto::paginate(1);
        } else {
            $productos = Producto::where('stock', '>', 0)->paginate(1);
        }
    
        return view('frontend.productos', compact('productos'));
    }
    

}
