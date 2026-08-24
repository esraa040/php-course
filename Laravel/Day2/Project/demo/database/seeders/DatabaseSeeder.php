<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
            'role'  => 'admin',
        ]);

        $users = User::factory(3)->create();
        $users->prepend($admin);

        $categories = [];
        foreach ([
            ['Laptops', 'Portable computers'],
            ['Phones',  'Smart phones and accessories'],
            ['Books',   'Programming and study books'],
        ] as $row) {
            $category = new Category();
            $category->name        = $row[0];
            $category->description = $row[1];
            $category->save();
            $categories[] = $category;
        }

        $products = [];
        foreach ([
            [0, 'Dell Inspiron', 780.00, 10],
            [0, 'HP Pavilion',   650.50,  7],
            [1, 'Samsung A55',   320.00, 25],
            [1, 'iPhone 13',     899.99,  5],
            [2, 'Clean Code',     35.75, 40],
            [2, 'PHP Objects',    42.00, 15],
        ] as $row) {
            $product = new Product();
            $product->name        = $row[1];
            $product->description = $row[1] . ' - sample product';
            $product->price       = $row[2];
            $product->quantity    = $row[3];
            $product->category_id = $categories[$row[0]]->id;
            $product->save();
            $products[] = $product;
        }

        foreach ($users as $user) {
            for ($n = 0; $n < 2; $n++) {

                $order = new Order();
                $order->user_id = $user->id;
                $order->save();

                foreach (collect($products)->random(2) as $product) {
                    $item = new Order_Item();
                    $item->order_id   = $order->id;
                    $item->product_id = $product->id;
                    $item->quantity   = rand(1, 3);
                    $item->price      = $product->price;
                    $item->save();
                }
            }
        }
    }
}
