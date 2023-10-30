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

    public function store(Request $request)
    {
        $request['status'] = 'Kosong';
        $table = Table::create($request->all());

        return response()->json($table);
    }
}
