<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = new User();
        $admin->name = 'Admin User';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('password');
        $admin->role = 'admin';
        $admin->save();

        $users = [$admin];

        foreach ([['Sara Ali', 'sara@example.com'], ['Omar Nabil', 'omar@example.com']] as $row) {
            $user = new User();
            $user->name = $row[0];
            $user->email = $row[1];
            $user->password = Hash::make('password');
            $user->role = 'user';
            $user->save();
            $users[] = $user;
        }

        $categories = [];
        foreach ([
            ['Electronics', 'Devices and gadgets powered by electricity.'],
            ['Games', 'Fun activities and entertainment for all ages.'],
            ['Movies', 'Films created for entertainment, storytelling, and enjoyment.'],
            ['Software', 'Programs and applications used on computers and devices.'],
        ] as $row) {
            $category = new Category();
            $category->name = $row[0];
            $category->description = $row[1];
            $category->save();
            $categories[$row[0]] = $category;
        }

        $products = [];
        foreach ([
            ['Microsoft Office', 'Software', 'A suite of productivity tools for documents, spreadsheets, and presentations.', 2000.00, 0],
            ['Smartphone', 'Electronics', 'A smart mobile device for communication, apps, and entertainment.', 1000.00, 2],
            ['Chess Board', 'Games', 'A board used for playing the classic game of chess.', 500.00, 1],
            ['Avengers DVD', 'Movies', 'A superhero film collection packed with action and adventure.', 150.00, 4],
        ] as $row) {
            $product = new Product();
            $product->name = $row[0];
            $product->description = $row[2];
            $product->price = $row[3];
            $product->quantity = $row[4];
            $product->category_id = $categories[$row[1]]->id;
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
                    $item->order_id = $order->id;
                    $item->product_id = $product->id;
                    $item->quantity = rand(1, 3);
                    $item->price = $product->price;
                    $item->save();
                }
            }
        }

        $this->call(PaymentSeeder::class);
    }
}
