<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateMedicoRequest;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MedicoController extends Controller
{
    public function index(Request $request)
    {
        $medicos = Medico::filter($request)
            ->orderBy('nome', 'asc')
            ->paginate();
        if($medicos->isEmpty()){
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return response()->json($medicos);
    }

    public function getMedicosByCidade(Request $request, $id)
    {
        $medicos = Medico::where('cidade_id', $id)
            ->filter($request)
            ->orderBy('nome', 'asc')
            ->paginate();
        if($medicos->isEmpty()){
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return response()->json($medicos);
    }

    public function store(StoreUpdateMedicoRequest $request)
    {
        $medico = Medico::create([
            'nome' => $request->nome,
            'especialidade' => $request->especialidade,
            'cidade_id' => $request->cidade_id
        ]);
        return response()->json($medico, Response::HTTP_CREATED);
    }

}
