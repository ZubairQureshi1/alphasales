@include('includes/header_start')

        <!-- DataTables -->
        <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/custom/admission.css') }}" rel="stylesheet" type="text/css" />

@include('includes/header_end')

             <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Attachments</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->
 
<div class="page-content-wrapper" id="sessions">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="m-b-10">
                    <div class="m-t-10 div-border-rad">
                        <div class="margin-10">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>Courses:</label>
                                        @if(count($courses)!=0)
                                            {!! Form::select('course_id[]', $courses, null, ['id' => 'course_id', 'onChange' => 'onCourseSelect()', 'class' => 'form-control','placeholder' => '------ Select Course ------']) !!}
                                        @else
                                            @include('includes/not_found')
                                        @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Session</label>
                                        <div id="session_select">

                                        </div>
                                </div> 
                                <div class="form-group col-md-4">
                                    <label>Student</label>
                                        <div id="student_list">

                                        </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="m-b-10">
                    <strong>Attachments:</strong>
                    <div class="m-t-10 div-border-rad">
                        <div class="margin-10">
                            <div class="form-group">
                                <div>
                                    <button type="button" id="add_attachment" onclick="AddAttachment()" name="add_attachment" class="btn btn-secondary waves-effect m-l-5 m-t-10 m-b-10 pull-right">
                                        Add Attachment
                                    </button>
                                    <div class="form-group">
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive b-0">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Attachment</th>
                                                            <th>Attachment Type</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="attachment_table_body">

                                                    </tbody>
                                                </table>
                                                <button type="button" onclick="saveAttachment()" class="btn btn-primary">Save</button>                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
    <!-- Datatable init js -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/parsley.min.js')  }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
        <script src="{{ asset('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js')  }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('form').parsley();
            });
            var template = '{{json_encode(config('constants'))}}';
            var constants = JSON.parse(template.replace(/&quot;/g,'"'));
        </script>
        <script src="{{ asset('js/registration/attachment.js')  }}"></script>

@include('includes/footer_end')

