<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
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
//        return [];
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', function($attribute, $value, $fail) {
                $user = $this->route('user');

                if($value === $user->email) return;

                if(DB::table('users')->where('email', $value)->count())
                    $fail('Email already in use.');
            }],
            'password' => ['sometimes', 'nullable','string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['admin', 'mod', 'user'])]
        ];
    }
}
