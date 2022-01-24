<?php

namespace Database\Factories\Order;

use App\Models\Order\Order;
use App\Models\Order\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    #[ArrayShape(['content' => "array", 'status' => "mixed"])]
    public function definition(): array
    {
        return [
            'content' => [
                'user' => [
                    'name' => $this->faker->name,
                    'phone_number' => $this->faker->phoneNumber,
                    'email' => $this->faker->email,
                    'address' => $this->faker->text,
                ],
                'books' => [
                    [
                        'id' => $this->faker->numberBetween(1,8),
                        'name' => $this->faker->name,
                    ],
                    [
                        'id' => $this->faker->numberBetween(1,8),
                        'name' => $this->faker->name,
                    ]
                ]
            ],
            'status' => $this->faker->randomElement([OrderStatus::Delivered->name, OrderStatus::Processed->name, OrderStatus::Pending->name])
        ];
    }
}
