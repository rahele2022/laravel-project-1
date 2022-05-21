<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $customers= Customer::orderBy('id')->get();
        return view('index');
    }
}
