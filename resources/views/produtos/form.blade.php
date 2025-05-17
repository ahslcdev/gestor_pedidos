<form action="{{ isset($produto) ? '/produtos/' . $produto->id : '/produtos' }}" method="POST" class="p-4 border rounded bg-light shadow-sm">
    @csrf
    @if(isset($produto))
    @method('PUT')
    @endif

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nm_produto" name="nm_produto" maxlength="255" required value="{{ old('nm_produto', $produto->nm_produto ?? '') }}" placeholder="Nome do Produto">
        <label for="nm_produto">Nome do Produto</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="ds_produto" name="ds_produto" value="{{ old('ds_produto', $produto->ds_produto ?? '') }}" placeholder="Valor do Produto">
        <label for="vl_produto">Descrição</label>
    </div>

    <div class="mb-3">
        <label class="form-label">Variações</label>
        <div id="variacoes-container">
            @if(isset($produto) && $produto->variacoes)
            @foreach ($produto->variacoes as $index => $variacao)
            <div class="row g-2 mb-2 align-items-end">
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="nm_variacao[]" maxlength="255" required placeholder="Nome da Variação" value="{{ $variacao->nm_variacao }}">
                        <label>Nome da Variação</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="number" class="form-control" name="vl_variacao[]" step="0.01" min="0" required placeholder="Valor da Variação" value="{{ $variacao->vl_variacao }}">
                        <label>Valor da Variação</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="number" class="form-control" name="nr_quantidade[]" step="1" min="1" required placeholder="Quantidade" value="{{ $variacao->estoque->nr_quantidade ?? '' }}">
                        <label>Quantidade</label>
                    </div>
                </div>
                <div class="col-md-2 text-end">
                    <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">Remover</button>
                </div>
            </div>
            @endforeach
            @else
            <div class="row g-2 mb-2 align-items-end">
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="nm_variacao[]" required placeholder="Nome da Variação">
                        <label>Nome da Variação</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="number" class="form-control" name="vl_variacao[]" step="0.01" min="0" required placeholder="Valor da Variação">
                        <label>Valor da Variação</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="number" class="form-control" name="nr_quantidade[]" step="1" min="1" required placeholder="Quantidade">
                        <label>Quantidade</label>
                    </div>
                </div>
                <div class="col-md-2 text-end">
                    <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">Remover</button>
                </div>
            </div>
            @endif
        </div>

        <button type="button" class="btn btn-outline-secondary mt-2" onclick="adicionarVariacao()">
            + Adicionar Variação
        </button>
    </div>


    <button type="submit" class="btn btn-primary w-100">
        Salvar
    </button>
</form>

@include('produtos.scripts')