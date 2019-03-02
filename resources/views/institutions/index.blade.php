@extends('templates.master')

@section('conteudo-view')

<style>
    .btn{
        display: inline-block;
        border-radius:30px;
    }
    div {
        display: inline-block;
    }
</style>


@if(session('success'))
    <h3>{{ session('success')['messages'] }}</h3>      
@endif

{!! Form::open(['route' => 'institution.store', 'method' => 'post', 'class' => 'form-padrao']) !!}

    @include('templates.formulario.input', ['label'=> 'Nome da Instituição', 'input' => 'name', 'attributes' => ['placeholder' => 'Nome da instituição']])
    @include('templates.formulario.submit', ['input' => 'Cadastrar', 'class' => 'btn btn-primary'])

{!! Form::close()!!}


    
    <table class="default-table table">
        <thead>
                <tr>
                    <th>#</th>
                    <th>Nome da Instituição</th>
                    <th>Opções</th>
                </tr>
        </thead>

            <tbody>
                @foreach ($institutions as $inst)
                
                    <tr>
                        <td>{{ $inst->id }}</td>
                        <td>{{ $inst->name }}</td>
                        <td>
                                {!! Form::open(['route' => ['institution.destroy', $inst->id], 'method' => 'delete']) !!}
                            <div>      
                                {!! Form::submit('Remover', ['class' => 'btn btn-danger', 'style' => 'border-radius:30px;', 'onclick' => 'return confirm("Deseja realmente excluir essa Instituição?")']) !!}
                                {!! Form::close() !!}
    
                                <a href="{{ route('institution.show', $inst->id) }}" class="btn btn-dark">Detalhes</a> 
        
                                <a href="{{ route('institution.edit', $inst->id) }}" class="btn btn-dark">Editar</a>

                                <a href="{{ route('institution.product.index', $inst->id) }}" class="btn btn-dark">Produtos</a>
                            </div> 

                        </td>
                    </tr>
                 @endforeach
            </tbody>


    </table>

@endsection