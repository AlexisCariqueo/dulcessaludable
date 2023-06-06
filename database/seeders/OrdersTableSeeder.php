<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Encuentra el primer usuario
        $user = User::first();

        if ($user) {
            // Crea algunas órdenes para este usuario
            for ($i = 0; $i < 10; $i++) {
                Order::create([
                    'users_id' => $user->id,
                    'total' => rand(100, 1000), // Un total aleatorio
                    'estado' => 'pendiente',
                    'paypal_order_id' => 'TEST'.rand(1000, 9999), // Un ID de orden de PayPal aleatorio
                ]);
            }
        }
    }
}
