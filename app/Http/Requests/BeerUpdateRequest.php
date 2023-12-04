<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeerUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'abv' => 'required|decimal:1',
            'color' => 'required|string|max:255',
            'brewery' => 'string|max:255',
            'beer_styles_id' => 'required|integer'
        ];
    }
}
