<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        $totalEvents = Event::count();
        $totalUsers = \App\Models\User::count();
        $totalRegistrations = \App\Models\Registration::count();

        return view('admin.dashboard', compact('totalEvents', 'totalUsers', 'totalRegistrations'));
    }
}
