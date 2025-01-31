<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CidadeController extends Controller
{
    public function index(Request $request)
    {
        $cidades = Cidade::filter($request)->orderBy('nome', 'asc')->paginate();
        if($cidades->isEmpty()){
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return response()->json($cidades);
    }

}
