<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cidade extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'nome', 'estado',];

    public function medicos()
    {
        return $this->hasMany(Medico::class);
    }

    //scope 
    public function scopeFilter($query, $request)
    {
        if(filled($request->nome)){
            $query->where('nome', 'LIKE', "%{$request->nome}%");
        }

        return $query;
    }
}
