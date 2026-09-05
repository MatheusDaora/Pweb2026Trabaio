<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovelSobMedida extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_nome',
        'cliente_telefone',
        'tipo_movel',
        'material',
        'cor_acabamento',
        'status',
        'largura_m',
        'altura_m',
        'profundidade_m',
        'codigo_orcamento',
        'area_m2'
    ];
}