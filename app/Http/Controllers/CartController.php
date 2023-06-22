<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Order;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartCount = 0;
    
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $cartItems = CartItem::where('user_id', $userId)->get()->load('producto');
        
            $total = 0;
            foreach ($cartItems as $item) {
                if ($item->producto) {
                    $total += $item->producto->precio * $item->quantity;
                    $cartCount += $item->quantity;
                }
            }
        } else {
            $cart = session()->get('cart', []);
        
            $total = 0;
            foreach ($cart as $id => $item) {
                $total += $item['price'] * $item['quantity'];
                $cartCount += $item['quantity'];
            }
            $cartItems = collect($cart);
        }
    
        session()->put('cartCount', $cartCount);
        
        return view('frontend.cart', compact('cartItems', 'total'));    
    }
    

    public function addToCart(Request $request)
    {
        // Validar datos
        $validatedData = $request->validate([
            'productos_id' => 'required|exists:productos,id',
            'cantidad' => 'required|numeric|min:1',
        ]);
    
        $productId = $validatedData['productos_id'];
        $quantity = $validatedData['cantidad'];
    
        $product = Producto::find($productId);
    
        if (!$product) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }
    
        if (auth()->check()) {
            $userId = auth()->user()->id;
    
            $cartItem = CartItem::firstOrCreate(
                ['user_id' => $userId, 'productos_id' => $productId],
                ['quantity' => 0]
            );
    
            if ($cartItem->quantity + $quantity > $product->stock) {
                return redirect()->back()->with('error', 'La cantidad ingresada supera la cantidad en stock.');
            }
    
            $cartItem->increment('quantity', $quantity); // incrementa en 'quantity' y no en 1
        } else {
            $cart = session()->get('cart', []);
            $cartItem = array_key_exists($productId, $cart)
                ? $cart[$productId]
                : ['id' => $product->id, 'name' => $product->name, 'quantity' => 0, 'price' => $product->precio];
    
            if ($cartItem['quantity'] + $quantity > $product->stock) {
                return redirect()->back()->with('error', 'La cantidad ingresada supera la cantidad en stock.');
            }
    
            $cartItem['quantity'] += $quantity; // incrementa en 'quantity' y no en 1
            $cart[$productId] = $cartItem;
            session()->put('cart', $cart);
        }
    
        $cartCount = session()->get('cartCount', 0);
        session()->put('cartCount', $cartCount + $quantity); // incrementa en 'quantity' y no en 1
    
        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }
    
    
    

    public function removeFromCart($itemId)
    {
        $cartCount = session()->get('cartCount', 0);

        if (auth()->check()) {
            $userId = auth()->user()->id;
            $cartItem = CartItem::where('user_id', $userId)->where('productos_id', $itemId)->first();
    
            if ($cartItem) {
                $cartCount = max(0, $cartCount - $cartItem->quantity);
                $cartItem->delete();
                session()->put('cartCount', $cartCount);
                return redirect()->back()->with('success', 'Producto eliminado del carrito.');
            }
        } else {
            $cart = session()->get('cart', []);
    
            if (isset($cart[$itemId])) {
                $cartCount = max(0, $cartCount - $cart[$itemId]['quantity']);
                unset($cart[$itemId]);
                session()->put('cart', $cart);
                session()->put('cartCount', $cartCount);
                return redirect()->back()->with('success', 'Producto eliminado del carrito.');
            }
        }
    
        return redirect()->back()->with('error', 'Producto no encontrado en el carrito.');
    }

    public function update(Request $request, $itemId)
    {
        $quantity = $request->input('quantity');
    
        if ($quantity < 1) {
            return redirect()->back()->with('error', 'La cantidad debe ser al menos 1.');
        }
    
        $product = Producto::find($itemId);
        if (!$product) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        $cartCount = 0;
    
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $cartItem = CartItem::where('user_id', $userId)->where('productos_id', $itemId)->first();
    
            if ($cartItem) {
                if ($quantity > $product->stock) {
                    return redirect()->back()->with('error', 'La cantidad ingresada supera la cantidad en stock.');
                }
    
                $cartItem->quantity = $quantity;
                $cartItem->save();

                $cartItems = CartItem::where('user_id', $userId)->get();
                foreach ($cartItems as $item) {
                    $cartCount += $item->quantity;
                }

                session()->put('cartCount', $cartCount);
                return redirect()->back()->with('success', 'Cantidad actualizada.');
            }
        } else {
            $cart = session()->get('cart', []);
    
            if (isset($cart[$itemId])) {
                if ($quantity > $product->stock) {
                    return redirect()->back()->with('error', 'La cantidad ingresada supera la cantidad en stock.');
                }
    
                $cart[$itemId]['quantity'] = $quantity;
                session()->put('cart', $cart);

                foreach ($cart as $item) {
                    $cartCount += $item['quantity'];
                }

                session()->put('cartCount', $cartCount);
                return redirect()->back()->with('success', 'Cantidad actualizada.');
            }
        }
    
        return redirect()->back()->with('error', 'Producto no encontrado en el carrito.');
    }

    public function getCartTotal() {
        $user = Auth::user();
    
        $order = Order::where('user_id', $user->id)
                      ->where('estado', 'pendiente')
                      ->first();
    

        if (!$order) {
            return response()->json(['error' => 'No hay un pedido pendiente'], 400);
        }
    
        return response()->json(['total' => $order->total]);
    }
    
    public function createOrder() {
        
        $user = Auth::user();
    
        $cartItems = CartItem::where('user_id', $user->id)->get();
    
        $order = new Order();
        $order->user_id = $user->id;
        $order->total = $cartItems->sum(function($item) {
            return $item->quantity * $item->producto->precio;
        });
        $order->estado = 'pendiente';
        $order->save();
    
        foreach ($cartItems as $item) {
            $order->products()->attach($item->producto_id, [
                'cantidad' => $item->quantity,
                'precio' => $item->producto->precio,
            ]);

            $item->delete();
        }
    
        return response()->json(['orderId' => $order->id, 'total' => $order->total]);
    }
    

}
