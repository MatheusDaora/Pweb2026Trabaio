<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movel extends Model {
    use HasFactory;
    protected $table = 'moveis';
    protected $fillable = ['categoria_id', 'nome', 'descricao', 'preco_custo', 'preco_venda', 'quantidade_estoque', 'material', 'cor', 'imagem', 'ativo'];

    public function categoria() { return $this->belongsTo(Categoria::class); }
    public function vendas() { return $this->hasMany(Venda::class); }
    public function scopeDisponivel($query) { return $query->where('ativo', true)->where('quantidade_estoque', '>', 0); }
    public function getImagemUrlAttribute() {
        if (!$this->imagem) return 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=600&q=80';
        if (str_starts_with($this->imagem, 'http')) return $this->imagem;
        return asset('storage/' . $this->imagem);
    }
}