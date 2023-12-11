<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HistoryController extends Controller
{
    public function index($id)
    {
        $response = Http::get('https://lamaisonetc.my.id/api/tables/' . $id . '/items');
        $data = $response->json();

        $responseTable = Http::get('https://lamaisonetc.my.id/api/tables/' . $id . '/reservations');
        $dataTable = $responseTable->json();

        return view('historypage.historypage', [
            'data' => $data,
            'dataTable' => $dataTable
        ]);
    }
}
