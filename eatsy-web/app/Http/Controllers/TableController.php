<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::with('reservation')->get();
        return response()->json($tables);
    }

    public function detail($id)
    {
        $table = Table::findOrFail($id);
        return response()->json($table);
    }


    public function store(Request $request)
    {
        $request['status'] = 'Kosong';
        $table = Table::create($request->all());

        return response()->json($table);
    }

    public function history_by_table($id)
    {
        $table = Table::find($id)->reservation()->with('order_items.item')->with('table')->get();

        foreach ($table as $reservation) {
            foreach ($reservation->order_items as $orderItem) {
                $item = $orderItem->item;
                if (!empty($item->foto)) {
                    $item->foto = url('../storage/app/image/' . basename($item->foto));
                }
            }
        }

        return response()->json($table);
    }

    public function table_active($id)
    {
        $table = Table::find($id)->reservation()->where('status', 'Process')->with('order_items.item')->with('table')->get();

        foreach ($table as $reservation) {
            foreach ($reservation->order_items as $orderItem) {
                $item = $orderItem->item;
                if (!empty($item->foto)) {
                    $item->foto = url('../storage/app/image/' . basename($item->foto));
                }
            }
        }

        return response()->json($table);
    }
}
