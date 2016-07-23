<?php namespace App\Http\Requests;

class SaveBookRequest extends Request
{
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
            'book_name' => 'required|min:10|max:255',
            'isbn' => 'required|isbn|unique:books',
            'edition' => 'required|integer|min:1',
            'publication_id' => 'required|integer|exists:publications,id'
        ];
    }
}
