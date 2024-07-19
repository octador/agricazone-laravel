<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Reservation;
use App\Models\Stock;
use App\Models\User; // Exemple de modèle
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardClient()
    {
        $user = auth()->user();

        if ($user->role_id != 3) {
            return redirect()->route('dashboard');
        }


        $categories = Category::paginate(10);

        return view('dashboard.dashboardClient', compact('user', 'categories'));
    }


    public function dashboardFarmer()
    {
        $user = auth()->user();

        if($user->role_id != 2){
            return redirect()->route('dashboard');
        }


        // je recupere les stock du user connecter
        $stock = Stock::where('user_id', $user->id)->paginate(5);

        // Je vérifie si il y a des stocks pour ce user
        $hasStock = $stock->count() > 0;

        // Récupérer les ID de tous les stocks de l'utilisateur
        $stockIds = $stock->pluck('id');

        // Récupérer les réservations où le stock_id est dans les ID de stocks de l'utilisateur
        $reservations = Reservation::whereIn('stock_id', $stockIds)->with('user')->get()->load('user');

        return view('dashboard.dashboardFarmer', [
            'user' => $user,
            'stock' => $stock,
            'reservations' => $reservations,
            'hasStock' => $hasStock
        ]);
    }
}
