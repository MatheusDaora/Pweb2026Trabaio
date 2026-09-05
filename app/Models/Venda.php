<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model {
    use HasFactory;
    protected $fillable = ['codigo_venda', 'movel_id', 'quantidade', 'preco_unitario', 'valor_total', 'cliente_nome', 'cliente_cpf_telefone', 'forma_pagamento', 'observacoes'];
    public function movel() {
        // O Laravel precisa saber que a chave estrangeira é 'movel_id'
        return $this->belongsTo(Movel::class, 'movel_id');
    }
}