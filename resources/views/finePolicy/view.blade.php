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
    <h3 class="page-title">Student Attendance Policy Details</h3>
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

                            <a href="{{url('/studentAttendancePolicy/')}}">
                            <div class="text-right float-right btn btn-dark text-white">
                            <i class="fa fa-plus"></i> | Add Attendance Policy
                            </div></a><br><br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <table id="datatable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                      <th>Academic Wing</th>
                                                      <th>Absent Fine</th>
                                                      <th>Initial Fine</th>
                                                      <th>Maximum Fine</th>
                                                      <th>Late Fine</th>
                                                      <th>Initial Fine</th>
                                                      <th>Maximum Fine</th>
                                                      <th>Leave Quota</th>
                                                      <th>Apply Absent Fine</th>
                                                      <th>Struck off Limit</th>
                                                      <th>Credit Hour</th>
                                                      <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach($policy as $data)
                                                <tr>
                                                    <td>{{ App\Models\Wing::where('id', $data->wing_id)->first()->name ?? '---'}}</td>
                                                    <td>{{$data->absent_fine ?? '---'}}</td>
                                                    <td>{{ $data->absent_initial_fine ?? '---'}}</td>
                                                    <td>{{$data->absent_maximum_fine ?? '---'}}</td>
                                                    <td>{{$data->late_fine ?? '---'}}</td>
                                                    <td>{{$data->late_initial_fine ?? '---'}}</td>
                                                    <td>{{$data->late_maximum_fine ?? '---'}}</td>
                                                    <td>{{$data->leave_quota ?? '---'}}</td>
                                                    <td>{{$data->apply_absent ?? '---'}}</td>
                                                    <td>{{$data->studentAttendancePolicyDetails()->first()->struck_off_limit ?? '--'}}</td>
                                                    <td>{{$data->studentAttendancePolicyDetails()->first()->credit_hour ?? '--'}}</td>
                                                    <td>
                                                        <a href="{{url('/studentAttendancePolicy/edit', $data->id)}}"><i class="fa fa-edit btn btn-success"></i></a>
                                                        <a href="{{url('/studentAttendancePolicy/show', $data->id)}}"><i class="fa fa-eye btn btn-primary"></i></a>
                                                          <a href="{{url('/studentAttendancePolicy/delete', $data->id)}}"><i class="fa fa-trash btn btn-danger"></i></a>
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