<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CarrinhoService;
use App\Mail\EmailService;
use Illuminate\Support\Facades\Mail;
use App\Models\CarrinhoProduto;
use App\Models\Cupons;
use App\Models\Pedidos;

class PedidoController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function finalizar(Request $request){
        $carrinho = $this->carrinhoService->getCarrinho($request);

        $carrinhoItem = CarrinhoProduto::with('variacao.estoque')
            ->where('cd_carrinho', $carrinho->id)
            ->first();

        if ($carrinhoItem) {
            $estoque = $carrinhoItem->variacao->estoque;
            $estoque->nr_quantidade = max(0, $estoque->nr_quantidade - $carrinhoItem->nr_quantidade);
            $estoque->save();
        }

        $valor = CarrinhoProduto::where('cd_carrinho', $carrinho->id)
            ->with('variacao')
            ->get()
            ->sum(function ($item) {
                return $item->variacao->vl_variacao * $item->nr_quantidade;
        });

        $frete = 200.00;
        $valor_total = 0;
        if ($valor > 52.00 && $valor < 166.59) {
            $frete = 15.00;
        } elseif ($valor > 200.00) {
            $frete = 0.00;
        }
        $valor_cupom = 0;
        $cupom = Cupons::find($request->input('cd_cupom'));
        if (!is_null($cupom)){
            $valor_cupom = $cupom->vl_desconto;
        }
        $valor_total = $valor + $frete - $valor_cupom;

        $pedido = new Pedidos();
        $pedido->nm_cliente = $request->input('nm_cliente');
        $pedido->ds_email_cliente = $request->input('ds_email');
        $pedido->ds_cep = $request->input('ds_cep');
        $pedido->ds_logradouro = $request->input('ds_logradouro');
        $pedido->nr_endereco = $request->input('nr_endereco');
        $pedido->ds_complemento = $request->input('ds_complemento');
        $pedido->ds_bairro = $request->input('ds_bairro');
        $pedido->ds_cidade = $request->input('ds_cidade');
        $pedido->ds_estado = $request->input('ds_estado');
        $pedido->vl_total = $valor_total;
        $pedido->vl_frete = $frete;
        $pedido->vl_cupom = $valor_cupom;
        $pedido->vl_total_sem_frete = $valor;
        $pedido->ie_status_pedido = "Realizado"; 
        $pedido->cd_carrinho = $carrinho->id;
        $pedido->cd_cupom = $request->input('cd_cupom') ?? null;
        $pedido->save();

        $carrinho->ie_ativo = 0;
        $carrinho->save();

        session()->flush();
        session()->flash('success', 'Pedido finalizado com sucesso!');
        return response()->json(['mensagem'=>"Pedido finalizado com sucesso."]);
    }
}
