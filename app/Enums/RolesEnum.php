<?php

namespace App\Enums;

enum RolesEnum: string
{
    case SYSTEMADMIN = 'System Administrator';
    case USERSMANAGER = 'Users Manager';
    case STAFFMANAGER = 'Staff Manager';
    case PRODUCTMANAGER = 'Product Manager';
    case TRANSACTIONSMANAGER = 'Transactions Manager';
    case PROJECTMANAGER = 'Project Manager';
    case FINANCIALMANAGER = 'Financial Manager';
}
