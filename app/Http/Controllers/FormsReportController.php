<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class FormsReportController extends Controller
{
    public function reportForm($formName)
    {
        switch ($formName) {
            case 'dailyIncome':
                return view('reports.transactions.daily_income');
            case 'invoiceReport':
                return view('reports.transactions.invoice');
            case 'productReport':
                $data['items'] = Products::select('product_id as id', 'name')->whereIn('division', get_stores_ids(42))->get();
                return view('reports.transactions.products', $data);
            default:
                return "No form Selected";
        }
    }
}
