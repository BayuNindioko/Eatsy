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

    public function detail($id)
    {
        $table = Table::find($id)->reservation()->with('order_items')->with('table')->orderBy('created_at', 'desc')->where('status', 'Process')->first();
        if ($table == null) {
            $table = Table::find($id);
            $data = [
                'id' => 0,
                'table_id' => $table['id'],
                'name' => '',
                'pin' => '',
                'status' => 'Finish',
                'created_at' => '',
                'updated_at' => '',
                'items' => [],
                'table' => $table
            ];

            $table = (object)$data;
        }

        return response()->json($table);
    }

    public function generate(Request $request, $id)
    {
        $generate_pin = strval(random_int(1000, 9999));

        $request['table_id'] = $id;
        $request['pin'] = $generate_pin;
        $request['status'] = "Process";

        $table = Table::find($id);
        $status = "Berisi";

        $reservation = Reservation::create($request->all());

        $table->status = $status;
        $table->save();

        return $reservation;
    }

    public function check_login($id, Request $request)
    {
        $reservation = Reservation::findOrFail($id);
        if ($reservation['name'] == $request['name'] && $reservation['pin'] == $request['pin']) {
            return response()->json($reservation);
        } else {
            return response()->json(['error' => 'Nama atau PIN salah'], 401);
        }
    }

    public function checkout($id, Request $request)
    {
        $id_table = $request->table_id;

        $table = Table::find($id_table);
        $table->status = 'Kosong';
        $table->save();

        $reservation = Reservation::find($id);
        $reservation->status = 'Finish';
        $reservation->save();

        $table = Table::find($id_table)->reservation()->with('order_items')->with('table')->orderBy('created_at', 'desc')->where('status', 'Finish')->first();

        return response()->json($table);
    }
}
