<?php

namespace App\Http;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use function back;
use function redirect;
use function view;

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
    public function store(CustomerRequest $request)
    {
            $validate_data = $request->validated();

            Customer::create([
            'name'=> $validate_data['name'],
            'family'=> $validate_data['family'],
            'email'=> $validate_data['email'],
            'age'=> $validate_data['age']
        ]);
            return redirect('/');
    }
    public function edit(Customer $customer)
    {
//        $customer = Customer::findOrFail($id);
        return view('customers.edit' , [
            'customer'=>$customer
        ]);
    }
    public function update( CustomerRequest $request,$id)
    {
        $validate_data = $request->validated();
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
