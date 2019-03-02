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
                <th>Nome do Grupo</th>
                <th>Instituição</th>
                <th>Nome do Responsável</th>
                <th>Opções</th>
            </tr>
    </thead>

        <tbody>
            @foreach ($group_list as $group)
            
                <tr>
                    <td>{{ $group->id }}</td>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->institution->name }}</td>
                    <td>{{ $group->owner->name }}</td>                            
                    <td>
                            {!! Form::open(['route' => ['group.destroy', $group->id], 'method' => 'delete']) !!}
                        <div>
                            {!! Form::submit('Remover', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Deseja realmente excluir essa Instituição?")']) !!}
                            
                             {!! Form::close() !!}

                            <a href="{{ route('group.show', $group->id) }}" class="btn btn-dark" >Detalhes</a>
                            <a href="{{ route('group.edit', $group->id) }}" class="btn btn-primary" >Editar</a>
                        </div>   
                         
                    </td>
                </tr>
             @endforeach
        </tbody>


</table>