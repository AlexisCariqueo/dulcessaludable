<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderCompleted;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;


class OrderController extends Controller
{
    
    public function index()
    {
        $orders = Order::paginate(10);

        $orderStatuses = ['pendiente', 'pagado', 'enviando', 'entregado'];

        return view('admin.ordenes.index', ['orders' => $orders, 'orderStatuses' => $orderStatuses]);
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'total' => 'required',
            'estado' => 'required',
            'paypal_order_id' => 'required', // Asegúrate de que estás recibiendo este dato
        ]);
    
        $order = Order::create($validatedData);
    
        return response()->json($order, 201);
    }

    public function show(Order $order)
    {
        $orderStatuses = ['pendiente', 'pagado', 'enviando', 'entregado'];
        
        return view('admin.ordenes.show', compact('order', 'orderStatuses'));
    }
    
    
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'total' => 'required',
            'estado' => 'required',
        ]);

        $order->update($validatedData);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }


    public function getOrderTotal($orderId) {
        $order = Order::find($orderId);
    
        if (!$order) {
            return response()->json(['error' => 'No se encontró la orden'], 404);
        }
    
        return response()->json(['total' => $order->total]);
    }
    
    public function getOrderStatus($orderId) {
        $order = Order::find($orderId);
    
        if (!$order) {
            return response()->json(['error' => 'No se encontró la orden'], 404);
        }
    
        return response()->json(['estado' => $order->estado]);
    }
    
    public function updateOrderStatus(Request $request, $orderId) {
        $validated = $request->validate([
            'estado' => 'required|in:pendiente,pagado,enviando,entregado',
        ]);
    
        $order = Order::findOrFail($orderId);
    
        // Registra el estado original y el nuevo estado
        Log::info('Estado original: ' . $order->estado);
        Log::info('Nuevo estado: ' . $validated['estado']);
    
        $order->estado = $validated['estado'];
        $order->save();
    
        // Verifica si el estado se actualizó correctamente
        $order = Order::findOrFail($orderId);  // Recupera la orden desde la base de datos otra vez
        Log::info('Estado después de guardar: ' . $order->estado);
    
        return response()->json(['success' => 'El estado de la orden se actualizó con éxito.']);
    }
    
    
    public function storeTransferProof(Request $request, Order $order)
    {
        $request->validate([
            'proof' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);
    
        if ($request->hasFile('proof')) {
            $fileName = 'order_'.$order->id.'_proof.'.$request->file('proof')->getClientOriginalExtension();
            $path = $request->file('proof')->storeAs('transfer_proofs', $fileName, 'public');
    
            if ($order->estado === null) {
                $order->estado = 'Pendiente';
            }
    
            $order->update([
                'transfer_proof' => $path,
                'estado' => $order->estado 
            ]);
    
            $orderItems = $order->orderItems;
    
            // Envía el correo de orden completada.
            Mail::to($order->user->email)->send(new OrderCompleted($order, $order->user, $orderItems));
            Mail::to('panaderiaypasteleria.olivias@gmail.com')->send(new OrderCompleted($order, $order->user, $orderItems));
        }
    
        // Redirige a la vista de confirmación.
        return redirect()->route('confirmation.view');
    }
    
    
    
    public function deleteOrder($id)
    {
            
        $order = Order::find($id);

        
        if ($order && empty($order->transfer_proof)) {
            $order->delete();
        }

        
        return redirect()->route('admin.ordenes.index');
    }

    public function changeStatus(Order $order, Request $request)
    {
        $order->update([
            'estado' => $request->estado,
        ]);
    
        if ($request->estado == 'enviando') { // Cambiado a 'enviando'
            Mail::to($order->user->email)->send(new OrderShipped($order));
            Mail::to('panaderiaypasteleria.olivias@gmail.com')->send(new OrderShipped($order));
    
            Log::info('Se ha enviado un correo electrónico al cliente y a la dirección de copia.');
    
            return redirect()->route('admin.ordenes.index', $order)->with([
                'status' => 'Estado de la orden actualizado con éxito.',
                'email_status' => 'Se ha enviado un correo electrónico al cliente y a la dirección de copia.',
            ]);
        }
    
        return redirect()->route('admin.ordenes.index', $order)->with('status', 'Estado de la orden actualizado con éxito.');
    }
    
    
    
    
    
}
