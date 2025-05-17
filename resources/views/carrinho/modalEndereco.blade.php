<div class="modal fade" id="enderecoModal" aria-labelledby="enderecoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="enderecoModalLabel">Dados do Cliente e Endereço</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <form id="enderecoForm" method="post">
          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" maxlength="255" id="nm_cliente" name="nm_cliente" placeholder="Nome" required>
                <label for="nm_cliente">Nome</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" class="form-control" maxlength="255" id="ds_email" name="ds_email" placeholder="Email" required>
                <label for="ds_email">Email</label>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-floating">
                <input type="text" class="form-control" maxlength="9" id="ds_cep" name="ds_cep" placeholder="CEP" required maxlength="9">
                <label for="ds_cep">CEP</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" maxlength="255" id="ds_logradouro" name="ds_logradouro" placeholder="Logradouro" required>
                <label for="ds_logradouro">Logradouro</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating">
                <input type="text" class="form-control" maxlength="20" id="nr_endereco" name="nr_endereco" placeholder="Número" required>
                <label for="nr_endereco">Número</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" class="form-control" id="ds_complemento" name="ds_complemento" placeholder="Complemento">
                <label for="ds_complemento">Complemento</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" class="form-control" maxlength="100" id="ds_bairro" name="ds_bairro" placeholder="Bairro" required>
                <label for="ds_bairro">Bairro</label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-floating">
                <input type="text" class="form-control" maxlength="100" id="ds_cidade" name="ds_cidade" placeholder="Cidade" required>
                <label for="ds_cidade">Cidade</label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-floating">
                <input type="text" class="form-control" maxlength="2" id="ds_estado" name="ds_estado" placeholder="Estado" required>
                <label for="ds_estado">Estado</label>
              </div>
            </div>
          </div>

          <div class="mt-4 text-end">
            <button type="button" class="btn btn-success" onclick="finalizarPedido()">Confirmar Pedido</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>