<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovelSobMedida extends Model {
    use HasFactory;
    protected $table = 'movel_sob_medidas';
    protected $fillable = ['codigo_orcamento', 'cliente_nome', 'cliente_telefone', 'tipo_movel', 'material', 'cor_acabamento', 'largura_m', 'altura_m', 'profundidade_m', 'area_m2', 'valor_estimado', 'status', 'especificacoes_tecnicas'];
}