<?php

use App\Http\Controllers\FormsDeleteController;
use App\Http\Controllers\FormsEditController;
use App\Http\Controllers\FormsReportController;
use App\Http\Controllers\FormsViewController;
use App\Http\Controllers\GetAjaxCallController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormsCreateController;


Route::middleware('auth')->group(function () {
    Route::get('form_create/{forms}', [FormsCreateController::class, 'createForm']);
    Route::get('form_edit/{forms}/{id}', [FormsEditController::class, 'editForm']);
    Route::get('form_view/{forms}/{id}', [FormsViewController::class, 'viewForm']);
    Route::get('form_delete/{forms}/{id}', [FormsDeleteController::class, 'deleteForm']);
    Route::get('form_report/{forms}', [FormsReportController::class, 'reportForm']);

    Route::controller(SearchController::class)->group(function() {
        Route::post('search_users', 'searchUsers');
        Route::post('search_lov_category', 'searchLOVCategory');
        Route::post('search_permissions', 'searchPermissions');
        Route::post('search_staff', 'searchStaff');
        Route::post('search_products', 'searchProducts');
        Route::post('search_restock', 'searchRestock');
        Route::post('search_prices', 'searchPrices');
        Route::post('search_transactions', 'searchTransactions');
        Route::post('search_projects', 'searchProjects');
        Route::post('search_tasks', 'searchTasks');
    });

    Route::controller(GetAjaxCallController::class)->group(function() {
        Route::post('get_search_product', 'getSearchProduct');
        Route::post('get_search_invoice', 'getSearchInvoice');
        Route::post('sales_received', 'getSalesReceived');
    });
});

