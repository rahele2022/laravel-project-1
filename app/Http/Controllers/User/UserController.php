<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Jobs\SendWelcomeEmailJob;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $users = User::all()->whereNotIn('role_id' , [2]);


        if (auth()->user()->role_id === Role::TYPE_ADMIN) {

//            dd(app('fooService')->dosomething());

            return view('/index', [
                'user' => $users
            ]);


        } elseif (auth()->user()->role_id === Role::TYPE_USER) {
            $user = User::where('id', auth()->id())->get();
            return view('/index', [
                'user' => $user
            ]);

        } elseif (auth()->user()->role_id === Role::TYPE_ACCOUNT) {

            $user = User::where('operator_id', auth()->id())->get();

            return view('/index', [
                'user' => $user
            ]);


        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        if (auth()->user()->role_id === Role::TYPE_ADMIN) {

            return view('user.create');

        } elseif (auth()->user()->role_id === Role::TYPE_ACCOUNT) {

            return view('user.usercreate');

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (auth()->user()->role_id === Role::TYPE_ADMIN) {


//            $validate_data = $request->validated();


            $validate_data = $request->validate([

                'role_id' => 'required',
                'name' => 'required|min:3 |max:50',
                'email' => 'required | email',
                'password' => 'required | min:8',
                'password-confirm' => 'required',
                'image' => 'mimes:jpg,jpeg | max:50',

            ]);

            if ($request->role_id == 3) {
                $validate_data['role_id'] = 3;
            } elseif ($request->role_id == 1) {
                $validate_data['role_id'] = 1;
            }

            $file = $request->file('image');
            $destinationPath = '/images/' . now()->year . '/' . now()->month . '/' . now()->day . '/';
            $file->move(public_path($destinationPath), $file->getClientOriginalName());
            $validate_data['image'] = $destinationPath . $file->getClientOriginalName();


            User::create([

                'role_id' => $validate_data['role_id'],
                'name' => $validate_data['name'],
                'email' => $validate_data['email'],
                'password' => Hash::make($request['password']),
                'password-confirm' => $validate_data['password-confirm'],
                'image' => $validate_data['image'],
            ]);


            $details['email'] = $validate_data['email'];
            dispatch(new SendWelcomeEmailJob($details));

            return redirect('/users')->withsuccess('اطلاعات کاربر با موفقیت ثبت شد');


        } elseif (auth()->user()->role_id === Role::TYPE_ACCOUNT) {

            $validate_data = $request->validate([

                'role_id' => 'required',
                'name' => 'required|min:3 |max:50',
                'email' => 'required | email',
                'password' => 'required | min:8',
                'password-confirm' => 'required',
                'image' => 'mimes:jpg,jpeg | max:50',

            ]);

            $validate_data['role_id'] = 1;
            $operator_id = auth()->id();

            $file = $request->file('image');
            $destinationPath = '/images/' . now()->year . '/' . now()->month . '/' . now()->day . '/';
            $file->move(public_path($destinationPath), $file->getClientOriginalName());
            $validate_data['image'] = $destinationPath . $file->getClientOriginalName();


            User::create([

                'role_id' => $validate_data['role_id'],
                'operator_id' => $operator_id,
                'name' => $validate_data['name'],
                'email' => $validate_data['email'],
                'password' => Hash::make($request['password']),
                'password-confirm' => $validate_data['password-confirm'],
                'image' => $validate_data['image'],
            ]);


            $details['email'] = $validate_data['email'];
            dispatch(new SendWelcomeEmailJob($details));

            return redirect('/users')->withsuccess('اطلاعات کاربر با موفقیت ثبت شد');


            $user_id = User::where('id', auth()->id())->get();
            $validate_data = $request->validated();

            $validate_data = $request->validate([
                'image' => 'mimes:jpg,jpeg|max:20'
            ]);


            User::create([

                'role_id' => 1,
                'operator_id' => $user_id,
                'name' => $validate_data['name'],
                'email' => $validate_data['email'],
                'password' => Hash::make($request['password']),
                'password-confirm' => $validate_data['password-confirm'],

            ]);

            $file = $request->file('image');
            $destinationPath = '/images/' . now()->year . '/' . now()->month . '/' . now()->day . '/';
            $file->move(public_path($destinationPath), $file->getClientOriginalName());
            $validate_data['image'] = $destinationPath . $file->getClientOriginalName();


            $details['email'] = $validate_data['email'];
            dispatch(new SendWelcomeEmailJob($details));

            return redirect('/users')->withsuccess('اطلاعات کاربر با موفقیت ثبت شد');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('user.show', [
            'user' => User::findOrFail($id)
        ]);


    }

    /**
     *
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $users = User::findOrFail($id);

        if (auth()->user()->role_id === Role::TYPE_ADMIN) {
            return view('user.edit', [
                'user' => $users

            ]);
        } elseif (auth()->user()->role_id === Role::TYPE_USER) {
            $user = User::where('id', auth()->id())->get();
            return view('user.useredit', [
                'user' => $users
            ]);

        } elseif (auth()->user()->role_id === Role::TYPE_ACCOUNT) {
            $user = User::where('id', auth()->id())->get();
            return view('user.useredit', [
                'user' => $users
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->role_id === Role::TYPE_ADMIN) {

            $validate_data = $request->validate([

                'role_id' => 'required',
                'name' => 'required|min:3 |max:50',
                'email' => 'required | email',
                'password' => 'required | min:8',
                'password-confirm' => 'required',
                'image' => 'mimes:jpg,jpeg | max:50',


            ]);


            if ($request->role_id == 3) {
                $validate_data['role_id'] = 3;
            } elseif ($request->role_id == 1) {
                $validate_data['role_id'] = 1;
            }

            $file = $request->file('image');
            $destinationPath = '/images/' . now()->year . '/' . now()->month . '/' . now()->day . '/';
            $file->move(public_path($destinationPath), $file->getClientOriginalName());
            $validate_data['image'] = $destinationPath . $file->getClientOriginalName();


            $user = User::findOrFail($id);
            $user->update([

                'role_id' => $validate_data['role_id'],
                'name' => $validate_data['name'],
                'email' => $validate_data['email'],
                'password' => Hash::make($request['password']),
                'password-confirm' => $validate_data['password-confirm'],
                'image' => $validate_data['image'],

            ]);


            return redirect('/users')->withsuccess('اطلاعات کاربر با موفقیت ویرایش شد');

        } elseif (auth()->user()->role_id === Role::TYPE_USER || auth()->user()->role_id === Role::TYPE_ACCOUNT) {

            $validate_data = $request->validate([

                'name' => 'required|min:3 |max:50',
                'email' => 'required | email',
                'password' => 'required | min:8',
                'password-confirm' => 'required',
                'image' => 'mimes:jpg,jpeg | max:50',


            ]);


            $file = $request->file('image');
            $destinationPath = '/images/' . now()->year . '/' . now()->month . '/' . now()->day . '/';
            $file->move(public_path($destinationPath), $file->getClientOriginalName());
            $validate_data['image'] = $destinationPath . $file->getClientOriginalName();


            $user = User::findOrFail($id);
            $user->update([

                'name' => $validate_data['name'],
                'email' => $validate_data['email'],
                'password' => Hash::make($request['password']),
                'password-confirm' => $validate_data['password-confirm'],
                'image' => $validate_data['image'],

            ]);


            return redirect('/users')->withsuccess('اطلاعات کاربر با موفقیت ویرایش شد');


        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy', $id);
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/users')->withsuccess('اطلاعات کاربر با موفقیت حذف شد');
    }
}
