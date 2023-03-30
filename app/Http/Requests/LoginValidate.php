<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginValidate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "code" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            "code.required" => "授权code不能为空",
        ];
    }
}
