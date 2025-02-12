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
    
        $adminCheck = DB::table('admins')
        ->select('username')
        ->where('username','admin')
        ->first();

        if(!$adminCheck){
            DB::table('admins')->insert([
                'username' => 'admin',
                'password' => hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
      
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
    }

}
