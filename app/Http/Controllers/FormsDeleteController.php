<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\PurchaseOrder;
use App\Models\RestockProduct;
use App\Models\Staff;
use App\Models\User;
use App\Models\SystemLOV;
use Illuminate\Http\Request;
use App\Models\SystemLOVCategories;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FormsDeleteController extends Controller
{
    public function deleteForm($formName, $id)
    {
        switch ($formName) {
            case 'deleteUser':
                $data['user'] = $id;
                return view('forms.delete.delete_user', $data);

                case 'deleteCategory':
                    $data['dropdown'] = $id;
                    return view('forms.delete.delete_lov_category', $data);

                case 'deleteLOV':
                    $data['lov'] = $id;
                    return view('forms.delete.delete_lov', $data);

                case 'deleteStaff':
                    $data['staff'] = $id;
                    return view('forms.delete.delete_staff', $data);

                case 'deleteProduct':
                    $data['product'] = $id;
                    return view('forms.delete.delete_product', $data);

            case 'deletePermission':
                $data['permission'] = $id;
                return view('forms.delete.delete_permission', $data);

                case 'deleteRole':
                    $data['role'] = $id;
                    return view('forms.delete.delete_role', $data);

            case 'deleteRestockProduct':
                $data['restock'] = $id;
                return view('forms.delete.delete_restock_product', $data);

            case 'deletePriceProduct':
                $data['price'] = $id;
                return view('forms.delete.delete_price_product', $data);

            case 'deleteTransaction':
                $data['transaction'] = $id;
                return view('forms.delete.delete_transaction', $data);

            case 'deletePayment':
                $data['payment'] = $id;
                return view('forms.delete.delete_payment', $data);

            case 'deleteProject':
                $data['project'] = $id;
                return view('forms.delete.delete_project', $data);

            case 'deleteTask':
                $data['task'] = $id;
                return view('forms.delete.delete_task', $data);

            case 'deleteRequisition':
                $data['requisition'] = $id;
                return view('forms.delete.delete_requisition', $data);

            case 'deleteWaybill':
                $data['waybill'] = $id;
                return view('forms.delete.delete_waybill', $data);

            case 'deleteFinancial':
                $data['financial'] = $id;
                return view('forms.delete.delete_financial', $data);

            case 'deleteAttendance':
                $data['attendance'] = $id;
                return view('forms.delete.delete_attendance', $data);

            case 'deleteSupplier':
                $data['supplier'] = $id;
                return view('forms.delete.delete_supplier', $data);

            case 'deleteSubCategory':
                $data['sub_category'] = $id;
                return view('forms.delete.delete_sub_category', $data);

            case 'deleteCustomer':
                $data['customer'] = $id;
                return view('forms.delete.delete_customer', $data);

            case 'deletePurchaseOrder':
                $data['purchase_order'] = $id;
                return view('forms.delete.delete_purchase_order', $data);

            default:
                return "No form Selected";
        }
    }
}
