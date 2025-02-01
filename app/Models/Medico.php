<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medico extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'nome',
        'especialidade',
        'cidade_id',
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    //scope
    public function scopeFilter($query, $request)
    {
        if ($request->filled('nome')) {
            $nome = trim($request->nome);
            $nomeSemPrefixo = preg_replace('/^(Dr\.?|Dra\.?)\s+/i', '', $nome);
            $query->whereRaw("REPLACE(REPLACE(nome, 'Dr. ', ''), 'Dra. ', '') LIKE ?", ["%{$nomeSemPrefixo}%"]);
        }

        return $query;
    }

}
