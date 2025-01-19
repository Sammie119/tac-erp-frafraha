<?php

use App\Enums\RolesEnum;
use App\Models\ProductSubCategory;
use App\Models\Setups;
use App\Models\SystemLOV;
use App\Models\VWStaff;
use App\Models\VWUser;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Spatie\Permission\Models\Permission;

if (!function_exists("get_logged_in_user_id")) {
    function get_logged_in_user_id(): int
    {
        return Auth::user()->id;
        // return auth()->user()["id"];
    }
}

if (!function_exists("get_logged_staff_name")) {
    function get_logged_staff_name($id = null): string
    {
        if($id == null){
            return VWUser::find(Auth::user()->id)->staff_name;
        }

        return VWUser::find($id)->staff_name;
    }
}

if (!function_exists("get_logged_staff_position")) {
    function get_logged_staff_position(): string
    {
        return VWStaff::find(Auth::user()->staff_id)->position_name;

    }
}

if (!function_exists("get_logged_user_division_id")) {
    function get_logged_user_division_id(): int
    {
        return Auth::user()->division;

    }
}

if (!function_exists("get_logged_user_stores_division_ids")) {
    function get_logged_user_stores_division_ids(): array
    {
        $st_array = SystemLOV::select('id')->where('parent_id', 42)->get()->pluck('id')->toArray();
        $st_array[] = 42;
        return $st_array;
    }
}

if (!function_exists("get_logged_user_division")) {

    function get_logged_user_division($id = null): string
    {
        if($id == null){
            $id = Auth::user()->division;
        }
        $division = SystemLOV::find($id);
        return $division->name;

    }
}

if (!function_exists("get_logged_user_division_name")) {
    function get_logged_user_division_name(): string
    {
        return SystemLOV::find(get_logged_user_division_id())->name;

    }
}

if (!function_exists("get_permission_name")) {
    function get_permission_name($id): string
    {
        $permission = Permission::find($id);

        if($permission){
            return $permission->name;
        }
        return "";

    }
}

if (!function_exists("use_roles_sidebar")) {
    function use_roles_sidebar($role_name)
    {
        return auth()->user()->hasRole($role_name->value);

    }
}

if(!function_exists("getTaxValue")){
    function getTaxValue($value)
    {
        // DB::table('shop_settings')->selectRaw('*')->first();
        $value = Setups::selectRaw("$value")->first()->$value;

        return $value;
    }
}

if(!function_exists("getShopSettings")){
    function getShopSettings()
    {
        // DB::table('shop_settings')->selectRaw('*')->first();
        return Setups::selectRaw('*')->where('division', get_logged_user_division_id())->first();
    }
}

if(!function_exists("getTax")){
    function getTax($amount)
    {
        $nhil = $amount * (getShopSettings()->nhil / 100);
        $gehl = $amount * (getShopSettings()->gehl / 100);
        $covid = $amount * (getShopSettings()->covid19 /100);

        $sum = $amount + $nhil + $gehl + $covid;

        $result = $sum * (getShopSettings()->vat / 100);

        $total = $sum + $result;

        return $total;
    }
}

if(!function_exists("invoice_num")){
    function invoice_num ($input, $pad_len = 7, $prefix = null) {
        if (is_string($prefix))
            return sprintf("%s%s", $prefix, str_pad($input, $pad_len, "0", STR_PAD_LEFT));

        return str_pad($input, $pad_len, "0", STR_PAD_LEFT);
    }
}

if(!function_exists("getStatus")){
    function getStatus($status, $type = null)
    {
        if($type === null) {
            switch ($status) {
                case 0:
                    return "<span class='badge bg-warning rounded-pill p-2' style='font-size: 14px'>Pending</span>";
                case 1:
                    return "<span class='badge bg-primary rounded-pill p-2' style='font-size: 14px'>In Progress</span>";
                case 2:
                    return "<span class='badge bg-success rounded-pill p-2' style='font-size: 14px'>Completed</span>";
                case 3:
                    return "<span class='badge bg-danger rounded-pill p-2' style='font-size: 14px'>Cancelled</span>";
                default:
                    return "Unknown";
            }
        }
        elseif($type === 1) {
            switch ($status) {
                case 0:
                    return "<span class='badge bg-warning rounded-pill p-2' style='font-size: 14px'>Pending</span>";
                case 1:
                    return "<span class='badge bg-success rounded-pill p-2' style='font-size: 14px'>Approved</span>";
                case 2:
                    return "<span class='badge bg-danger rounded-pill p-2' style='font-size: 14px'>Rejected</span>";
                default:
                    return "Unknown";
            }
        }
    }
}

if(!function_exists("getPriority")){
    function getPriority($priority)
    {
        switch ($priority) {
            case 0:
                return "<span class='badge bg-success rounded-pill p-2' style='font-size: 14px'>Low</span>";
            case 1:
                return "<span class='badge bg-warning rounded-pill p-2' style='font-size: 14px'>Medium</span>";
            case 2:
                return "<span class='badge bg-danger rounded-pill p-2' style='font-size: 14px'>High</span>";
            default:
                return "Unknown";
        }
    }
}

if(!function_exists("getPaymentStatus")){
    function getPaymentStatus($status = 'Not Started')
    {
        $paymentStatus = [
            'Not Started' => "<span class='badge bg-danger rounded-pill p-2' style='font-size: 14px'>Not Started</span>",
            'Paid' => "<span class='badge bg-success rounded-pill p-2' style='font-size: 14px'>Paid</span>",
            'Paying' => "<span class='badge bg-primary rounded-pill p-2' style='font-size: 14px'>Paying</span>",
        ][$status] ?? 'Not Started';

        return $paymentStatus;
    }
}

if(!function_exists("getOrderStatus")){
    function getOrderStatus($status = 0)
    {
        $paymentStatus = [
            0 => "<span class='badge bg-danger rounded-pill p-2' style='font-size: 14px'>Pending</span>",
            1 => "<span class='badge bg-success rounded-pill p-2' style='font-size: 14px'>Received</span>",
        ][$status] ?? 0;

        return $paymentStatus;
    }
}

if(!function_exists("getDateFormat")){
    function getDateFormat($datetime)
    {
        $date = date_create($datetime);
        return date_format($date,"Y-m-d h:i A");
    }
}

if(!function_exists("getCategoryName")){
    function getCategoryName($id, $type = 'Category')
    {
        if($type == 'Category'){
            $category = SystemLOV::find($id)->name;
        } else {
            $category = ProductSubCategory::find($id)->name;
        }
        return $category;
    }
}

