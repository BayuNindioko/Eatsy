<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index($id)
    {
        $dataRes = session('data');

        $tableIdInSession = Session::get('table_id');
        if (!$tableIdInSession || $tableIdInSession !== $id) {
            return redirect()->route('register/', ['id' => $id])->with('error', 'You are not authorized to access this table.');
        }

        $response = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/items');
        $data = $response->json();

        $responseCategory = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/categories');
        $dataCategory = $responseCategory->json();

        $responseTable = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/tables/reservations/' . $dataRes['id'] . '/login');
        $dataTable = $responseTable->json();

        return view('homepage.homepage', [
            'data' => $data,
            'dataCategory' => $dataCategory,
            'dataTable' => $dataTable
        ]);
    }
}
