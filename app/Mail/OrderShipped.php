<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->markdown('emails.orders.shipped')
            ->subject('Su pedido ha sido enviado')
            ->with([
                'order' => $this->order,
                'user' => $this->order->user,
                'direccion' => $this->order->user->direccion,
                'telefono' => $this->order->user->telefono,
                'orderItems' => $this->order->productos,
            ]);
    }
    
}
