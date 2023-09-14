<div class="row">
   <div class="col-md-12 m-b-10">
      <strong>Student's Information:</strong>
      <div class="m-t-10 div-border">
         <div class="margin-10">
            <div class="row">
               {{--  --}}
               <div class="form-group col-md-4" data-step="1" data-intro="Select the academic wing!" data-position='top'>
                  <label>Academic Wing:<span style="color: red">*</span></label>
                  @if(count($wings)!=0)
                  {!! Form::select('wing_id', $wings, null, ['id' => 'wing_id', 'onChange' => 'onWingSelect()', 'class' => 'form-control select2 item-required header-required', 'errorLabel' => 'Academic Wing', 'placeholder' => '--- Select Wing ---']) !!}
                  @else
                  @include('includes/not_found')
                  @endif
               </div>
               {{-- COURSE --}}
               <div class="form-group col-md-4" data-step="2" data-intro="Select course against academic wing!" data-position='bottom'>
                  <label>Course:<span style="color: red">*</span></label>
                  <select onchange="onCourseSelect();" id="course_id" name="course_id" class="form-control select2 item-required header-required" data-placeholder="---Select Course---" errorLabel="Course">
                  </select>
               </div>
               {{-- AFFILIATED BODY --}}
               <div id="affiliated_body_id_div" class="form-group col-md-4" data-step="3" data-intro="Select affiliated body against selected course!" data-position='top'>
                  <label>Affiliated Body:<span style="color: red">*</span></label>
                  <select id="affiliated_body_id" class="form-control select2 item-required header-required" onchange="onAffiliatedBodySelect()" data-placeholder="--- Select Affiliated Body ---" errorLabel="Affiliated Body">
                  </select>
               </div>
               {{-- Annaul / Year --}}
               <div class="form-group col-md-3" data-step="4" data-intro="Select Annaul / Semester term against course" data-position='left'>
                  <label>Annaul / Year:<span style="color: red">*</span></label>
                  <select onchange="onTermSelect()" id="term_id" name="term_id" class="form-control select2 item-required header-required" data-placeholder="--- Select Term  / Year---" errorLabel="Academic Term / Year">
                  </select>
               </div>
               {{-- SHIFT --}}
               <div id="shift_id_div" class="form-group col-3" data-step="5" data-intro="Select shift for the section!" data-position='bottom'>
                  <label>Shift:<span style="color: red">*</span></label>
                  {{ Form::select('shift_id', config('constants.shifts'), null ,[ 'id' => 'shift_id', 'class' => 'form-control select2 item-required header-required', 'placeholder' => '--- Select Shift ---', 'errorLabel' => 'Shift']) }}
               </div>
               {{-- STATUS --}}
               <div id="status_id_div" class="form-group col-3" data-step="6" data-intro="Select section status!" data-position='top'>
                  <label>Status:<span style="color: red">*</span></label>
                  {{ Form::select('status_id', config('constants.section_statuses'), null ,[ 'id' => 'status_id', 'class' => 'form-control select2 item-required header-required', 'placeholder' => '--- Select Status ---', 'errorLabel' => 'Status']) }}
               </div>
               {{-- GENDER --}}
               <div id="gender_id_div" class="form-group col-md-3" hidden="true">
                  <label>Gender:<span style="color: red">*</span></label>
                  {!! Form::select('gender_id', array_slice(config('constants.genders'), 0, 2, true), null, ['id' => 'gender_id', 'class' => 'form-control select2 item-required header-required', 'errorLabel' => 'Gender', 'placeholder' => '--- Select Gender ---']) !!}
               </div>
            </div>
         </div>
      </div>
      @include('layouts/loading')
   </div>
   {{-- Body --}}
   <div class="col-md-12">
      <div class='text-right my-3 clearfix'>
         <div class="float-left">
            <h5 class="font-weight-bold my-2">Total Students: <span id="totalStudents">0</span></h5>
         </div>
         {{-- Check For Students --}}
         <div class="float-right my-auto pt-2">
            <button class="btn btn-outline-dark btn-sm waves-effect waves-light" onclick="checkForStudentCount()" type="button">
               <i class="fa fa-search fa-fw"></i> | Check Students
            </button>
            {{-- Add section row --}}
            <button onclick="addNewSectionRow()" class='btn btn-success btn-sm' id="addNewCsSectionBtn" data-step="7" data-intro="After selecting required filters, click this button to create section." data-position='bottom'>
               <i class='fa fa-plus fa-fw'></i> | Add new Section
            </button>
         </div>
      </div>
      {{-- show count --}}
      {{-- Dynamic Form Render Here --}}
      <div id="section_details"></div>
   </div>
</div>
{{-- Footer --}}
<div class="text-left">
   <div class="form-group">
      <div>
         <a href="{{ route('sections.index') }}" class="btn btn-light btn-sm active waves-effect mr-1"><i class="fa fa-remove fa-fw text-danger"></i> Cancel</a>
         <button class="btn btn-dark btn-sm waves-effect waves-light" onclick="validateForm()" type="button"><i class="fa fa-cloud-upload fa-fw"></i> | Save Section</button>
      </div>
   </div>
</div>