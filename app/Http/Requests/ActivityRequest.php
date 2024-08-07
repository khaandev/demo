<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ActivityRequest extends FormRequest
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
            'images' => [Route::currentRouteName() === 'activites.store' ? 'required' : 'nullable', 'array'],
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string',
        ];
    }
}
