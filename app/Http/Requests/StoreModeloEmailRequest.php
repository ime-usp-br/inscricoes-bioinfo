<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModeloEmailRequest extends FormRequest
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
            'nome' => 'required',
            'descricao_e_classe' => 'required',
            'assunto' => 'required|max:256',
            'corpo' => 'required|max:65000',
            'frequencia_envio' => 'required',
            'data_envio' => 'required_if:frequencia_envio,Mensal|Única',
            'hora_envio' => 'required_if:frequencia_envio,Mensal|Única',
        ];

        return $rules;
    }
}
