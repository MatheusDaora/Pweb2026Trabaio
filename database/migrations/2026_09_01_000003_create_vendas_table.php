<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_venda')->unique();
            $table->foreignId('movel_id')->constrained('moveis')->onDelete('cascade');
            $table->integer('quantidade');
            $table->decimal('preco_unitario', 10, 2);
            $table->decimal('valor_total', 10, 2);
            $table->string('cliente_nome');
            $table->string('cliente_cpf_telefone')->nullable();
            $table->string('forma_pagamento');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('vendas'); }
};