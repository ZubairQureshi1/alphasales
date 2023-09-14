@include('includes/header_start')

        <!-- DataTables -->
        <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/custom/admission.css') }}" rel="stylesheet" type="text/css" />
        <style>
             @media print {
         .student_name{
             display:none;
         }
      }
        </style>
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
<div class="page-content-wrapper">
    <div class="container">
        <div class="m-b-10 student_name">
                <div class="m-t-10 div-border-rad">
                    <div class="margin-10">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <form>
                                    <label for="student_select">Select Student</label>
                                    <input type="text" name="date_sheet_id" value="{{ $datesheet->id }}" hidden="hidden" id="date_sheet_id" />
                                    <select class="form-control" id="student_id" onChange="onStudentSelect()">
                                            <option>Select Student</option>
                                            @foreach($selected_datesheet_section_students as $selected_datesheet_section_student)
                                            <option value="{{$selected_datesheet_section_student['id']}}">
                                                {{$selected_datesheet_section_student['student_name']}}
                                            </option>
                                            @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div>
    </div>
    <div class="card" style="border:1px solid #000000;margin-top:3%;">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ asset('assets/images/rollno_slip_profille.jpg') }}" style="padding:.25rem;border-radius:.25rem;border: 1px solid #dee2e6;width:100px;height:100px;">
                    </div>
                    <div class="col-md-6 text-center">
                        <h4>CFE College of Commerce and Science</h4>
                        <p><label style="border:1px solid #000000;padding:0px 8px;"><b>Roll no slip</b></label></p>
                        @foreach($date_sheet_exam_types as $date_sheet_exam_type)
                            <strong>{{$date_sheet_exam_type->exam_type}}</strong>
                            @endforeach
                             <label>(<label>
                            @foreach($date_sheet_sections as $date_sheet_section)
                            <label> {{$date_sheet_section->section_name}} , </label>
                            @endforeach <label>)</label>
                    </div>
                    <div class="col-md-3 text-right" style="padding-left:3%;">
                        <img src="{{ asset('assets/images/logo_dark.png') }}" style="padding:.50rem;border-radius:.25rem;border: 1px solid #dee2e6;width: 150px;height: 75px;">
                    </div>
                </div>  
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="m-b-10">
                            <div class="m-t-10 div-border-rad">
                                <div class="margin-10">
                                    <div class="student_detail">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div><!--card body End-->
    </div><!--card End-->
    <div class="card" style="border:1px solid #000000;margin-top:3%;">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                        <table class="table ">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col"><h6>Date</h6></th>
                                <th scope="col"><h6>Subject</h6></th>
                                <th scope="col"><h6>Start Time</h6></th>
                                <th scope="col"><h6>End Time</h6></th>
                                <th scope="col"><h6>Syllabus</h6></th>
                                </tr>
                            </thead>
                            <tbody id="datesheet_subjects">
                                    {{-- @foreach($date_sheet_books as $date_sheet_book)
                                <tr>
                                        <td>
                                        {{$date_sheet_book->date->format('D d/m/Y')}}
                                        </td>
                                        <td>
                                        {{$date_sheet_book->book_name}}
                                        </td>
                                        <td>
                                        {{$date_sheet_book->start_time->format('h:i-a')}}
                                        </td>
                                        <td>    
                                        {{$date_sheet_book->end_time->format('h:i-a')}}
                                        </td>
                                        <td>    
                                        {{$date_sheet_book->syllabus}}
                                        </td>
                                </tr>
                                    @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div><!--card body End-->
    </div><!--card End-->
</div><!-- ==================
     PAGE CONTENT EnD
     ================== -->
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

    </script>
    <script src="{{ asset('js/datesheet/student_roll_no_slip.js')  }}"></script>
@include('includes/footer_end')