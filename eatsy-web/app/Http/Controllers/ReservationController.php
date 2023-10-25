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

    public function generate(Request $request, $id)
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

    public function check_login($id)
    {
        $reservation = Reservation::findOrFail($id);

        return response()->json($reservation);
    }
}
