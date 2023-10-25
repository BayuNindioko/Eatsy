<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function index($id)
    {
        $responseTable = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/tables/reservations/' . $id . '/login');
        $dataTable = $responseTable->json();
        return view('cartpage.cartpage', ['dataTable' => $dataTable]);
    }
}
