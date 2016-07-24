<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveUserRequest extends Request {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|max:255',
            'expires_at' => 'required|date',
            'role_id' => 'required|integer',
        ];

        if(trim($this->input('password')) != ""){
            $rules['password'] = 'required|min:6|confirmed';
        }

        return $rules;
    }
}
