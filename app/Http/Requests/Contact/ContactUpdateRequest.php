<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:5'],
            'contact' => [
                'required',
                'string',
                'size:9',
                Rule::unique('contacts', 'contact')->ignore($this->route('contact')->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('contacts', 'email')->ignore($this->route('contact')->id),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.min' => 'O nome deve ter pelo menos 5 caracteres.',
            'contact.required' => 'O contato é obrigatório.',
            'contact.size' => 'O contato deve ter 9 caracteres.',
            'contact.unique' => 'O contato já está em uso.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser um endereço de email válido.',
            'email.unique' => 'O email já está em uso.',
        ];
    }
}
