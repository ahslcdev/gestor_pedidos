<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nm_produto', 'vl_produto', 'cd_estoque'];

    public function variacoes()
    {
        return $this->hasMany(ProdutoVariacao::class, 'cd_produto');
    }
}
