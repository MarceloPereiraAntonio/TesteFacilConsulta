<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePacienteRequest;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PacienteController extends Controller
{
    public function getPacientesByMedico(Request $request, $medico_id)
    {
        $pacientes = Paciente::filter($request)
            ->select(
                'consultas.medico_id',
                'consultas.data as data_consulta',
                'pacientes.id', 
                'pacientes.nome', 
                'pacientes.cpf', 
                'pacientes.celular',) 
            ->join('consultas', 'consultas.paciente_id', '=', 'pacientes.id')
            ->where('consultas.medico_id', $medico_id)
            ->orderBy('consultas.data', 'asc')
            ->paginate();
        if($pacientes->isEmpty()){
            return response()->json([], Response::HTTP_NO_CONTENT);
        }
        return response()->json($pacientes);
    }

    public function store(StoreUpdatePacienteRequest $request)
    {
        $paciente = Paciente::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'celular' => $request->celular
        ]);
        return response()->json($paciente, Response::HTTP_CREATED);
    }

    public function update(StoreUpdatePacienteRequest $request, $id)
    {
        if(!$paciente = Paciente::find($id)){
            return response()->json(['message' => 'Paciente não encontrado'], Response::HTTP_NOT_FOUND);
        }
        $paciente->update([
            'nome' => $request->nome,
            'celular' => $request->celular
        ]);
        return response()->json($paciente);
    }

}
