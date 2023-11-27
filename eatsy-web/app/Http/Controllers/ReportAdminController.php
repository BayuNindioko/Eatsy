<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
<<<<<<< HEAD
use Barryvdh\DomPDF\Facade\Pdf as PDF;
=======
>>>>>>> 1f00d300c237900cb3a92d828f935b97a6a134ee

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
<<<<<<< HEAD

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
=======
>>>>>>> 1f00d300c237900cb3a92d828f935b97a6a134ee
}
