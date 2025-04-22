<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin_dashboard()
    {
        return view('admin.dashboard'); // resources/views/admin/dashboard.blade.php
    }

    public function pelayan_dashboard()
    {
        return view('pelayan.dashboard'); // resources/views/pelayan/dashboard.blade.php
    }

    public function kasir_dashboard()
    {
        return view('kasir.dashboard'); // resources/views/kasir/dashboard.blade.php
    }

    public function pemilik_dashboard()
    {
        return view('pemilik.dashboard'); // resources/views/pemilik/dashboard.blade.php
    }

    public function dapur_dashboard()
    {
        return view('dapur.dashboard'); // resources/views/dapur/dashboard.blade.php
    }
}
