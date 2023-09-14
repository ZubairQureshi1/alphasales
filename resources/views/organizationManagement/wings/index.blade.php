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
        <h3 class="page-title">Project(s)</h3>
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
                <div class="form-group">
                    <button type="button"
                        class="btn btn-primary btn-sm waves-effect waves-light pull-right m-b-10 m-t-15-negative"
                        data-toggle="modal" data-target="#createWing"><i class="fa fa-plus-circle"></i> Create</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Short Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($wings as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->short_name }}</td>
                                    <td>
                                        <div class="btn-toolbar" role="toolbar"
                                            aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                                {!! Form::open(['route' => ['wings.destroy', $row->id], 'method' => 'delete']) !!}
                                                <button href="{{ route('wings.destroy', $row['id']) }}"
                                                    class="btn btn-danger btn-sm"><i
                                                        class='mdi mdi-delete'></i></button>
                                                {!! Form::close() !!}
                                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#edit_{{ $index }}"><i
                                                        class="mdi mdi-pencil"></i></button>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @include('organizationManagement.wings.edit-wing')
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('organizationManagement.wings.add-wing')

    @include('includes/footer_start')

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
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}"></script>
    <script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>

    <!-- Datatable init js -->
    <script src="assets/pages/datatables.init.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    @include('includes/footer_end')
    @include('alertify::alertify')
