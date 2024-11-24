<?php

namespace App\Enums;

enum ShopStatus: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case SUSPEND = 'suspend';
}