<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Project;
use App\Models\Technology;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'technologies' => Technology::count(),
            'inquiries' => Inquiry::count(),
            'users' => User::count(),
        ];

        $recentProjects = Project::orderByDesc('created_at')->limit(5)->get();
        $newInquiries = Inquiry::where('status', 'new')->orderByDesc('created_at')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProjects', 'newInquiries'));
    }
}