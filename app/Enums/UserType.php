<?php

namespace App\Enums;

enum UserType:string{
    case USER = 'user';
    case SELLER = 'seller';
    case ADMIN = 'admin';
}