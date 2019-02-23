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


        <table class="default-table table">
            <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome do Grupo</th>
                        <th>Instituição</th>
                        <th>Nome do Responsável</th>
                        <th>Opções</th>
                    </tr>
            </thead>
    
                <tbody>
                    @foreach ($groups as $group)
                    
                        <tr>
                            <td>{{ $group->id }}</td>
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->institution->name }}</td>
                            <td>{{ $group->owner->name }}</td>                            
                            <td>
                                {!! Form::open(['route' => ['group.destroy', $group->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Remover', ['class' => 'btn btn-danger', 'style' => 'border-radius:30px;', 'onclick' => 'return confirm("Deseja realmente excluir essa Instituição?")']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                     @endforeach
                </tbody>
    
    
        </table>
    
@endsection