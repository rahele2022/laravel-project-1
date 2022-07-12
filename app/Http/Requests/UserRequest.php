<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'role_id'=> 'required',
            'name'=> 'required|min:3 |max:50',
            'email' => 'required | email',
            'password'=> 'required | min:8',
            'password-confirm'=> 'required',
            'image'=> 'mimes: jpg , jpeg | max:50',

        ];
    }
}
