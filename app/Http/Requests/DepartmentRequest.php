<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
                'name' => 'required|String',
                'description' => 'required|String',
                'logo' => 'required|File|mimes:jpeg,bmp,png|max:512',
            ];
        } elseif ($this->method() === self::METHOD_PUT) {
            return [
                'name' => 'String',
                'description' => 'String',
//                'logo' => 'File|mimes:jpeg,bmp,png|max:512',
            ];
        }
    }
}
