@include('includes/header_start')

        <!-- DataTables -->
        <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@include('includes/header_end')

             <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Designations</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->

<div class="page-content-wrapper" id="designations">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">   
                <a href="{{ route('designations.create') }}" class="btn btn-dark waves-effect waves-light pull-right mb-3 btn-sm">
                    <i class="fa fa-plus fa-fw"></i> <b>|</b> Add New Designation
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body buttons-group-mobile">
                        @if(count($designations)!=0)
                        <div class="table-responsive">
                            <table id="datatable-buttons" isDefault="true" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 1%" class="text-center">#</th>
                                        <th>Name</th>
                                        <th class="text-center">Code</th>
                                        <th>Organization</th>
                                        <th class="text-center">Organization Campuses</th>
                                        <th class="text-center w-25">Departments</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                            <tbody>
                                @foreach ($designations as $index => $designation)
                                    <tr>
                                        <td class="text-center">{{ ++$index }}</td>
                                        <td>{{ $designation->name }}</td>
                                        <td class="text-center">{{ $designation->code }}</td>
                                        <td>{{ $designation->organization_name }}</td>
                                        <td>
                                            @forelse($designation->campuses as $campus)
                                                <span class="badge badge-primary p-1">{{ $campus->organization_campus_name }}</span>
                                            @empty
                                                <center class="font-weight-bold">---</center>
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($designation->departments as $value)
                                                <span class="badge badge-primary p-1">{{ $value->department_name}}</span>
                                            @empty
                                                <center class="font-weight-bold">---</center>
                                            @endforelse
                                        </td>
                                        <td>
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                                    @include('designations/designation_action')
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                        @else
                            No Designations found
                        @endif

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
@include('includes/footer_start')

    <!-- Required datatable js -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/pages/datatables.init.js') }}"></script>

@include('includes/footer_end')

