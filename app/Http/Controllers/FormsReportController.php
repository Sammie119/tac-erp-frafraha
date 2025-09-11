<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\SystemLOV;
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
                $data['items'] = Products::select('product_id as id', 'name')->where('division', get_logged_user_division_id())->get();
                return view('reports.transactions.products', $data);
            case 'productExport':
                $data['categories'] = SystemLOV::select('id', 'name')->where('category_id', 16)->get();
                return view('reports.transactions.products_export', $data);
            default:
                return "No form Selected";
        }
    }
}
