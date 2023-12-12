<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReportAdminController extends Controller
{
    public function index(Request $request)
    {
        $token = session('bearer_token');

        if (!$token) {
            return redirect('');
        } else {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            // Validate and set default values for start and end dates if not provided
            $startDate = $startDate ? Carbon::parse($startDate)->toDateString() : null;
            $endDate = $endDate ? Carbon::parse($endDate)->toDateString() : null;

            // Construct the API URL with the date parameters
            $apiUrl = 'https://lamaisonetc.my.id/api/order/report';
            $queryParams = ['start_date' => $startDate, 'end_date' => $endDate];

            // Remove null values from the query parameters
            $queryParams = array_filter($queryParams, function ($value) {
                return $value !== null;
            });

            // Make the HTTP request
            $response = Http::get($apiUrl, $queryParams);
            $data = $response->json();

            return view('reportcms.report_table', ['data' => $data, 'startDate' => $startDate, 'endDate' => $endDate]);
        }
    }

    public function exportpdf(Request $request)
    {
        $token = session('bearer_token');

        if (!$token) {
            return redirect('');
        } else {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            // Validate and set default values for start and end dates if not provided
            $startDate = $startDate ? Carbon::parse($startDate)->toDateString() : null;
            $endDate = $endDate ? Carbon::parse($endDate)->toDateString() : null;

            // Construct the API URL with the date parameters
            $apiUrl = 'https://lamaisonetc.my.id/api/order/report';
            $queryParams = ['start_date' => $startDate, 'end_date' => $endDate];

            // Remove null values from the query parameters
            $queryParams = array_filter($queryParams, function ($value) {
                return $value !== null;
            });

            // Make the HTTP request
            $response = Http::get($apiUrl, $queryParams);
            $data = $response->json();

            $pdfOptions = new Options();
            $pdfOptions->set('defaultFont', 'Arial');

            $dompdf = new Dompdf($pdfOptions);
            $view = view('exportpdf.exports', ['data' => $data]);
            $dompdf->loadHtml($view->render());

            // Render the PDF
            $dompdf->render();

            // Output the generated PDF (force download)
            return $dompdf->stream('exportpdf.pdf');
        }
    }
}
