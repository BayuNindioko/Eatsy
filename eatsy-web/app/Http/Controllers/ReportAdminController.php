<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReportAdminController extends Controller
{
    public function index()
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            $response = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/order/report');
            $data = $response->json();

            return view('report.report_table', ['data' => $data]);
        }
    }

    public function create()
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            $response = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/order/report');
            $data = $response->json();
            return view('report.report_create', ['data' => $data]);
        }
    }

    public function create_process(Request $request)
    {
        $request['file'] = $request->file('file');
        $response = Http::post('http://127.0.0.1/Eatsy/eatsy-web/public/api/order/report', $request->all());
        $data = $response->json();

        return $request;
    }

    public function detail($id)
    {
        $token = session('bearer_token');
        if (!$token) {
            return redirect('');
        } else {
            $response = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/order/report' . $id);
            $data = $response->json();
            $responseCat = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/order/report');
            $dataCat = $responseCat->json();
            return view('report.report_detail', ['data' => $data, 'dataCat' => $dataCat]);
        }
    }

    public function item_process($id, Request $request)
    {
        $endpoint = 'http://127.0.0.1/Eatsy/eatsy-web/public/api/order/report' . $id;

        $response = Http::patch($endpoint, $request);

        if ($response->successful()) {
            return redirect()->route('items')->with('success', 'Data meja berhasil diperbarui.');
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
            $response = Http::delete('http://127.0.0.1/Eatsy/eatsy-web/public/api/order/report' . $id);

            if ($response->successful()) {
                return redirect()->route('items')->with('success', 'Data meja berhasil diperbarui.');
            } else {
                return redirect()->back()->with('error', 'Gagal memperbarui data meja. Silakan coba lagi.');
            }
        }
    }
}
