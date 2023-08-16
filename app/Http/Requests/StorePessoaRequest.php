<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePessoaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required',
            'email' =>  "required|unique:pessoas,email,{$this->id},id",
            'cpf' =>  "required|unique:pessoas,cpf,{$this->id},id",
            'categoria_id' => 'required|exists:categorias,id',
        ];
    }
}
