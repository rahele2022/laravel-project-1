<?php

namespace App\Http\Controllers\Customer;

use App\Jobs\SendWelcomeEmailJob;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\TestMail;
use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use function back;
use function redirect;
use function view;

class CustomerController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {
//        $user = User::find(2);
//         $user->role()->get();

//        $role = Role::find(1);
//       return $role->user()->get();

        return view('index', [
            'user' => User::all()
        ]);
    }

    public function create()
    {
        return view('users.create');

    }

    public function store(UserRequest $request)
    {
        $validate_data = $request->validated();

        auth()->user()->create([
            'name' => $validate_data['name'],
            'email' => $validate_data['email'],
            'password' => $validate_data['password'],
            'password-confirm' => $validate_data['password-confirm']
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
//            return view('users.edit' , [
//                'customer'=>$customer
//            ]);
//        }
//        abort(403);

//        $this->authorize('edit-user' , $customer);

//        if (auth()->customer()->can('edit-user' , $customer))
//
//        return view('users.edit' , [
//            'customer'=>$customer
//        ]);
//        abort(403);

        if (Gate::allows('edit', $customer)) {
            return view('users.edit', [
                'customer' => $customer
            ]);
        }
        abort(403);
    }

    public function update(UserRequest $request, $id)
    {
        $validate_data = $request->validated();
        $customer = Customer::findOrFail($id);
        $customer->update($validate_data);
        return redirect('/')->withsuccess('اطلاعات کاربر با موفقیت ویرایش شد');
    }

    public function delete($id, Customer $customer)
    {
        if (Gate::allows('delete', $customer)) {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return redirect('/')->withsuccess('اطلاعات کاربر با موفقیت حذف شد');
        }


    }

}
