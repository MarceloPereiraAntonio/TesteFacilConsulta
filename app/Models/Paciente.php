<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nome', 'cpf', 'celular'];

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    //scope
    public function scopeFilter($query, $request)
    {
        if ($request->boolean('apenas-agendadas')) {
            $query->where('data', '>', now());
        }

        if(filled($request->nome)){
            $query->where('nome', 'LIKE', "%{$request->nome}%");
        }
    }

}
