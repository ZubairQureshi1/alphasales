<table class="table table-bordered table-striped table-hover" id="datatable-buttons" cellspacing="0" width="100%" IsDefault="true"> 
    <thead>
        <tr>
            <th style="width: 2%; text-align: center;">#</th>
            <th style="width: 5%; text-align: center;">Profile</th>
            <th>Name</th>
            <th>Email</th>
            <th style="width: 5%; text-align: center;">Role</th>
            {{-- <th>Employee Code</th> --}}
            <th style="width: 10%; text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $index => $user)
        <tr>
            <td class="text-center">{{ ++$index }}</td>
            <td class="text-center">
                <img class="img-responsive responsive-image rounded-circle" src=".{{ !empty($user->profile_pic_url) ? '/uploads/Employees/---/profile_picture/'.$user->profile_pic_url : 'assets/images/users/dummy.png'  }}" alt="Generic placeholder image">
            </td>
            <td>{{ $user->display_name ?? '----' }}</td>
            <td>{{ $user->email ?? '---' }}</td>
            <td class="text-center">{{ $user->roles()->get()->first()!=null?$user->roles()->get()->first()->display_name: '---' }}</td>
            {{-- <td>{{ !$user->campusDetails()->where('is_primary_emp_code', true)->get()->isEmpty()?$user->campusDetails()->where('is_primary_emp_code', true)->get()->first()->emp_code: '---' }}</td> --}}
            <td class="text-center">
                <div class="btn-group" role="group" aria-label="Action Buttone">
                    {{-- VIEW USER --}}
                    @can('view_users')
                    <a title="View {{ $user->display_name }}" data-placement="top" data-toggle="tooltip" class="btn btn-primary btn-sm waves-effect waves-light rounded-0" href="{!! route('users.show', [$user->id]) !!}">
                        <i class="mdi mdi-eye"></i>
                    </a>
                    @endcan
                    {{-- EDIT USER --}}
                    @can('update_users')
                    <a title="Edit {{ $user->display_name }}" data-placement="top" data-toggle="tooltip" class="btn btn-info btn-sm waves-effect waves-light rounded-0" href="{!! route('users.edit', [$user->id]) !!}">
                        <i class="mdi mdi-pencil"></i>
                    </a>
                    @endcan
                    {{-- DELETE USER --}}
                    @can('delete_users')
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm waves-effect waves-light rounded-0', 'title' => 'Delete '.$user->display_name, 'data-toggle' => "tooltip"]) !!}
                    {!! Form::close() !!}
                    @endcan
                    {{-- USER QR --}}
                    {{-- <a title="{{ $user->display_name }} QR Code" data-toggle="tooltip" class="btn btn-success btn-sm waves-effect waves-light rounded-0" href="{{ route('users.generateQRCode', [$user->id]) }}">
                        <i class="fa fa-qrcode"></i>
                    </a> --}}
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>