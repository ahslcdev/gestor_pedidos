<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Gestor de Pedidos')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<style>
    .floating-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    .floating-badge-outside {
        position: fixed;
        bottom: 75px; 
        right:55px;
        z-index: 10000;
        font-size: 14px;
        padding: 4px 7px;
        border-radius: 50%;
        transform: translate(-50%, 50%);
    }
</style>
<body style="background-color: #f1f1f1;">
    @include('layouts.header')
    <div class="content container mt-5 mb-5 bg-white" style="height: 100%;">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="p-4">
            @yield('content')
        </div>
    </div>
    <a 
        href="#" 
        class="btn btn-success btn-lg rounded-circle shadow floating-btn" 
        data-toggle="modal"
        data-target="#carrinhoModal" 
        data-placement="left" 
        title="Visualizar Carrinho"
    >
        <i class="bi bi-cart"></i>
    </a>
    <span class="floating-badge-outside badge bg-danger">
        {{ count(session('carrinho') ?? []) }}
    </span>

    @include('carrinho.carrinhoModal')
    @include('carrinho.modalEndereco')

    @include('layouts.footer')

    @include('layouts.scripts')
</body>
</html>