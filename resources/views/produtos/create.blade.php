@extends('layouts.main')
@section('title', 'Cadastro de Produtos')
@section('content')
    <h2 class="mb-4">Cadastrar produtos:</h2>
    <div class="row">
        @include('produtos.form')
    </div>
@endsection