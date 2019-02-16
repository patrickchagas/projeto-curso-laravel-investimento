@extends('templates.master')

@section('css-view')
    
@endsection




@section('conteudo-view')
       
        {!! Form::open(['route' => 'user.store', 'method' => 'post', 'class' => 'form-padrao']) !!}

            @include('templates.formulario.input', ['label'=> 'CPF', 'input' => 'cpf', 'attributes' => ['placeholder' => 'Digite o CPF']])
            @include('templates.formulario.input', ['input' => 'name', 'attributes' => ['placeholder' => 'Digite o nome']])
            @include('templates.formulario.input', ['input' => 'birth', 'attributes' => ['placeholder' => 'Data de Nascimento']])
            @include('templates.formulario.input', ['input' => 'phone', 'attributes' => ['placeholder' => 'Digite o telefone']])
            @include('templates.formulario.input', ['input' => 'email', 'attributes' => ['placeholder' => 'Digite o e-mail']])
            @include('templates.formulario.password', ['input' => 'password', 'attributes' => ['placeholder' => 'Digite a senha']])
            @include('templates.formulario.submit', ['input' => 'Cadastrar'])


        {!! Form::close() !!}


       
@endsection

@section('js-view')
    
@endsection
