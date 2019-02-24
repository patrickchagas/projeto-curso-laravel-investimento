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
        @foreach ($user_list as $user)
            
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