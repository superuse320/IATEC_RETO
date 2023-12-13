<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function index()
    {
        Auth::user()->emainl;
        return view('admin.home');
    }
}
