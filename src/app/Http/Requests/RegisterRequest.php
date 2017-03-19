<?php

namespace App\Http\Requests;

use Mail;
use App\User;
use App\Mail\RegisterMail;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegisterRequest
 * @package App\Http\Requests
 */
class RegisterRequest extends FormRequest
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
            'name' => 'required|max:30', // Name
            'username' => 'required|min:4|max:20|unique:users', // URL safe name
            'profile' => 'max:200', // Profile text
            'location' => 'max:255', // Location
            'email' => 'required|email|max:255|unique:users', // Email address used for auth.
            'password' => 'required|min:7|confirmed', //  Password, confirm input, 7 chars minimum.
        ];
    }


    public function presist()
    {
        $user = User::register($this->only(['name', 'username', 'profile', 'location', 'email', 'password']));
        auth()->login($user);
        Mail::to($user)->send(new RegisterMail($user));
    }
}
