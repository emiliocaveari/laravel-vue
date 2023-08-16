<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePessoaRequest;
use App\Http\Resources\PessoaResource;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    

    public function index()
    {
        $pessoas = Pessoa::paginate(5);
        return PessoaResource::collection($pessoas);
    }

    public function add(){

    }
    
    public function store(StorePessoaRequest $request)
    {
        $data = $request->validated();

        if ( !$pessoa = Pessoa::create($data) )
            return response()->json(['message'=>'Unable to create new record'],500);

        return new PessoaResource($pessoa);
    }

    public function update(StorePessoaRequest $request, int $id)
    {
        $data = $request->validated();
        
        if ( !$pessoa = Pessoa::find($id) )
            return response()->json(['message'=>'Paciente not found!'],404);

        $pessoa->update($data);
        return new PessoaResource($pessoa);
    }

    public function delete(int $id){

        if ( !$pessoa = Pessoa::find($id) )
            return response()->json(['message'=>'Paciente not found!'],404);

        $pessoa->delete();
        return response()->json(['message'=>'Pessoa excluida com sucesso!'],200);

    }
}
