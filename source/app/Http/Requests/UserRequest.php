<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
* This is our user request class
* and it's used for validating the username
*
* @author     Hussien Ashour
* @version    1
* ...
*/
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
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users,name'
        ];
    }
}
