<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Halaman Dashboard Admin
    public function admin()
    {
        return view('admin.dashboard');
    }

    // Halaman Dashboard Masyarakat
    public function masyarakat()
    {
        return view('masyarakat.dashboard');
    }

    // Halaman Dashboard Stakeholder
    public function stakeholder()
    {
        return view('stakeholder.dashboard');
    }
}

