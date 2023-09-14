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
        <h3 class="page-title">Date-Sheet</h3>
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
        <div class="m-b-10">
            <div class="card">
                <div class="card-body">
                    <div class="m-t-10 div-border-rad">
                        <div class="margin-10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <strong> <i class="fa fa-table" aria-hidden="true"></i> Student-DateSheet:</strong>
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="col-md-4 m-b-10"><a class="btn btn-block btn-primary"
                                        href="{{route('datesheet.create')}}"> <i class="fa fa-plus"
                                            aria-hidden="true"></i> Create New Date-Sheet</a></div>
                                <div class="col-md-4 m-b-10"><a class="btn  btn-block btn-primary" href="awardlist"> <i
                                            class="fa fa-trophy" aria-hidden="true"></i> Student Award Lists</a></div>
                                <div class="col-md-4 m-b-10"><a class="btn btn-block btn-primary" href="Sittingplan"> <i
                                            class="fa fa-wheelchair" aria-hidden="true"></i> Student Sitting Plan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-top:3%;">
                <div class="card-body">
                    <div class="m-t-10 div-border-rad">
                        <div class="margin-10">
                            <div class="row">
                                <div class="col-12">

                                    @foreach($data as $value)
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header p-3" id="heading_{{$value->id}}">
                                                <a href="#collapse_{{$value->id}}" class="text-dark collapsed"
                                                    data-toggle="collapse" aria-expanded="false"
                                                    aria-controls="collapse_{{$value->id}}">
                                                    <h6 class="m-0">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                Exam Type: {{$value->exam_type_name}}
                                                            </div>
                                                            <div class="col-md-3">
                                                                Session: {{$value->session_name}}
                                                            </div>
                                                            <div class="col-md-3">
                                                                Course: {{$value->course_name}}
                                                            </div>
                                                            <div class="col-md-3">
                                                                @foreach($value['date_sheet_sections'] as
                                                                $date_sheet_section)
                                                                Section: {{$date_sheet_section->section_name}},
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </h6>
                                                </a>
                                            </div>

                                            <div id="collapse_{{$value->id}}" class="collapse"
                                                aria-labelledby="heading_{{$value->id}}" data-parent="#accordion"
                                                style="">
                                                <div class=" table-responsive">
                                                    <table class="table table-sm table-bordered ">
                                                        <thead>
                                                            <tr>

                                                                <th scope="col">Subject</th>
                                                                <th scope="col">Date</th>
                                                                <th scope="col">Start Time</th>
                                                                <th scope="col">End Time</th>
                                                                <th scope="col">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>

                                                                <td>
                                                                    @foreach($value['date_sheet_books'] as
                                                                    $date_sheet_book)
                                                                    <div class="col-md-12">
                                                                        {{$date_sheet_book->subject_name}}
                                                                    </div>
                                                                    @endforeach
                                                                </td>

                                                                <td>
                                                                    @foreach($value['date_sheet_books'] as
                                                                    $date_sheet_book)
                                                                    <div class="col-md-12"> 
                                                                        {{$date_sheet_book->date}}
                                                                    </div>
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    @foreach($value['date_sheet_books'] as
                                                                    $date_sheet_book)
                                                                    <div class="col-md-12">  
                                                                        {{$date_sheet_book->start_time}}
                                                                    </div>
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    @foreach($value['date_sheet_books'] as
                                                                    $date_sheet_book)
                                                                    <div class="col-md-12">   
                                                                        {{$date_sheet_book->end_time}}
                                                                    </div>
                                                                    @endforeach
                                                                </td>

                                                                <td class="date_sheet_btns">
                                                                    <a href="edit/{{ $value['id'] }}"><i
                                                                            class="fa fa-pencil-square"
                                                                            aria-hidden="true"
                                                                            style="font-size:18px;"></i></a> 
                                                                            <a href="datesheetview/{{ $value['id'] }}"><i
                                                                            class="fa fa-address-card"
                                                                            aria-hidden="true"
                                                                            style="font-size:18px;"></i></a>  
                                                                    <a href="general_datesheet_view/{{ $value['id'] }}"><i
                                                                            class="fa fa-eye" aria-hidden="true"
                                                                            style="font-size:18px;"></i></a> 
                                                                    <a href="destroy/{{$value['id']}}"><i
                                                                            class="fa fa-trash" aria-hidden="true"
                                                                            style="font-size:18px;"></i></a> 
                                                                    <a href="Sitting_Plan_View/{{$value['id']}}"><i
                                                                            class="fa fa-wheelchair" aria-hidden="true"
                                                                            style="font-size:18px;"></i></a>
                                                                </td>
                                                            </tr>


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    @endforeach
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
    $(document).ready(function () {
        $('form').parsley();
    });
    var template = '{{json_encode(config('constants'))}}';
    var constants = JSON.parse(template.replace(/&quot;/g, '"'));

</script>
<script src="{{ asset('js/admission/admission.js')  }}"></script>

@include('includes/footer_end')