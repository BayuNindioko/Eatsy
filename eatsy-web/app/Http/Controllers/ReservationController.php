<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function registration($id)
    {
        $table = Table::findOrFail($id);
        return response()->json($table);
    }

    public function login(Request $request, $id)
    {
        $request['table_id'] = $id;
        $request['status'] = "Process";

        $table = Table::find($id);
        $status = "Berisi";

        $reservation = Reservation::create($request->all());

        $table->status = $status;
        $table->save();

        return $reservation;
    }

    public function check_login(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        if ($reservation['name'] == $request['name'] && $reservation['pin'] == $request['pin']) {
            return response()->json($reservation);
        } else {
            return response()->json(['error' => 'Nama atau PIN salah'], 401);
        }
    }
}
