<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\ProdutoVariacao;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $produtos = Produto::with('variacoes.estoque')->whereNull('deleted_at')->get();
        return view('produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request, $id) {
            $request->validate([
                'nm_produto' => 'required|string|max:255',
                'ds_produto' => 'required|string|max:500',
                'nm_variacao' => 'required|array|min:1',
                'vl_variacao' => 'required|array|min:1',
                'nr_quantidade' => 'required|array|min:1',
            ]);
            $produto = Produto::create([
                'nm_produto' => $request->nm_produto,
                'ds_produto' => $request->ds_produto,
            ]);

            foreach ($request->nm_variacao as $index => $nome) {
                $estoque = Estoque::create([
                    'nr_quantidade' => $request->nr_quantidade[$index]
                ]);

                ProdutoVariacao::create([
                    'produto_id'    => $produto->id,
                    'nm_variacao'   => $nome,
                    'vl_variacao'   => $request->vl_variacao[$index],
                    'cd_estoque'    => $estoque->id,
                    'cd_produto'    => $produto->id
                ]);
            }
        });
        return redirect('/produtos')->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produto = Produto::with('variacoes.estoque')->find($id);
        $data = [
            "produto" => $produto
        ];
        return view('produtos.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::transaction(function () use ($request, $id) {
            $produto = Produto::with('variacoes.estoque')->findOrFail($id);

            $produto->nm_produto = $request->nm_produto;
            $produto->ds_produto = $request->ds_produto;
            $produto->save();

            foreach ($produto->variacoes as $variacao) {
                $variacao->estoque?->delete();
                $variacao->delete();
            }

            $nm_variacoes = $request->input('nm_variacao', []);
            $vl_variacoes = $request->input('vl_variacao', []);
            $nr_quantidades = $request->input('nr_quantidade', []);

            for ($i = 0; $i < count($nm_variacoes); $i++) {
                $estoque = Estoque::create([
                    'nr_quantidade' => $nr_quantidades[$i],
                ]);

                ProdutoVariacao::create([
                    'cd_produto' => $produto->id,
                    'nm_variacao' => $nm_variacoes[$i],
                    'vl_variacao' => $vl_variacoes[$i],
                    'cd_estoque' => $estoque->id,
                ]);
            }
        });
        return redirect('/produtos')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();
        return redirect('/produtos')->with('success', 'Produto deletado com sucesso!');
    }
}
