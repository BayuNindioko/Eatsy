<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function index($id)
    {
        $responseTable = Http::get('https://lamaisonetc.my.id/api/tables/' . $id . '/reservations');
        $dataTable = $responseTable->json();
        return view('cartpage.cartpage', ['dataTable' => $dataTable]);
    }
}
