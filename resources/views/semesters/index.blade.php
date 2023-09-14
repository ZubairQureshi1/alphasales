@include('includes/header_start')

        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/alertify/css/alertify.css') }}" rel="stylesheet" type="text/css" />

@include('includes/header_end')

             <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Semeters</h3>
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

<div class="page-content-wrapper" id="semesters">

    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12 pull-right">
                   
               {{-- <button type="button" id="add" class="btn btn-primary waves-effect waves-light pull-right m-b-10 m-t-15-negative"  data-toggle="modal" data-target=".create_semester_model">Add New</button> --}}<a class="btn btn-primary waves-effect waves-light pull-right m-b-10 m-t-15-negative" href="{{ route('semester.create') }}">Add New</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body buttons-group-mobile">
                        @if(count($semesters)!=0)
                            <div class="table-responsive">
                                <table id="datatable-buttons" isDefault="true" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Semester</th>
                                        <th>Course</th>
                                        <th>Session</th>
                                        <th>Minimum Discount</th>
                                        <th>Maximum Discount</th>
                                        <th>Minimum Installments</th>
                                        <th>Maximum Installments</th>
                                        <th> Actions</th>
                                    </tr>
                                </thead>

                            <tbody>
                                @foreach ($semesters as $semester)
                                    <tr>
                                        <td>{{$semester->semester}}</td>
                                        <td>{{$semester->Course->name}}</td>
                                        <td>{{$semester->Session->session_name}}</td>
                                        <td>{{$semester->min_discount}}</td>
                                        <td>{{$semester->max_discount}}</td>
                                        <td>{{$semester->min_installments}}</td>
                                        <td>{{$semester->max_installments}}</td>
                                        <td>
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">

                                                    {{-- For Editing a specific object/row --}}

                                                    <a class="btn btn-primary btn-sm" href="{{ route('semester.edit', $semester['id']) }}"><i class="mdi mdi-pencil"></i></a>
                                                    {{-- For Editing a specific object/row ends here --}}
                                                    {!! Form::open(['route' => ['semester.destroy', $semester['id']], 'method' => 'delete']) !!}
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="typcn typcn-delete-outline"></i></button>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                        @else
                        No semesters found
                        @endif

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
@include('includes/footer_start')

    <!-- Required datatable js -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets/plugins/alertify/js/alertify.js') }}"></script>
    <!-- Buttons examples -->
    <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables/jszip.min.js"></script>
    <script src="assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
    <!-- Datatable init js -->
    <script src="assets/pages/datatables.init.js"></script>

@include('includes/footer_end')