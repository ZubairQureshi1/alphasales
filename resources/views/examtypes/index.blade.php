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
                <h3 class="page-title">Add Exam Type</h3>
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
                <div class="row">
                    <div class="col-lg-4">
                        <form name="examtype_from" method="post"  action="{{url('examtypes')}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Exam Type:</label>
                                    <input type="text" name="exam_type" class="form-control"  placeholder="Enter Exam Type...">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="margin-top:5%;">
            <div class="card-body">
                <div class="row" >
                    <div class="col-lg-4">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Exam Type</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                                <tbody>
                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->exam_type}}</td>
                                            <td>
                                                <a href="examtypes/{{ $value['id'] }}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                <a href="examtypes/{{ $value['id'] }}/destroy"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
    <script src="{{ asset('js/admission/admission.js')  }}"></script>

@include('includes/footer_end')