<?php

namespace App\Http\Controllers\Web\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index() : View
    {
        return view('pages.dashboard.index');
    }
}
