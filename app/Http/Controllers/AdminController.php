<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;


class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        $productCount = Producto::count();
        $PostCount = Post::count(); 
    
        $orderCounts = [
            'noPaid' => Order::where('estado', null)->count(),
            'pending' => Order::where('estado', 'pendiente')->count(),
            'paid' => Order::where('estado', 'pagado')->count(),
            'sent' => Order::where('estado', 'enviado')->count(),
            'completed' => Order::where('estado', 'entregado')->count(),
        ];
        
        return view('admin.dashboard', compact('userCount', 'productCount','PostCount', 'orderCounts'));
    }
    
}
