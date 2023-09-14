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
    <h3 class="page-title">Attendance & Fine Sheet</h3>
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
                                    <div class="card m-b-30">
                                        <div class="card-body"><br>
                                          <div class="form-group row">
                                            <div class="col-md-4">
                                              <label class="h5">Student Name:</label>
                                              <span class="h6 font-weight-normal">{{$studentData->student_name}}</span>
                                            </div>
                                            <div class="col-md-4">
                                              <label class="h5">Roll No:</label>
                                              <span class="h6 font-weight-normal">{{$studentData->roll_no}}</span>
                                            </div>
                                            <div class="col-md-4">
                                              <label class="h5">Program:</label>
                                              <span class="h6 font-weight-normal">{{$studentData->course_name}}</span>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                          {{-- <a href="{{url('/studentAttendancePolicy/')}}">
                            <div class="text-right float-right btn btn-dark text-white">
                            <i class="fa fa-plus"></i> | Add Attendance Policy
                            </div></a><br><br> --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <table id="datatable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                      <th>Section</th>
                                                      <th>Course</th>
                                                      <th>Teacher</th>
                                                      <th>Date</th>
                                                      <th>Present</th>
                                                      <th>Absent</th>
                                                      <th>Late</th>
                                                      <th>Leave</th>
                                                      <th>Fine</th>
                                                      <th>Fine Discount</th>
                                                      <th>Fine Payment</th>
                                                      <th>Chalan no</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach($policy as $data)
                                                <tr>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>{{$data->created_at->todatestring()}}</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>{{$data->absent_fine}}</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
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
<script src="{{ asset( 'assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{ asset( 'assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
<!-- Responsive examples -->
<script src="{{ asset( 'assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

<!-- Datatable init js -->
<script src="{{ asset( 'assets/pages/datatables.init.js')}}"></script>
<script src="{{ asset('js/affiliatedBodies/afiliated_bodies.js') }}"></script>
<script src="{{ asset('js/attendance/attendance_sheet_entry.js') }}"></script>
@include('includes/footer_end')