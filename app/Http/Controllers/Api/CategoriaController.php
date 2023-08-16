<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    

    public function index()
    {
        $categorias = Categoria::all();
        return CategoriaResource::collection($categorias);
    }


}
