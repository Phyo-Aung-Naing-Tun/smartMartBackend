<?php

namespace App\Traits;

use App\Models\User;

trait AuthTraits
{

    public function checkPhone($phone)
    {
        return User::where('phone', $phone)->exists();
    }

    public function checkEmail($email)
    {
        return User::where('email', $email)->exists();
    }
}
