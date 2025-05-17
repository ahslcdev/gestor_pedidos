<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script>
    function abrirCheckout() {
        $('#carrinhoModal').modal('hide');
        setTimeout(function() {
            $('#enderecoModal').modal('show');
        }, 500);
    }
</script>

<script>
    document.getElementById('ds_cep').addEventListener('blur', function () {
  const cep = this.value.replace(/\D/g, '');

  if (cep.length === 8) {
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
      .then(response => {
        if (!response.ok) throw new Error('Erro na requisição');
        return response.json();
      })
      .then(data => {
        if (!data.erro) {
          document.getElementById('ds_logradouro').value = data.logradouro;
          document.getElementById('ds_bairro').value = data.bairro;
          document.getElementById('ds_cidade').value = data.localidade;
          document.getElementById('ds_estado').value = data.uf;
        } else {
          alert('CEP não encontrado.');
        }
      })
      .catch(() => {
        alert('Erro ao buscar CEP.');
      });
  }
});


</script>


<script>
    function finalizarPedido(e) {
        const form = document.getElementById('enderecoForm');
        const formData = {
            nm_cliente: form.nm_cliente.value,
            ds_email: form.ds_email.value,
            ds_cep: form.ds_cep.value,
            ds_logradouro: form.ds_logradouro.value,
            nr_endereco: form.nr_endereco.value,
            ds_complemento: form.ds_complemento.value,
            ds_bairro: form.ds_bairro.value,
            ds_cidade: form.ds_cidade.value,
            ds_estado: form.ds_estado.value,
            cd_cupom: parseInt(document.getElementById('cd_cupom').value)
        };

        fetch('/api/pedido/finalizar/', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao finalizar o pedido');
            }
            return response.json();
        })
        .then(data => {
            window.location.reload();
        })
        .catch(error => {
            alert(error.message);
        });
    }

</script>


@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#198754'
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: '{{ session('error') }}',
        });
    </script>
@endif