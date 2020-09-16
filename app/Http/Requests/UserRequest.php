<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        if ($this->method() === self::METHOD_POST) {
            return [
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string',
            ];
        } elseif ($this->method() === self::METHOD_PUT) {
            return [
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'string',
            ];
        }
    }
}
