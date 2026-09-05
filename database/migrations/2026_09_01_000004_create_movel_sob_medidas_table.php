<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('movel_sob_medidas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_orcamento')->unique();
            $table->string('cliente_nome');
            $table->string('cliente_telefone');
            $table->string('tipo_movel');
            $table->string('material');
            $table->string('cor_acabamento');
            $table->decimal('largura_m', 8, 2);
            $table->decimal('altura_m', 8, 2);
            $table->decimal('profundidade_m', 8, 2);
            $table->decimal('area_m2', 8, 2);
            $table->enum('status', ['Orçamento', 'Aprovado', 'Em Produção', 'Pronto', 'Entregue'])->default('Orçamento');
            $table->text('especificacoes_tecnicas')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('movel_sob_medidas'); }
};