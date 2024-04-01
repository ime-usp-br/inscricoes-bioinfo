<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInscricaoRequest extends FormRequest
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
            'categoria' => 'required',
            'nome' => 'required',
            'email' => 'required',
            'nascimento' => 'required',
            'nacionalidade' => 'required',
            'rg' => 'required_without:rnm_passaporte|nullable',
            'cpf' => 'required_without:rnm_passaporte|nullable',
            'rnm_passaporte' => 'required_without:rg|nullable',
            'endereco' => 'required',
            'telefone' => 'required',
            'anexosNovos' => "required|array",
            "anexosNovos.*.arquivo" => "required",
        ];

        return $rules;
    }    
    
    public function messages()
    {
        return [
            'anexosNovos.required' => 'É necessário anexar a documentação em formato PDF.',
        ];
    }
}
