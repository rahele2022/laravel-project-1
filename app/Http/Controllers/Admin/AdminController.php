<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
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

