<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarrinhoProduto;
use App\Models\Produto;
use App\Models\ProdutoVariacao;
use App\Services\CarrinhoService;

class CarrinhoController extends Controller
{

    protected $carrinhoService;

    public function __construct()
    {
        $this->carrinhoService = new CarrinhoService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $carrinho = $this->carrinhoService->getCarrinho($request);

        $variacao = ProdutoVariacao::with(['estoque', 'produto'])->find($request->cd_variacao);

        if (!$variacao || ($variacao->estoque->nr_quantidade ?? 0) <= 0) {
            return response()->json(['message' => 'O produto selecionado não está em estoque.'], 400);
        }

        $carrinhoItem = CarrinhoProduto::where('cd_carrinho', $carrinho->id)
            ->where('cd_variacao', $request->cd_variacao)
            ->first();

        if ($carrinhoItem) {
            $carrinhoItem->nr_quantidade += 1;
            $carrinhoItem->save();
        } else {
            $carrinhoItem = CarrinhoProduto::create([
                'cd_carrinho' => $carrinho->id,
                'cd_variacao' => $request->cd_variacao,
                'nr_quantidade' => $request->nr_quantidade,
            ]);
        }
        $carrinhoSessao = session()->get('carrinho', []);

        $carrinhoSessao[] = [
            'nm_produto' => "{$variacao->produto->nm_produto} - {$variacao->nm_variacao}",
            'vl_produto' =>$variacao->vl_variacao,
            'nr_quantidade' =>$carrinhoItem->nr_quantidade,
        ];

        session(['carrinho' => $carrinhoSessao]);
        return response()->json(['message' => 'Item adicionado ao carrinho', 'item' => $carrinho]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
