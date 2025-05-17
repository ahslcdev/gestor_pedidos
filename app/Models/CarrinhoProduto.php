<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarrinhoProduto extends Model
{
    use HasFactory;
    protected $table = 'carrinho_produto';
    protected $fillable = [
        'nr_quantidade', 'cd_variacao', 'cd_carrinho'
    ];

    public function variacao()
    {
        return $this->belongsTo(ProdutoVariacao::class, 'cd_variacao');
    }
}
