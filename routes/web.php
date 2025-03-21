<?php

use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use App\Http\Controllers\BankingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\FinancialPeriodController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SetupsController;
use App\Http\Controllers\StaffAttendanceController;
use App\Http\Controllers\StoresTransferController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionReportController;
use App\Http\Controllers\WaybillController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DropdownsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(ProfileController::class)->group(function() {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::put('/profile', 'update')->name('profile.update');
//        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::group(['middleware' => ['role:'.RolesEnum::STAFFMANAGER->value]], function () {
        Route::controller(StaffController::class)->group(function () {
            Route::get('staff', 'index')->name('staff')->middleware('permission:'.PermissionsEnum::VIEWSTAFF->value);
            Route::post('staff_store', 'store')->middleware('permission:'.PermissionsEnum::CREATESTAFF->value);
            Route::put('staff_store', 'update')->middleware('permission:'.PermissionsEnum::UPDATESTAFF->value);
            Route::post('delete_staff', 'destroy')->middleware('permission:'.PermissionsEnum::DELETESTAFF->value);
            // Route::post('system_lovs_store', 'store');
        });
        Route::controller(StaffAttendanceController::class)->group(function () {
            Route::get('attendance', 'index')->name('attendance')->middleware('permission:'.PermissionsEnum::STAFFATTENDANCE->value);
            Route::post('attendance_store', 'store')->middleware('permission:'.PermissionsEnum::STAFFATTENDANCE->value);
            Route::get('attendance_export', 'export')->middleware('permission:'.PermissionsEnum::STAFFATTENDANCE->value);
            Route::post('delete_attendance', 'destroy')->middleware('permission:'.PermissionsEnum::DELETEATTENDANCE->value);
        });
    });

    Route::group(['middleware' => ['role:'.RolesEnum::PRODUCTMANAGER->value]], function () {
        Route::controller(ProductsController::class)->group(function () {
            Route::get('products', 'index')->name('products')->middleware('permission:'.PermissionsEnum::VIEWPRODUCT->value);
            Route::post('product_store', 'store')->middleware('permission:'.PermissionsEnum::CREATEPRODUCT->value);
            Route::put('product_store', 'update')->middleware('permission:'.PermissionsEnum::UPDATEPRODUCT->value);
            Route::post('delete_product', 'destroy')->middleware('permission:'.PermissionsEnum::DELETEPRODUCT->value);
            Route::get('restock_products', 'restockProductIndex')->name('restock_products')->middleware('permission:'.PermissionsEnum::VIEWPRODUCT->value);
            Route::post('restock_product_store', 'restockProductStore')->middleware('permission:'.PermissionsEnum::CREATEPRODUCT->value);
            Route::put('restock_product_store', 'restockProductUpdate')->middleware('permission:'.PermissionsEnum::UPDATEPRODUCT->value);
            Route::post('delete_restock_product', 'restockProductDestroy')->middleware('permission:'.PermissionsEnum::DELETEPRODUCT->value);
            Route::get('product_pricing', 'productPricingIndex')->name('product_pricing')->middleware('permission:'.PermissionsEnum::VIEWPRODUCT->value);
            Route::post('price_product_store', 'productPricingStore')->middleware('permission:'.PermissionsEnum::CREATEPRODUCT->value);
            Route::put('price_product_store', 'productPricingUpdate')->middleware('permission:'.PermissionsEnum::UPDATEPRODUCT->value);
            Route::post('delete_price_product', 'productPricingDestroy')->middleware('permission:'.PermissionsEnum::DELETEPRODUCT->value);

            Route::get('materials', 'indexMaterial')->name('materials')->middleware('permission:'.PermissionsEnum::VIEWPRODUCT->value);

            Route::group(['middleware' => ['permission:'.PermissionsEnum::REQUISITIONREQUEST->value]], function () {
                Route::controller(RequisitionController::class)->group(function () {
                    Route::get('requisitions', 'index')->name('requisitions');
                    Route::post('requisition_store', 'store');
                    Route::put('requisition_store', 'update');
                    Route::post('delete_requisition', 'destroy')->middleware('permission:'.PermissionsEnum::DELETEREQUISITION->value);
                    Route::post('approve_requisition', 'approveRequisition')->middleware('permission:'.PermissionsEnum::APPROVEREQUISITION->value);
                });
            });

            Route::group(['middleware' => ['permission:'.PermissionsEnum::CREATESTORESPRODUCTS->value]], function () {
                Route::controller(DropdownsController::class)->group(function () {
                    Route::get('sub_categories', 'indexSubCategories')->name('sub_categories');
                    Route::post('sub_categories_store', 'storeSubCategories');
                    Route::post('delete_sub_categories', 'destroySubCategories');
                });
            });

            // Stock Transfer
            Route::controller(StoresTransferController::class)->group(function () {
                Route::get('stores_transfer', 'index')->name('stores_transfer')->middleware('permission:'.PermissionsEnum::CREATESTORESTRANSFER->value);
                Route::post('stores_transfer_store', 'store')->middleware('permission:'.PermissionsEnum::CREATESTORESTRANSFER->value);
                Route::put('stores_transfer_store', 'update')->middleware('permission:'.PermissionsEnum::CREATESTORESTRANSFER->value);
                Route::post('delete_stores_transfer', 'destroy')->middleware('permission:'.PermissionsEnum::DELETESTORESTRANSFER->value);
                Route::put('approve_stores_transfer/{id}', 'transferApprove')->middleware('permission:'.PermissionsEnum::APPROVESTORESTRANSFER->value);
            });

        });
    });

    Route::group(['middleware' => ['role:'.RolesEnum::TRANSACTIONSMANAGER->value]], function () {
        Route::controller(TransactionController::class)->group(function () {
            Route::get('transactions', 'transactionsIndex')->name('transactions')->middleware('permission:'.PermissionsEnum::VIEWINVOICE->value);
            Route::post('transaction_store', 'transactionsStore')->middleware('permission:'.PermissionsEnum::CREATEINVOICE->value);
            Route::put('transaction_store', 'transactionsUpdate')->middleware('permission:'.PermissionsEnum::UPDATEINVOICE->value);
            Route::post('delete_transaction', 'transactionsDestroy')->middleware('permission:'.PermissionsEnum::DELETEINVOICE->value);
            Route::get('payments', 'paymentsIndex')->name('payments')->middleware('permission:'.PermissionsEnum::VIEWPAYMENT->value);
            Route::post('make_payment', 'makePayment')->middleware('permission:'.PermissionsEnum::CREATEPAYMENT->value);
            Route::put('make_payment', 'paymentUpdate')->middleware('permission:'.PermissionsEnum::UPDATEPAYMENT->value);
            Route::post('make_single_payment', 'makeSinglePayment')->middleware('permission:'.PermissionsEnum::CREATEPAYMENT->value);
            Route::post('delete_payment', 'paymentDestroy')->middleware('permission:'.PermissionsEnum::DELETEPAYMENT->value);
            Route::get('print/{id}/{location}', 'invoicePrint')->name('print');
            Route::get('invoice/{id}/{type}', 'invoice');
            Route::get('invoice_pdf/{id}/{type}', 'invoicePdf')->name('invoice_pdf');

            Route::controller(BankingController::class)->group(function () {
                Route::get('sales_banking', 'index')->name('sales_banking')->middleware('permission:'.PermissionsEnum::CREATESALESBANKING->value);
                Route::post('sales_banking_store', 'salesBankingStore')->middleware('permission:'.PermissionsEnum::CREATESALESBANKING->value);
                Route::put('sales_banking_store', 'salesBankingUpdate')->middleware('permission:'.PermissionsEnum::CREATESALESBANKING->value);
                Route::post('delete_sales_banking', 'salesBankingDestroy')->middleware('permission:'.PermissionsEnum::DELETESALESBANKING->value);
                Route::put('approve_sales_banking/{id}', 'salesBankingApprove')->middleware('permission:'.PermissionsEnum::APPROVESALESBANKING->value);
            });
        });

        Route::controller(TransactionReportController::class)->group(function () {
            Route::get('transaction_reports', 'index')->name('transaction_reports');
            Route::post('invoice_report', 'invoiceReport');
            Route::post('daily_income_report', 'dailyIncomeReport');
//            Route::put('setup_store', 'update');
        });

        Route::group(['middleware' => ['permission:'.PermissionsEnum::PRINTWAYBILL->value]], function () {
            Route::controller(WaybillController::class)->group(function () {
                Route::get('waybills', 'index')->name('waybills');
                Route::post('waybill_store', 'store');
                Route::put('waybill_store', 'update');
                Route::post('delete_waybill', 'destroy')->middleware('permission:'.PermissionsEnum::DELETEWAYBILL->value);
                Route::get('print_waybill/{waybill_id}', 'printWaybill')->name('print_waybill');
            });
        });
    });

    Route::group(['middleware' => ['role:'.RolesEnum::PROJECTMANAGER->value]], function () {
        Route::controller(ProjectController::class)->group(function () {
            Route::get('projects', 'index')->name('projects')->middleware('permission:'.PermissionsEnum::VIEWPROJECT->value);
            Route::post('project_store', 'store')->middleware('permission:'.PermissionsEnum::CREATEPROJECT->value);
            Route::put('project_store', 'update')->middleware('permission:'.PermissionsEnum::UPDATEPROJECT->value);
            Route::post('delete_project', 'destroy')->middleware('permission:'.PermissionsEnum::DELETEPROJECT->value);
        });

        Route::controller(TaskController::class)->group(function () {
            Route::get('tasks', 'index')->name('tasks')->middleware('permission:'.PermissionsEnum::VIEWTASK->value);
            Route::post('task_store', 'store')->middleware('permission:'.PermissionsEnum::CREATETASK->value);
            Route::put('task_store', 'update')->middleware('permission:'.PermissionsEnum::UPDATETASK->value);
            Route::post('delete_task', 'destroy')->middleware('permission:'.PermissionsEnum::DELETETASK->value);
            Route::get('my_tasks', 'myTasks')->name('my_tasks')->middleware('permission:'.PermissionsEnum::VIEWALLTASK->value);
            Route::post('task_progress_store', 'taskProgressStore')->middleware('permission:'.PermissionsEnum::VIEWALLTASK->value);
        });
    });

    Route::group(['middleware' => ['role:'.RolesEnum::FINANCIALMANAGER->value]], function () {
        Route::controller(FinancialController::class)->group(function () {
            Route::get('financials', 'index')->name('financials')->middleware('permission:'.PermissionsEnum::VIEWFINANCIAL->value);
            Route::post('financial_store', 'store')->middleware('permission:'.PermissionsEnum::CREATEFINANCIAL->value);
            Route::put('financial_store', 'update')->middleware('permission:'.PermissionsEnum::UPDATEFINANCIAL->value);
            Route::post('delete_financial', 'destroy')->middleware('permission:'.PermissionsEnum::DELETEFINANCIAL->value);
            Route::get('financial_report', 'financialReport')->name('financial_report')->middleware('permission:'.PermissionsEnum::FINANCIALREPORT->value);
            // Route::post('system_lovs_store', 'store');
        });
    });

    Route::group(['middleware' => ['permission:'.PermissionsEnum::SUPPLIERSMANAGER->value]], function () {
        Route::controller(SupplierController::class)->group(function () {
            Route::get('suppliers', 'index')->name('suppliers');
            Route::post('supplier_store', 'store');
            Route::put('supplier_store', 'update');
            Route::post('delete_supplier', 'destroy');
        });
    });

    Route::group(['middleware' => ['permission:'.PermissionsEnum::MANAGERCUSTOMER->value]], function () {
        Route::controller(CustomerController::class)->group(function () {
            Route::get('customers', 'index')->name('customers');
            Route::post('customer_store', 'store');
            Route::put('customer_store', 'update');
            Route::post('delete_customer', 'destroy');
        });
    });

    Route::group(['middleware' => ['role:'.RolesEnum::SYSTEMADMIN->value]], function () {
        Route::group(['middleware' => ['permission:'.PermissionsEnum::PURCHASEORDER->value]], function () {
            Route::controller(PurchaseOrderController::class)->group(function () {
                Route::get('purchase_orders', 'index')->name('purchase_orders');
                Route::post('purchase_order_store', 'store');
                Route::put('purchase_order_store', 'update');
                Route::post('delete_purchase_order', 'destroy');
            });
        });

        //change permission later
        Route::group(['middleware' => ['permission:'.PermissionsEnum::PURCHASEORDER->value]], function () {
            Route::controller(FinancialPeriodController::class)->group(function () {
                Route::get('financial_periods', 'index')->name('financial_periods');
                Route::post('financial_period_store', 'store');
                Route::put('financial_period_store', 'update');
                Route::post('delete_financial_period', 'destroy');
            });
        });

    });

    Route::group(['middleware' => ['role:'.RolesEnum::SYSTEMADMIN->value]], function () {
        Route::controller(DropdownsController::class)->group(function () {
            Route::get('system_lovs', 'index')->name('system_lovs')->middleware('permission:'.PermissionsEnum::VIEWLOV->value);
            Route::post('system_lovs_store', 'store')->middleware('permission:'.PermissionsEnum::CREATELOV->value);
            Route::put('system_lovs_store', 'update')->middleware('permission:'.PermissionsEnum::UPDATELOV->value);
            Route::post('delete_category', 'destroy')->middleware('permission:'.PermissionsEnum::DELETELOV->value);
            Route::post('list_of_values_store', 'createListOfValue')->middleware('permission:'.PermissionsEnum::CREATELOV->value);
            Route::post('delete_lov_value', 'deleteLOVValue')->middleware('permission:'.PermissionsEnum::DELETELOV->value);
        });

        Route::controller(SetupsController::class)->group(function () {
            Route::get('setups', 'index')->name('setups');
            Route::post('setup_store', 'store');
            Route::put('setup_store', 'update');
        });

        Route::controller(PermissionController::class)->group(function () {
            Route::get('permissions', 'index')->name('permissions');
            Route::post('permission_store', 'store');
            Route::put('permission_store', 'update');
            Route::post('delete_permission', 'destroy');
        });

        Route::controller(RoleController::class)->group(function () {
            Route::get('roles', 'index')->name('roles');
            Route::post('role_store', 'store');
            Route::put('role_store', 'update');
            Route::post('delete_role', 'destroy');
            Route::put('permissions_store', 'storePermission');
        });
    });

//    Route::get('permissions', [PermissionController::class, 'store']);

});

require __DIR__.'/auth.php';

require __DIR__.'/ajax.php';
