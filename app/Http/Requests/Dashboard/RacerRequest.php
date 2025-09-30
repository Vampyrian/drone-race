<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class RacerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'nickname' => ['nullable'],
            'email' => ['nullable', 'email', 'max:254'],
            'age' => ['nullable'],
            'flight_license' => ['nullable'],
            'license_plate' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
