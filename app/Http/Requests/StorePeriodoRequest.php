<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeriodoRequest extends FormRequest
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
        $rules = [
            'ano' => 'required|numeric',
            'semestre' => 'required|in:1°,2°',
            'data_inicio_inscricoes' => 'required|date_format:d/m/Y|before:data_final_inscricoes',
            'data_final_inscricoes' => 'required|date_format:d/m/Y',
        ];

        return $rules;
    }
}
