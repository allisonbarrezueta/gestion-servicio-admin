<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class UsersController extends Controller
{
    protected $model = User::class;
}
