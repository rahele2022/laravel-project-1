<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function home()
    {
        $customers= Customer::orderBy('id')->get();
        return view('index');
    }
    public function create()
    {
        return view('customers.create');

    }
    public function store()
    {
        $validate_data = Validator::make(request()->all() , [
            'name'=> 'required|min:3 |max:50',
            'family'=> 'required',
            'email'=> 'required',
            'age'=> 'required'
        ])->validated();

            Customer::create([
            'age'=> $validate_data('age'),
            'name'=> $validate_data('name'),
            'family'=> $validate_data('family'),
            'email'=> $validate_data('email')
        ]);
            return redirect('/');
    }

}
