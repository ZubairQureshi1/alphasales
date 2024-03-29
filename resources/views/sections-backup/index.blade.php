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
                <h3 class="page-title">Sections</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->

<div class="page-content-wrapper" id="subjects">

    <div class="container-fluid">

        <div class="modal fade create_section_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Add<strong> Sections</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="POST" action="{{ route('sections.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <div>
                                    <input data-parsley-type="name" type="text"
                                           class="form-control" required
                                           name="name" id="name"
                                           placeholder="Enter Name"/>
                                </div>
                                <label>Code</label>
                                <div>
                                    <input data-parsley-type="code" type="text"
                                           class="form-control" required
                                           name="code" id="code"
                                           placeholder="Enter Code"/>
                                </div>
                                {!! Form::label('course', 'Course:') !!}
                                {!! Form::select('courses[]', $courses, null, ['id' => 'course_id', 'class' => 'form-control select2 select2-multiple' , 'multiple', 'data-placeholder' => 'Select Courses']) !!}
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        {{-- thi model is generated for subjects edit. On click edit butoon this open through javascript --}}


        <div class="row">
            <div class="col-12 pull-right">

                <button type="button" id="add" class="btn btn-primary waves-effect waves-light pull-right m-b-10 m-t-15-negative"  data-toggle="modal" data-target=".create_section_model">Add New</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                      <!--   <h4 class="mt-0 header-title">Buttons example</h4>
                        <p class="text-muted m-b-30 font-14">The Buttons extension for DataTables
                            provides a common set of options, API methods and styling to display
                            buttons on a page that will interact with a DataTable. The core library
                            provides the based framework upon which plug-ins can built.
                        </p> -->

                        @if(count($sections)!=0)
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        @foreach ($section_keys as $key)
                                        @if($key == "name" || $key == "id" || $key == "code")
                                        <th> {{ $key }}</th>
                                        @endif
                                        @endforeach
                                        <th> Actions</th>
                                    </tr>
                                </thead>

                            <tbody>
                                @foreach ($sections as $section)
                                    <tr>
                                        @foreach ($section_keys as $key)
                                        @if($key == "name")
                                            <td>{{ $section[$key] }}</td>
                                        @elseif ($key == "id")
                                            <td>{{ $section[$key] }}</td>
                                             @elseif ($key == "code")
                                            <td>{{ $section[$key] }}</td>
                                        @endif
                                        @endforeach
                                        <td>
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">

                                                   {{--  {!! Form::open(['route' => ['sections.destroy', $section['id']], 'method' => 'delete']) !!}
                                                    {{-- For Editing a specific object/row --}}

                                                    <button type="button" data-toggle="modal" data-target="#{{ $section['id']}}" class="btn btn-primary btn-sm"><i class="mdi mdi-pencil"></i></button>


                                                    <div class="modal fade update_subect_model" id="{{ $section['id'] }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0">Update<strong> Subject</strong></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p></p>
                                                                    {!! Form::open(['route' => ['sections.update', $section['id']], 'method' => 'patch']) !!}
                                                                        <div class="form-group">
                                                                            <label>Name</label>
                                                                            <div>
                                                                                <input data-parsley-type="name" type="text"
                                                                                       class="form-control" required
                                                                                       name="name" id="update_section_name"
                                                                                       value="{{ $section['name'] }}"
                                                                                       placeholder="Enter Name"/>
                                                                            </div>
                                                                            <label>Code</label>
                                                                            <div>
                                                                                <input data-parsley-type="code" type="text"
                                                                                       class="form-control" required
                                                                                       name="code" id="update_section_code"
                                                                                       value="{{ $section['code'] }}"
                                                                                       placeholder="Enter Code"/>
                                                                            </div>
                                                                            {!! Form::label('course', 'Course:') !!}
                                {!! Form::select('courses[]', $courses, isset($section->sectionCourses)?$section->sectionCourses()->pluck('course_id')->toArray():null, ['id' => 'course_id', 'class' => 'form-control select2 select2-multiple' , 'multiple', 'data-placeholder' => 'Select Courses']) !!}

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->

                                                    {{-- For Editing a specific object/row ends here --}}
                                                    {{-- {!! Form::open(['route' => ['sections.destroy', $section['id']], 'method' => 'delete']) !!}
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="typcn typcn-delete-outline"></i></button>
                                                    {!! Form::close() !!} --}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        @else
                        No sections found
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
    <script type="text/javascript">
        
        $( document ).ready(function() {
            $('.select2').select2();
        });
    </script>
@include('includes/footer_end')
