<div class="row">
   <div class="col-md-12 m-b-10">
      <strong>Student's Information:</strong>
      <div class="m-t-10 div-border">
         <div class="margin-10">
            <div class="row">
               {{--  --}}
               <div class="form-group col-md-4">
                  <label>Academic Wing:<span style="color: red">*</span></label>
                  @if(count($wings)!=0)
                  {!! Form::select('wing_id', $wings, null, ['id' => 'wing_id', 'onChange' => 'onWingSelect()', 'class' => 'form-control select2 item-required', 'errorLabel' => 'Academic Wing', 'placeholder' => '--- Select Wing ---']) !!}
                  @else
                  @include('includes/not_found')
                  @endif
               </div>
               {{-- COURSE --}}
               <div class="form-group col-md-4">
                  <label>Course:<span style="color: red">*</span></label>
                  <select onchange="onCourseSelect();" id="course_id" name="course_id" class="form-control select2 item-required" data-placeholder="---Select Course---" errorLabel="Course">
                  </select>
               </div>
               {{-- AFFILIATED BODY --}}
               <div id="affiliated_body_id_div" class="form-group col-md-4">
                  <label>Affiliated Body:<span style="color: red">*</span></label>
                  <select id="affiliated_body_id" class="form-control select2 item-required" onchange="onAffiliatedBodySelect()" data-placeholder="--- Select Affiliated Body ---" errorLabel="Affiliated Body">
                  </select>
               </div>
               {{-- Annaul / Year --}}
               <div class="form-group col-md-3">
                  <label>Annaul / Year:<span style="color: red">*</span></label>
                  <select onchange="onTermSelect()" id="term_id" name="term_id" class="form-control select2 item-required" data-placeholder="--- Select Term  / Year---" errorLabel="Academic Term / Year">
                  </select>
               </div>
               {{-- SHIFT --}}
               <div id="shift_id_div" class="form-group col-3">
                  <label>Shift:<span style="color: red">*</span></label>
                  {{ Form::select('shift_id', config('constants.shifts'), null ,[ 'id' => 'shift_id', 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Shift ---', 'errorLabel' => 'Shift']) }}
               </div>
               {{-- GENDER --}}
               <div id="gender_id_div" class="form-group col-md-3" hidden="true">
                  <label>Gender:<span style="color: red">*</span></label>
                  {!! Form::select('gender_id', array_slice(config('constants.genders'), 0, 2, true), null, ['id' => 'gender_id', 'class' => 'form-control select2 item-required', 'errorLabel' => 'Gender', 'placeholder' => '--- Select Gender ---']) !!}
               </div>
            </div>
         </div>
      </div>
      @include('layouts/loading')
   </div>
   {{-- Body --}}
   <div class="col-md-12">
      {{-- ACTION BUTTON --}}
      <div class="text-right my-4">
         <button class="btn btn-outline-dark btn-sm" onclick="validateForm('student')"><i class="fa fa-filter fa-fw"></i> | Student Wise Data</button>
         <button class="btn btn-success btn-sm" onclick="validateForm('subject')"><i class="fa fa-book fa-fw"></i> | Subject Wise Data</button>
      </div>
      {{-- Dynamic Form Render Here --}}
      <div id="section_reporting_details" class="row"></div>
   </div>
</div>