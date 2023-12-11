<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserAdminController extends Controller
{
    public function index()
    {
        $token = session('bearer_token');

        $response = Http::get('https://lamaisonetc.my.id/api/users');
        $data = $response->json();

        if (!$token) {
            return redirect('');
        } else {
            return view('user.user_table', ['data' => $data]);
        }
    }

    public function create()
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            return view('user.user_create');
        }
    }

    public function create_process(Request $request)
    {
        $response = Http::post('https://lamaisonetc.my.id/api/users', $request->all());
        $data = $response->json();

        if ($response->successful()) {
            return redirect()->route('users')->with('success', 'Data user berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data user. Silakan coba lagi.');
        }
    }

    public function detail($id)
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            $response = Http::get('https://lamaisonetc.my.id/api/users/' . $id);
            $data = $response->json();
            return view('user.user_detail', ['data' => $data]);
        }
    }

    public function user_process($id, Request $request)
    {
        $endpoint = 'https://lamaisonetc.my.id/api/users/' . $id;

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        $response = Http::patch($endpoint, $data);

        if ($response->successful()) {
            return redirect()->route('users')->with('success', 'Data user berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui data user. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            $response = Http::delete('https://lamaisonetc.my.id/api/users/' . $id);

            if ($response->successful()) {
                return redirect()->route('users')->with('success', 'Data user berhasil diperbarui.');
            } else {
                return redirect()->back()->with('error', 'Gagal memperbarui data user. Silakan coba lagi.');
            }
        }
    }

    public function homepage()
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            $responseCat = Http::get('https://lamaisonetc.my.id/api/categories');
            $dataCat = count($responseCat->json());

            $responseItem = Http::get('https://lamaisonetc.my.id/api/items');
            $dataItem = count($responseItem->json());

            $responseTab = Http::get('https://lamaisonetc.my.id/api/tables');
            $dataTab = count($responseTab->json());

            $responseUser = Http::get('https://lamaisonetc.my.id/api/users');
            $dataUser = count($responseUser->json());

            $responseReport = Http::get('https://lamaisonetc.my.id/api/order/report');
            $dataReport = $responseReport->json()['totalItemsSold'];

            return view(
                'homecms/homepage',
                [
                    'dataCat' => $dataCat,
                    'dataItem' => $dataItem,
                    'dataTab' => $dataTab,
                    'dataUser' => $dataUser,
                    'dataReport' => $dataReport
                ]
            );
        }
    }
}
