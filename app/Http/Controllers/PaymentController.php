<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        return view('payments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'order_id' => 'required',
            'payment_method' => 'required',
            'amount' => 'required',
            'paid_at' => 'required',
        ]);

        Payment::create($request->all());

        return redirect()->route('payments.index')
            ->with('success', 'Payment created successfully.');
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'user_id' => 'required',
            'order_id' => 'required',
            'payment_method' => 'required',
            'amount' => 'required',
            'paid_at' => 'required',
        ]);

        $payment->update($request->all());

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully');
    }

    public function processPaypalPayment(Request $request)
    {

        Log::info('processPaypalPayment called with request', $request->all());

        $order = Order::find($request->orderID);


        Log::info('Order found', ['order' => $order]);
        
        // Validar que el request contiene un orderID
        $request->validate([
        'orderID' => 'required'
        ]);

        // Buscar la orden en la base de datos utilizando el orderID
        $order = Order::find($request->orderID);

        // Si no se encuentra la orden, retornar una respuesta con un error
        if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
        }

        // Actualizar el estado de la orden a 'pagado'
        $order->estado = 'pagado';
        $order->save();

        // Registrar el pago en la base de datos
        Payment::create([
        'user_id' => $order->users_id,
        'order_id' => $order->id,
        'payment_method' => 'paypal', 
        'amount' => $order->total,
        'paid_at' => now(),
        ]);

        // Retornar una respuesta con un código de estado 200 (OK)
        return response()->json(['message' => 'Payment processed successfully']);
    }

}
