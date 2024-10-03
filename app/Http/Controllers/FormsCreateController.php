<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Products;
use App\Models\Project;
use App\Models\SystemLOV;
use App\Models\VWStaff;
use App\Models\VWTransactions;
use Illuminate\Http\Request;

class FormsCreateController extends Controller
{
    public function createForm($formName)
    {
        switch ($formName) {
            case 'createUser':
                $data['staff'] = VWStaff::selectRaw('staff_id as id, full_name as name')->orderBy('full_name')->get();
                $data['division'] = SystemLOV::where('category_id', 6)->get();
                return view('forms.create.create_user', $data);

            case 'createCategory':
                return view('forms.create.create_lov_category');

            case 'createStaff':
                $data['title'] = SystemLOV::where('category_id', 1)->get();
                $data['position'] = SystemLOV::where('category_id', 7)->get();
                $data['gender'] = SystemLOV::where('category_id', 3)->get();
                $data['married'] = SystemLOV::where('category_id', 2)->get();
                return view('forms.create.create_staff', $data);

            case 'createProduct':
                if(get_logged_in_user_id() === 1){
                    $data['type'] = SystemLOV::where('category_id', 8)->get();
                } else {
                    $data['type'] = SystemLOV::where('division', get_logged_user_division_id())->where('category_id', 8)->get();
                }
                return view('forms.create.create_product', $data);

            case 'createPermission':
                return view('forms.create.create_permission');

            case 'createRole':
                return view('forms.create.create_role');

            case 'createRestockProducts':
                if(get_logged_in_user_id() === 1){
                    $data['items'] = Products::select('product_id as id', 'name')->where('type', 20)->get();
                } else {
                    $data['items'] = Products::select('product_id as id', 'name')->where('division', get_logged_user_division_id())->where('type', 20)->get();
                }
                return view('forms.create.create_restock_product', $data);

            case 'createPriceProducts':
                if(get_logged_in_user_id() === 1){
                    $data['items'] = Products::select('product_id as id', 'name')->get();
                } else {
                    $data['items'] = Products::select('product_id as id', 'name')->where('division', get_logged_user_division_id())->get();
                }
                return view('forms.create.create_price_product', $data);

            case 'createTransaction':
                if(get_logged_in_user_id() === 1){
                    $data['products'] = Products::select('name')->orderBy('name')->get();
                    $data['customers'] = Customer::select('name')->orderBy('name')->get();
                } else {
                    $data['products'] = Products::select('product_id as id', 'name')->where('division', get_logged_user_division_id())->orderBy('name')->get();
                    $data['customers'] = Customer::select('name')->where('division', get_logged_user_division_id())->orderBy('name')->get();
                }
                return view('forms.create.create_transaction', $data);

            case 'createSetup':
                if(get_logged_in_user_id() === 1){
                    $data['division'] = SystemLOV::where('category_id', 6)->get();
                } else {
                    $data['division'] = get_logged_user_division_id();
                }
                return view('forms.create.create_system_setup', $data);

            case 'createPayment':
                $data['payment_methods'] = SystemLOV::where('category_id', 9)->get();
                $data['department'] = SystemLOV::where('category_id', 6)->get();
                if(get_logged_in_user_id() === 1){
                    $data['invoices'] = VWTransactions::select('invoice_no as name')->orderByDesc('invoice_no')->get();
                } else {
                    $data['invoices'] = VWTransactions::select('invoice_no as name')->where('division', get_logged_user_division_id())->orderByDesc('invoice_no')->get();
                }
                return view('forms.create.create_payment', $data);

            case 'createProject':
                return view('forms.create.create_project');

            case 'createTask':
                if(get_logged_in_user_id() === 1){
                    $data['staffs'] = VWStaff::select('full_name as name')->orderBy('full_name')->get();
                    $data['projects'] = Project::select('name')->orderBy('name')->get();
                } else {
                    $data['staffs'] = VWStaff::select('full_name as name')->where('division', get_logged_user_division_id())->orderBy('fullname')->get();
                    $data['projects'] = Project::select('name')->where('division', get_logged_user_division_id())->orderBy('name')->get();
                }
                return view('forms.create.create_task', $data);

            case 'createRequisition':
                if(get_logged_in_user_id() === 1){
                    $data['items'] = Products::select('product_id as id', 'name')->get();
                } else {
                    $data['items'] = Products::select('product_id as id', 'name')->where('division', get_logged_user_division_id())->get();
                }
                return view('forms.create.create_requisition', $data);

            case 'createWaybill':
                $data['projects'] = Project::select('project_id as id','name')->orderBy('name')->get();
                if(get_logged_in_user_id() === 1){
                    $data['items'] = Products::select('product_id as id', 'name')->get();
                    $data['customers'] = Customer::select('name')->orderBy('name')->get();
                } else {
                    $data['items'] = Products::select('product_id as id', 'name')->where('division', get_logged_user_division_id())->get();
                    $data['customers'] = Customer::select('name')->where('division', get_logged_user_division_id())->orderBy('name')->get();
                }
                return view('forms.create.create_waybill', $data);

            case 'createFinancial':
                $data['transaction_type'] = SystemLOV::where('category_id', 10)->get();
                $data['transaction_source'] = SystemLOV::where('category_id', 11)->get();
                $data['transaction_mode'] = SystemLOV::where('category_id', 9)->get();
                $data['department'] = SystemLOV::where('category_id', 6)->get();
                return view('forms.create.create_financial_entry', $data);

            case 'createAttendance':
                return view('forms.create.create_attendance');

            default:
                return "No form Selected";
        }
    }
}
