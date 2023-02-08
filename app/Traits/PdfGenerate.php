<?php

namespace App\Traits;

use Modules\Setting\Entities\PdfFont;
use PDF;

trait PdfGenerate
{
    public function getInvoice($view, $data)
    {
        $pdf_font= PdfFont::where('is_active',1)->first();
        $pdf = PDF::loadView($view,compact('data','pdf_font'))->setPaper('a4', 'portrait');

        return $pdf->download("invoice-{$data->invoice_no}.pdf");

    }

    public function getPayroll($view, $payrollDetails)
    {
        $pdf_font= PdfFont::where('is_active',1)->first();
        $pdf = PDF::loadView($view,compact('payrollDetails', 'pdf_font'))->setPaper('a4', 'portrait');
        return $pdf->download("Payroll-{$payrollDetails->staff->employee_id}.pdf");
    }

    public function getPdf($title,$view, $data)
    {
        $data['pdf_font']= PdfFont::where('is_active',1)->first();
        $pdf = PDF::loadView($view,$data);
        return $pdf->download($title);
    }

}
