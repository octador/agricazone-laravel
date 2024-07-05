<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Créer 10 catégories en utilisant la factory
        \App\Models\Category::factory()->count(10)->create();
    }
}

