<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private User $user)
    {

    }

    public function signUp() {


    }
}
