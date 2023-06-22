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
        
        
        $request->validate([
        'orderID' => 'required'
        ]);

        
        $order = Order::find($request->orderID);

        
        if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
        }

        $order->estado = 'pagado';
        $order->save();

       
        Payment::create([
        'user_id' => $order->users_id,
        'order_id' => $order->id,
        'payment_method' => 'paypal', 
        'amount' => $order->total,
        'paid_at' => now(),
        ]);

        return response()->json(['message' => 'Payment processed successfully']);
    }

}
