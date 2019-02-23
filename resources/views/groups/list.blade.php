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
                        {!! Form::submit('Remover', ['class' => 'btn btn-danger', 'style' => 'border-radius:30px;', 'onclick' => 'return confirm("Deseja realmente excluir essa Instituição?")']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
             @endforeach
        </tbody>


</table>