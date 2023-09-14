@include('includes/header_start')

<!-- DataTables -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
  <li class="list-inline-item">
    <button type="button" class="button-menu-mobile open-left waves-effect">
      <i class="ion-navicon"></i>
    </button>
  </li>
  <li class="hide-phone list-inline-item app-search">
    <h3 class="page-title">Attendance Sheet Entry</h3>
  </li>
</ul>
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
                                <div class="card shadow">
                                  <div class="card-body">
                                    <div class="form-group row">
                                      <div class="col-md-3">
                                        <label>Academic Wing:</label>
                                        {{--  {!! Form::select('wing_id', $wings, null, ['id' => 'wing_id', 'onChange' => 'onWingSelect()', 'class' => 'form-control', 'placeholder' => '--- Select Wing ---']) !!} --}}
                                        {{ Form::select('filter_wing_id', App\Models\Wing::pluck('name', 'id'), null, ['class' => 'form-control select2 item-required', 'id' => 'filter_wing_id', 'onChange' => 'onWingSelect()', 'placeholder' => '--- Select Wing ---', 'never-bypass' => true, 'errorLabel' => 'Wing']) }}
                                      </div>
                                      <div class="col-md-3">
                                        <label>Course:</label>
                                        <select onchange="onCourseSelect();" never-bypass="true" errorLabel="Course" id="course_id" name="course_id" class="form-control select2 item-required" data-placeholder="---Select Course---">
                                        </select>
                                      </div>
                                      {{-- Annaul / Year --}}
                                      <div class="form-group col-md-2">
                                        <label>Annaul / Year:<span style="color: red">*</span></label>
                                        <select onchange="onTermSelect()" never-bypass="true" id="term_id" name="term_id" placeholder="--Select Annaul / Year--" class="form-control select2 item-required" data-placeholder="--- Select Term  / Year---" errorLabel="Academic Term / Year">
                                        </select>
                                      </div>
                                      <div class="col-md-2">
                                        <label>Subject:</label>
                                        <select onchange="onSubjectSelect();" never-bypass="true" errorLabel="Subject" id="subject_id" name="subject_id" class="form-control select2 item-required" data-placeholder="---Select Subject---" placeholder="---Select Subject---">
                                        </select>
                                      </div>
                                      <div class="col-md-2">
                                        <label>Section:</label>
                                        <select onchange="onSectionSelect();" never-bypass="true" errorLabel="Section" id="section_id" name="section_id" class="form-control select2 item-required" data-placeholder="---Select Section---" placeholder="---Select Section---"></select>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <div class="col-md-3">
                                          <label>Teacher:</label>
                                          <select id="teacher_id" name="teacher_id" never-bypass="true" errorLabel="Teacher" class="form-control select2 item-required" data-placeholder="---Select Teacher---"></select>
                                          </div>
                                          <div class="col-md-3">
                                            <label>Room:</label>
                                            {{ Form::select('room_id', App\Models\Room::where('organization_campus_id', Illuminate\Support\Facades\Session::get('organization_campus_id'))->pluck('name', 'id'), null, ['class' => 'form-control select2 item-required', 'id' => 'room_id','placeholder' => '--- Select Room ---', 'never-bypass' => true, 'errorLabel' => 'Room']) }}
                                          </div>
                                          <div class="col-md-3">
                                            <label>Title:</label>
                                            <input id="title" class="form-control" type="text" placeholder="Enter Title" name="title">
                                          </div>
                                          <div class="col-md-3">
                                            <label>Date & Time:</label><br>
                                            <input id="date_time" data-date-format='yyyy-mm-dd' class="form-control" type="datetime-local" placeholder="Enter End Date" name="date_time">
                                          </div>
                                        </div>
                                        <div class="col-12 text-right p-0">
                                          <button class="btn btn-success btn-sm" onclick="validateForm()"><i class="fa fa-filter fa-fw"></i> | Filter Data</button>
                                        </div>
                                      </div>
                                      @include('layouts/loading')
                                    </div>
                                  </div>
                                </div>
                                <!-- end row -->
                                <br><br>

                                <div id="filteredResponse">
                                  
                                </div> <!-- end col -->
                              </div> <!-- end row -->
                            </div>
                          </div>

@include('includes/footer_start')

<!-- Required datatable js -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
<!-- Responsive examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

<!-- Datatable init js -->
<script src="{{ asset('assets/pages/datatables.init.js')}}"></script>
<script src="{{ asset('js/affiliatedBodies/afiliated_bodies.js') }}"></script>
<script src="{{ asset('js/attendance/attendance_sheet_entry.js') }}"></script>
@include('includes/footer_end')