<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();
    
        DB::table('admins')->insert([
            'username' => 'admin',
            'password' => hash::make('admin'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
      
        $item1 = $faker->numberBetween(65,70);
        $item2 = $faker->numberBetween(65,70);
        $item3 = $faker->numberBetween(65,70);
        $item4 = $faker->numberBetween(65,70);
        $item5 = $faker->numberBetween(65,70);
        $item6 = $faker->numberBetween(65,70);
        $item7 = $faker->numberBetween(65,70);
        $item8 = $faker->numberBetween(65,70);
        $item9 = $faker->numberBetween(65,70);
        $item10 = $faker->numberBetween(65,70);
        $item11 = $faker->numberBetween(65,70);
        $item12 = $faker->numberBetween(65,70);
        $item13 = $faker->numberBetween(65,70);

        DB::table('tags')->insert([
            'productID' => 1,
            'tagName' => 'immunity',
        ]);

        DB::table('tags')->insert([
            'productID' => 2,
            'tagName' => 'immunity',
        ]);

        DB::table('tags')->insert([
            'productID' => 3,
            'tagName' => 'immunity',
        ]);

        DB::table('tags')->insert([
            'productID' => 5,
            'tagName' => 'immunity',
        ]);

        DB::table('tags')->insert([
            'productID' => 6,
            'tagName' => 'immunity',
        ]);

        DB::table('tags')->insert([
            'productID' => 12,
            'tagName' => 'multivitamins',
        ]);


        DB::table('tags')->insert([
            'productID' => 1,
            'tagName' => 'sexual health vitamins',
        ]);

        DB::table('tags')->insert([
            'productID' => 2,
            'tagName' => 'sexual health vitamins',
        ]);

        DB::table('tags')->insert([
            'productID' => 4,
            'tagName' => 'nutritional foods & drinks',
        ]);

        DB::table('tags')->insert([
            'productID' => 6,
            'tagName' => 'pain relief & fever',
        ]);

        DB::table('tags')->insert([
            'productID' => 7,
            'tagName' => 'pain relief & fever',
        ]);

        DB::table('tags')->insert([
            'productID' => 5,
            'tagName' => 'digestive care',
        ]);

        DB::table('tags')->insert([
            'productID' => 10,
            'tagName' => 'lemon & ginger tea',
        ]);

        DB::table('tags')->insert([
            'productID' => 13,
            'tagName' => 'brain & memory',
        ]);

        DB::table('tags')->insert([
            'productID' => 8,
            'tagName' => 'heart & blood pressure',
        ]);

        DB::table('products')->insert([
            'product' => 'DriveMax Plus Capsule',
            'price' => $item1,
            'description' => 'Adult herbal capsule',
            'remaining' => 10,
            'max_quantity' => 10,
            'image' => 'products/drivemax.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'DriveMax Coffee',
            'price' => $item2,
            'description' => 'Herbal blend coffee mix',
            'remaining' => 10,
            'max_quantity' => 10,
            'image' => 'products/drivemax-coffee.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Guard-C Capsule',
            'price' => $item3,
            'remaining' => 10,
            'max_quantity' => 10,
            'description' => 'Vitamin Capsule',
            'image' => 'products/guard-c.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Maxan Mangosteen Coffee',
            'price' => $item4,
            'remaining' => 10,
            'max_quantity' => 10,
            'description' => 'Herbal blend coffee mix',
            'image' => 'products/maxan.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'NutriCleanse Herbal Capsule',
            'price' => $item5,
            'remaining' => 10,
            'max_quantity' => 10,
            'description' => 'Herbal capsule food suplement',
            'image' => 'products/nutri-cleanse.jfif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Paracetamol + Ibuprofen Fast Relax',
            'price' => $item6,
            'remaining' => 10,
            'max_quantity' => 10,
            'description' => 'Analgesic/Antipyretic, Non-steriodal, Anti-inflammatory drug',
            'image' => 'products/paracetamol-fastrelax.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Paracetamol + Ibuprofen Pain Relief',
            'price' => $item7,
            'remaining' => 10,
            'max_quantity' => 10,
            'description' => 'Double action pain relief',
            'image' => 'products/paracetamol-painrelief.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Power Cells Herbal Capsule',
            'price' => $item8,
            'remaining' => 10,
            'max_quantity' => 10,
            'description' => 'Herbal dietary supplement capsule',
            'image' => 'products/powercell.jfif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Power Cells Coffee',
            'price' => $item9,
            'remaining' => 10,
            'max_quantity' => 10,
            'description' => 'Herbal blend coffee flavoured soya drink mix with tongkat ali, mangosteen, malunggay and ampalaya',
            'image' => 'products/powercell-coffee.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Power Cells 6in1 Salabat',
            'price' => $item10,
            'remaining' => 10,
            'max_quantity' => 10,
            'description' => 'Hebal mix ginger brew',
            'image' => 'products/powercell-herbal.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Power Cells 60ml Liniment',
            'price' => $item11,
            'remaining' => 10,
            'max_quantity' => 10,
            'description' => 'Pain reliever and for itchiness and other minor skin disease',
            'image' => 'products/powercell-liniment.jfif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'YummyVit 120ml',
            'price' => $item12,
            'remaining' => 10,
            'max_quantity' => 10,
            'description' => 'Food suplement syrup',
            'image' => 'products/yummyvit.jfif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Curamed',
            'price' => $item13,
            'remaining' => 10,
            'max_quantity' => 10,
            'description' => 'Herbal Dietary Supplement Capsule',
            'image' => 'products/curamed.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sales')->insert([
            'productID' => 1,
            'product_name' => 'DriveMax Plus Capsule',
            'item_price' => $item1,
            'item_cost' => $faker->numberBetween(55,60),
            'shipping_charge' => 20,
            'shipping_cost' => 15,
            'total_sold' => $faker->numberBetween(10,30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sales')->insert([
            'productID' => 2,
            'product_name' => 'DriveMax Coffee',
            'item_price' => $item2,
            'item_cost' => $faker->numberBetween(55,60),
            'shipping_charge' => 20,
            'shipping_cost' => 15,
            'total_sold' => $faker->numberBetween(10,30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sales')->insert([
            'productID' => 3,
            'product_name' => 'Guard-C Capsule',
            'item_price' => $item3,
            'item_cost' => $faker->numberBetween(55,60),
            'shipping_charge' => 20,
            'shipping_cost' => 15,
            'total_sold' => $faker->numberBetween(10,30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sales')->insert([
            'productID' => 4,
            'product_name' => 'Maxan Mangosteen Coffee',
            'item_price' => $item4,
            'item_cost' => $faker->numberBetween(55,60),
            'shipping_charge' => 20,
            'shipping_cost' => 15,
            'total_sold' => $faker->numberBetween(10,30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sales')->insert([
            'productID' => 5,
            'product_name' => 'NutriCleanse Herbal Capsule',
            'item_price' => $item5,
            'item_cost' => $faker->numberBetween(55,60),
            'shipping_charge' => 20,
            'shipping_cost' => 15,
            'total_sold' => $faker->numberBetween(10,30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sales')->insert([
            'productID' => 6,
            'product_name' => 'Paracetamol + Ibuprofen Fast Relax',
            'item_price' => $item6,
            'item_cost' => $faker->numberBetween(55,60),
            'shipping_charge' => 20,
            'shipping_cost' => 15,
            'total_sold' => $faker->numberBetween(10,30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sales')->insert([
            'productID' => 7,
            'product_name' => 'Paracetamol + Ibuprofen Pain Relief',
            'item_price' => $item7,
            'item_cost' => $faker->numberBetween(55,60),
            'shipping_charge' => 20,
            'shipping_cost' => 15,
            'total_sold' => $faker->numberBetween(10,30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sales')->insert([
            'productID' => 8,
            'product_name' => 'Power Cells Herbal Capsule',
            'item_price' => $item8,
            'item_cost' => $faker->numberBetween(55,60),
            'shipping_charge' => 20,
            'shipping_cost' => 15,
            'total_sold' => $faker->numberBetween(10,30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sales')->insert([
            'productID' => 9,
            'product_name' => 'Power Cells Coffee',
            'item_price' => $item9,
            'item_cost' => $faker->numberBetween(55,60),
            'shipping_charge' => 20,
            'shipping_cost' => 15,
            'total_sold' => $faker->numberBetween(10,30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sales')->insert([
            'productID' => 10,
            'product_name' => 'Power Cells 6in1 Salabat',
            'item_price' => $item10,
            'item_cost' => $faker->numberBetween(55,60),
            'shipping_charge' => 20,
            'shipping_cost' => 15,
            'total_sold' => $faker->numberBetween(10,30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sales')->insert([
            'productID' => 11,
            'product_name' => 'Power Cells 60ml Liniment',
            'item_price' => $item11,
            'item_cost' => $faker->numberBetween(55,60),
            'shipping_charge' => 20,
            'shipping_cost' => 15,
            'total_sold' => $faker->numberBetween(10,30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sales')->insert([
            'productID' => 12,
            'product_name' => 'YummyVit 120ml',
            'item_price' => $item12,
            'item_cost' => $faker->numberBetween(55,60),
            'shipping_charge' => 20,
            'shipping_cost' => 15,
            'total_sold' => $faker->numberBetween(10,30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sales')->insert([
            'productID' => 13,
            'product_name' => 'Curamed',
            'item_price' => $item13,
            'item_cost' => $faker->numberBetween(55,60),
            'shipping_charge' => 20,
            'shipping_cost' => 15,
            'total_sold' => $faker->numberBetween(10,30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
    }

}
