<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function index()
    {
        $productos = Producto::orderBy('updated_at', 'desc')
                    ->orderBy('stock', 'desc')
                    ->paginate(10);
        return view('frontend.home', compact('productos'));
    }
    
    public function productos(Request $request)
    {
        $filtro = $request->input('filtro');
    
        if ($filtro === 'todos') {
            $productos = Producto::orderBy('updated_at', 'desc')
                    ->orderBy('stock', 'desc')
                    ->paginate(10);
        } else {
            $productos = Producto::where('stock', '>', 0)
                    ->orderBy('updated_at', 'desc')
                    ->orderBy('stock', 'desc')
                    ->paginate(10);
        }
    
        return view('frontend.productos', compact('productos'));
    }
    
    

}
