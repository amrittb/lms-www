<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveBookProviderRequest extends Request {

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
        return [
            'provider_name' => 'required|min:10',
            'contact_no' => 'required|min:10',
            'contact_pname' => 'required|min:10'
        ];
    }
}
