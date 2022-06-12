<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Jobs\SendWelcomeEmailJob;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function show()
    {
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
        $details['email'] = $validate_data['email'];
        dispatch(new SendWelcomeEmailJob($details));
        return redirect('/')->withsuccess('اطلاعات کاربر با موفقیت ثبت شد');
    }

    public function edit(User $user)
    {
        if (Gate::allows('edit', $user)) {
            return view('users.edit', [
                'user' => $user
            ]);
        }
        abort(403);
    }

    public function update(UserRequest $request, $id)
    {
        $validate_data = $request->validated();
        $user = User::findOrFail($id);
        $user->update($validate_data);
        return redirect('/')->withsuccess('اطلاعات کاربر با موفقیت ویرایش شد');
    }

    public function delete($id, User $user)
    {
        if (Gate::allows('delete', $user)) {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect('/')->withsuccess('اطلاعات کاربر با موفقیت حذف شد');
        }

    }
}

