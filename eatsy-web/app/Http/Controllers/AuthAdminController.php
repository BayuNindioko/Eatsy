<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthAdminController extends Controller
{
    public function index()
    {
        $token = session('bearer_token');
        if (!$token) {
            return view('logincms/login');
        } else {
            return redirect('homecms');
        }
    }

    public function login_process(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password'  => 'required',
        ]);

        $response = Http::post('http://127.0.0.1/Eatsy/eatsy-web/public/api/users/login', $request->all());

        session(['bearer_token' => $response['data']['access_token']]);

        if ($response['status'] == 'success') {
            return redirect('homecms');
        } else {
            return back()->withErrors(['login' => 'Login gagal. Silakan cek kembali email dan password Anda.']);
        }
    }

    public function logout()
    {
        $token = session('bearer_token');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('http://127.0.0.1/Eatsy/eatsy-web/public/api/users/logout');
        session()->forget('bearer_token');

        return redirect('cms');
    }
}
