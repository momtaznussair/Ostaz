<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:11|numeric|unique:users,phone',
            'city_id' => 'required|exists:cities,id',
            'country' => 'required|exists:countries,id',
            'avatar' =>  'nullable|image|max:1024', //1MB Max
            'password' => ['required', 'confirmed', Password::defaults()],
            'age' => 'required|integer|min:13',
            'gender' => ['required', Rule::in(['m', 'f']) ],
            'type' => ['required', Rule::in(['Instructor', 'Student']) ],
        ];
    }
}
