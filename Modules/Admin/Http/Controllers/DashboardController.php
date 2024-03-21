<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return 'hey admin';
    }
}