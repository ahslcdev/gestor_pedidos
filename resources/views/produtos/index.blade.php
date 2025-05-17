@extends('layouts.main')
@section('title', 'Lista de Produtos')

@section('content')
<h2 class="mb-4">Produtos disponíveis:</h2>
<div class="row">
    @foreach ($produtos as $produto)
        @foreach ($produto->variacoes as $variacao)
            <div class="col-md-4 mb-4 col-sm-6 d-flex justify-content-center">
                <div class="card shadow" style="width: 18rem; position: relative;">
                    <div class="card-header">
                        <h5 class="card-title">{{ $produto->nm_produto }}</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">{{ $variacao->nm_variacao }}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $produto->ds_produto }}</h6>
                        <p class="card-text">
                            Valor: <strong>R$ {{ number_format($variacao->vl_variacao, 2, ',', '.') }}</strong><br>
                            Estoque: {{ $variacao->estoque->nr_quantidade ?? 'Indisponível' }}
                        </p>

                        <!-- Link invisível que cobre todo o card -->
                        <a href="{{ route('produtos.edit', $produto->id) }}">Visualizar produto</a>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button
                                class="btn btn-primary mt-2"
                                title="Adicionar ao carrinho"
                                data-toggle="tooltip"
                                data-placement="top"
                                type="button"
                                onclick="event.stopPropagation(); adicionarAoCarrinho({{ $variacao->id }})">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>

@include('produtos.scripts')

@endsection