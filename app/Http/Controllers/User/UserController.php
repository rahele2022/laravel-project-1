<?php

namespace App\Http\Controllers\User;

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

class UserController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {
        return view('index', [
            'user' => User::all()
        ]);
    }

    public function create()
    {
        return view('admin.create');

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

        $details['email'] = $validate_data['email'];
        dispatch(new SendWelcomeEmailJob($details));

        return redirect('/')->withsuccess('اطلاعات کاربر با موفقیت ثبت شد');
    }

    public function edit(Customer $customer)
    {

        if (Gate::allows('edit', $customer)) {
            return view('admin.edit', [
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
