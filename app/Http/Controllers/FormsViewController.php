<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Financial;
use App\Models\Products;
use App\Models\ProductSubCategory;
use App\Models\Project;
use App\Models\Requisition;
use App\Models\RequisitionDetails;
use App\Models\Setups;
use App\Models\StaffAttendanceDetail;
use App\Models\Supplier;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransactionPayment;
use App\Models\User;
use App\Models\SystemLOV;
use App\Models\VWStaff;
use App\Models\SystemLOVCategories;
use App\Models\VWTransactions;
use App\Models\Waybill;
use App\Models\WaybillDetails;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FormsViewController extends Controller
{
    public function viewForm($formName, $id)
    {
        switch ($formName) {
            case 'createUserRole':
                $user = User::find($id);
                $data['user'] = $user->id;
                $data['roles'] = Role::pluck('name')->toArray();
                $data['permissions'] = $user->getRoleNames()->toArray();

                return view('forms.view.create_user_role', $data);

            case 'createListOfValues':
                $data['dropdown'] = SystemLOVCategories::find($id)->id;
                $data['values'] = SystemLOV::where('category_id', $id)->orderBy('name')->get();

                return view('forms.view.create_lov_values', $data);

            case 'viewStaff':
                $data['staff'] = VWStaff::find($id);

                return view('forms.view.view_staff', $data);

            case 'viewProduct':
                $data['product'] = Products::find($id);

                return view('forms.view.view_product', $data);

            case 'addPermissions':
                $data['role'] = $id;
                $data['permissions'] = Permission::get();
                $data['get_permissions'] = DB::table('role_has_permissions')->where('role_id', $id)->pluck('permission_id')->toArray();

                return view('forms.view.add_permissions', $data);

            case 'viewSetup':
                $data['setup'] = Setups::find($id);

                return view('forms.view.view_setup', $data);

            case 'viewInvoice':
                $data['transaction'] = VWTransactions::find($id);

                $data['details'] = TransactionDetail::where('transaction_id', $id)->get();
                return view('forms.view.view_invoice', $data);

            case 'viewReceipt':
                $data['payment'] = TransactionPayment::find($id);
                $data['transaction'] = VWTransactions::find($data['payment']->transaction_id);
                $data['details'] = TransactionDetail::where('transaction_id', $data['payment']->transaction_id)->get();

                return view('forms.view.view_receipt', $data);

            case 'viewProject':
                $data['project'] = Project::find($id);
                $data['tasks'] = Task::where('project_id', $id)->get();

                return view('forms.view.view_project', $data);

            case 'viewTask':
                $data['task'] = Task::find($id);

                return view('forms.view.view_task', $data);

            case 'viewRequisition':
                $data['requisition'] = Requisition::find($id);
                $data['requisition_details'] = RequisitionDetails::where('req_id', $id)->get();
                return view('forms.view.view_requisition', $data);

            case 'approveRequisition':
                $data['requisition'] = Requisition::find($id);
                $data['requisition_details'] = RequisitionDetails::where('req_id', $id)->get();
                return view('forms.view.approve_requisition', $data);

            case 'viewWaybill':
                $data['waybill'] = Waybill::find($id);
                $data['waybill_details'] = WaybillDetails::where('waybill_id', $id)->get();
                return view('forms.view.view_waybill', $data);

            case 'viewFinancial':
                $data['financial'] = Financial::find($id);
                return view('forms.view.view_financial', $data);

            case 'viewAttendance':
                $data['att_details'] = StaffAttendanceDetail::where('attendance_id', $id)->get();
                return view('forms.view.view_attendance', $data);

            case 'viewSupplier':
                $data['supplier'] = Supplier::find($id);
                return view('forms.view.view_supplier', $data);

            case 'createSubCategories':
                $data['category'] = $id;
                $data['values'] = ProductSubCategory::where('category_id', $id)->orderBy('name')->get();
                $data['units'] = SystemLOV::where('category_id', 15)->get();
                return view('forms.view.create_sub_categories', $data);

            case 'viewCustomer':
                $data['customer'] = Customer::find($id);
                return view('forms.view.view_customers', $data);

            default:
                return "No form Selected";
        }
    }
}
