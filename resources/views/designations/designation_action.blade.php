
{{-- <button type="button" data-toggle="modal" data-target="#edit_modal_{{$index}}" class="btn btn-primary btn-sm"><i class="mdi mdi-pencil"></i></button> --}}

<a class="btn btn-primary btn-sm" href="{{ route('designations.edit', $designation->id) }}"><i class="mdi mdi-pencil"></i></a>

{{-- <div class="modal fade update_subect_model" id="edit_modal_{{$index}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Update<strong> Designation</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => ['designations.update', $designation->id], 'method' => 'patch']) !!}
                    <div class="form-group">
                        <label>Name</label>
                        <input data-parsley-type="name" type="text" class="form-control" name="name" id="update_designation_name" value="{{ $designation->name }}" placeholder="Enter Name" required/>
                    </div>
                    <div class="form-group">
                        <label>Code</label>
                        <input data-parsley-type="code" type="text" class="form-control" name="code" id="update_designation_code" value="{{ $designation->code }}" placeholder="Enter code" required/>
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        {!! Form::select('department_ids[]', App\Models\Department::where('organization_campus_id', $designation->organization_campus_id)->pluck('name', 'id'), $designation->departments->pluck('department_id'), ['id' => 'department_id', 'class' => 'form-control select2', 'data-placeholder' => '--- Select Department ---', 'multiple']) !!}
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> --}}

{{-- For Editing a specific object/row ends here --}}
{!! Form::open(['route' => ['designations.destroy', $designation->id], 'method' => 'delete']) !!}
<button type="submit" class="btn btn-danger btn-sm"><i class="typcn typcn-delete-outline"></i></button>
{!! Form::close() !!}