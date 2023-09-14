<div class="row">
   <div class="col-md-12">
      <strong>Section Information:</strong>
      <div class="m-t-10 div-border">
         <div class="margin-10">
            <div class="row">
               {{--  --}}
               <div class="form-group col-md-3">
                  <label>Academic Wing:<span style="color: red">*</span></label>
                  @if(count($wings)!=0)
                  {!! Form::select('wing_id', $wings, $section->academic_wing_id, ['id' => 'wing_id', 'onChange' => 'onWingSelect()', 'class' => 'form-control select2 item-required header-required', 'errorLabel' => 'Academic Wing', 'placeholder' => '--- Select Wing ---', 'disabled']) !!}
                  @else
                     @include('includes/not_found')
                  @endif
               </div>
               {{-- COURSE --}}
               <div class="form-group col-md-3">
                  <label>Course:<span style="color: red">*</span></label>
                  <select onchange="onCourseSelect();" id="course_id" name="course_id" class="form-control select2 item-required header-required" data-placeholder="---Select Course---" errorLabel="Course" disabled>
                  </select>
               </div>
               {{-- AFFILIATED BODY --}}
               <div id="affiliated_body_id_div" class="form-group col-md-3">
                  <label>Affiliated Body:<span style="color: red">*</span></label>
                  <select id="affiliated_body_id" class="form-control select2 item-required header-required" onchange="onAffiliatedBodySelect()" data-placeholder="--- Select Affiliated Body ---" errorLabel="Affiliated Body" disabled>
                  </select>
               </div>
               {{-- Annaul / Year --}}
               <div class="form-group col-md-3">
                  <label>Annaul / Year:<span style="color: red">*</span></label>
                  <select onchange="onTermSelect()" id="term_id" name="term_id" class="form-control select2 item-required header-required" data-placeholder="--- Select Term  / Year---" errorLabel="Academic Term / Year" disabled>
                  </select>
               </div>
               {{-- SHIFT --}}
               <div id="shift_id_div" class="form-group col-3">
                  <label>Shift:<span style="color: red">*</span></label>
                  {{ Form::select('shift_id', config('constants.shifts'), null ,[ 'id' => 'shift_id', 'class' => 'form-control select2 item-required header-required', 'placeholder' => '--- Select Shift ---', 'errorLabel' => 'Shift', 'disabled']) }}
               </div>
               {{-- STATUS --}}
               <div id="status_id_div" class="form-group col-3">
                  <label>Status:<span style="color: red">*</span></label>
                  {{ Form::select('status_id', config('constants.section_statuses'), null ,[ 'id' => 'status_id', 'class' => 'form-control select2 item-required header-required', 'placeholder' => '--- Select Status ---', 'errorLabel' => 'Status']) }}
               </div>
               {{-- GENDER --}}
               <div id="gender_id_div" class="form-group col-md-3" hidden="true">
                  <label>Gender:<span style="color: red">*</span></label>
                  {!! Form::select('gender_id', array_slice(config('constants.genders'), 0, 2, true), null, ['id' => 'gender_id', 'class' => 'form-control select2 item-required header-required', 'errorLabel' => 'Gender', 'placeholder' => '--- Select Gender ---', 'disabled']) !!}
               </div>
            </div>
         </div>
      </div>
      @include('layouts/loading')
   </div>
   {{-- Body --}}
   <div class="col-md-12">
      <div class="clearfix my-3">
         <div class="float-left d-flex">
            <h6 class="text-dark mr-5">Total Students: <b class="font-weight-bold" id="totalStudents">0</b></h6>
            <h6 class="text-dark mr-5">Total Section Strength: <b class="font-weight-bold" id="totalSectionStrength">{{ $section->sectionDetails->sum('section_strength') }}</b></h6>
            <h6 class="text-dark mr-5">Section Assigned To: <b class="font-weight-bold" id="totalSectionStudents">{{ $section->studentBooks()->groupBy('student_academic_history_id')->get()->count() }}</b> Students</h6>
            <h6 class="text-dark">Variation: <b class="font-weight-bold" id="totalStudentVariation">0</b></h6>
         </div>
         <div class='float-right my-auto pt-2'>
            <button onclick="addNewSectionRow()" class='btn btn-success btn-sm' id="addNewCsSectionBtn">
               <i class='fa fa-plus fa-fw'></i> | Add new Section
            </button>
         </div>
      </div>
      {{-- Dynamic Form Render Here --}}
      <div id="section_details">
         @foreach($section->sectionDetails as $key => $sectionDetail)
         @php ++$key @endphp
         <input type="hidden" id="count_subjects_{{ $key }}" value="{{ count($sectionDetail->sectionSubjectDetails) }}">
         <div class="mb-5 div-border px-2 sectionRow" id="sectionDiv_{{ $key }}" row-status="division">
            <div class="margin-10">
               <div class="text-center">
                  <h4 class="font-weight-bold my-4">Section Row</h4>
                     <input type="hidden" id="section_id_{{ $key }}" value="{{ $sectionDetail->id }}">
               </div>
               <div class="form-row">
                  <div class="col-4 form-group">
                     <label>Section Name:<span style="color: red">*</span></label>
                     <input type="text" id="section_name_{{ $key }}" class="form-control" placeholder="Section Name" value="{{ $sectionDetail->section_name }}">
                  </div>
                  <div class="col-4 form-group">
                     <label class="mr-1">Section Strength:<span class="text-danger">*</span></label>
                     <input type="number" min="0" id="section_strength_{{ $key }}" class="form-control rounded-0 item-required" placeholder="Section Strength" errorLabel="Section ({{ $key }}) Strength" value="{{ $sectionDetail->section_strength}}">
                  </div>
                  <div class="col-4 form-group">
                     <label class="mr-1">Section Code:<span class="text-danger">*</span></label>
                     <input type="text" id="section_code_{{ $key }}" class="form-control rounded-0 item-required" placeholder="Section Code" errorLabel="Section ({{ $key }}) Code" value="{{ $sectionDetail->section_code }}">
                  </div>
               </div>
               {{-- Subjects rows --}}
               <div class="mt-3">
                  @foreach($sectionDetail->sectionSubjectDetails as $sub => $subject)
                  <div class="form-row hvr-underline-reveal section-subject-row">
                     {{-- SUBJECTS --}}
                     <div class="form-group col-4">
                        <label>Subject {{ $sub+1 }}:<span style="color: red">*</span></label>
                        <input type="hidden" id="id_{{ $key.'_'.$sub }}" value="{{ $subject->id }}">
                        <input type="text" class="form-control bg-light" value="{{ App\Models\SessionCourseSubject::where('subject_id', $subject->subject_id)->get()->last()->subject_name }}" readonly>
                        <input type="hidden" id="subject_{{ $key.'_'.$sub }}" value="{{ $subject->subject_id }}">
                     </div>
                     {{-- TEACHER --}}
                     <div class="form-group col-4">
                        <label>Teacher For:<span style="color: red">*</span></label>
                        {{ Form::select('teacher_id', App\User::whereHas('roles', function($q){$q->where('id', '4')->orWhere('id', '16')->orWhere('id', '17');})->get()->pluck('name', 'id'), $subject->sectionTeachers()->where('type', 0)->get()->last()->user_id, [ 'id' =>
                        'teacher_'.$key.'_'.$sub, 'class' => 'form-control select2 item-required', 'placeholder' => '--- Select Teacher ---', 'errorLabel' => 'Section ('.$key.') & Subject ('. $subject->subject_name .') Teacher']) }}
                     </div>
                     {{-- HELPER TEACHER --}}
                     @if($section->academic_wing_id != 2)
                     <div class="form-group col-4">
                        <label>Helper Teacher For:<span style="color: red">*</span></label>
                        {{ Form::select('helper_teacher_ids[]', App\User::whereHas('roles', function($q){$q->where('id', '4');})->get()->pluck('name', 'id'), $subject->sectionTeachers()->where('type', 1)->get()->pluck('user_id') ,[ 'id' =>
                        'helper_teachers_'.$key.'_'.$sub, 'class' => 'form-control select2 select2-multiple item-required', 'multiple','data-placeholder' => '--- Select Helper Teacher ---', 'errorLabel' => 'Section ('.$key.') & Subject ('. $subject->subject_name .') Helper Teacher']) }}
                     </div>
                     @endif
                  </div>
                  @endforeach
               </div>
               {{-- DELETE --}}
               <button class="btn btn-danger btn-sm" onclick="deleteSectionRow({{ $key }})" data-section="{{ $sectionDetail->id ?? 'empty' }}">
                  <i class="mdi mdi-delete"></i> | Delete
               </button>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</div>
{{-- Footer --}}
<div class="text-left">
   <div class="form-group">
      <div>
         <a href="{{ route('sections.index') }}" class="btn btn-light btn-sm active waves-effect mr-1">
            <i class="fa fa-remove fa-fw text-danger"></i> Cancel
         </a>
         <button class="btn btn-dark btn-sm waves-effect waves-light" onclick="validateForm()" type="button">
            <i class="fa fa-cloud-upload fa-fw"></i> | Update Section
         </button>
      </div>
   </div>
</div>