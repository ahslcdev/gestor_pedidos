<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = ['nr_quantidade'];
    protected $table  = 'estoque';

    public function produto()
    {
        return $this->hasOne(Produto::class, 'cd_estoque');
    }
}
