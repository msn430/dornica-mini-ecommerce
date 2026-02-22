<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class EditProfilePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                "required",
                "string",
                "min:2",
                "max:150",
                "persian_alpha"
            ],
            'last_name' => [
                "required",
                "string",
                "min:2",
                "max:150",
                "persian_alpha"
            ],
            'mobile' => [
                "required",
                "digits:11",
                'ir_mobile:zero',
                "unique:App\Models\User,mobile," . auth()->id(),
            ],
            'email' => [
                "required",
                "email",
                "max:150",
                "unique:App\Models\User,email," . auth()->id(),
            ],
            'password' => [
                'required',
                'min:8',
                'max:150',
                'alpha_num',
            ],
        ];
    }
}
