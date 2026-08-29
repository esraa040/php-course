<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = ['cash', 'card', 'wallet'];
        $statuses = ['paid', 'paid', 'pending', 'refunded'];

        foreach (Order::with('order_items')->get() as $index => $order) {
            $amount = 0;
            foreach ($order->order_items as $item) {
                $amount = $amount + $item->price * $item->quantity;
            }

            $status = $statuses[$index % count($statuses)];

            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->amount = $amount;
            $payment->method = $methods[$index % count($methods)];
            $payment->status = $status;
            $payment->paid_at = $status === 'paid' ? now()->subDays($index) : null;
            $payment->save();
        }
    }
}
