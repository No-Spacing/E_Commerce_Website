<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('products')->insert([
            'product' => 'DriveMax Plus Capsule',
            'price' => $faker->numberBetween(30,60),
            'description' => 'Adult herbal capsule',
            'image' => 'products/drivemax.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'DriveMax Coffee',
            'price' => $faker->numberBetween(30,60),
            'description' => 'Herbal blend coffee mix',
            'image' => 'products/drivemax-coffee.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Guard-C Capsule',
            'price' => $faker->numberBetween(30,60),
            'description' => 'Vitamin Capsule',
            'image' => 'products/guard-c.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Maxan Mangosteen Coffee',
            'price' => $faker->numberBetween(30,60),
            'description' => 'Herbal blend coffee mix',
            'image' => 'products/maxan.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'NutriCleanse Herbal Capsule',
            'price' => $faker->numberBetween(30,60),
            'description' => 'Herbal capsule food suplement',
            'image' => 'products/nutri-cleanse.jfif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Paracetamol + Ibuprofen Fast Relax',
            'price' => $faker->numberBetween(30,60),
            'description' => 'Analgesic/Antipyretic, Non-steriodal, Anti-inflammatory drug',
            'image' => 'products/paracetamol-fastrelax.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Paracetamol + Ibuprofen Pain Relief',
            'price' => $faker->numberBetween(30,60),
            'description' => 'Double action pain relief',
            'image' => 'products/paracetamol-painrelief.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Power Cells Herbal Capsule',
            'price' => $faker->numberBetween(30,60),
            'description' => 'Herbal dietary supplement capsule',
            'image' => 'products/powercell.jfif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Power Cells Coffee',
            'price' => $faker->numberBetween(30,60),
            'description' => 'Herbal blend coffee flavoured soya drink mix with tongkat ali, mangosteen, malunggay and ampalaya',
            'image' => 'products/powercell-coffee.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Power Cells 6in1 Salabat',
            'price' => $faker->numberBetween(30,60),
            'description' => 'Hebal mix ginger brew',
            'image' => 'products/powercell-herbal.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'Power Cells 60ml Liniment',
            'price' => $faker->numberBetween(30,60),
            'description' => 'Pain reliever and for itchiness and other minor skin disease',
            'image' => 'products/powercell-liniment.jfif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product' => 'YummyVit 120ml ',
            'price' => $faker->numberBetween(30,60),
            'description' => 'Food suplement syrup',
            'image' => 'products/yummyvit.jfif',
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
