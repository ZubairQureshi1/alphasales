@include('includes/header_start')

        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

@include('includes/header_end')

             <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Installment Plan</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->

<div class="page-content-wrapper" id="courses">

    <div class="container-fluid">

        <div class="modal fade create_subect_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Add<strong> Installment Plan</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        {{-- thi model is generated for courses edit. On click edit butoon this open through javascript --}}

        
        <div class="row">
            <div class="col-12 pull-right">
                   
                 {{--  <button type="button" id="add" class="btn btn-primary waves-effect waves-light pull-right m-b-10 m-t-15-negative"  data-toggle="modal" data-target=".create_session_model">Add New</button> --}}<a class="btn btn-primary waves-effect waves-light pull-right m-b-10 m-t-15-negative" href="{{ route('installmentplans.create') }}">Add New</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body buttons-group-mobile">

                      <!--   <h4 class="mt-0 header-title">Buttons example</h4>
                        <p class="text-muted m-b-30 font-14">The Buttons extension for DataTables
                            provides a common set of options, API methods and styling to display
                            buttons on a page that will interact with a DataTable. The core library
                            provides the based framework upon which plug-ins can built.
                        </p> -->

                        @if(count($installmentplans)!=0)
                            <table id="datatable-buttons" isDefault="true" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        @foreach ($installmentplans_keys as $key)
                                        @if($key != "replaced_name" &&$key != "created_at" && $key != "updated_at" && $key != "deleted_at")
                                        <th> {{ $key }}</th>
                                        @endif
                                        @endforeach
                                        <th> Actions</th>
                                    </tr>
                                </thead>

                            <tbody>
                                @foreach ($installmentplans as $installmentplan)
                                    <tr>
                                        @foreach ($installmentplans_keys as $index => $key)
                                        @if($key != "id" && $key != "replaced_name" && $key != "created_at" && $key != "updated_at" && $key != "deleted_at")
                                            <td>{{ $installmentplan[$key] }}</td>
                                        @elseif ($key == "id")
                                            <td>{{ $index+1 }}</td>
                                        @endif
                                        @endforeach
                                        <td>
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">

                                                    {{-- For Editing a specific object/row --}}

                                                      <a class="btn btn-primary btn-sm" href="{{ route('installmentplans.edit', $installmentplan['id']) }}"><i class="mdi mdi-pencil"></i></a>
                                                    {{-- For Editing a specific object/row ends here --}}
                                                    {!! Form::open(['route' => ['installmentplans.destroy', $installmentplan['id']], 'method' => 'delete']) !!}
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="typcn typcn-delete-outline"></i></button>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        @else
                        No Installment Plan found
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

    <!-- Datatable init js -->
    <script src="assets/pages/datatables.init.js"></script>
    <script src="js/course.js"></script>

@include('includes/footer_end')