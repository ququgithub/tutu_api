<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateSubscribeValidate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "template_id" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            "template_id.required" => "模板不能为空",
        ];
    }
}
