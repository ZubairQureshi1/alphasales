<form id="session_form" method="POST" action="{{ route('sessions.store') }}">
    @csrf
    <div class="row">
        <div class="col-md-4 col-sm-4 form-group">
            <label>Organization</label>
            {{ Form::select('organization_id', $orgnaization = App\Models\Organization::pluck('name', 'id'), $orgnaization->first(), ['class' => 'form-control select2', 'id' => 'organizationId', 'readonly']) }}
        </div>
        <div class="col-md-4 col-sm-4 form-group">
            <label>Session Name</label>
            <div>
                <input data-parsley-type="name" type="text" class="form-control" required name="session_name" placeholder="Enter Name"/>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 form-group">
            <button type="button" onclick="onAddSessionDetails()" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Session Details</button>
        </div>
    </div>
    <div id="session_detail" class="form-group">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="session_submit">Save</button>
        <a class="btn btn-secondary" href="{{ route('sessions.index') }}">Close</a>
        <!--<button  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
    </div>
</form>

