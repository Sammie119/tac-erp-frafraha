<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Financial;
use App\Models\ProductPrice;
use App\Models\Products;
use App\Models\ProductSubCategory;
use App\Models\Project;
use App\Models\PurchaseOrder;
use App\Models\Requisition;
use App\Models\RequisitionDetails;
use App\Models\RestockProduct;
use App\Models\Setups;
use App\Models\Staff;
use App\Models\Supplier;
use App\Models\Task;
use App\Models\TaskProgress;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransactionPayment;
use App\Models\User;
use App\Models\SystemLOV;
use App\Models\VWStaff;
use App\Models\VWTransactions;
use App\Models\Waybill;
use App\Models\WaybillDetails;
use Illuminate\Http\Request;
use App\Models\SystemLOVCategories;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FormsEditController extends Controller
{
    public function editForm($formName, $id)
    {
        switch ($formName) {
            case 'editUser':
                $data['user'] = User::find($id);
                $data['staff'] = VWStaff::selectRaw('staff_id as id, full_name as name')->orderBy('full_name')->get();
                $data['division'] = SystemLOV::where('category_id', 6)->get();
                return view('forms.create.create_user', $data);

            case 'editCategory':
                $data['dropdown'] = SystemLOVCategories::find($id);
                return view('forms.create.create_lov_category', $data);

            case 'editStaff':
                $data['staff'] = Staff::find($id);
                $data['title'] = SystemLOV::where('category_id', 1)->get();
                $data['position'] = SystemLOV::where('category_id', 7)->get();
                $data['gender'] = SystemLOV::where('category_id', 3)->get();
                $data['married'] = SystemLOV::where('category_id', 2)->get();
                return view('forms.create.create_staff', $data);

            case 'editProduct':
                $data['product'] = Products::find($id);
                if(get_logged_in_user_id() === 1){
                    $data['type'] = SystemLOV::where('category_id', 8)->get();
                    $data['sub_categories'] = ProductSubCategory::select('sub_category_id as id', 'name')->orderBy('name')->get();
                } else {
                    $data['type'] = SystemLOV::where('division', get_logged_user_division_id())->where('category_id', 8)->get();
                    $data['sub_categories'] = ProductSubCategory::select('sub_category_id as id', 'name')->where('division', get_logged_user_division_id())->orderBy('name')->get();
                }
                return view('forms.create.create_product', $data);

            case 'editPermission':
                $data['permission'] = Permission::find($id);
                return view('forms.create.create_permission', $data);

            case 'editRole':
                $data['role'] = Role::find($id);
                return view('forms.create.create_role', $data);

            case 'editRestockProduct':
                $data['restock'] = RestockProduct::find($id);
                if(get_logged_in_user_id() === 1){
                    $data['items'] = Products::select('product_id as id', 'name')->where('type', 20)->get();
                } else {
                    $data['items'] = Products::select('product_id as id', 'name')->where('division', get_logged_user_division_id())->where('type', 20)->get();
                }
                return view('forms.create.create_restock_product', $data);

            case 'editPriceProduct':
                $data['price'] = ProductPrice::find($id);
                if(get_logged_in_user_id() === 1){
                    $data['items'] = Products::select('product_id as id', 'name')->get();
                } else {
                    $data['items'] = Products::select('product_id as id', 'name')->where('division', get_logged_user_division_id())->get();
                }
                return view('forms.create.create_price_product', $data);

            case 'editSetup':
                $data['setup'] = Setups::find($id);
                if(get_logged_in_user_id() === 1){
                    $data['division'] = SystemLOV::where('category_id', 6)->get();
                } else {
                    $data['division'] = get_logged_user_division_id();
                }

                return view('forms.create.create_system_setup', $data);

            case 'editTransaction':
                $data['transaction'] = Transaction::find($id);
                $data['transaction_details'] = TransactionDetail::where('transaction_id', $id)->get();
                if(get_logged_in_user_id() === 1){
                    $data['products'] = Products::select('name')->orderBy('name')->get();
                    $data['customers'] = Customer::select('name')->orderBy('name')->get();
                } else {
                    $data['products'] = Products::select('product_id as id', 'name')->where('division', get_logged_user_division_id())->orderBy('name')->get();
                    $data['customers'] = Customer::select('name')->where('division', get_logged_user_division_id())->orderBy('name')->get();
                }
                return view('forms.create.create_transaction', $data);

            case 'editPayment':
                $data['payment_methods'] = SystemLOV::where('category_id', 9)->get();
                $data['department'] = SystemLOV::where('category_id', 6)->get();
                $data['payment'] = TransactionPayment::find($id);
                $data['transaction'] = VWTransactions::where('transaction_id', $data['payment']->transaction_id)->first();
                if(get_logged_in_user_id() === 1){
                    $data['invoices'] = VWTransactions::select('invoice_no as name')->orderByDesc('invoice_no')->get();
                } else {
                    $data['invoices'] = VWTransactions::select('invoice_no as name')->where('division', get_logged_user_division_id())->orderByDesc('invoice_no')->get();
                }
                return view('forms.create.create_payment', $data);

            case 'makeSinglePayment':
                $data['payment_methods'] = SystemLOV::where('category_id', 9)->get();
                $data['department'] = SystemLOV::where('category_id', 6)->get();
                $data['transaction'] = VWTransactions::where('transaction_id', $id)->first();
                if(get_logged_in_user_id() === 1){
                    $data['invoices'] = VWTransactions::select('invoice_no as name')->orderByDesc('invoice_no')->get();
                } else {
                    $data['invoices'] = VWTransactions::select('invoice_no as name')->where('division', get_logged_user_division_id())->orderByDesc('invoice_no')->get();
                }
                return view('forms.create.create_payment', $data);

            case 'editProject':
                $data['project'] = Project::find($id);
                return view('forms.create.create_project', $data);

            case 'editTask':
                $data['task'] = Task::find($id);
                if(get_logged_in_user_id() === 1){
                    $data['staffs'] = VWStaff::select('full_name as name')->orderBy('full_name')->get();
                    $data['projects'] = Project::select('name')->orderBy('name')->get();
                } else {
                    $data['staffs'] = VWStaff::select('full_name as name')->where('division', get_logged_user_division_id())->orderBy('fullname')->get();
                    $data['projects'] = Project::select('name')->where('division', get_logged_user_division_id())->orderBy('name')->get();
                }
                return view('forms.create.create_task', $data);

            case 'workOnTask':
                $data['project'] = $id;
                $data['tasks'] = Task::where('project_id', $id)->get();
                return view('forms.create.create_work_on_task', $data);

            case 'editRequisition':
                $data['requisition'] = Requisition::find($id);
                $data['requisition_details'] = RequisitionDetails::where('req_id', $data['requisition']->req_id)->get();
                if(get_logged_in_user_id() === 1){
                    $data['items'] = Products::select('product_id as id', 'name')->get();
                } else {
                    $data['items'] = Products::select('product_id as id', 'name')->where('division', get_logged_user_division_id())->get();
                }
                return view('forms.create.create_requisition', $data);

            case 'editWaybill':
                $data['waybill'] = Waybill::find($id);
                $data['waybill_details'] = WaybillDetails::where('waybill_id', $id)->get();
                $data['projects'] = Project::select('project_id as id','name')->orderBy('name')->get();
                if(get_logged_in_user_id() === 1){
                    $data['items'] = Products::select('product_id as id', 'name')->get();
                    $data['customers'] = Customer::select('name')->orderBy('name')->get();
                } else {
                    $data['items'] = Products::select('product_id as id', 'name')->where('division', get_logged_user_division_id())->get();
                    $data['customers'] = Customer::select('name')->where('division', get_logged_user_division_id())->orderBy('name')->get();
                }
                return view('forms.create.create_waybill', $data);

            case 'editFinancial':
                $data['financial'] = Financial::find($id);
                $data['transaction_type'] = SystemLOV::where('category_id', 10)->get();
                $data['transaction_source'] = SystemLOV::where('category_id', 11)->get();
                $data['transaction_mode'] = SystemLOV::where('category_id', 9)->get();
                $data['department'] = SystemLOV::where('category_id', 6)->get();
                return view('forms.create.create_financial_entry', $data);

            case 'editSupplier':
                $data['supplier'] = Supplier::find($id);
                return view('forms.create.create_supplier', $data);

            case 'editCustomer':
                $data['customer'] = Customer::find($id);
                return view('forms.create.create_customer', $data);

            case 'editPurchaseOrder':
                $data['purchase_order'] = PurchaseOrder::find($id);
                $data['suppliers'] = Supplier::select('supplier_name as name')->orderBy('supplier_name')->get();
                return view('forms.create.create_purchase_order', $data);

            default:
                return "No form Selected";
        }
    }
}
