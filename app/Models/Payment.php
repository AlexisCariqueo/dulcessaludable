<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments'; // Nombre de la tabla

    protected $fillable = [
        'user_id',
        'order_id',
        'payment_method',
        'amount',
        'paid_at',
    ];

    protected $dates = [
        'paid_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
