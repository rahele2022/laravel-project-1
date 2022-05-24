<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        return view('index',[
            'customers'=> Customer::all()
        ]);
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
            'name'=> $validate_data['name'],
            'family'=> $validate_data['family'],
            'email'=> $validate_data['email'],
            'age'=> $validate_data['age']
        ]);
            return redirect('/');
    }
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit' , [
            'customer'=>$customer
        ]);
    }
    public function update($id)
    {
        $validate_data = Validator::make(request()->all() , [
            'name'=> 'required|min:3 |max:50',
            'family'=> 'required',
            'email'=> 'required',
            'age'=> 'required'
        ])->validated();

        $customer = Customer::findOrFail($id);
        $customer-> update($validate_data);
        return redirect('/');
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return back();
    }

}
