<?php

namespace App\Http\Controllers;

use App\Models\ProductPrice;
use App\Models\Products;
use App\Models\RestockProduct;
use App\Models\SystemLOVCategories;
use App\Models\Task;
use App\Models\User;
use App\Models\VWProject;
use App\Models\VWStaff;
use App\Models\VWTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class SearchController extends Controller
{
    public function searchUsers(Request $request)
    {
        $users = User::where('name', 'ILIKE', '%'.$request['search'].'%')
                        ->orWhere('email', 'ILIKE', '%'.$request['search'].'%')
                        ->orderBy('name')->limit(100)->get();

        if($users){
            foreach ($users as $key => $user) {
                echo '
                <tr>
                    <td style="width: 10px">'.++$key.'</td>
                    <td>'.$user->name.'</td>
                    <td>'.$user->email.'</td>
                    <td style="width: 200px">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Set User Roles" data-bs-url="form_edit/createUserRole/'.$user->id.'" data-bs-size="modal-lg"> User Roles</button>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit User Details" data-bs-url="form_edit/editUser/'.$user->id.'" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm User Deletion" data-bs-url="form_delete/deleteUser/'.$user->id.'" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                ';
            }

        }
        else {
            echo '
                <tr>
                    <td colspan="10"><h3>No Data Found</h3></td>
                </tr>
            ';
        }

    }

    public function searchLOVCategory (Request $request)
    {
        $dropdowns = SystemLOVCategories::where('category_name', 'ILIKE', '%'.$request['search'].'%')
                        ->orderBy('category_name')->limit(100)->get();

        // <td>'.$user->position.'</td>
        if($dropdowns){
            foreach ($dropdowns as $key => $dropdown) {
                echo '
                <tr>
                    <td style="width: 20px">'.++$key.'</td>
                    <td>'.$dropdown->category_name.'</td>
                    <td style="width: 300px">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add List of Values" data-bs-url="form_edit/createListOfValues/'.$dropdown->id.'" data-bs-size="modal-lg"> Values</button>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Category Detail" data-bs-url="form_edit/editCategory/'.$dropdown->id.'" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Category Deletion" data-bs-url="form_delete/deleteCategory/'.$dropdown->id.'" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                ';
            }

        }
        else {
            echo '
                <tr>
                    <td colspan="10"><h3>No Data Found</h3></td>
                </tr>
            ';
        }
    }

    public function searchPermissions(Request $request)
    {
        $permissions = Permission::where('name', 'ILIKE', '%'.$request['search'].'%')
           ->orderBy('name')->limit(100)->get();

        if($permissions){
            foreach ($permissions as $key => $permission) {
                echo '
                <tr>
                    <td style="width: 10px">'.++$key.'</td>
                    <td>'.$permission->name.'</td>
                    <td style="width: 200px">
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Permission" data-bs-url="form_edit/editPermission/'.$permission->id.'" data-bs-size="modal-lg"> <i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Permission Deletion" data-bs-url="form_delete/deletePermission/'.$permission->id.'" data-bs-size=""> <i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                ';
            }

        }
        else {
            echo '
                <tr>
                    <td colspan="10"><h3>No Data Found</h3></td>
                </tr>
            ';
        }
    }

    public function searchStaff (Request $request)
    {
        $staff = VWStaff::where('full_name', 'ILIKE', '%'.$request['search'].'%')
            ->orWhere('email', 'ILIKE', '%'.$request['search'].'%')
            ->orWhere('phone', 'ILIKE', '%'.$request['search'].'%')
            ->orWhere('position_name', 'ILIKE', '%'.$request['search'].'%')
            ->orderBy('full_name')->limit(100)->get();

        if($staff){
            foreach ($staff as $key => $value) {
                echo '
                <tr>
                    <td style="width: 10px">'.++$key.'</td>
                    <td>'.$value->full_name.'</td>
                    <td>'.$value->gender_name.'</td>
                    <td>'.$value->date_of_birth.'</td>
                    <td>'.$value->phone.'</td>
                    <td>'.$value->email.'</td>
                    <td>'.$value->position_name.'</td>
                    <td style="width: 200px">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Staff Detail" data-bs-url="form_view/viewStaff/'.$value->staff_id.'" data-bs-size="modal-xl"> View Staff</button>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Staff Details" data-bs-url="form_edit/editStaff/'.$value->staff_id.'" data-bs-size="modal-xl" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Staff Deletion" data-bs-url="form_delete/deleteStaff/'.$value->staff_id.'" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                ';
            }

        }
        else {
            echo '
                <tr>
                    <td colspan="10"><h3>No Data Found</h3></td>
                </tr>
            ';
        }
    }

    public function searchProducts (Request $request)
    {
        $products = Products::where('name', 'ILIKE', '%'.$request['search'].'%')
            ->orderBy('name')->limit(100)->get();

        // <td>'.$user->position.'</td>
        if($products){
            foreach ($products as $key => $product) {
                echo '
                <tr>
                    <td style="width: 10px">'.++$key.'</td>
                    <td>'.$product->name.'</td>
                    <td>'.$product->type_name->name.'</td>
                    <td>'.$product->stock_out.'</td>
                    <td style="width: 200px">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Products Detail - '.$product->name.'" data-bs-url="form_view/viewProduct/'.$product->product_id.'" data-bs-size="modal-lg"> View Product</button>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Product Details" data-bs-url="form_edit/editProduct/'.$product->product_id.'" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Product Deletion" data-bs-url="form_delete/deleteProduct/'.$product->product_id.'" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                ';
            }

        }
        else {
            echo '
                <tr>
                    <td colspan="10"><h3>No Data Found</h3></td>
                </tr>
            ';
        }
    }

    public function searchRestock (Request $request)
    {
        $products = RestockProduct::whereRelation('product_name','name', 'ILIKE', '%'.$request['search'].'%')
            ->limit(100)->get();

        // <td>'.$user->position.'</td>
        if($products){
            foreach ($products as $key => $product) {
                echo '
                <tr>
                    <td style="width: 10px">'.++$key.'</td>
                    <td>'.$product->product_name->name.'</td>
                    <td>'.$product->old_quantity.'</td>
                    <td>'.$product->old_stock.'</td>
                    <td>'.$product->old_sold.'</td>
                    <td>'.$product->new_quantity.'</td>
                    <td>'.$product->updated_at.'</td>
                    <td style="width: 200px">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Products Detail - '.$product->product_name->name.'" data-bs-url="form_view/viewProduct/'.$product->product_id.'" data-bs-size="modal-lg"> View Product</button>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Restock Details" data-bs-url="form_edit/editRestockProduct/'.$product->restock_id.'" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Restock Deletion" data-bs-url="form_delete/deleteRestockProduct/'.$product->restock_id.'" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                ';
            }

        }
        else {
            echo '
                <tr>
                    <td colspan="10"><h3>No Data Found</h3></td>
                </tr>
            ';
        }
    }

    public function searchPrices (Request $request)
    {
        $prices = ProductPrice::whereRelation('product_name','name', 'ILIKE', '%'.$request['search'].'%')
            ->limit(100)->get();

        // <td>'.$user->position.'</td>
        if($prices){
            foreach ($prices as $key => $price) {
                echo '
                <tr>
                    <td style="width: 10px">'.++$key.'</td>
                    <td>'.$price->product_name->name.'</td>
                    <td>'.$price->old_cost.'</td>
                    <td>'.$price->old_price.'</td>
                    <td>'.$price->new_cost.'</td>
                    <td>'.$price->new_price.'</td>
                    <td>'.$price->updated_at.'</td>
                    <td style="width: 200px">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Products Detail - '.$price->product_name->name.'" data-bs-url="form_view/viewProduct/'.$price->product_id.'" data-bs-size="modal-lg"> View Product</button>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Price Details" data-bs-url="form_edit/editPriceProduct/'.$price->price_id.'" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Price Deletion" data-bs-url="form_delete/deletePriceProduct/'.$price->price_id.'" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                ';
            }

        }
        else {
            echo '
                <tr>
                    <td colspan="10"><h3>No Data Found</h3></td>
                </tr>
            ';
        }
    }

    public function searchTransactions (Request $request)
    {
        $transactions = VWTransactions::where('invoice_no', 'ILIKE', '%'.$request['search'].'%')
                    ->orWhere('customer_name', 'ILIKE', '%'.$request['search'].'%')
                    ->orWhere('transaction_date', 'ILIKE', '%'.$request['search'].'%')
                    ->orWhere('status', 'ILIKE', '%'.$request['search'].'%')
                    ->orderByDesc('transaction_date')->limit(100)->get();
        // <td>'.$user->position.'</td>
        if($transactions){
            foreach ($transactions as $key => $transaction) {
                echo '
                <tr>
                    <td style="width: 10px">'.++$key.'</td>
                    <td>'.$transaction->invoice_no.'</td>
                    <td>'.$transaction->customer_name.'</td>
                    <td>'.$transaction->transaction_amount.'</td>
                    <td>'.$transaction->amount_paid.'</td>
                    <td>'.$transaction->balance.'</td>
                    <td>'.$transaction->status.'</td>
                    <td>'.$transaction->transaction_date.'</td>
                    <td style="width: 200px">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Invoice - '.$transaction->invoice_no.'" data-bs-url="form_view/viewInvoice/'.$transaction->transaction_id.'" data-bs-size="modal-xl"> Invoice</button>
                        <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Make Payment for - '.$transaction->invoice_no.'" data-bs-url="form_edit/makePayment/'.$transaction->transaction_id.'" data-bs-size="modal-xl" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-cash-stack"></i></button>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Transaction Details for '.$transaction->invoice_no.'" data-bs-url="form_edit/editTransaction/'.$transaction->transaction_id.'" data-bs-size="modal-xl" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Transaction Deletion" data-bs-url="form_delete/deleteTransaction/'.$transaction->transaction_id.'" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                ';
            }

        }
        else {
            echo '
                <tr>
                    <td colspan="10"><h3>No Data Found</h3></td>
                </tr>
            ';
        }
    }

    public function searchProjects (Request $request)
    {
        $projects = VWProject::where('name', 'ILIKE', '%'.$request['search'].'%')
            ->orWhere('description', 'ILIKE', '%'.$request['search'].'%')
            ->orWhere('due_date', 'ILIKE', '%'.$request['search'].'%')
            ->orderByDesc('created_at')->limit(100)->get();

        if($projects){
            foreach ($projects as $key => $project) {
                $percent = 0;
                if($project->task_count >= 1){
                    $percent =  ($project->task_count_completed / $project->task_count) * 100;
                }
                echo '
                    <tr class="align-middle">
                        <td>'.++$key.'</td>
                        <td nowrap>'.$project->name.'</td>
                        <td>'.$project->description.'</td>
                        <td nowrap>'.$project->due_date.'</td>
                        <td nowrap>'.getStatus($project->status).'</td>
                        <td>
                            <div class="progress rounded" role="progressbar" aria-label="Danger striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 22px">
                                <div class="progress-bar progress-bar-striped bg-danger" style="width: '.$percent.'%">'.$percent.'%</div>
                            </div>
                        </td>
                        <td nowrap>'.get_logged_staff_name($project->createdBy->id).'</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Projects Detail - '.$project->name.'" data-bs-url="form_view/viewProject/'.$project->project_id.'" data-bs-size="modal-xl"> View Project</button>
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Project Details" data-bs-url="form_edit/editProject/'.$project->project_id.'" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Project Deletion" data-bs-url="form_delete/deleteProject/'.$project->project_id.'" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                ';
            }

        }
        else {
            echo '
                <tr>
                    <td colspan="10"><h3>No Data Found</h3></td>
                </tr>
            ';
        }
    }

    public function searchTasks (Request $request)
    {
        $tasks = Task::where('name', 'ILIKE', '%'.$request['search'].'%')
            ->orWhere('description', 'ILIKE', '%'.$request['search'].'%')
            ->orWhere('due_date', 'ILIKE', '%'.$request['search'].'%')
            ->orderByDesc('created_at')->limit(100)->get();

        if($tasks){
            foreach ($tasks as $key => $task) {
                echo '
                    <tr class="align-middle">
                        <td>'.++$key.'</td>
                        <td nowrap>'.$task->name.'</td>
                        <td nowrap>'.$task->project->name.'</td>
                        <td>'.$task->description.'</td>
                        <td nowrap>'.$task->due_date.'</td>
                        <td nowrap>'.getStatus($task->status).'</td>
                        <td nowrap>'.getPriority($task->priority).'</td>
                        <td nowrap>'.$task->assignedStaff->full_name.'</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="View Tasks Detail - '.$task->name.'" data-bs-url="form_view/viewTask/'.$task->task_id.'" data-bs-size="modal-xl"> View Task</button>
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Edit Task Details" data-bs-url="form_edit/editTask/'.$task->task_id.'" data-bs-size="modal-lg" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Confirm Task Deletion" data-bs-url="form_delete/deleteTask/'.$task->task_id.'" data-bs-size="" style="padding-top: 8px; padding-bottom: 8px;"> <i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                ';
            }

        }
        else {
            echo '
                <tr>
                    <td colspan="10"><h3>No Data Found</h3></td>
                </tr>
            ';
        }
    }
}
