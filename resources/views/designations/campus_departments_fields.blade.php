<div class="form-row">
    {{-- CAMPUS --}}
    @if (App\Models\Organization::count() > 0)
        <div class="mt-4 pt-2 mr-2 ml-2">
            <button class="btn btn-outline-danger btn-sm btn-remove rounded-0" type="button">
                <i class="fa fa-times fa-fw fa-lg"></i>
            </button>
        </div>
        <div class="form-group col-md-4">
            <label>Campus</label>
            {!! Form::select('designation_details['. $count .'][organization_campus_id]', App\Models\OrganizationCampus::pluck('name', 'id'), null, ['id' => 'campus_id'.$count, 'class' => 'form-control select2', 'placeholder' => '--- Select Campus ---', 'required', 'onchange'=>'onOrganizationCampusSelect(event)', 'data-row' => $count]) !!}
        </div>
    @else
        <h6 class="text-danger">Create Campuses First To Proceed</h6>
    @endif
    {{-- DEPARTMENT --}}
    <div id="department_id_{{$count}}" class="col-md-7"></div>
</div>