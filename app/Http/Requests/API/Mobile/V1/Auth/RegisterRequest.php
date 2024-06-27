<?php

namespace App\Http\Requests\API\Mobile\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'email' => [
                'required', 
                'email', 
                'unique:accounts,email'
            ],
            'password' => [
                'required', 
                'regex:/^[a-zA-Z0-9@\-_\/\'".,?!]+$/'
            ],
            'otp_id' => [
                'required',
                Rule::exists('otps', 'id')
                    ->where('email', $this->input('email'))
                    ->whereNotNull('verified_at')
            ],
        ];
    }
}
