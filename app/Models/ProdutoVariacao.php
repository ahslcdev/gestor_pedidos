<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoVariacao extends Model
{
    use HasFactory;
    protected $fillable = [
        'nm_variacao',
        'cd_produto',
        'vl_variacao',
        'cd_estoque'
    ];
    protected $table = 'produtos_variacoes'; 

    public function estoque()
    {
        return $this->belongsTo(Estoque::class, 'cd_estoque');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'cd_produto');
    }
}
