<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TableAdminController extends Controller
{
    public function index()
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            $response = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/tables');
            $data = $response->json();

            return view('table.table_table', ['data' => $data]);
        }
    }

    public function create()
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            return view('table.table_create');
        }
    }

    public function create_process(Request $request)
    {
        $response = Http::post('http://127.0.0.1/Eatsy/eatsy-web/public/api/tables', $request->all());
        $data = $response->json();

        if ($response->successful()) {
            return redirect()->route('tables')->with('success', 'Data meja berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data meja. Silakan coba lagi.');
        }
    }

    public function detail($id)
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            $response = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/tables/' . $id . '/detail');
            $data = $response->json();
            return view('table.table_detail', ['data' => $data]);
        }
    }

    public function table_process($id, Request $request)
    {
        $endpoint = 'http://127.0.0.1/Eatsy/eatsy-web/public/api/tables/' . $id;

        $data = [
            'number' => $request->input('number'),
            'status' => $request->input('status'),
        ];

        $response = Http::patch($endpoint, $data);

        if ($response->successful()) {
            return redirect()->route('tables')->with('success', 'Data meja berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data meja. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            $response = Http::delete('http://127.0.0.1/Eatsy/eatsy-web/public/api/tables/' . $id);

            if ($response->successful()) {
                return redirect()->route('tables')->with('success', 'Data meja berhasil diperbarui.');
            } else {
                return redirect()->back()->with('error', 'Gagal memperbarui data meja. Silakan coba lagi.');
            }
        }
    }
}