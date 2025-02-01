<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdatePacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('id_paciente');
        return [
            'nome' => [
                'required',
                'string',
                'min:5',
                'max:255',
            ],
            'celular' => [
                'min:11',
                'max:11',
            ],
            'cpf' => [
                $id ? 'prohibited' : 'required', // Proibido no update, obrigatório na criação
                'string',
                'size:11',
                Rule::unique('pacientes', 'cpf'), 
            ],
        ];
    }
}
