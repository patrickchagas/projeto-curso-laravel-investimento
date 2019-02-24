@extends('templates.master')


@section('conteudo-view')
    
    <header>
        <h1>Nome do Gropo: {{ $group->name}}</h1>
        <h2>Instituição: {{ $group->institution->name }}</h2>
        <h2>Responsável: {{ $group->owner->name }}</h2>
    </header>

    {{-- Relacionar usuarios ao grupo --}}

    {!! Form::open(['route' => ['group.user.store', $group->id] ,'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.select', ['label' => 'Usuário', 'select' => 'user_id', 'data' => [$user_list], 'attributes' => ['placeholder' => "Usuário"]])
        @include('templates.formulario.submit', ['input' => 'Relacionar ao Grupo: ' . $group->name, 'class' => 'btn btn-primary'])   
    {!! Form::close() !!} 
    
    @include('user.list', ['user_list' => $group->users]);

@endsection