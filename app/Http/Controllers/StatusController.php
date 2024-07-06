<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function update($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation->status_id == 3) {
            $reservation->status_id = 2;
            $reservation->update();
            return redirect()->route('reservations.search', '$id')->with('success', 'Le status de la réservation a bien été mise à jour');
        } elseif ($reservation->status_id == 2) {
            $reservation->status_id = 1;
            $reservation->update();
            return redirect()->route('reservations.search', '$id')->with('success', 'Le status de la réservation a bien été mise à jour');
        } elseif ($reservation->status_id == 1) {
            $reservation->status_id = 3;
            $reservation->update();
            return redirect()->route('reservations.search', '$id')->with('success', 'Le status de la réservation a été remis en attente');
        } else {
            abort(403);
        }
    }
}
