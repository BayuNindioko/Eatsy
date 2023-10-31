<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index($id)
    {
        $responseRes = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/tables/' . $id . '/reservations');
        $dataRes = $responseRes->json();

        if (isset($dataRes['status']) && $dataRes['status'] == 'Process') {
            session(['table_id' => $id]);
            return view('welcomepage.welcomepage', ['data' => $dataRes]);
        }

        $response = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/tables/' . $id . '/reservations/register');
        $data = $response->json();

        session(['table_id' => $id]);

        return view('registerpage.registerpage', ['data' => $data]);
    }

    public function process($id, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);

        $response = Http::post('http://127.0.0.1/Eatsy/eatsy-web/public/api/tables/' . $id . '/reservations', $request->all());

        $data = $response->json();

        session(['table_id' => $id]);

        return view('welcomepage.auth', ['data' => $data]);
    }

    public function login_request($id, Request $request)
    {
        $validated = $request->validate([
            'pin' => 'required|numeric',
            'name' => 'required',
        ]);

        $pin = $request->input('pin');
        $name = $request->input('name');
        $table_id = $request->input('table_id');

        $response = Http::post('http://127.0.0.1/Eatsy/eatsy-web/public/api/tables/reservations/' . $id . '/login', $request->all());

        if ($response->successful()) {
            session(['table_id' => $table_id]);
            return redirect()->to('homepage/' . $table_id)->with('message', 'Login successful!');
        } else {
            return back()->withInput()->with('error', 'Login failed. Please try again.');
        }
    }

    public function welcome_pin()
    {
        $tableIdInSession = Session::get('table_id');

        $responseRes = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/tables/' . $tableIdInSession . '/reservations');
        $data = $responseRes->json();

        return view('welcomepage.welcomepage', ['data' => $data]);
    }
}
