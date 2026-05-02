<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'categories' => Category::count(),
            'music' => Media::where('type', 'music')->count(),
            'videos' => Media::where('type', 'video')->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
