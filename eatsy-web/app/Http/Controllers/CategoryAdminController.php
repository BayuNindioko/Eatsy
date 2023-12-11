<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryAdminController extends Controller
{
    public function index()
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            $response = Http::get('https://lamaisonetc.my.id/api/categories');
            $data = $response->json();

            return view('category.category_table', ['data' => $data]);
        }
    }

    public function create()
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            return view('category.category_create');
        }
    }

    public function create_process(Request $request)
    {
        $response = Http::post('https://lamaisonetc.my.id/api/categories', $request->all());
        $data = $response->json();

        if ($response->successful()) {
            return redirect()->route('categories')->with('success', 'Data category berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data category. Silakan coba lagi.');
        }
    }

    public function detail($id)
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            $response = Http::get('https://lamaisonetc.my.id/api/categories/' . $id);
            $data = $response->json();
            return view('category.category_detail', ['data' => $data]);
        }
    }

    public function category_process($id, Request $request)
    {
        $endpoint = 'https://lamaisonetc.my.id/api/categories/' . $id;

        $data = [
            'name' => $request->input('name')
        ];

        $response = Http::patch($endpoint, $data);

        if ($response->successful()) {
            return redirect()->route('categories')->with('success', 'Data category berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data category. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            $response = Http::delete('https://lamaisonetc.my.id/api/categories/' . $id);

            if ($response->successful()) {
                return redirect()->route('categories')->with('success', 'Data category berhasil diperbarui.');
            } else {
                return redirect()->back()->with('error', 'Gagal memperbarui data category. Silakan coba lagi.');
            }
        }
    }
}
