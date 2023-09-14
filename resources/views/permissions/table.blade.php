<table id="datatable-buttons" isDefault="true" class="table table-bordered" id="permissions-table">
    <thead>
        <th>
            Permission
        </th>
        <th colspan="3">
            Action
        </th>
    </thead>
    <tbody>
        @foreach ($permissions as $permission)
        <tr>
            <td class="col-md-8">
                {!! $permission->action_name !!}
            </td>
            <td class="col-md-4">
                {!! Form::open(['route' => ['permissions.destroy', $permission->id], 'method' => 'delete']) !!}
                <div class="btn-group">
                    <a class="btn btn-primary btn-sm" href="{!! route('permissions.show', [$permission->id]) !!}">
                        <i class="mdi mdi-eye"></i>
                    </a>
                    <a class="btn btn-dark btn-sm" href="{!! route('permissions.edit', [$permission->id]) !!}">
                        <i class="mdi mdi-pencil">
                        </i>
                    </a>
                    {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}

                    {!! Form::close() !!}

                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
