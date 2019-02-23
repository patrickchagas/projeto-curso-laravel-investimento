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

        <table class="default-table table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>CPF</td>
                    <td>Nome</td>
                    <td>Telefone</td>
                    <td>Nascimento</td>
                    <td>E-mail</td>
                    <td>Status</td>
                    <td>Permissão</td>
                    <td>Menu</td>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->Formattedcpf }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->Formattedphone }}</td>
                    <td>{{ $user->Formattedbirth }}</td>
                    <td>{{ $user->email }}</td>      
                    <td>{{ $user->status }}</td>
                    <td>{{ $user->permission }}</td>
                    <td>
                        {!! Form::open(['route' => ['user.destroy', $user->id], 'method' => 'DELETE']) !!}

                        {!! Form::submit('Remover', ['class' => 'btn btn-danger', 'style' => 'border-radius:30px;', 'onclick' => 'return confirm("Deseja realmente excluir esse usuário?")']) !!}

                        {!! Form::close() !!}
                        
                    </td>
                </tr>
                @endforeach
            </tbody>                
        </table>

       
@endsection

@section('js-view')
    
@endsection
