
    <div class="row">
        <div class="col-md-4 col-sm-4 form-group">
            <label>Organization</label>
            {{ Form::select('organization_id', App\Models\Organization::pluck('name', 'id'), $session->organization_id, ['class' => 'form-control select2', 'id' => 'organizationId', 'readonly']) }}
        </div>
        <div class="col-md-4 col-sm-4 form-group">
            <label>Session Name</label>
            <input data-parsley-type="name" type="text" class="form-control" value="{{$session->session_name}}" required name="session_name" placeholder="Enter Name"/>
        </div>
        <div class="col-md-4 col-sm-4 form-group element-flex-end">
            <button type="button" onclick="onAddSessionDetails(true, {{$session->id}})" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i> | Session Details</button>
        </div>
    </div>
    <strong>FILTERS</strong>
    <div class="div-border padding-10">
        <div class="row">
            <div class="col-md-3 form-group">
                <label>Wing</label>
                {{ Form::select('filter_wing_id', App\Models\Wing::pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'filter_wing_id', 'placeholder' => '--- Select Wing ---']) }}
            </div>
            <div class="col-md-3 form-group">
                <label>Affiliated Body</label>
                <div>
                    {{ Form::select('filter_affiliated_body_id', App\Models\AffiliatedBody::pluck('name', 'id'), null, ['class' => 'form-control select2', 'id' => 'filter_affiliated_body_id','placeholder' => '--- Select Affiliated Body ---']) }}
                </div>
            </div>
            <div class="col-md-3 form-group">
                <label>Course</label>
                <div>
                    {{ Form::select('filter_course_id', App\Models\SessionCourse::wingWise(App\Models\OrganizationCampus::find(Illuminate\Support\Facades\Session::get('organization_campus_id'))->organizationCampusWings()->pluck('wing_id'))->where('session_id', $session->id)->get()->pluck('course_name', 'course_id'), null, ['class' => 'form-control select2', 'id' => 'filter_course_id','placeholder' => '--- Select Course ---']) }}
                </div>
            </div>
            <div class="col-md-3 col-sm-3 form-group element-flex-end">
                <button type="button" onclick="renderDegreeDetails({{$session->id}})" class="btn btn-info btn-sm pull-right"><i class="fa fa-list"></i> | Fetch Details</button>
            </div>
        </div>
    </div>
    <div id="edit_session_detail" class="form-group margin-top-10">
       {{-- @include('sessions/edit/session_details') --}}
    </div>
    <div id="session_detail" class="form-group margin-top-10">
       {{-- @include('sessions/edit/session_details') --}}
    </div>
