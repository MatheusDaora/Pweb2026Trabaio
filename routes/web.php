<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MovelController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\MovelSobMedidaController;

Route::get('/', function () {
    return view('welcome', [
        'totalMoveis' => \App\Models\Movel::count(),
        'totalEstoque' => \App\Models\Movel::sum('quantidade_estoque'),
        'totalVendas' => \App\Models\Venda::count(),
        'faturamento' => \App\Models\Venda::sum('valor_total'),
        'totalSobMedida' => \App\Models\MovelSobMedida::count(),
        'ultimosMoveis' => \App\Models\Movel::with('categoria')->latest()->take(6)->get()
    ]);
})->name('home');

Route::resource('categoria', \App\Http\Controllers\CategoriaController::class);
Route::resource('movel', MovelController::class);
Route::get('/catalogo', [VendaController::class, 'catalogo'])->name('venda.catalogo');
// Substitua qualquer rota antiga de 'venda' por esta linha:
Route::resource('venda', App\Http\Controllers\VendaController::class);
Route::resource('sob_medida', MovelSobMedidaController::class);
Route::delete('/venda/{venda}', [App\Http\Controllers\VendaController::class, 'destroy'])->name('venda.destroy');