<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function cordinator(){     
        return view('dashboards.coordinator');
    }

    public function teacher(){      
        return view('dashboards.teacher');
    }

    public function student(){   
        return view('dashboards.student');
    }
}
