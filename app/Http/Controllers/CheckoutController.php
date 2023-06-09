<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    // ...

    public function index()
    {
        if (auth()->guest()) {
            return redirect('login');
        }
    
        $user = auth()->user();
        $direccion = $user->direccion;
    
        $cartItems = $this->getCartItems();

        if (count($cartItems) === 0) {
            return redirect()->route('cart.index')->with('error', 'No puedes ir a la página de pago con un carrito vacío.');
        }
    
        $total = $this->calculateTotal($cartItems);
    
        return view('frontend.checkout', compact('cartItems', 'total', 'direccion'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'phone' => 'required',
        ]);
    
        try {
            $user = auth()->user();
            if (!$user) {
                return redirect('login');
            }
    
            $this->updateOrCreateAddress($request, $user);

            $cartItems = $this->getCartItems();
            $order = $this->createOrder($cartItems, $user);

            $this->createOrderItems($cartItems, $order);
    
            CartItem::where('user_id', $user->id)->delete();

            session()->put('cartCount', 0);
    
            $paymentMethod = $request->input('payment-method');
            Log::info('Payment method: '.$paymentMethod);
    
            if ($paymentMethod == 'flow') {
                return $this->initiatePayment($request, $order);
            } else if ($paymentMethod == 'transferencia') {
                return redirect()->route('frontend.checkout-transferencia', ['order' => $order->id]);
            }
        } catch (\Exception $e) {
            Log::error('Checkout process failed: '.$e->getMessage());
            return redirect()->back()->with('error', 'Error en el proceso de checkout. Por favor intente de nuevo.');
        }
    }

    private function getCartItems()
    {
        return CartItem::where('user_id', auth()->user()->id)->get()->map(function ($item) {
            return [
                'id' => $item->productos_id,
                'name' => $item->producto->name,
                'quantity' => $item->quantity,
                'price' => $item->producto->precio,
            ];
        })->toArray();
    }

    private function updateOrCreateAddress(Request $request, $user)
    {
        $direccion = $user->direccion;
        $addressData = [
            'calle' => $request->address,
            'comuna' => $request->city,
            'codigo_postal' => $request->postal_code,
        ];
        if ($direccion) {
            $direccion->update($addressData);
        } else {
            Direccion::create(array_merge($addressData, ['user_id' => $user->id]));
        }
    }

    private function createOrder($cartItems, $user)
    {
        return Order::create([
            'status' => 'pending',
            'user_id' => $user->id,
            'total' => $this->calculateTotal($cartItems),
        ]);
    }

    private function createOrderItems($cartItems, $order)
    {
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
    }

    private function calculateTotal($cartItems)
    {
        return array_reduce($cartItems, function ($total, $item) {
            return $total + $item['price'] * $item['quantity'];
        }, 0);
    }

    private function initiatePayment(Request $request, Order $order)
    {
        try {

            return redirect()->route('frontend.checkout-confirmacion', ['order' => $order->id]);
        } catch (\Exception $e) {
            Log::error('Failed to initiate payment: '.$e->getMessage());
            return redirect()->back()->with('error', 'No se pudo iniciar el pago. Por favor intente de nuevo.');
        }
    }

    public function initiateTransferencia(Request $request, Order $order)
    {
        try {

            return redirect()->route('frontend.checkout-transferencia-confirmacion', ['order' => $order->id]);
        } catch (\Exception $e) {
            Log::error('Failed to initiate transfer: '.$e->getMessage());
            return redirect()->back()->with('error', 'No se pudo iniciar la transferencia. Por favor intente de nuevo.');
        }
    }

    public function checkout()
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('producto')->get();
    
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->producto->precio;
        });
    
        $direccion = $user->direccion;
    
        $errors = [];
        foreach ($cartItems as $cartItem) {
            $producto = $cartItem->producto;
            if ($producto->stock < $cartItem['quantity']) {
                $errors[] = 'El producto "'.$producto->name.'" no tiene suficiente stock. Stock disponible: '.$producto->stock;
            }
        }
    
        if (!empty($errors)) {
            
            return view('frontend.checkout', compact('cartItems', 'total', 'direccion', 'errors'));
        }
    
        // Pasar los datos a la vista
        return view('frontend.checkout', compact('cartItems', 'total', 'direccion'));
    }
    
    
    

    public function processPayment(Request $request) {
        
        $cartItems = $this->getCartItems();
    
       
        $total = array_reduce($cartItems, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    
       
        foreach ($cartItems as $cartItem) {
            $producto = Producto::find($cartItem['id']);
            if ($producto->stock < $cartItem['quantity']) {
                return redirect()->back()->with('error', 'El producto "'.$producto->name.'" no tiene suficiente stock. Stock disponible: '.$producto->stock);
            }
        }
    
       
        $order = new Order;
        $order->users_id = auth()->id(); 
        $order->total = $total;
    
        
    
        $order->save();
    
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'productos_id' => $cartItem['id'],
                'cantidad' => $cartItem['quantity'],
                'precio' => $cartItem['price'],
            ]);
            
           
            $producto = Producto::find($cartItem['id']);
            $producto->stock -= $cartItem['quantity'];
            $producto->save();
        }
    
        
        CartItem::where('user_id', auth()->id())->delete();

        session()->put('cartCount', 0);
    
       
        if ($request->get('payment-method') === 'transferencia') {
            return redirect()->route('frontend.checkout.transferencia', ['order' => $order->id]);
        } else if ($request->get('payment-method') === 'flow') {
           
        } else {
            
        }
    }
    
    
    

    public function showTransferencia(Order $order)
    {
        $productos = $order->orderItems()->with('producto')->get();
        
        return view('frontend.checkout-transferencia', [
            'order' => $order,
            'productos' => $productos,
        ]);
    }



    

}

