<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Mail\TestMail;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use function back;
use function redirect;
use function view;

class CustomerController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
    public function index()
    {
//        dd(auth()->user());
//          dd(auth()->check());
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


            $customer = Customer::find($validate_data);
            Mail::to($validate_data['email'])->send(new TestMail($validate_data['name'], $validate_data['family']));

//            Mail::to('r.manzari@gmail.com')->send(new TestMail('Rahele' , 2022));
            return redirect('/')->withsuccess('اطلاعات کاربر با موفقیت ثبت شد');
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
        return redirect('/')->withsuccess('اطلاعات کاربر با موفقیت ویرایش شد');
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect('/')->withsuccess('اطلاعات کاربر با موفقیت حذف شد');
    }

}
