@include('includes/header_start')

<!-- DataTables -->
<link href="{{ asset ('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset ('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset ('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
  <li class="list-inline-item">
    <button type="button" class="button-menu-mobile open-left waves-effect">
      <i class="ion-navicon"></i>
    </button>
  </li>
  <li class="hide-phone list-inline-item app-search">
    <h3 class="page-title">Attendance List</h3>
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
                          <center>
@if (Session::has('message'))
                                          <div class="alert alert-danger font-weight-bold">{{ Session::get('message') }}</div>
                                        @endif </center><br>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <table id="datatable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>Registration</th>
                                                    <th>Student Name</th>
                                                    <th>Status Type</th>
                                                    {{-- <th>Educational Wing</th> --}}
                                                    <th>Course</th>
                                                    {{-- <th>Subject</th> --}}
                                                    <th>Section</th>
                                                    <th>Teacher</th>
                                                    <th>Room</th>
                                                    <th>Title</th>
                                                    <th>Date & Time</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
            
            
                                                <tbody>
                                                  @foreach($attendanceDetail as $data)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$data->student->roll_no ?? '---'}}</td>
                                                    <td>{{$data->student->student_name ?? '---'}}</td>
                                                    <td>
                                                        @php $status_title = ''; @endphp
                                                            @foreach(config('constants.attendance_statuses') as $key => $val)    
                                                            @php
                                                            if($data->status_id == $key){
                                                                echo $status_title = $val;
                                                            }
                                                            @endphp
                                                            @endforeach
                                                    </td>
                                                    {{-- <td>{{$data->student->course_id ?? '---'}}</td> --}}
                                                    <td>{{$data->student->course_name}}</td>
                                                    {{-- <td>Tiger Nixon</td> --}}
                                                    <td>{{$data->studentAttendance->section_name ?? '---'}}</td>
                                                    <td>{{App\User::find($data->studentAttendance->user_id)->display_name ?? '---'}}</td>
                                                    <td>{{$data->studentAttendance->room_name ?? '---'}}</td>
                                                    <td>{{$data->studentAttendance->title ?? '---'}}</td>
                                                    <td>{{$data->studentAttendance->date_time ?? '---'}}</td>
                                                    <td>
                                                        {{-- <a href="{{url('/studentAttendance/editAttendanceDetail', $data->id)}}"><i class="fa fa-edit btn btn-success"></i></a> --}}
                                                        <a title="Check Fine Sheet ({{$data->student->student_name}})" href="{{url('/studentAttendancePolicy/fineSheet', $data->student->id)}}"><i class="fa fa-arrow-right btn btn-warning"></i></a>
                                                        </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
            
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->


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