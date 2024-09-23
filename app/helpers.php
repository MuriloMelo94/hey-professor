<?php

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

if(!function_exists('user')) {

    /* @return User | Authenticatable */
    function user(): ?User
    {

        if(auth()->check()) {
            return auth()->user();
        }

        return null;
    }
}
