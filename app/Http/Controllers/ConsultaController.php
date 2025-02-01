<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateConsultaRequest;
use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConsultaController extends Controller
{
    public function store(StoreUpdateConsultaRequest $request)
    {
        $consulta = Consulta::create([
            'medico_id' => $request->medico_id,
            'paciente_id' => $request->paciente_id,
            'data' => $request->data
        ]);

        return response()->json($consulta, Response::HTTP_CREATED);
    }

}
