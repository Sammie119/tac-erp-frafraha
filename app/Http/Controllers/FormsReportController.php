<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormsReportController extends Controller
{
    public function reportForm($formName)
    {
        switch ($formName) {
            case 'invoiceReport':

                return view('reports.transactions.invoice');

            default:
                return "No form Selected";
        }
    }
}
