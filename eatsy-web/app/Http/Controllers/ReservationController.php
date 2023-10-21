<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function registration($id)
    {
        $table = Table::findOrFail($id);
        return response()->json($table);
    }
}
