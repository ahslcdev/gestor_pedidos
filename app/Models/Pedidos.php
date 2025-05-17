<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;
    protected $fillable = [
        'nm_cliente',
        'ds_email_cliente',
        'ds_cep',	
        'ds_logradouro',
        'nr_endereco',	
        'ds_complemento',
        'ds_bairro',	
        'ds_cidade',	
        'ds_estado',	
        'vl_total',	
        'ie_status_pedido',	
        'cd_carrinho',	
        'cd_cupom',	
    ];
}
