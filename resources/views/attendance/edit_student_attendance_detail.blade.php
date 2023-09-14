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
    <h3 class="page-title">Edit Student Attendance</h3>
  </li>
</ul>
</nav>
</div>
 <div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card shadow">
          <div class="card-body">
            <div class="form-group row">
              <div class="col-md-3">
                <label>Student Name:</label>
                  <input id="name" class="form-control" type="text" readonly="" placeholder="Enter Student Name" name="name" value="{{ucfirst($data->student_name)}}">
                </div>
                <div class="col-md-3">
                  <label>Status (P/A/L):</label>
                  
                  <input type="hidden" name="attendance_id" id="attendance_id" value="{{$attendanceId}}">
                  <input type="hidden" name="student_id" id="student_id" value="{{$data->id}}">
                  {{-- @php dd($previousAtandance->student_attendance_id) @endphp --}}
                  {{-- previousAtandance --}}
                  {{ Form::select('status_id',  config('constants.attendance_statuses'),  $previousAtandance->status_id, ['class' => 'form-control select2', 'id' => 'status_id','placeholder' => '--- Select Status ---']) }}
                </div>
                <div class="col-12 text-right p-0">
                  <button class="btn btn-primary btn-sm" onclick="onClickEditStudentAttendence()">Update</button>
                </div>
               </div>
              </div>
            </div>
          </div>  
        </div>
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