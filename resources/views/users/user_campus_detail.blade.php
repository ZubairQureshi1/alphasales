<div class="row {{$name_for_ids}}" id="{{$name_for_ids}}">
	<div class="col-12">
		<label class="margin-top-5 padding-5">{{ $campus_name }}</label>
		<div class="div-border-rad padding-10">
			<div class="row">
			    <div class="form-group col-sm-3">
			        {!! Form::label('designation', 'Designation:') !!}<span style="color: red">*</span><br>
			        {!! Form::select($name_for_ids.'[designation_id]', collect($designations)->pluck('name', 'id'), null, ['id' => $name_for_ids.'designation_select', 'class' => 'form-control  select2', 'placeholder' => '--- Select Designation---', 'required', 'name_for_ids' => $name_for_ids, 
			        'onchange'=>'getDesignationDepartments(event)', 'data-campus-id' => $campus_id ]) !!}
			        @if (count($designations) < 0)
			        	<span class="text-danger"><b>Note:</b> No Designation found against this campus. Please add first to proceed</span>
			        @endif
			    </div>
			    <div class="form-group col-sm-3" id="{{$name_for_ids.'_department_div'}}" hidden>
			        {!! Form::label('department', 'Department:') !!}<span style="color: red">*</span><br>
			        {!! Form::select($name_for_ids.'[department_ids][]', [], null, ['id' => $name_for_ids.'_department', 'class' => 'form-control select2', 'data-placeholder' => '--- Select Department ---', 'required', 'multiple']) !!}
			    </div>
			    <div class="form-group col-sm-3">
			        {!! Form::label('role', 'Role:') !!}<span style="color: red">*</span><br>
			        {!! Form::select($name_for_ids.'[role]', Spatie\Permission\Models\Role::pluck('display_name', 'id'), null, ['id' => 'roles_select', 'class' => 'form-control  select2', 'placeholder' => '--- Select Role ---', 'required']) !!}
			    </div>
			    <div class="form-group col-sm-3">
			        {!! Form::label('job_title', 'Job Title:') !!}<span style="color: red">*</span><br>
			        {!! Form::select($name_for_ids.'[job_title]', App\Models\JobTitle::where('organization_id', $organization_id)->pluck('name','id'), null, ['id' => 'job_title_select', 'class' => 'form-control select2', 'placeholder' => '--- Select Job Title ---', 'required']) 
			        !!}
			    </div>
				<!-- <div class="col-md-2 form-group text-center">
					<label>Working(Active)</label><br>
			        <div class="custom-control custom-checkbox">
			           <input type="checkbox" class="custom-control-input"  name="{{$name_for_ids.'[is_working]' }}" id="{{$name_for_ids.'[is_working]' }}" value="1" checked>
			           <label class="custom-control-label" for="{{$name_for_ids}}[is_working]"></label>
			        </div>
				</div>
				<div class="col-md-2 form-group text-center">
					<label>Primary Employee Code</label><br>
			        <div class="custom-control custom-checkbox">
			           <input type="checkbox" class="custom-control-input chk"  name="{{$name_for_ids.'[is_primary_emp_code]' }}" id="{{$name_for_ids.'[is_primary_emp_code]' }}" value="1">
			           <label class="custom-control-label" for="{{$name_for_ids}}[is_primary_emp_code]"></label>
			        </div>
				</div> -->
			</div>
		</div>
	</div>
</div>