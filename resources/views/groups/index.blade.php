@extends('templates.master')

@section('conteudo-view')

        @if(session('success'))
            <h3>{{ session('success')['messages'] }}</h3>      
        @endif

        {!! Form::open(['route' => 'group.store', 'method' => 'post', 'class' => 'form-padrao']) !!} 
            @include('templates.formulario.input', ['label' => 'Nome do Grupo', 'input' => 'name', 'attributes' => ['placeholder' => "Nome do Grupo"]]) 
            @include('templates.formulario.select', ['label' => 'User', 'select' => 'user_id', 'data' => $user_list,'attributes' => ['placeholder' => "User"]]) 
            @include('templates.formulario.select', ['label' => 'Instituição', 'select' => 'institution_id', 'data' => $institution_list, 'attributes' => ['placeholder' => "User"]])
            @include('templates.formulario.submit', ['input' => 'Cadastrar', 'class' => 'btn btn-primary'])   
        {!! Form::close() !!}


        @include('groups.list', ['group_list' => $groups]);
    
@endsection