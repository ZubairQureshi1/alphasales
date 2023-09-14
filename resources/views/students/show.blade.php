@include('includes/header_start')
@include('includes/header_end')
<!-- Page title -->
<ul class="list-inline menu-left mb-0">
   <li class="list-inline-item">
      <button type="button" class="button-menu-mobile open-left waves-effect">
         <i class="ion-navicon"></i>
      </button>
   </li>
   <li class="hide-phone list-inline-item app-search">
      <h3 class="page-title text-capitalize">{{$student['student_name']}} - {{ $student['roll_no'] }}</h3>
   </li>
</ul>
@include('alertify::alertify')
<div class="clearfix"></div>
</nav>
</div>
<!-- Top Bar End -->
<!-- ==================
   PAGE CONTENT START
   ================== -->
   <div class="page-content-wrapper">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header no-margin">
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @can(['view_admissions'])
                        <li class="nav-item">
                           <a class="nav-link active" id="student-profile-tab" data-toggle="tab" href="#student_profile_tab" role="tab" aria-controls="student_profile_tab" aria-selected="true"><i class="ti-user pr-2 text-primary"></i> Student Profile</a>
                        </li>
                        @endcan
                        {{-- NOTE: Show only when admission is not from pwwb --}}
                        {{-- FEE PACKAGE --}}
                        @if($student['student_category_id'] !== 0)
                           @can(['view_fee_package'])
                           <li class="nav-item">
                              <a class="nav-link" id="fee-package-tab" data-toggle="tab" href="#fee_package_form" role="tab" aria-controls="fee_package_form" aria-selected="false"><i class="ti-money pr-2 text-primary"></i> Fee Package</a>
                           </li>
                           @endcan
                           {{-- STUDENT INSTALLMENTS --}}
                           @can(['view_installments'])
                              <li class="nav-item">
                                 <a class="nav-link" id="installment-tab" data-toggle="tab" href="#installment_form" role="tab" aria-controls="installment_form" aria-selected="false"><i class="ti-wallet pr-2 text-primary"></i> Installments</a>
                              </li>
                           @endcan
                        @endif
                       {{-- STUDENT REGISTRATION --}}
                       @can(['view_student_registration'])
                       <li class="nav-item">
                          <a class="nav-link" id="registration-tab" data-toggle="tab" href="#registration_form" role="tab" aria-controls="registration_form" aria-selected="false"><i class="ti-id-badge pr-2 text-primary"></i> Student Registration</a>
                       </li>
                       @endcan
                   </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                     <div class="tab-pane fade show active" id="student_profile_tab" role="tabpanel" aria-labelledby="student-profile-tab">
                        <div class="row">
                           <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-3">
                              <div class="card m-b-30 ">
                                 <div class="div-border">
                                    <div class="text-center">
                                       <img class="m-t-20 m-b-20 rounded-circle circular_image shadow" src="{{ !empty($student['profile_image']) ? asset('uploads/Students/'.$student['roll_no'].'/profile/'.$student['profile_image']) : asset('assets/images/avatar.png') }}" alt="Nature" style="width:25vh; height: 25vh; object-fit: cover;"/>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                       <li class="list-group-item">
                                          <span class="profile-card-icon text-center"><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal" ></i> 
                                          </span>
                                          {{ $student['course_name'] }}
                                       </li>
                                       <li class="list-group-item">
                                          <span class="profile-card-icon text-center"><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal" id="set"></i> 
                                          </span>
                                          {{ $student['present_address'] }}
                                       </li>
                                       <li class="list-group-item">
                                          <span class="profile-card-icon text-center">
                                             <i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal" id="set"></i>
                                          </span>
                                          {{ $student['email'] }}
                                       </li>
                                       <li class="list-group-item">
                                          <span class="profile-card-icon text-center">
                                             <i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal" id="set"></i>
                                          </span>
                                          {{ !empty($student['student_cell_no'] ) ? $student['student_cell_no']  : '----'}}
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <!-- end col -->
                           <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-9">
                              <div class="row">
                                 <div class="col-md-12 col-lg-12">
                                    <div class="card m-b-30">
                                       <div class="card-body div-border">
                                          @include('students/show_personal_details')
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="card m-b-30">
                                       <div class="card-body div-border">
                                          <div class="heading">
                                             <strong>Subjects</strong> (<i>Current Session Subjects</i>)
                                          </div>
                                          <table class="table table-striped table-bordered">
                                             <thead>
                                                <tr>
                                                   <th>#</th>
                                                   <th>Subject Name</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             @foreach($student_book as $index => $subject)
                                             <tr>
                                                <td>{{ ++$index }}</td>
                                                <td> {{ ucfirst($subject['subject_name']) }}</td>
                                             </tr>
                                             @endforeach
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           {{-- Academic Histories --}}
                           <div class="row">
                              <div class="col-12">
                                 <div class="card m-b-30">
                                    <div class="card-body div-border pb-4">
                                       <div class="heading">
                                          <strong>Academic Records</strong>
                                       </div>
                                        <div class="m-t-20">
                                            <div id="academic_table_body">
                                            @forelse($academicRecord as $key => $record)
                                            <div class='form-row div-border p-2 mb-2'>   
                                               <div class='form-group col-md-3'>
                                                  <input type="hidden" name="records[{{ $key }}][id]" value="{{ $record->id }}">
                                                  <label for='academic_type_{{ $key }}'>Academic Type</label>
                                                  {!! Form::select('records['.$key.'][type_id]', config('constants.previous_degrees'), $record->type_id, ['id' => 'academic_type_'.$key, 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Academic Type', 'onchange' => 'otherDegreeType()', 'row_count' => $key, 'disabled']) !!}
                                               </div>
                                               <div class='form-group col-md-4' id='academic_other_degree_div_{{ $key }}' {{ $record->type_id == 12 ? '' : 'hidden="true"' }}>
                                                  <label for='academic_other_degree_{{ $key }}'>Other Degree Name:</label>
                                                  <input id='academic_other_degree_{{ $key }}' type='text' name='records[{{ $key }}][other_degree_name]' placeholder='Enter Other Degree Name' class='form-control' value="{{ $record->other_degree_name }}" readonly>   
                                               </div>
                                               <div class='form-group col-md-2'>
                                                  <label for='academic_year_{{ $key }}'>Academic Year:</label>
                                                  <input name="records[{{ $key }}][years]" id='academic_year_{{ $key }}' type='text' placeholder='YYYY' data-mask='9999' class='form-control' value="{{ $record->year }}" readonly>
                                               </div>
                                               <div class='form-group col-md-2'>
                                                  <label for='academic_roll_no_{{ $key }}'>Roll Number:</label>
                                                  <input name="records[{{ $key }}][rollNumbers]" id='academic_roll_no_{{ $key }}' type='text' placeholder='Roll No.' class='form-control' value="{{ $record->roll_no }}" readonly>
                                               </div>
                                               <div class='form-group col-md-2'>
                                                  <label for='academic_marks_{{ $key }}'>Marks Obtained:</label>
                                                  <input name="records[{{ $key }}][marks]" id='academic_marks_{{ $key }}' type='number' min='0'  placeholder='Marks Obtained' class='form-control' value="{{ $record->marks }}" readonly>
                                               </div>
                                               <div class='form-group col-md-2'>
                                                  <label for='academic_total_marks_{{ $key }}'>Total Marks:</label>
                                                  <input name="records[{{ $key }}][totalMarks]" id='academic_total_marks_{{ $key }}' onchange='validateMarks({{$key}})' onmouseup='validateMarks({{$key}})' type='number' placeholder='Total Marks' class='form-control' value="{{ $record->total_marks }}" readonly>
                                               </div>
                                               <div class='form-group col-md-2'>
                                                  <label for='academic_percentage_{{ $key }}'>Percentage:</label>
                                                  <input name="records[{{ $key }}][percentages]" id='academic_percentage_{{ $key }}' type='number' placeholder='Percentage' class='form-control' value="{{ $record->percentage }}" readonly>
                                               </div>
                                               <div class='form-group col-md-2'>
                                                  <label for='academic_grade_{{ $key }}'>Grade:</label>
                                                  <input name="records[{{ $key }}][grades]" id='academic_grade_{{ $key }}' type='text' placeholder='Grades' class='form-control' value="{{ $record->grade }}" readonly>
                                               </div>
                                               <div class='form-group col-md-3'>
                                                  <label for='academic_school_{{ $key }}'>School/College:</label>
                                                  <input name="records[{{ $key }}][schools]" id='academic_school_{{ $key }}' type='text' placeholder='School/College' class='form-control' value="{{ $record->school_college }}" readonly>
                                               </div>
                                               <div class='form-group col-md-4'>
                                                  <label for='academic_board_uni_{{ $key }}'>Board/University:</label>
                                                  <input name="records[{{ $key }}][boards]" id='academic_board_uni_{{ $key }}' type='text' placeholder='Board/University' class='form-control' value="{{ $record->board_uni }}" readonly>
                                               </div>
                                               {{-- name='records[{{ $key }}][attachments]' --}}
                                               <input type='file' data-target='attachment_input_{{ $key }}' row_index='{{ $key }}' class='d-none' onchange="uploadNewAcademicAttachment({{ $record->id }})" id='academic_attachment_url_{{ $key }}' onchange='showAcademicAttachmentFile()' value='' readonly/>
                                               <input type='hidden' name='academic_row_state_{{ $key }}' id='academic_row_state_{{ $key }}' value='unchanged' />
                                            </div>
                                            @empty
                                               <div class="records-alert alert alert-info"><i class="fa fa-exclamation-circle fa-fw fa-lg" aria-hidden="true"></i> No Record Added!</div>
                                            @endforelse
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           {{-- attachments --}}
                           <div class="row">
                              <div class="col-12">
                                 <div class="card m-b-30">
                                    <div class="card-body div-border">
                                       <div class="heading">
                                          <strong>Attachments</strong>
                                       </div>
                                       <table class="table table-striped table-bordered">
                                          <thead>
                                             <tr>
                                                <th>Filename</th>
                                                <th class="text-center">Type</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             @foreach($attachments as $attachment)
                                             <tr>
                                                <td> Attachment - {{ ($attachment->attachment_url) }}</td>
                                                <td class="text-center"> {{ $attachment->attachment_type }}</td>
                                             </tr>
                                             @endforeach
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        </div>
                     </div>
                  <div class="tab-pane fade div-border padding-10" id="fee_package_form" role="tabpanel" aria-labelledby="fee-package-tab">
                    @if(!empty($fee_package))
                        @include('accounts/feePackage/show')
                    @else 
                        @include('includes/not_found')
                    @endif
                  </div>
                  {{-- NOTE: Fee Installments --}}
                  <div class="tab-pane fade div-border padding-10" id="installment_form" role="tabpanel" aria-labelledby="installment-tab">
                     @if(count($fee_instalments) == 0)
                        @include('includes/not_found')
                     @else
                        @include('accounts.studentInstallments.installments')
                     @endif
                  </div>

                  {{-- NOTE: STUDENT REGISTATION --}}
                  <div class="tab-pane fade div-border padding-10" id="registration_form" role="tabpanel" aria-labelledby="registration-tab">
                     @include('registrations.show_registrations')
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>

{{-- ADD ATTACHMENTS MODAL --}}
<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="addAttachments" role="dialog" tabindex="-1">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header bg-light">
            <h5 class="modal-title mt-0">Add Student <strong>Attachment</strong></h5>
            <button aria-hidden="true" class="close text-danger" data-dismiss="modal" type="button">×</button>
         </div>
         <div class="modal-body">
            <form action="{{route('students.addAttachment',$student['id'])}}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                  <label>Select Attachment Type: </label>
                  {{ Form::select('attachment_type',config('constants.attachment_types'), null, ['class' => 'form-control select2', 'data-placeholder' => '--- Select Attachment Type ---'] ) }}
               </div>
               <div class="form-group">
                  <label>Select File</label>
                  <input type="file" class="form-control" name="attachment_file">
               </div>
               <div class="mt-4 text-right">
                  <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-cloud-upload"></i> <b>|</b> Save Attachment</button>
                  <button class="btn btn-default btn-sm" data-dismiss="modal" type="button">Cancel</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
{{-- /.ADD ATTACHMENTS MODAL --}}

@include('includes/footer_start')
<!-- Required datatable js -->
@if(!empty($fee_package))
   <script type="text/javascript">
      var other_count  =  {{ count($fee_package->feeOtherCharges)+1 }};
   </script>
@endif
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
   var template = '{{json_encode(config('constants'))}}';
   var constants = JSON.parse(template.replace(/&quot;/g,'"'));
</script>

<script type="text/javascript">
   const isNewFeePackage = {{ !empty($fee_package) ? 0 : 1 }};
</script>

<script>
   var template_enquiry = '{{json_encode($student)}}';
   var student = @json($student);
   var academic_history_id = {{ $studentAcademicHistory->id }};
</script>

   <!-- Datatable init js -->
   <script type="text/javascript">
      var contact_count = {!! count($contactInfos)+1 !!};
      var academicRecord = {!! count($academicRecord)+1 !!};
      var other_count = 0;
   </script>

   <script src="{{asset('js/accounts/fee-package/fee_package.js')}}"></script>
   <script src="{{asset('js/student/student.js')}}"></script>
   <script src="{{asset('js/student_registrations/registration.js')}}"></script>

   @include('includes/footer_end')
