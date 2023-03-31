<?php
declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageUidValidate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "image_uid" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            "image_uid.required" => "图片编号不能为空",
        ];
    }
}
