<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function update($id)
    {
        dd($id);
        // $reservation = Reservation::find($id);
    }
}
