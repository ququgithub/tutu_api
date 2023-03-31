<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInfoValidate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "nickname" => "required|max:20",
            "mobile" => "sometimes",
            "email" => "sometimes",
            "avatar_url" => "required",
            "gender" => "required",
            "birthday" => "required|date",
            "remark" => "sometimes",
            "profession" => "sometimes",
            "name" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            "nickname.required" => "昵称必填",
            "nickname.max" => "昵称最大20字符",
            "avatar_url.required" => "头像必传",
            "gender.required" => "性别必选",
            "birthday.required" => "生日必填",
            "name.required" => "姓名必填",
        ];
    }
}
