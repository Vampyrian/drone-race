<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class RaceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after_or_equal:start_at'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
