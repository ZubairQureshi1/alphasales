<table id="datatable-buttons" isDefault="true" class="table table-bordered" id="roles-table">
    <thead>
        <th>Role</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
        @foreach ($roles as $role)
        <tr>
            <td class="col-md-8">
                {!! $role->display_name !!}
            </td>
            <td class="col-md-4">
                {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                <div class="btn-group">
                    @can('view_roles')
                    <a class="btn btn-primary btn-sm" href="{!! route('roles.show', [$role->id]) !!}">
                        <i class="mdi mdi-eye"></i>
                    </a>
                    @endcan
                    @can('update_roles')
                    <a class="btn btn-dark btn-sm" href="{!! route('roles.edit', [$role->id]) !!}">
                        <i class="mdi mdi-pencil">
                        </i>
                    </a>
                    @endcan
                    @can('delete_roles')
                    {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}
                    @endcan

                    {!! Form::close() !!}

                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
