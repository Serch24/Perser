<?php

namespace Database\Seeders;

use App\Models\hasUploadProducts;
use App\Models\Products;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Products::factory(15)->create()->each(function ($product) {
            $user = User::factory()->create();
            hasUploadProducts::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
        });
    }
}
