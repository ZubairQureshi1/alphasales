<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PWWB</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('pwwb/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('pwwb/css/datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('select2/css/select2.min.css')}}">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
    <style>
        .homestyle{
            background: none;
            border: none;
        }
        label{
            font-weight: bold;
            color: #566573;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <!-- Content here -->
    <div id="container_holder">
        <div class="card mt-5">
            <div class="card-header" style="font-weight: bold; font-size: 30px; font-family: 'Balsamiq Sans', cursive;
        background: #17202A; color: #ffffff;">
                PWWB:
            </div><br>
            <div class="card shadow p-3 w-100">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>District:</label><br>
                            <select multiple onchange="searchFilter();" id="districtSearchFilter" name="districtSearchFilter[]" class="select2"  style="width: 80%;" data-placeholder="---Select---">
{{--                                 <option value="" selected disabled>Select District Name</option>--}}
                                @foreach(\Config::get('constants.districts') as $key => $districtName)
                                    <option value="{{$key}}" {{ $data ? $data['district'] == $key ? 'selected' : '' : ''}}>{{$districtName}}</option>
                                @endforeach
                            </select>

                        </div><input type="hidden" name="district_hidden" id="district_hidden" value="Attock">
                        <div class="form-group col-md-2">
                            <label>Data Entry Date (Start):</label><br>
{{--                             {!! Form::select('receiving_date', $mainTable->where('receiving_date', '!=', null)->pluck('receiving_date', 'id'), null, ['class' => 'select2', 'placeholder' => '-- Select -- ', 'style' => "width: 80%", 'id' => "receiving_date"]) !!}--}}
                            <input id="dataEntryDateStart" data-date-format='yyyy-mm-dd' class="form-control datepicker" type="date" style="width: 80%;" placeholder="Enter Start Date" name="dataEntryDateStart">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Data Entry Date (End):</label><br>
                            <input id="dataEntryDateEnd" data-date-format='yyyy-mm-dd' class="form-control datepicker" type="date" style="width: 80%;" placeholder="Enter End Date" name="dataEntryDateEnd">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Priority of Submission:</label><br>
                            <select multiple class="select2" id="priorityofsubmission" name="priorityofsubmission[]"  style="width: 80%;" data-placeholder="---Select---">
{{--                                <option value="" selected disabled>Select Priority</option>--}}
                                @foreach(\Config::get('constants.priority_of_submission') as $key => $priority)
                                    <option value="{{$key}}" {{ $data ? $data['priority_of_submission'] == $key ? 'selected' : '' : ''}}>{{$priority}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Submission Date (Start):</label><br>
{{--                             {!! Form::select('receiving_date', $mainTable->where('receiving_date', '!=', null)->pluck('receiving_date', 'id'), null, ['class' => 'select2', 'placeholder' => '-- Select -- ', 'style' => "width: 80%", 'id' => "receiving_date"]) !!}--}}
                            <input class="form-control datepicker" id="submissionDateStart" type="date" style="width: 80%;" placeholder="Enter Start Date" name="submissionDateStart">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Submission Date (End):</label><br>
                            <input class="form-control datepicker" id="submissionDateEnd" type="date" style="width: 80%;" placeholder="Enter End Date" name="submissionDateEnd">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Educational Wing:</label><br>
                            <select multiple class="select2"  id="wingSearchFilter" name="wingSearchFilter[]" style="width: 80%;" data-placeholder="---Select---">
{{--                                 <option value="" selected disabled>Select District Name</option>--}}
                                @foreach($wings as $wing)
                                    <option value="{{$wing->id}}">{{$wing->short_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Course Applied:</label><br>
                            <select multiple class="select2" id="courseSearchFilter" name="courseSearchFilter[]" style="width: 80%;" data-placeholder="---Select---">
{{--                                <option value="" selected disabled>Select District Name</option>--}}
                                @foreach($courses as $course)
                                    <option value="{{$course['id']}}">{{$course['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Course Enrolled:</label><br>
                            <select multiple class="select2" id="courseEnrollerdInSearchFilter" name="courseEnrollerdInSearchFilter[]"  style="width: 80%;" data-placeholder="---Select---">
{{--                                 <option value="" selected disabled>Select District Name</option>--}}
                                @foreach($courses as $course)
                                    <option value="{{$course['id']}}">{{$course['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Course Registered:</label><br>
                            <select multiple class="select2" id="courseRegisteredInSearchFilter" name="courseRegisteredInSearchFilter[]"  style="width: 80%;" data-placeholder="---Select---">
{{--                                 <option value="" selected disabled>Select District Name</option>--}}
                                @foreach($courses as $course)
                                    <option value="{{$course['id']}}">{{$course['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Affiliated Bodies:</label><br>
                            <select multiple class="select2" id="courseaffiliatedbody" name="courseaffiliatedbody[]"  style="width: 80%;" data-placeholder="---Select---">
{{--                                <option value="" selected disabled>Select District Name</option>--}}
                                @foreach($affiliatedBodies as $affiliatedBody)
                                    <option value="{{$affiliatedBody['id']}}">{{$affiliatedBody['code']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Transport Facility:</label><br>
                            <select multiple class="select2" id="pwwbtransportfacility" name="pwwbtransportfacility[]"  style="width: 80%;" data-placeholder="---Select---">
{{--                                 <option value="" selected disabled>Select District Name</option>--}}
                                @foreach(\Config::get('constants.transport_yes_no_undecided') as $key => $transportFacility)
                                    <option value="{{$key}}" {{ $data ? $data['transport_facility'] == $key ? 'selected' : '' : ''}}>{{$transportFacility}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Hostel Facility:</label><br>
                            <select multiple class="select2" id="pwwbhostelfacility" name="pwwbhostelfacility[]"  style="width: 80%;" data-placeholder="---Select---">
{{--                                 <option value="" selected disabled>Select District Name</option>--}}
                                @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                    <option value="{{$key}}" {{ $data ? $data['transport_hostel_details']['hostel_facility'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Status of Claim:</label><br>
                            <select multiple class="select2" id="provisionalclaimstatus" name="provisionalclaimstatus[]"  style="width: 80%;" data-placeholder="---Select---">
{{--                                 <option value="" selected disabled>Select District Name</option>--}}
                                @foreach(\Config::get('constants.claim_status') as $key => $claimStatus)
                                    <option value="{{$key}}">{{$claimStatus}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Academic Term:</label><br>
                            <select class="select2" name="pwwbacademicterm" id="pwwbacademicterm"  style="width: 80%;" data-placeholder="---Select---">
                                <option value="" selected disabled>Select Academic Term</option>
                                @foreach(\Config::get('constants.academic_terms') as $key => $academicterm)
                                    <option value="{{$key}}" {{ $data ? $data['annual_semester_id'] == $key ? 'selected' : '' : ''}}>{{$academicterm}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="display:none;" id="forannual" class="form-group col-md-2">
                            <label>Annual:</label><br>
                            <select class="select2" name="pwwbacademictermannual" id="pwwbacademictermannual"  style="width: 80%;" data-placeholder="---Select---">
                                <option value="" selected disabled>Select Annual Part</option>
                                @foreach(\Config::get('constants.pwwb_annual_years') as $key => $academictermannual)
                                    <option value="{{$key}}">{{$academictermannual}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="display: none" id="forsemester" class="form-group col-md-2">
                            <label>Semester:</label><br>
                            <select class="select2" name="pwwbacademictermsemester" id="pwwbacademictermsemester"  style="width: 80%;" data-placeholder="---Select---">
                                <option value="" selected disabled>Select Semester</option>
                                @foreach(\Config::get('constants.pwwb_semesters_years') as $key => $academictermsemester)
                                    <option value="{{$key}}">{{$academictermsemester}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Result:</label><br>
                            <select class="select2" name="resultSearchFilter" id="resultSearchFilter" style="width: 80%;" data-placeholder="---Select---">
                                 <option value="" selected disabled>Select District Name</option>
                                @foreach(\Config::get('constants.result_statuses') as $key => $resultStatus)
                                    <option value="{{$key}}" {{ $data ? $data['result'] == $key ? 'selected' : '' : ''}}>{{$resultStatus}}</option>
                                @endforeach
                            </select>
                        
                        </div>
                        <div class="form-group col-md-2">
                            <label>Return Files:</label><br>
                            <select class="select2" name="return_files" id="return_files" style="width: 80%;" data-placeholder="---Select---">
                                 <option value="" selected disabled>Select Return Files</option>
                                @foreach(\Config::get('constants.return_files') as $key => $resultStatus)
                                    <option value="{{$key}}" {{ $data ? $data['return_files'] == $key ? 'selected' : '' : ''}}>{{$resultStatus}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="col-md-12">
                @can('create_files')
                    <a href="/loadMainPage" class="btn btn-info" style="float: right;font-weight:bold; margin-right: 10px;"><i class="fa fa-file"></i> Add New Record</a>
                @endcan
                <button class="btn btn-info" style="float: left; font-weight: bold; margin-left: 10px;" onClick="window.location.reload();"><i class="fa fa-refresh"></i> Reset</button>
                <a href="#" id="clickButtonFilter" style="float: left; font-weight: bold; margin-left: 10px;" name="clickButtonFilter" class="btn btn-info" ><i class="fa fa-eye"></i> Filter Wise Export</a>
                <a href="#" id="clickButton" style="float: left; font-weight: bold; margin-left: 10px;" name="clickButton" class="btn btn-info" ><i class="fa fa-eye"></i> Pwwb Module Files Export</a>            
            </div><br>


            {{--<a href="#" onclick="getExportData();">Export</a>--}}
            
            <table id="my_home" class="table table-striped table-bordered" style="width:100%">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Roll No</th>
                    <th scope="col">District</th>
                    <th scope="col">File Received No</th>
                    <th scope="col">File Module No</th>
                    <th scope="col">File Submission No</th>
                    <th scope="col">Priority Of Submission</th>
                    <th scope="col">Data Entry Date</th>
{{--                    <th scope="col">Worker No</th>--}}
                    <th scope="col">Worker Name</th>
                    <th scope="col">Worker CNIC</th>
                    <th scope="col">Factory Name</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Student CNIC</th>
{{--                    <th scope="col">Student No</th>--}}
{{--                    <th scope="col">CFE Fee</th>--}}
{{--                    <th scope="col">Reason</th>--}}
{{--                    <th scope="col">Roll No (Semester)</th>--}}
{{--                    <th scope="col">Roll No (Annual)</th>--}}
{{--                    <th scope="col">Bus Stop</th>--}}
{{--                    <th scope="col">Hostel Name</th>--}}
                    <th scope="col">Wing</th>
                    <th scope="col">Affiliated Body</th>
                    <th scope="col">Course Applied</th>
                    <th scope="col">Course Registered</th>
                    <th scope="col">Course Enrolled</th>
                    <th scope="col">Self Contact</th>
                    <th scope="col">Father Contact</th>
                    <th scope="col">Transport</th>
                    <th scope="col">Hostel</th>
                    {{-- <th scope="col">Admitted</th> --}}
                    <th scope="col">Action</th>
                </tr>
                </thead>
{{--                <tbody>--}}
{{--                @foreach($mainTable as $value)--}}
{{--                    <tr>--}}
{{--                        <th style="font-size: 14px;">{{$value->id}}</th>--}}
{{--                        <td style="font-size: 14px;">{{$value->file_received_number}}</td>--}}
{{--                        <td style="font-size: 14px;">{{$value->fresh_file_submission_in_pwwb_number}}</td>--}}
{{--                        <td style="font-size: 14px;">{{$value && $value->receiving_date ? $value->receiving_date : '--'}}</td>--}}
{{--                        <td style="font-size: 14px; width: 7%;">--}}
{{--                            @foreach($value->WorkerContactNumber as $number)--}}
{{--                                {{ $number && $number->contact_no ? $number->contact_no : '--' }}--}}
{{--                                @if(!$loop->last)--}}
{{--                                    <br>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </td>--}}
{{--                        <td style="font-size: 14px;">{{isset($value->WorkerPersonalDetail) ? $value->WorkerPersonalDetail->worker_cnic : '--'}}</td>--}}
{{--                        <td style="font-size: 14px;">{{isset($value->FactoryDetail) ? $value->FactoryDetail->factory_name : '--'}}</td>--}}
{{--                        <td style="font-size: 14px;">{{isset($value->studentPersonalDetail) ? $value->studentPersonalDetail->name : '--'}}</td>--}}
{{--                        <td style="font-size: 14px;">{{!empty($value->studentPersonalDetail) ? $value->studentPersonalDetail->cnic_no : '--' }}</td>--}}
{{--                        --}}{{-- <td style="font-size: 14px;">{{$value->StudentContactNumber[0]->contact_no}}</td> --}}
{{--                        --}}{{-- <td style="font-size: 14px;">{{$value->StudentContactNumber->first()->contact_no}}</td> --}}
{{--                        <td style="font-size: 14px; width: 7%;"">--}}
{{--                        @foreach($value->StudentContactNumber as $number)--}}
{{--                            {{ $number && $number->contact_no ? $number->contact_no : '--' }}--}}
{{--                            @if(!$loop->last)--}}
{{--                                <br>--}}
{{--                                @endif--}}
{{--                                @endforeach--}}
{{--                                </td>--}}
{{--                                --}}{{-- <td style="font-size: 14px;">{{!empty($value->ProvisionalClaim) ? $value->ProvisionalClaim->cfe_fee : '---' }}</td> --}}
{{--                                <td style="font-size: 14px;">@foreach($value->ProvisionalClaim as $claim)--}}
{{--                                        {{ $claim && $claim->cfe_fee ? $claim->cfe_fee : '--' }}--}}
{{--                                        @if(!$loop->last)--}}
{{--                                            <br>--}}
{{--                                        @endif--}}
{{--                                    @endforeach</td>--}}
{{--                                <td style="font-size: 14px;">@foreach($value->ProvisionalClaim as $reason)--}}
{{--                                        {{ $reason && $reason->reason ? $reason->reason : '--' }}--}}
{{--                                        @if(!$loop->last)--}}
{{--                                            <br>--}}
{{--                                        @endif--}}
{{--                                    @endforeach</td>--}}
{{--                                <td style="font-size: 14px;">{{isset($value->FirstSemesterDetail) ? $value->FirstSemesterDetail->roll_no : '--'}}</td>--}}
{{--                                <td style="font-size: 14px;">{{isset($value->FirstAnnualDetail) ? $value->FirstAnnualDetail->roll_no : '--'}}</td>--}}
{{--                                <td style="font-size: 14px;">{{isset($value->TransportHostelDetail) ? $value->TransportHostelDetail->bus_stop : '--'}}</td>--}}
{{--                                <td>--}}
{{--                                    <a href="/edit-record/{{$value->id}}" class="btn btn-success"><i class="fa fa-edit"></i></a>--}}
{{--                                    <a href="/view-record/{{$value->id}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>--}}
{{--                                    <a href="/delete-record/{{$value->id}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>--}}
{{--                                </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
            </table>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script>
    // $('.datepicker').datepicker({
    //     format:'yyyy-mm-dd',
    //     endDate: new Date(),
    //     autoclose: true
    // });
    // $('#datepickerend').datepicker({
    //      format:'dd/mm/yyyy',
    //      minDate : 0,
    //      autoclose: true
    //  });
</script>

<script type="text/javascript">
    var viewPermission    = {{ auth()->user()->can('view_files') ? 'true' : 'false' }};
    var updatePermission  = {{ auth()->user()->can('update_files') ? 'true' : 'false' }};
    var destroyPermission = {{ auth()->user()->can('delete_files') ? 'true' : 'false' }};
    var updateAfterAdmission = {{ auth()->user()->can('updateafteradmission_files') ? 'true' : 'false' }};
    var dsmPrivileges = {{ auth()->user()->can('d_s_m_privilege_files') ? 'true' : 'false' }};        
</script>

<script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script src="{{asset('pwwb/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('select2/js/select2.min.js')}}"></script>
<script src="{{asset('pwwb/js/custom.js')}}"></script>
</body>
</html>


<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script> -->