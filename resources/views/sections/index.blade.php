@include('includes/header_start')
    <!-- DataTables -->
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    @include('alertify::alertify')
@include('includes/header_end')
        <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect"><i class="ion-navicon"></i></button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Sections</h3>
            </li>
        </ul>
    </nav>
</div>
<!-- Top Bar End -->
<!-- PAGE CONTENT START -->
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-custom-header clearfix">
                        {{-- LEFT ACTION --}}
                        <div class="float-left">
                            <h5 class="card-title font-weight-bold">Sections</h5>
                        </div>
                        {{-- RIGHT ACTIONS --}}
                        <div class="float-right my-2">
                            <a class="btn btn-dark btn-sm waves-effect waves-light" href="{{ route('sections.create') }}">
                                <i class="fa fa-plus fa-fw"></i> | Add New Section
                            </a>
                            {{-- @if($ifSectionExists == '1') --}}
                            <a class="btn btn-outline-dark btn-sm waves-effect waves-light" href="{{ route('sections.assign') }}">
                                <i class="fa fa-retweet fa-fw"></i> | Assign Section
                            </a>
                            {{-- @endif --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable-buttons" isDefault="true" class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 2%;">No</th>
                                        <th>Academic Wing</th>
                                        <th>Course</th>
                                        <th>Affiliated Body</th>
                                        <th class="text-center" style="width: 1%;">Session</th>
                                        <th class="text-center" style="width: 1%;">Annaul / Semester</th>
                                        <th class="text-center" style="width: 1%;">Gender</th>
                                        <th class="text-center" style="width: 1%;">Shift</th>
                                        <th>Status</th>
                                        <th>Sections</th>
                                        <th class="text-center" style="width: 1%;">Strength</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sections as $key => $section)
                                    <tr>
                                        <td class="text-center">{{ ++$key }}</td>
                                        <td>{{ $section->academic_wing_name }}</td>
                                        <td>{{ $section->course_name }}</td>
                                        <td>{{ $section->affiliated_body_name }}</td>
                                        <td class="text-center">{{ $section->session_name }}</td>
                                        <td class="text-center">{{ $section->annual_semester ?? '---' }}</td>
                                        <td class="text-center">{{ config('constants.genders')[$section->gender_id] ?? '---' }}</td>
                                        <td class="text-center">{{ config('constants.shifts')[$section->shift_id] ?? '---' }}</td>
                                        <td>
                                            @if($section->status_id == 0)
                                                <span class="badge badge-success p-2 rounded-0">{{ config('constants.section_statuses')[$section->status_id] ?? '---' }}</span>
                                            @elseif($section->status_id == 1)
                                                <span class="badge badge-danger p-2 rounded-0">{{ config('constants.section_statuses')[$section->status_id] ?? '---' }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach($section->sectionDetails as $sectionDetail)
                                                <span class="badge badge-warning badge-pill" data-toggle="tooltip" data-original-title="Section Strength: {{ $sectionDetail->section_strength }}">{{ $sectionDetail->section_name ?? '---' }}</span>
                                            @endforeach
                                        </td>
                                        <td class="text-center">{{ $section->total_strength ?? '---' }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                {{-- <a href="#" class="btn btn-primary"><i class="mdi mdi-eye"></i></a> --}}
                                                <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-info"><i class="mdi mdi-pencil"></i></a>
                                                <a href="{{ route('sections.delete', $section->id) }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Delete Section permanently?"><i class="mdi mdi-delete"></i> </a>
                                            </div>
                                        </td>
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
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ asset('assets/pages/datatables.init.js') }}"></script>
@include('includes/footer_end')