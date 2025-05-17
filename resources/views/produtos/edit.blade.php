@extends('layouts.main')
@section('title', 'Editar Produto')

@section('content')
    <h2 class="mb-4">Editar produto:</h2>
    <div class="row">
        @include('produtos.form')
    </div>
@endsection