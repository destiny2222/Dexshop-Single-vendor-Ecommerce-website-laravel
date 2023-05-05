<?php

namespace App\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'field'=>['required','string'],
            'password'=>['required']
        ];
    }
    public function authenticate()
    {
        $adminuser = Admin::where('email', $this->field)->orWhere('phone',$this->field)->first();
        if (!$adminuser || !Hash::check($this->password,$adminuser->password )){
            throw ValidationException::withMessages([
                'field'=>'The data does not match with what we have in our database'
            ]);
        }
        Auth::guard('admin')->login($adminuser);
    }
}
