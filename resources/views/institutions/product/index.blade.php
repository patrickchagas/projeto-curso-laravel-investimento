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

    <style>
        .btn{
            border-radius:30px;
        }
        div {
            display: inline-block;
        }
    </style>
        

    <table class="default-table table">

        <thead>
            <tr>    
                <th>#</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Indexador</th>
                <th>Taxa de Juros</th>
                <th>Opções</th>
            </tr>
        </thead>

        <tbody>
            @forelse($institution->products as $product)
                
            <tr>
                <td> {{ $product->id  }}</td>
                <td> {{ $product->name }} </td>
                <td> {{ $product->description }} </td>
                <td> {{ $product->index }} </td>
                <td> {{ $product->interest_rate}} </td>

                <td>
                   
                        {!! Form::open(['route' => ['institution.product.destroy', $institution->id, $product->id], 'method' => 'delete']) !!}
                    <div>
                        {!! Form::submit('Remover', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Deseja realmente excluir essa Instituição?")']) !!}

                        {!! Form::close() !!}

                        <a href="" class="btn btn-primary" >Editar</a>
                    </div>
                </td>
            <tr>    

            @empty
                <tr>
                    <th>Nada Cadastrado</th>
                    
                </tr>

            @endforelse
        </tbody>

    </table>   


@endsection