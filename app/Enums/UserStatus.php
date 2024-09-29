<?php

namespace App\Enums;

enum UserStatus: string
{
    case USER = 'user';
    case SELLER = 'seller';
    case ADMIN = 'admin';
}
