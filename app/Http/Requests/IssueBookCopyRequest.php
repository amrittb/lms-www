<?php namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class IssueBookCopyRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'member_id' => 'required|integer|exists:users,id'
        ];
    }
}
