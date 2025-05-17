<div class="modal fade" id="carrinhoModal" aria-labelledby="carrinhoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="carrinhoModalLabel">Seu Carrinho</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        @if(session('carrinho') && count(session('carrinho')) > 0)
        <div class="mb-3">
          <label for="cupom" class="form-label">Cupom de Desconto</label>
          <div class="input-group">
            <input type="text" class="form-control" id="cupom" name="cupom" placeholder="Digite seu cupom">
            <input type="hidden" id="cd_cupom" name="cd_cupom">
            <button class="btn btn-outline-secondary" type="button" id="aplicarCupom">Aplicar</button>
          </div>
          <small id="cupomMensagem" class="text-success d-none mt-1"></small>
        </div>
        @endif
        @php
          $total = 0;
          $frete = 200.00;
        @endphp
        @if(session('carrinho') && count(session('carrinho')) > 0)
          
          <table class="table table-striped text-center">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Valor (R$)</th>
              </tr>
            </thead>
            <tbody>
              @foreach(session('carrinho') as $item)
                @php
                  $quantidade = $item['quantidade'] ?? 1;
                  $subtotal = $item['vl_produto'] * $quantidade;
                  $total += $subtotal;
                @endphp
                <tr>
                  <td>{{ $item['nm_produto'] }}</td>
                  <td>{{ $quantidade }}</td>
                  <td>{{ number_format($subtotal, 2, ',', '.') }}</td>
                </tr>
              @endforeach

              @php
                
                if ($total > 52.00 && $total < 166.59) {
                  $frete = 15.00;
                } elseif ($total > 200.00) {
                  $frete = 0.00;
                }
              @endphp
              <tr>
                <td colspan="2">Subtotal</td>
                <td>{{ number_format($total, 2, ',', '.') }}</td>
              </tr>
              <tr>
                <td colspan="2">Frete</td>
                <td>{{ number_format($frete, 2, ',', '.') }}</td>
              </tr>
              <tr id="linhaDesconto" style="display: none;">
                <td colspan="2">Desconto</td>
                <td id="valorDesconto"></td>
              </tr>
              <tr class="fw-bold">
                <td colspan="2">Total Final</td>
                <td id="valorTotalFinal">{{ number_format($total + $frete, 2, ',', '.') }}</td>
              </tr>
            </tbody>
          </table>
        @else
          <p>Seu carrinho está vazio.</p>
        @endif
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary" onclick="abrirCheckout()">Preencher endereço</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('aplicarCupom').addEventListener('click', function () {
    const codigo = document.getElementById('cupom').value;

    if (!codigo) {
      alert('Digite um cupom.');
      return;
    }

    fetch(`/api/cupons/${codigo}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Cupom inválido ou expirado.');
        }
        return response.json();
      })
      .then(data => {
        const desconto = data.vl_desconto ?? 0;
        try{
          if (data.vl_desconto) {
              $('#cd_cupom').val(data.id);
              alert(`Cupom aplicado!`);
          } else {
              alert('Cupom inválido.');
          }
          const subtotal = {{ $total }};
          const frete = {{ $frete }};
          const totalFinal = (subtotal + frete - desconto).toFixed(2);

          document.getElementById('linhaDesconto').style.display = 'table-row';
          document.getElementById('valorDesconto').textContent = desconto.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
          document.getElementById('valorTotalFinal').textContent = parseFloat(totalFinal).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

          document.getElementById('cupomMensagem').textContent = 'Cupom aplicado com sucesso!';
          document.getElementById('cupomMensagem').classList.remove('d-none');
        }catch(e){
          console.log(e)
        }
        
      })
      .catch(error => {
        alert(error.message);
      });
  });
</script>
