<?php

namespace App\Http\Resources;

use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PessoaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'categoria_id' => $this->categoria->id,
            'categoria' => $this->categoria->nome,
            'classificacao' => Pessoa::CLASSIFICACAO[$this->categoria->id],
        ];
    }
}
