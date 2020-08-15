<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employees = Employee::all();
        return view('welcome',compact('employees'));
    }
}
