<?php

namespace App\Http\Controllers\dashbord;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        User::where('role', User::CUSTOMER)->paginate(20);
        return view('dashbord.index');
    }
}
