<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function index(){

    }
    public function generatePDF()
    {
        $data = ['title' => 'Welcome to Laravel PDF Generation'];
        $pdf = PDF::loadView('admin.dashboard.order.pdf_view', $data);
        $pdf->setPaper('A4', 'portrait');

        // Set font tiếng Việt
        $pdf->set_option('defaultFont', 'DejaVuSans');
        return $pdf->download('laravel_pdf.pdf');
    }
}
