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
    
    <table class="default-table table">
        <thead>
                <tr>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Produto</th>
                    <th>Grupo</th>
                    <th>Valor</th>
                    <th></th>
                </tr>
        </thead>

            <tbody>
                @foreach ($moviment_list as $moviment)
                
                    <tr>
                        <td>{{ $moviment->created_at->format("d/m/Y H:i") }}</td>
                        <td>{{ $moviment->type == 1 ? "Investimento" : "Resgate" }}</td>
                        <td>{{ $moviment->product->name }}</td>
                        <td>{{ $moviment->group->name }}</td>
                        <td>{{ $moviment->value }}</td>

                    </tr>
                 @endforeach
            </tbody>


    </table>

@endsection