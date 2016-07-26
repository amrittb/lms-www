<?php namespace App\Http\Requests;


class SaveBookCopyRequest extends Request {

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
            'provider_id' => 'required',
            'provision_category_id' => 'required'
        ];

        if($this->getMethod() != "PATCH") {
            $rules['copy_id'] = 'required|integer';
        }

        return $rules;
    }
}
