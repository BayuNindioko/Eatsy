<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DetailController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->input('id');
        $table_id = $request->input('table_id');

        $response = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/items/' . $id . '');
        $data = $response->json();

        $responseTable = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/tables/' . $table_id . '/reservations');
        $dataTable = $responseTable->json();

        return view('detailpage.detailpage', [
            'data' => $data,
            'dataTable' => $dataTable
        ]);
    }
}
