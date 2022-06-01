<?php

namespace App\Http\Controllers\Customer;

use App\Jobs\SendWelcomeEmailJob;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Mail\TestMail;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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

//            $details['name'] = $validate_data['name'];
            $details['email'] = $validate_data['email'];
            dispatch(new SendWelcomeEmailJob($details));

//            $customer = Customer::find($validate_data);
//            Mail::to($validate_data['email'])->send(new TestMail($validate_data['name'], $validate_data['family']));

//            Mail::to('r.manzari@gmail.com')->send(new TestMail('Rahele' , 2022));
            return redirect('/')->withsuccess('اطلاعات کاربر با موفقیت ثبت شد');
    }
    public function edit(Customer $customer)
    {
//        $customer = Customer::findOrFail($id);

//        if (Gate::allows('edit-user' , $customer))
//        {
//            return view('customers.edit' , [
//                'customer'=>$customer
//            ]);
//        }
//        abort(403);

//        $this->authorize('edit-user' , $customer);

//        if (auth()->customer()->can('edit-user' , $customer))
//
//        return view('customers.edit' , [
//            'customer'=>$customer
//        ]);
//        abort(403);

    if (Gate::allows('edit', $customer)){
        return view('customers.edit' , [
            'customer'=>$customer
        ]);
    }
        abort(403);
    }
    public function update( CustomerRequest $request,$id)
    {
        $validate_data = $request->validated();
        $customer = Customer::findOrFail($id);
        $customer-> update($validate_data);
        return redirect('/')->withsuccess('اطلاعات کاربر با موفقیت ویرایش شد');
    }

    public function delete($id , Customer $customer)
    {
        if (Gate::allows('delete' , $customer)) {
                $customer = Customer::findOrFail($id);
                 $customer->delete();
            return redirect('/')->withsuccess('اطلاعات کاربر با موفقیت حذف شد');
        }



    }

}
