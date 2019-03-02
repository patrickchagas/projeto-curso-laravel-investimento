@extends('templates.master')

@section('conteudo-view')
    
        @if(session('success'))
            <h3>{{ session('success')['messages'] }}</h3>      
        @endif

    {!! Form::open(['route' => ['institution.product.store', $institution->id ], 'method' => 'post', 'class' => 'form-padrao']) !!}

        @include('templates.formulario.input', ['label' => 'Nome do Produto', 'input' => 'name'])
        @include('templates.formulario.input', ['label' => 'Descrição do Produto', 'input' => 'description'])
        @include('templates.formulario.input', ['label' => 'Indexador', 'input' => 'index'])
        @include('templates.formulario.input', ['label' => 'Taxa de Juros', 'input' => 'interest_rate'])

        @include('templates.formulario.submit', ['input' => 'Cadastrar', 'class' => 'btn btn-primary'])

    {!! Form::close() !!}


@endsection