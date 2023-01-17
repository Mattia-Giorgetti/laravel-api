<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:types|max:100|min:2',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nome obbligatorio!',
            'name.min' => 'Il nome deve contenere almeno :min caratteri!',
            'name.max' => 'Il nome può contenere massimo :max caratteri',
            'name.unique:types' => 'Questo nome esiste già',
        ];
    }
}
