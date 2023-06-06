<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Collection;

class OrderCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;
    public $orderItems;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, User $user, Collection $orderItems)
    {
        $this->order = $order;
        $this->user = $user;
        $this->orderItems = $orderItems;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order_completed')
                    ->subject('Gracias Por comprar, Tu Orden esta en Pendinte')
                    ->with([
                        'order' => $this->order,
                        'user' => $this->user,
                        'orderItems' => $this->orderItems
                    ]);
    }
}
