<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ==================== Users ====================
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // ==================== Categories ====================
        $elektronik = Category::create(['name' => 'Elektronik']);
        $gaming = Category::create(['name' => 'Gaming']);
        $aksesoris = Category::create(['name' => 'Aksesoris']);

        // ==================== Products ====================
        $laptopGaming = Product::create([
            'name' => 'Laptop Gaming',
            'description' => 'Laptop gaming performa tinggi',
            'price' => 15000000,
            'stock' => 10,
            'user_id' => $admin->id,
        ]);

        $mouse = Product::create([
            'name' => 'Mouse',
            'description' => 'Mouse wireless ergonomis',
            'price' => 250000,
            'stock' => 50,
            'user_id' => $admin->id,
        ]);

        $keyboard = Product::create([
            'name' => 'Keyboard Mechanical',
            'description' => 'Keyboard mechanical RGB',
            'price' => 750000,
            'stock' => 30,
            'user_id' => $admin->id,
        ]);

        $headset = Product::create([
            'name' => 'Headset Gaming',
            'description' => 'Headset gaming surround sound',
            'price' => 500000,
            'stock' => 25,
            'user_id' => $admin->id,
        ]);

        // ==================== Pivot: category_product (many-to-many) ====================
        // Laptop Gaming -> Elektronik, Gaming
        $laptopGaming->categories()->attach([$elektronik->id, $gaming->id]);

        // Mouse -> Elektronik, Aksesoris
        $mouse->categories()->attach([$elektronik->id, $aksesoris->id]);

        // Keyboard -> Elektronik, Gaming, Aksesoris
        $keyboard->categories()->attach([$elektronik->id, $gaming->id, $aksesoris->id]);

        // Headset -> Elektronik, Gaming
        $headset->categories()->attach([$elektronik->id, $gaming->id]);
    }
}
