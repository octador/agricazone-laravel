<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User; // Exemple de modèle
use App\Models\Order; // Exemple de modèle

class DashboardController extends Controller
{
    public function index()
    {
        // Exemple d'agrégation de données
        $userCount = User::count();
        $categories = Category::all();
        

        // Passer les données à la vue du tableau de bord
        return view('dashboard', compact('userCount', 'categories'));
    }

    // Vous pouvez ajouter d'autres méthodes ici si nécessaire
}
