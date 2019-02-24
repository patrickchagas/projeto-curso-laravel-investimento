@extends('templates.master')

@section('css-view')
    
@endsection




@section('conteudo-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>      
    @endif
       
        {!! Form::open(['route' => 'user.store', 'method' => 'post', 'class' => 'form-padrao']) !!}

            @include('templates.formulario.input', ['label'=> 'CPF', 'input' => 'cpf', 'attributes' => ['placeholder' => 'Digite o CPF']])
            @include('templates.formulario.input', ['label' => 'Nome','input' => 'name', 'attributes' => ['placeholder' => 'Digite o nome']])
            @include('templates.formulario.input', ['label' => 'Data de Nascimento','input' => 'birth', 'attributes' => ['placeholder' => 'Data de Nascimento']])
            @include('templates.formulario.input', ['label' => 'Telefone ou Celular', 'input' => 'phone', 'attributes' => ['placeholder' => 'Digite o telefone']])
            @include('templates.formulario.input', ['label' => 'E-mail','input' => 'email', 'attributes' => ['placeholder' => 'Digite o e-mail']])
            @include('templates.formulario.password', ['label' => 'Senha','input' => 'password', 'attributes' => ['placeholder' => 'Digite a senha']])
            @include('templates.formulario.submit', ['input' => 'Cadastrar'])


        {!! Form::close() !!}

        @include('user.list', ['user_list' => $group->users]);

       
@endsection

@section('js-view')
    
@endsection
