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
                    <th>Produto</th>
                    <th>Nome da Instituição</th>
                    <th>Valor investido</th>
                </tr>
        </thead>

            <tbody>
                @foreach ($product_list as $product)
                
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->institution->name }}</td>
                        <td>{{ $product->valuefromUser(Auth::user()) }}</td>
                    </tr>
                 @endforeach
            </tbody>


    </table>

@endsection