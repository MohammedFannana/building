<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'image' => ['image', 'required', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            // *******************
            'experience_year' => ['nullable', "required_if:user_type,==,provider", 'int'],
            'provider' => ['in:technical_worker,general_contractor,equipment_company,materials_company,factory'],
            'commercial_register' => ['int'],
            'services' => ['string'],
            'address' => ['string'],

        ];
    }
}
