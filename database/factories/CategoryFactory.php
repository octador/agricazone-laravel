<?php

namespace Database\Factories;
namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    // Définir les catégories prédéfinies
    protected static $categories = [
        'Légumes',
        'Fruits',
        'Produits laitiers',
        'Viande',
        'Œufs',
        'Céréales',
        'Miel',
        'Herbes',
        'Noix',
        'Produits de boulangerie',
    ];

    public function definition()
    {
        static $index = 0;

        $categoryName = self::$categories[$index % count(self::$categories)];
        $index++;

        return [
            'name' => $categoryName,
        ];
    }
}

