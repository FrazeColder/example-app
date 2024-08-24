<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OrderFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $shopifyId = fake()->unique()->randomDigit();

        return [
            'shopify_id' => fake()->unique()->randomDigit(),
            'order_number' => fake()->unique()->randomDigit(),
            'status' => Order::OPEN,
            'financial_status' => "PENDING",
            'fulfillment_status' => "PENDING",
            'email' => fake()->email,
            'phone' => fake()->phoneNumber,
            'fulfillment_provider' => "Merch One",
            'fulfillment_id' => fake()->unique()->randomDigit(),
            'shipment_provider' => "DHL",
            'shipment_tracking_number' => fake()->unique()->randomDigit(),
            'stop_refreshing' => false,
            'signed_url' => 'https://example.com',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
