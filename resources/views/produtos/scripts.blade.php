<script>
    function adicionarAoCarrinho(variacaoId) {
        fetch('/api/carrinho/', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ cd_variacao: variacaoId, nr_quantidade: 1 })
        })
        .then(response => {
            if (!response.ok) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao tentar adicionar o produto ao carrinho, tente novamente mais tarde!',
                    confirmButtonColor: '#198754',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
            
            return response.json();
        })
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: 'Produto adicionado ao carrinho!',
                confirmButtonColor: '#198754',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Ocorreu um erro ao tentar adicionar o produto ao carrinho, tente novamente mais tarde!',
                confirmButtonColor: '#198754',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        });
    }

    function adicionarVariacao() {
        const container = document.getElementById('variacoes-container');

        const variacaoHtml = `
            <div class="row g-2 mb-2 align-items-end">
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" maxlength="255" name="nm_variacao[]" required placeholder="Nome da Variação">
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
        `;

        container.insertAdjacentHTML('beforeend', variacaoHtml);
    }
</script>