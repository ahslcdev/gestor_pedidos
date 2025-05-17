<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Carrinho;

class CarrinhoService
{
    public function getCarrinho(Request $request)
    {
        $session_id = $request->session()->getId();
        $carrinho = Carrinho::where('cd_sessao', $session_id)->where('ie_ativo', 1)->first();

        if (!$carrinho) {
            Carrinho::where('cd_sessao', $session_id)->update(['ie_ativo' => 0]);
            $request->session()->invalidate();
            $request->session()->regenerate();
            $id = session()->getId();
            $carrinho = Carrinho::create([
                'cd_sessao' => $id,
                'ie_ativo' => 1
            ]);
        }

        return $carrinho;
    }
}