<?php
declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocValidate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "uid" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            "uid.required" => "编号不能为空",
        ];
    }
}
