<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $customers = Customer::latest()->paginate(10);

        return view('dashboard', compact('totalUsers', 'customers'));
    }
}
