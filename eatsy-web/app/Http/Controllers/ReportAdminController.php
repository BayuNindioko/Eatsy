<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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

            return view('reportcms.report_table', ['data' => $data]);
        }
    }

    public function exportpdf()
    {
        $token = session('bearer_token');
        if (!$token) {
        return redirect('');
        } else {
        $response = Http::get('http://127.0.0.1/Eatsy/eatsy-web/public/api/order/report');
        $data = $response->json();

        $pdf = PDF::loadView('exportpdf.exports', ['data' => $data]);

        return $pdf->download('exportpdf.pdf');
        }
    }
}
