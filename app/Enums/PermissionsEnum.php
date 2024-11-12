<?php

namespace App\Enums;

enum PermissionsEnum: string
{
    //Users Permissions
    case CREATEUSERS = 'Create Users';
    case UPDATEUSERS = 'Update Users';
    case VIEWUSERS = 'View Users';
    case DELETEUSERS = 'Delete Users';
    case ADDROLESTOUSERS = 'Add Role to Users';

    //Staff Permissions
    case CREATESTAFF = 'Create Staff';
    case UPDATESTAFF = 'Update Staff';
    case VIEWSTAFF = 'View Staff';
    case DELETESTAFF = 'Delete Staff';
    case STAFFATTENDANCE = 'Staff Attendance';
    case DELETEATTENDANCE = 'Delete Attendance';

    //Product Permissions
    case CREATEPRODUCT = 'Create Products';
    case UPDATEPRODUCT = 'Update Products';
    case VIEWPRODUCT = 'View Products';
    case DELETEPRODUCT = 'Delete Products';
    case REQUISITIONREQUEST = 'Requisition Request';
    case APPROVEREQUISITION = 'Approve Requisition';
    case DELETEREQUISITION = 'Delete Requisition';
    case SUPPLIERSMANAGER = 'Suppliers Manager';

    //LOV Permissions
    case CREATELOV = 'Create LOVs';
    case UPDATELOV = 'Update LOVs';
    case VIEWLOV = 'View LOVs';
    case DELETELOV = 'Delete LOVs';

    //Transactions Permissions
    case CREATEINVOICE = 'Create Invoice';
    case UPDATEINVOICE = 'Update Invoice';
    case VIEWINVOICE = 'View Invoice';
    case DELETEINVOICE = 'Delete Invoice';
    case VIEWTRANSACTIONREPORT = 'View Transaction Report';

    case CREATEPAYMENT = 'Create Payment';
    case UPDATEPAYMENT = 'Update Payment';
    case VIEWPAYMENT = 'View Payment';
    case DELETEPAYMENT = 'Delete Payment';
    case PRINTWAYBILL = 'Print Waybill';
    case DELETEWAYBILL = 'Delete Waybill';

    //Project Permissions
    case CREATEPROJECT = 'Create Project';
    case UPDATEPROJECT = 'Update Project';
    case VIEWPROJECT = 'View Project';
    case DELETEPROJECT = 'Delete Project';
    case VIEWTASK = 'View Task';
    case CREATETASK = 'Create Task';
    case UPDATETASK = 'Update Task';
    case DELETETASK = 'Delete Task';
    case VIEWALLTASK = 'View All Task';

    //Financial Manager
    case CREATEFINANCIAL = 'Create Financial';
    case UPDATEFINANCIAL = 'Update Financial';
    case VIEWFINANCIAL = 'View Financial';
    case DELETEFINANCIAL = 'Delete Financial';
    case FINANCIALREPORT = 'Financial Report';

    //STORES MANAGER
    case CREATESTORESPRODUCTS = 'Create Stores Products';
    case MANAGERCUSTOMER = 'Manager Customer';
    case PURCHASEORDER = 'Create Purchase Order';
}


