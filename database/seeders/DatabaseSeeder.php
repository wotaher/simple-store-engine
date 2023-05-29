<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.pl',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Mod',
            'email' => 'mod@mod.pl',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => 'mod'
        ]);

        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => 'Product NO ' . $i,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi rhoncus ipsum dictum, placerat purus quis, consequat purus. Etiam lorem arcu, ullamcorper vitae semper quis, condimentum eget orci. Fusce in lectus a mauris eleifend euismod. Vestibulum non tempor orci. Morbi volutpat quam eu lacus pretium, ac varius enim mattis. Nulla sapien libero, posuere porta elementum eget, elementum sed erat. Pellentesque sem quam, blandit non convallis nec, iaculis sit amet urna. Cras varius id neque vehicula tristique.',
                'price' => $i * 100,
            ]);
        }

        Order::create([
            'name' => 'First Last',
            'email' => 'emailaddress@gmail.com',
            'phone' => '123123123',
            'address' => 'at home 1/2',
            'zip_code' => '12-234',
            'city' => 'Poznan',
            'user_id' => 1,
        ]);

        OrderDetail::create([
            'product_id' => 1,
            'order_id' => 1,
            'unit_price' => 100,
            'quantity' => 2,
            'product_name' => 'product name at the moment of order creation'
        ]);

        OrderDetail::create([
            'product_id' => 2,
            'order_id' => 1,
            'unit_price' => 2040,
            'quantity' => 5,
            'product_name' => 'product name at the moment of order creation 2'
        ]);
    }
}
