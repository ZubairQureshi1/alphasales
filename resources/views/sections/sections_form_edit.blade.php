<div class="row">
    {{-- <h6 class="col-md-3" id="form_code" value="Form Code: {{ $form_code }}">
        Form Code: {{ $form_code }}
    </h6> --}}
    <div class="col-md-3" id="session_div">
        {!! Form::label('session', 'Session:') !!}<span style="color: red">*</span>
        {{ Form::select('session_id', \Auth::user()->userAllowedSessions()->get()->pluck('session_name', 'session_id'), \Auth::user()->userAllowedSessions()->count()>0?Illuminate\Support\Facades\Session::get('selected_session_id'):null, ['class' => 'form-control select2 item-required', 'id' => 'session_id', 'placeholder' => '--- Select Session ---', 'onchange' => 'getCoursesBySession()', 'never-bypass' => true, 'errorLabel' => 'Session', 'disabled']) }}
    </div>
    
</div>
<div class="row">
    <div class="col-md-12 m-b-10">
        <strong>
            Student's Information:
        </strong>
        <div class="m-t-10 div-border">
            <div class="margin-10">
                <div class="row">
                     <div class="col-md-3">
                        <label>
                            Academic Wing:<span style="color: red">*</span>
                        </label>
                        @if(count($wings)!=0)
                                {!! Form::select('wing_id', $wings, $selectData->wing_id, ['id' => 'wing_id', 'onChange' => 'onWingSelect()', 'class' => 'form-control select2', 'placeholder' => '--- Select Wing ---']) !!}
                            @else
                                @include('includes/not_found')
                            @endif
                    </div>
                    <input name="section_id" id="section_id" value="{{ $selectData->id }}" type="hidden">
                    <div class="col-md-3">
                        <label>
                            Course:<span style="color: red">*</span>
                        </label>
                        @if(isset($selectData))
                          @if(count($wings)!=0)
                                {!! Form::select('course_id', $courses, $selectData->course_id, ['id' => 'course_id', 'onChange' => 'onCourseSelect()', 'class' => 'form-control select2', 'placeholder' => '--- Select Course ---']) !!}
                            @else
                                @include('includes/not_found')
                            @endif
                        @else
                        <select onchange="onCourseSelect();" id="course_id" name="course_id" class="form-control select2"  style="width: 80%;" data-placeholder="---Select Course---">
                        </select>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <label>
                            Subject:<span style="color: red">*</span>
                        </label>
                        @if(isset($selectData))
                          @if(count($courses)!=0)
                                {!! Form::select('subject_id', $subjects, $selectData->subject_id, ['id' => 'subject_id', 'onChange' => 'onSubjectSelect()', 'class' => 'form-control select2', 'placeholder' => '--- Select Course ---']) !!}
                            @else
                                @include('includes/not_found')
                            @endif
                        @else
                        <select onchange="onSubjectSelect();" id="subject_id" name="subject_id" class="form-control select2"  style="width: 80%;" data-placeholder="---Select Subject---">
                        </select>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @include('layouts/loading')
    </div>

    <div id="sectionId" class="col-md-12 m-b-10">
        <strong>
            Section:
        </strong>
        <div class="m-t-10 div-border">
            <div class="margin-10">
                <div class="row">
                    <table class="">
                        <table class="table table-bordered" style="border: 1px solid #ddd !important;">
                          <thead>
                            <tr>
                              <th scope="col">Section Name</th>
                              <th scope="col">Section Code</th>
                              <th scope="col">Affiliated Body</th>
                              <th scope="col">Teacher</th>
                              <th scope="col">Teacher Helper</th>
                              <th scope="col">Strength</th>
                              <th scope="col">Active</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th>
                                  <input class="form-control letter_capitalize item-required" never-bypass data-parsley-type="name" id="name" name="name" value="{{ $selectData->name }}" placeholder="Enter Section Name" required="" errorLabel="Section Name" type="text"/>
                              </th>
                              <td>
                                  <input class="form-control letter_capitalize item-required" never-bypass data-parsley-type="code" id="code" name="code" value="{{ $selectData->code }}" placeholder="Enter Section Code" required="" errorLabel="Section Code" type="text"/>
                              </td>
                              <td>
                              	 @if(isset($teacherHelpers))
		                          @if(count($courses)!=0)
		                                {!! Form::select('affiliated_body_ids[]', $bodies, $affiliatedBodies, ['id' => 'affiliated_body_ids', 'class' => 'form-control select2', 'placeholder' => '--- Select Affiliated Body---', 'multiple'])  !!}
		                            @else
		                                @include('includes/not_found')
		                            @endif
		                        @else
		                         <select multiple onchange="" id="affiliated_body_ids" name="affiliated_body_ids" class="form-control select2"  style="width: 80%;" data-placeholder="---Select Affiliated Body---">
                                  </select>
		                        @endif
                                 
                              </td>
                              <td>                              	
                                   @if(isset($selectData))
			                          @if(count($wings)!=0)
			                                {!! Form::select('teacher_primary', $teachers, $teacherPrimary->user_id, ['id' => 'teacher_primary', 'onChange' => '', 'class' => 'form-control select2', 'placeholder' => '--- Select ---']) !!}
			                            @else
			                                @include('includes/not_found')
			                            @endif
			                        @else
			                        <select onchange="onCourseSelect();" id="teacher_primary" name="teacher_primary" class="form-control select2"  style="width: 80%;" data-placeholder="---Select---">
			                        </select>
			                        @endif
                              </td>
                              <td>
                              	 @if(isset($teacherHelpers))
		                          @if(count($courses)!=0)
		                                {!! Form::select('teacher_helpers[]', $teachers, $teacherHelpers, ['id' => 'teacher_helpers', 'class' => 'form-control select2', 'placeholder' => '--- Select Helper Teacher ---', 'multiple'])  !!}
		                            @else
		                                @include('includes/not_found')
		                            @endif
		                        @else
		                        <select multiple onchange="" id="teacher_helpers" name="teacher_helpers" class="form-control select2"  style="width: 80%;" data-placeholder="---Select Helper Teacher---">
                                  </select>
		                        @endif

                                  
                              </td>
                              <td>
                                  <input class="form-control letter_capitalize item-required" never-bypass onkeypress="return numericOnly(event)" value="{{ $selectData->strength }}" data-parsley-type="strength" id="strength" name="strength" placeholder="Enter Section Strength" required="" errorLabel="Section Strength" type="text"/>
                              </td>
                              <td>
                                  {{-- <select onchange="" id="sectionActive" name="sectionActive" class="form-control select2"  style="width: 80%;" data-placeholder="---Select---">
                                    <option value=""></option>
                                    <option value=""></option>
                                  </select> --}}
                                  {{ Form::select('active', config('constants.section_active'), $selectData->active, ['id' => 'active', 'class' => 'form-control select2', 'placeholder' => '---Select Active Status ---']) }}
                              </td>
                            </tr>
                          </tbody>
                        </table>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
   <div class="col-md-12 m-b-10">
    <div class="form-group">
        <div>
            <button class="btn btn-primary waves-effect waves-light" onclick="editValidateForm()" type="button">
                Submit
            </button>
            <a href="{{ route('sections.update') }}" class="btn btn-secondary waves-effect m-l-5" type="reset">
                Cancel
            </a>
        </div>
    </div>  
  </div>
</div>

