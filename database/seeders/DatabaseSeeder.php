<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Testuser',
            'role' => 'SUPERADMIN',
            'email' => 'hello@example.com',
            'password' => '$2y$12$e.9Jl.6BDvB5uUQF.WMuRenLbYcW.GHL.8ee5fRFvKIh9o9PVVWkC', // 123456
        ]);

        $order = Order::factory()->create();
        OrderItem::factory()->count(3)->create([
            'order_id' => $order->id,
        ]);
    }
}
