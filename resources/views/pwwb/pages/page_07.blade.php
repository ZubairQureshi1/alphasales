<style type="text/css">
    label{
        font-weight: bold;
        color: black;
        font-family: 'Balsamiq Sans', cursive;
    }
    h1{
        font-weight: bold;
        text-align: center;
        font-family: 'Balsamiq Sans', cursive;
        background: #17202A;
        color: white;
        padding: 15px;
        position: relative;
        top: -20px;
    }
    .aa{
        font-size: 14px;
        font-weight: bold;
        color: #D0D3D4;
        font-family: 'Balsamiq Sans', cursive;
        border-bottom: 1px solid white;
        margin-top: 10px;
        padding-left: 3px;
        padding-right: 0px;
    }
    input{
        text-transform: capitalize;
    }
</style>
@php
    $startDateOfSession = '';
    $endDateOfSession = '';
    if(isset($sessionStartEndDate->session_start_date)){
        $startDateOfSession = date('d/m/Y',strtotime($sessionStartEndDate->session_start_date));
    }
    if(isset($sessionStartEndDate->session_end_date)){
        $endDateOfSession = date('d/m/Y',strtotime($sessionStartEndDate->session_end_date));
    }
@endphp
<div id="page_07">
    <h1>Educational Wing of CFE<span class="float-right">Page # 07</span></h1><br>
    <form id="page_07_form">
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-4">
                        <label style="font-size: 20px;">Educational Wing of CFE:</label>
                        <select id="cfe_wing_selection" name="educational_wing_cfe" class="form-control"
                                onchange="setWingCorrespondingSectionDisplay()">
                            <option value="" selected>--select--</option>
                            {{--                            @foreach(\Config::get('constants.educational_wing_cfe') as $key => $value)--}}
                            {{--                                <option value="{{$key}}" {{ $data ? $data['educational_wing_cfe']['educational_wing_cfe'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                            {{--                            @endforeach--}}
                            @foreach($wings as $wing)
                                {{--                                {{ $data ? $data['educational_wing_cfe']['educational_wing_cfe'] == $key ? 'selected' : '' : ''}}--}}
                                <option value="{{$wing->id}}" {{ $data ? $data['educational_wing_cfe']['educational_wing_cfe'] == $wing->id ? 'selected' : '' : ''}}>{{$wing->short_name}}</option>
                            @endforeach
                        </select>
                        <label style="font-size: 11px;color:red" >If the academic wing is changed you must reload the page.</label>
                    </div>
                </div>
                <div id="wing_parent_div">
                    <div style="display: none;" id="getAccValue">
                        You cannot select this option. Your service period is less then 3 years.
                    </div>
                    <div id="wing_div_bise">
                        <div class="col-md-12 mt-2">
                            <label for="" style="font-size: 20px;">BISE:</label>
                        </div>
                        <div class="card shadow p-3 w-100">
                            <div class="card-body ">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Course Applied in:<span style="color: red;">*</span></label>
                                        <select onchange="setBiseFieldsDisplay(); setBiseFieldsDisplay();" name="bise_course_applied_in" id="bise_course_applied_in" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.bise_course_applied_in') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['bise_details']['bise_course_applied_in'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                        @php
                                            $checkifbise = 0;
                                            if(isset($data['bise_details']['bise_course_applied_in'])){
                                                $checkifbise = $data['bise_details']['bise_course_applied_in'];
                                            }
                                        @endphp
                                    </div>
                                    <div class="form-group col-md-3" id="bise_optional_subject_div" style="display: none">
                                        <label>Optional Subjects:<span style="color: red;">*</span></label>
                                        <select id name="bise_optional_subject" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.bise_optional_subject') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['bise_details']['bise_optional_subject'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" id="bise_others_div" style="display: none">
                                        <label>Others:<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control text-center" name="bise_others" value="{{$data ? $data['bise_details']['bise_others'] : ''}}"
                                               placeholder="XXXXX">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Course Enrolled in CFE:<span style="color: red;">*</span></label>
                                        <select onchange="onChangeBISEEnrolled();" id="bise_course_enrolled_cfe" name="bise_course_enrolled_cfe" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.bise_course_enrolled_cfe') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['bise_details']['bise_course_enrolled_cfe'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Course Registered in:<span style="color: red;">*</span></label>
                                        <select onchange="onChangeBISERegistered();" id="bise_course_registered_in" name="bise_course_registered_in" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.bise_course_applied_in') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['bise_details']['bise_course_registered_in'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Roll No:<span style="color: red;">*</span></label>
                                        <input readonly type="text" class="form-control text-center" name='bise_roll_no' value="{{$data ? $data['roll_no'] : ''}}" 
                                               placeholder="Enter Roll No">
                                               {{-- value="{{$data ? $data['bise_details']['bise_roll_no'] : ''}}" --}}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Affiliated Body:<span style="color: red;">*</span></label>
                                        <select readonly name="bise_affiliated_body" onchange="getAcademicTerm_bise();" id="bise_affiliated_body" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.bise_affiliated_body') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['bise_details']['bise_affiliated_body'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                            @foreach($affiliated_bodies as $affiliated_body)
                                                <option value="{{$affiliated_body->id}}" {{ $data ? $data['bise_details']['bise_affiliated_body'] == $affiliated_body->id ? 'selected' : '' : ''}}>{{$affiliated_body->code}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Duration of Course:<span style="color: red;">*</span></label>
                                        <input readonly type="text" name="bise_duration_of_course" id="bise_duration_of_course" value="{{ $data ? $data['bise_details']['bise_duration_of_course'] : ''}}" class="form-control">
                                        {{--                                        <select name="bise_duration_of_course" class="form-control">--}}
                                        {{--                                            <option value="" selected disabled>--select--</option>--}}
                                        {{--                                            @foreach(\Config::get('constants.bise_duration_of_course') as $key => $value)--}}
                                        {{--                                                <option value="{{$key}}" {{ $data ? $data['bise_details']['bise_duration_of_course'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                        {{--                                            @endforeach--}}
                                        {{--                                        </select>--}}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Date of Admission:<span style="color: red;">*</span></label>
                                        <input onchange="getEndDateForBise();" type="text"  class="form-control text-center datepicker__"
                                               name="bise_admission_date" id="bise_admission_date"
                                               value="{{$data && $data['bise_details']['bise_admission_date'] ? date('d/m/Y',strtotime($data['bise_details']['bise_admission_date'])) : ''}}"
                                               {{--                                               value="{{$sessionStartEndDate && $sessionStartEndDate->session_start_date ? date('d/m/Y',strtotime($sessionStartEndDate->session_start_date)) : ''}}"--}}
                                               placeholder="Enter Date">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Ending Date:<span style="color: red;">*</span></label>
                                        <input type="text" readonly class="form-control text-center datepickerAll"
                                               name="bise_ending_date" id="bise_ending_date"
                                               value="{{$data && $data['bise_details']['bise_ending_date'] ? date('d/m/Y',strtotime($data['bise_details']['bise_ending_date'])) : ''}}"
                                               {{--                                               value="{{$sessionStartEndDate && $sessionStartEndDate->session_end_date ? date('d/m/Y',strtotime($sessionStartEndDate->session_end_date)) : ''}}"--}}
                                               placeholder="Enter Date">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Academic Term:<span style="color: red;">*</span></label>
                                        <select readonly="" id="bise_academic_term" name="bise_academic_term" class="form-control" onchange="setDisplayForAnnualAndSemester()">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.academic_terms') as $key => $value)
                                                {{--                                                <option value="{{$key}}" {{ $data ? $data['bise_details']['bise_academic_term'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                                <option  value="{{$key}}" >{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="bise_academic_term_category_div" class="form-group  col-md-3">
                                        {{--                                   Ali Naeem Edit. AF      --}}
                                        <label>Semester Category:<span style="color: red;">*</span></label>
                                        <select id="bise_academic_term_category" name="bise_academic_term_category" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.semester_category') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['bise_details']['bise_semester_category'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Shift:<span style="color: red;">*</span></label>
                                        <select name="bise_shift" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.shift') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['bise_details']['bise_shift'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card shadow p-3 w-100">
                                    <div class="card-body ">
                                        <label for="">Previous Academic Details:</label>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Course:</label>
                                                <input type="text" name="bise_previous_course" value="{{ $data ? $data['bise_details']['bise_previous_course'] : ''}}" class="form-control">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Board / University:</label>
                                                <input type="text" name="bise_board_university" value="{{ $data ? $data['bise_details']['bise_board_university'] : ''}}" class="form-control">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Roll No:</label>
                                                <input type="text" class="form-control text-center" name="bise_previous_roll_no" placeholder="Enter Roll No"  value="{{$data ? $data['bise_details']['bise_previous_roll_no'] : ''}}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Passing Date:</label>
                                                <input type="text" class="form-control text-center datepicker" id="previous_passing_date" name="bise_previous_passing_date" value="{{$data && $data['bise_details']['bise_previous_passing_date'] ? date('d/m/Y',strtotime($data['bise_details']['bise_previous_passing_date'])) : ''}}"
                                                       placeholder="Enter Date">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group  col-md-3">
                                                <label>Total Marks:</label>
                                                <input id="previous_total_marks_bise" onkeyup="setPercentageForBise()" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="bise_previous_total_marks" placeholder="Enter Total Marks" value="{{$data ? $data['bise_details']['bise_previous_total_marks'] : ''}}">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Marks Obtained:</label>
                                                <input id="previous_marks_obtained_bise" onkeyup="setPercentageForBise()" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="bise_previous_marks_obtained" placeholder="Enter Marks Obtained" value="{{$data ? $data['bise_details']['bise_previous_marks_obtained'] : ''}}">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Percentage:</label>
                                                <input id="previous_cgpa_bise" readonly type="text" class="form-control text-center" name="bise_previous_percentage" placeholder="Enter Previous CGPA" value="{{$data ? $data['bise_details']['bise_previous_percentage'] : ''}}">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>CGPA:</label>
                                                <input type="text" class="form-control text-center" name="bise_previous_cgpa" placeholder="Enter Previous CGPA" value="{{$data ? $data['bise_details']['bise_previous_cgpa'] : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="card shadow p-3 w-100">
                                    <div class="card-body ">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Registration Status with Affiliated Body:<span style="color: red;">*</span></label>

                                                <select onchange="setBISERegistrationDateDisplay();" id="bise_registration_status" name="bise_registration_status" class="form-control">
                                                    <option value="" selected>--select--</option>
                                                    @foreach(\Config::get('constants.registration_status') as $key => $value)
                                                        <option value="{{$key}}" {{ $data ? $data['bise_details']['bise_registration_status'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6" style="display: none" id="bise_registration_date">
                                                <label>Date of Registration:<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control text-center datepicker"
                                                       name="bise_registration_date" id="registration_date_bise" value="{{$data && $data['bise_details']['bise_registration_date'] ? date('d/m/Y',strtotime($data['bise_details']['bise_registration_date'])) : ''}}"
                                                       placeholder="Enter Date">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="" style="font-size: 20px;">Registration Fees:</label>
                                        </div>
                                        <div class="card shadow p-3 w-100">
                                            <div class="card-body ">
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label>Actual:<span style="color: red;">*</span></label>
                                                        <input onkeyup="setTotalFeeBise()" id="actual_fee_bise" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center"
                                                               name="bise_actual_fee" value="{{$data ? $data['bise_details']['bise_actual_fee'] : ''}}"
                                                               placeholder="Enter Actual Fee">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Late:<span style="color: red;">*</span></label>
                                                        <input onkeyup="setTotalFeeBise()" id="late_fee_bise" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center "
                                                               name="bise_late_fee" value="{{$data ? $data['bise_details']['bise_late_fee'] : ''}}"
                                                               placeholder="Enter Late Fee">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Total:<span style="color: red;">*</span></label>
                                                        <input readonly id="total_fee_bise" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center"
                                                               name="bise_total_fee" value="{{$data ? $data['bise_details']['bise_total_fee'] : ''}}"
                                                               placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="wing_div_ims">
                        <div class="col-md-12 mt-2">
                            <label for="" style="font-size: 20px;">IMS:</label>
                        </div>
                        <div class="card shadow p-3 w-100">
                            <div class="card-body ">
                                <div class="form-row">
                                    <div class="form-group  col-md-4">
                                        <label>Course Applied in CFE:<span style="color: red;">*</span></label>
                                        <select name="ims_course_applied_in_cfe" id="ims_course_applied_in_cfe" onchange="selectAffiliatedBodyId();" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.ims_course_applied_in_cfe') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['ims_details']['ims_course_applied_in_cfe'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                          @php
                                            $checkifims = 0;
                                            if(isset($data['ims_details']['ims_course_applied_in_cfe'])){

                                                $checkifims = $data['ims_details']['ims_course_applied_in_cfe'];
                                            }
                                        @endphp


                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Course Enrolled in CFE:<span style="color: red;">*</span></label>
                                        <select onchange="onChangeIMSEnrolled();" id="ims_course_enrolled_in_cfe" name="ims_course_enrolled_in_cfe" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.ims_course_applied_in_cfe') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['ims_details']['ims_course_enrolled_in_cfe'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Course Registered in:<span style="color: red;">*</span></label>
                                        <select onchange="onChangeIMSRegistered();" id="ims_course_registered" name="ims_course_registered" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.ims_course_registered') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['ims_details']['ims_course_registered'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group  col-md-4">
                                        <label>Roll No:<span style="color: red;">*</span></label>
                                        <input readonly type="text" class="form-control text-center" name="ims_roll_no" value="{{$data ? $data['roll_no'] : ''}}" 
                                               placeholder="Enter Roll No">
                                               {{-- value="{{$data ? $data['ims_details']['ims_roll_no'] : ''}}" --}}
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Affiliated Body:<span style="color: red;">*</span></label>
                                        <select readonly name="ims_affiliated_body" id="ims_affiliated_body" onchange="getAcademicTerm();" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.ims_affiliated_body') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['ims_details']['ims_affiliated_body'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                            @foreach($affiliated_bodies as $affiliated_body)
                                                <option value="{{$affiliated_body->id}}" {{ $data ? $data['ims_details']['ims_affiliated_body'] == $affiliated_body->id ? 'selected' : '' : ''}}>{{$affiliated_body->code}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Duration of Course:<span style="color: red;">*</span></label>
                                        <input readonly type="text" name="ims_duration_of_course" id="ims_duration_of_course" value="{{ $data ? $data['ims_details']['ims_duration_of_course'] : ''}}" class="form-control">
                                        {{--                                        <select name="ims_duration_of_course" class="form-control">--}}
                                        {{--                                            <option value="" selected disabled>--select--</option>--}}
                                        {{--                                            @foreach(\Config::get('constants.ims_duration_of_course') as $key => $value)--}}
                                        {{--                                                <option value="{{$key}}" {{ $data ? $data['ims_details']['ims_duration_of_course'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                        {{--                                            @endforeach--}}
                                        {{--                                        </select>--}}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group  col-md-4">
                                        <label>Date of Admission:<span style="color: red;">*</span></label>
                                        {{--                                        <input type="text" class="form-control text-center datepicker"--}}
                                        {{--                                               name="ims_admission_date" value="{{$data && $data['ims_details']['ims_admission_date'] ? date('d/m/Y',strtotime($data['ims_details']['ims_admission_date'])) : ''}}"--}}
                                        {{--                                               placeholder="Enter Date">--}}
                                        <input  type="text" class="form-control text-center datepicker__"
                                                {{--                                               {{$data && $data['ims_details']['ims_admission_date'] ? date('d/m/Y',strtotime($data['ims_details']['ims_admission_date'])) : ''}}--}}
                                                name="ims_admission_date" value="{{$data && $data['ims_details']['ims_admission_date'] ? date('d/m/Y',strtotime($data['ims_details']['ims_admission_date'])) : ''}}"
                                                placeholder="Enter Date" onchange="checkDateCount(); getEndDateForIMS();" id="sessionStartDate_" >
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Ending date:<span style="color: red;">*</span></label>
                                        {{--                                        <input type="text" class="form-control text-center datepickerAll"--}}
                                        {{--                                               name="ims_ending_date" value="{{$data && $data['ims_details']['ims_ending_date'] ? date('d/m/Y',strtotime($data['ims_details']['ims_ending_date'])) : ''}}"--}}
                                        {{--                                               placeholder="Enter Date">--}}
                                        <input type="text" readonly class="form-control text-center datepickerAll"
                                               name="ims_ending_date" value="{{$data && $data['ims_details']['ims_ending_date'] ? date('d/m/Y',strtotime($data['ims_details']['ims_ending_date'])) : ''}}"
                                               placeholder="Enter Date" onchange="checkDateCount();" id="sessionEndDate_">
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Academic Term:<span style="color: red;">*</span></label>
                                        <select readonly="" id="ims_academic_term" name="ims_academic_term" class="form-control" onchange="setImsSemesterCategoryDisplay()">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.academic_terms') as $key => $value)
                                                <option value="{{$key}}" >{{$value}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="ims_academic_term" id="ims_academic_term_hidden" value="{{$sessionStartEndDate && $sessionStartEndDate->academic_term_id ? $sessionStartEndDate->academic_term_id : ''}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group  col-md-4" id="ims_semester_category_div">
                                        <label>Semester Category:<span style="color: red;">*</span></label>
                                        <select name="ims_semester_category" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.semester_category') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['ims_details']['ims_semester_category'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Shift:<span style="color: red;">*</span></label>
                                        <select name="ims_shift" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.shift') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['ims_details']['ims_shift'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card shadow p-3 w-100">
                                    <div class="card-body ">
                                        <label for="">Previous Academic Details:</label>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Course:</label>
                                                <input type="text" name="ims_previous_course" value="{{ $data ? $data['ims_details']['ims_previous_course'] : ''}}" class="form-control">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Board / University:</label>
                                                <input type="text" name="ims_board_university" value="{{ $data ? $data['ims_details']['ims_board_university'] : ''}}" class="form-control">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Roll No:</label>
                                                <input type="text" class="form-control text-center" name="ims_previous_roll_no" placeholder="Enter Roll No" value="{{$data ? $data['ims_details']['ims_previous_roll_no'] : ''}}">
                                                
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Passing Date:</label>
                                                <input type="text" class="form-control text-center datepicker" id="previous_passing_date" name="ims_previous_passing_date" value="{{$data && $data['ims_details']['ims_previous_passing_date'] ? date('d/m/Y',strtotime($data['ims_details']['ims_previous_passing_date'])) : ''}}"
                                                       placeholder="Enter Date">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group  col-md-3">
                                                <label>Total Marks:</label>
                                                <input id="previous_total_marks_ims" onkeyup="setPercentageForIms()" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="ims_previous_total_marks" placeholder="Enter Total Marks" value="{{$data ? $data['ims_details']['ims_previous_total_marks'] : ''}}">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Marks Obtained:</label>
                                                <input id="previous_marks_obtained_ims" onkeyup="setPercentageForIms()" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="ims_previous_marks_obtained" placeholder="Enter Marks Obtained" value="{{$data ? $data['ims_details']['ims_previous_marks_obtained'] : ''}}">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Percentage:</label>
                                                <input id="previous_cgpa_ims" readonly type="text" class="form-control text-center" name="ims_previous_percentage" placeholder="Enter Previous CGPA" value="{{$data ? $data['ims_details']['ims_previous_percentage'] : ''}}">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>CGPA:</label>
                                                <input type="text" class="form-control text-center" name="ims_previous_cgpa" placeholder="Enter Previous CGPA" value="{{$data ? $data['ims_details']['ims_previous_cgpa'] : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="card shadow p-3 w-100">
                                    <div class="card-body ">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Registration Status with Affiliated Body:<span style="color: red;">*</span></label>
                                                <select id="ims_registration_status" name="ims_registration_status" class="form-control" onchange="setImsRegistrationDateDisplay()">
                                                    <option value="" selected>--select--</option>
                                                    @foreach(\Config::get('constants.registration_status') as $key => $value)
                                                        <option value="{{$key}}" {{ $data ? $data['ims_details']['ims_registration_status'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6" id="ims_registration_date" style="display: none">
                                                <label>Date of Registration:<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control text-center datepicker"
                                                       name="ims_registration_date" id="registration_date_ims" value="{{$data && $data['ims_details']['ims_registration_date']? date('d/m/Y',strtotime($data['ims_details']['ims_registration_date'])) : ''}}"
                                                       placeholder="Enter Date">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="" style="font-size: 20px;">Registration Fees:</label>
                                        </div>
                                        <div class="card shadow p-3 w-100">
                                            <div class="card-body ">
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label>Actual:<span style="color: red;">*</span></label>
                                                        <input onkeyup="setTotalFeeIms()" id="actual_fee_ims" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center"
                                                               name="ims_actual_fee" value="{{$data ? $data['ims_details']['ims_actual_fee'] : ''}}"
                                                               placeholder="Enter Actual Fee">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Late:<span style="color: red;">*</span></label>
                                                        <input onkeyup="setTotalFeeIms()" id="late_fee_ims" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center "
                                                               name="ims_late_fee" value="{{$data ? $data['ims_details']['ims_late_fee'] : ''}}"
                                                               placeholder="Enter Late Fee">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Total:<span style="color: red;">*</span></label>
                                                        <input id="total_fee_ims" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center"
                                                               name="ims_total_fee" value="{{$data ? $data['ims_details']['ims_total_fee'] : ''}}"
                                                               readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="wing_div_af">
                        <div class="col-md-12 mt-2">
                            <label for="" style="font-size: 20px;">AF:</label>
                        </div>
                        <div class="card shadow p-3 w-100">
                            <div class="card-body ">
                                <div class="form-row">
                                    <div class="form-group  col-md-4">
                                        <label>Course Applied in:<span style="color: red;">*</span></label>
                                        <select name="af_course_applied_in" id="af_course_applied_in" onchange="selectAffiliatedBodyId_af();" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.af_course_applied_in') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['af_details']['af_course_applied_in'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                        @php
                                            $checkifaf = 0;
                                            if(isset($data['af_details']['af_course_applied_in'])){
                                                $checkifaf = $data['af_details']['af_course_applied_in'];
                                            }
                                        @endphp
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Course Enrolled in CFE:<span style="color: red;">*</span></label>
                                        <select onchange="onChangeAFEnrolled();" id="af_course_enrolled_in" name="af_course_enrolled_in" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.af_course_enrolled_in') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['af_details']['af_course_enrolled_in'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Course Registered in:<span style="color: red;">*</span></label>
                                        <select onchange="onChangeAFRegistered();" id="af_course_registered_in" name="af_course_registered_in" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.af_course_registered_in') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['af_details']['af_course_registered_in'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group  col-md-4">
                                        <label>Roll No:<span style="color: red;">*</span></label>
                                        <input readonly type="text" class="form-control text-center" name="af_roll_no" value="{{$data ? $data['roll_no'] : ''}}" 
                                               placeholder="Enter Roll No">
                                               {{-- value="{{$data ? $data['af_details']['af_roll_no'] : ''}}" --}}
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Affiliated Body:<span style="color: red;">*</span></label>
                                        <select readonly name="af_affiliated_body" id="af_affiliated_body" onchange="getAcademicTerm_af();" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--@foreach($affiliated_bodies as $affiliated_body)
                                                <option value=""</option>
                                                    {{$affiliated_body->id}}" {{ $data ? $data['af_details']['af_affiliated_body'] == $affiliated_body->id ? 'selected' : '' : ''}}>{{$affiliated_body->code}}
                                                    @endforeach --}}
                                            @foreach($affiliated_bodies as $affiliated_body)
                                                <option value="{{$affiliated_body->id}}" {{ $data ? $data['af_details']['af_affiliated_body'] == $affiliated_body->id ? 'selected' : '' : ''}}>{{$affiliated_body->code}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Duration of Course:<span style="color: red;">*</span></label>
                                        <input readonly type="text" name="af_duration_of_course" id="af_duration_of_course" value="{{ $data ? $data['af_details']['af_duration_of_course'] : ''}}" class="form-control">
                                        {{--                                        <select name="af_duration_of_course" class="form-control">--}}
                                        {{--                                            <option value="" selected disabled>--select--</option>--}}
                                        {{--                                            @foreach(\Config::get('constants.af_duration_of_course') as $key => $value)--}}
                                        {{--                                                <option value="{{$key}}" {{ $data ? $data['af_details']['af_duration_of_course'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                        {{--                                            @endforeach--}}
                                        {{--                                        </select>--}}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group  col-md-4">
                                        <label>Date of Admission:<span style="color: red;">*</span></label>
                                        <input onchange="getEndDateForAF();" type="text"  class="form-control text-center datepicker__"
                                               name="af_admission_date" id="af_admission_date" value="{{$data && $data['af_details']['af_admission_date'] ? date('d/m/Y',strtotime($data['af_details']['af_admission_date'])) : ''}}"
                                               placeholder="Enter Date">
                                        {{--{{$data && $data['af_details']['af_admission_date'] ? date('d/m/Y',strtotime($data['af_details']['af_admission_date'])) : ''}}--}}
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Ending date:<span style="color: red;">*</span></label>
                                        <input type="text" readonly class="form-control text-center datepickerAll"
                                               name="af_ending_date" id="af_ending_date" value="{{$data && $data['af_details']['af_ending_date'] ? date('d/m/Y',strtotime($data['af_details']['af_ending_date'])) : ''}}"
                                               placeholder="Enter Date">
                                        {{--
                                            {{$data && $data['af_details']['af_ending_date'] ? date('d/m/Y',strtotime($data['af_details']['af_ending_date'])) : ''}}--}}
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Academic Term:<span style="color: red;">*</span></label>
                                        <select readonly id="af_academic_term" name="af_academic_term" class="form-control" onchange="setAFSemesterCategoryDisplay()">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.academic_terms') as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div id="af_semester_category_div" class="form-group  col-md-3">
                                        {{--                                   Ali Naeem Edit. AF      --}}
                                        <label>Semester Category:<span style="color: red;">*</span></label>
                                        <select id="af_semester_category" name="af_semester_category" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.semester_category') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['ims_details']['ims_semester_category'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Shift:<span style="color: red;">*</span></label>
                                        <select name="af_shift" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.shift') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['af_details']['af_shift'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card shadow p-3 w-100">
                                    <div class="card-body ">
                                        <label for="">Previous Academic Details:</label>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Course:</label>
                                                <input type="text" name="af_previous_course" value="{{ $data ? $data['af_details']['af_previous_course'] : ''}}" class="form-control">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Board / University:</label>
                                                <input type="text" name="af_board_university" value="{{ $data ? $data['af_details']['af_board_university'] : ''}}" class="form-control">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Roll No:</label>
                                                <input type="text" class="form-control text-center" name="af_previous_roll_no" placeholder="Enter Roll No" value="{{$data ? $data['af_details']['af_previous_roll_no'] : ''}}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Passing Date:</label>
                                                <input type="text" class="form-control text-center datepicker" id="previous_passing_date" name="af_previous_passing_date" value="{{$data && $data['af_details']['af_previous_passing_date'] ? date('d/m/Y',strtotime($data['af_details']['af_previous_passing_date'])) : ''}}"
                                                       placeholder="Enter Date">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group  col-md-3">
                                                <label>Total Marks:</label>
                                                <input id="previous_total_marks_af" onkeyup="setPercentageForAf()" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="af_previous_total_marks" placeholder="Enter Total Marks" value="{{$data ? $data['af_details']['af_previous_total_marks'] : ''}}">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Marks Obtained:</label>
                                                <input id="previous_marks_obtained_af" onkeyup="setPercentageForAf()" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="af_previous_marks_obtained" placeholder="Enter Marks Obtained" value="{{$data ? $data['af_details']['af_previous_marks_obtained'] : ''}}">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Percentage:</label>
                                                <input id="previous_cgpa_af" readonly type="text" class="form-control text-center" name="af_previous_percentage" placeholder="Enter Previous CGPA" value="{{$data ? $data['af_details']['af_previous_percentage'] : ''}}">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>CGPA:</label>
                                                <input type="text" class="form-control text-center" name="af_previous_cgpa" placeholder="Enter Previous CGPA" value="{{$data ? $data['af_details']['af_previous_cgpa'] : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="card shadow p-3 w-100">
                                    <div class="card-body ">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Registration Status with Affiliated Body:<span style="color: red;">*</span></label>
                                                <select name="af_registration_status" id="af_registration_status" onchange="setAfRegistrationDateDisplay()" class="form-control">
                                                    <option value="" selected>--select--</option>
                                                    @foreach(\Config::get('constants.registration_status') as $key => $value)
                                                        <option value="{{$key}}" {{ $data ? $data['af_details']['af_registration_status'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6" id="af_registration_date">
                                                <label>Date of Registration:<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control text-center datepicker"
                                                       name="af_registration_date" id="registration_date_af" value="{{$data && $data['af_details']['af_registration_date'] ? date('d/m/Y',strtotime($data['af_details']['af_registration_date'])) : ''}}"
                                                       placeholder="Enter Date">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="" style="font-size: 20px;">Registration Fees:</label>
                                        </div>
                                        <div class="card shadow p-3 w-100">
                                            <div class="card-body ">
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label>Actual:<span style="color: red;">*</span></label>
                                                        <input onkeyup="setTotalFeeAf()" id="actual_fee_af" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center"
                                                               name="af_actual_fee" value="{{$data ? $data['af_details']['af_actual_fee'] : ''}}"
                                                               placeholder="Enter Actual Fee">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Late:<span style="color: red;">*</span></label>
                                                        <input onkeyup="setTotalFeeAf()" id="late_fee_af" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center "
                                                               name="af_late_fee" value="{{$data ? $data['af_details']['af_late_fee'] : ''}}"
                                                               placeholder="Enter Late Fee">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Total:<span style="color: red;">*</span></label>
                                                        <input id="total_fee_af" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center"
                                                               name="af_total_fee" value="{{$data ? $data['af_details']['af_total_fee'] : ''}}"
                                                               readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="wing_div_vti">
                        <div class="col-md-12 mt-2">
                            <label for="" style="font-size: 20px;">VTI:</label>
                        </div>
                        <div class="card shadow p-3 w-100">
                            <div class="card-body ">
                                <div class="form-row">
                                    <div class="form-group  col-md-3">
                                        <label>Diploma Applied in:<span style="color: red;">*</span></label>
                                        <select onchange="selectAffiliatedBodyId_vti();" name="vti_diploma_applied_in" id="vti_diploma_applied_in" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.vti_diploma_applied_in') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['vti_details']['vti_diploma_applied_in'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                        @php
                                            $checkifvti = 0;
                                            if(isset($data['vti_details']['vti_diploma_applied_in'])){
                                                $checkifvti = $data['vti_details']['vti_diploma_applied_in'];
                                            }
                                        @endphp
                                    </div>
                                    <div class="form-group  col-md-3">
                                        <label>Diploma Enrolled in:<span style="color: red;">*</span></label>
                                        <select onchange="onChangeVTIEnrolled();" id="vti_diploma_enrolled_in" name="vti_diploma_enrolled_in" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.vti_diploma_enrolled_in') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['vti_details']['vti_diploma_enrolled_in'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-3">
                                        <label>Diploma Registered in:<span style="color: red;">*</span></label>
                                        <select onchange="onChangeVTIRegistered();" id="vti_diploma_registered_in" name="vti_diploma_registered_in" class="form-control">
                                            <option value="" selected >--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.vti_diploma_registered_in') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['vti_details']['vti_diploma_registered_in'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-3">
                                        <label>Dual course:<span style="color: red;">*</span></label>
                                        <select id="vti_dual_course" name="vti_dual_course" class="form-control" onchange="setDualCoursePageDisplay()">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['vti_details']['vti_dual_course'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-3">
                                        <label>Reason:<span style="color: red;">*</span></label>
                                        <select id="vti_reason" name="vti_reason" class="form-control" onchange="setVtiFieldsDisplay()">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.vti_reason') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['vti_details']['vti_reason'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" style="display: none" id="vti_further_file_div">
                                        <label>Further File to be Received:<span style="color: red;">*</span></label>
                                        <select id="vti_further_file_received" name="vti_further_file_received" class="form-control" onchange="setVtiFollowUpDate()">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['vti_details']['vti_further_file_received'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-3" style="display: none" id="vti_follow_up_date">
                                        <label>Follow-Up Date:<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control text-center datepickerAll" id="vti_follow_up"
                                               name="vti_follow_up" value="{{$data && $data['vti_details']['vti_follow_up'] ? date('d/m/Y',strtotime($data['vti_details']['vti_follow_up'])) : ''}}"
                                               placeholder="Enter Date">
                                    </div>
                                    <div class="form-group  col-md-3">
                                        <label>Roll No:<span style="color: red;">*</span></label>
                                        <input readonly type="text" class="form-control text-center" name="vti_roll_no" value="{{$data ? $data['roll_no'] : ''}}"
                                               placeholder="Enter Roll No">
                                               {{-- value="{{$data ? $data['vti_details']['vti_roll_no'] : ''}}" --}}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group  col-md-4">
                                        <label>Affiliated Body:<span style="color: red;">*</span></label>
                                        <select readonly onchange="getAcademicTerm_vti();" name="vti_affiliated_body" id="vti_affiliated_body" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--                                            @foreach(\Config::get('constants.vti_affiliated_body') as $key => $value)--}}
                                            {{--                                                <option value="{{$key}}" {{ $data ? $data['vti_details']['vti_affiliated_body'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                            @foreach($affiliated_bodies as $affiliated_body)
                                                <option value="{{$affiliated_body->id}}" {{ $data ? $data['vti_details']['vti_affiliated_body'] == $affiliated_body->id ? 'selected' : '' : ''}}>{{$affiliated_body->code}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Duration of Diploma:<span style="color: red;">*</span></label>
                                        <input readonly type="text" name="vti_duration_of_diploma" id="vti_duration_of_diploma" value="{{ $data ? $data['vti_details']['vti_duration_of_diploma'] : ''}}" class="form-control">
                                        {{--                                        <select name="vti_duration_of_diploma" class="form-control">--}}
                                        {{--                                            <option value="" selected disabled>--select--</option>--}}
                                        {{--                                            @foreach(\Config::get('constants.vti_duration_of_diploma') as $key => $value)--}}
                                        {{--                                                <option value="{{$key}}" {{ $data ? $data['vti_details']['vti_duration_of_diploma'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                        {{--                                            @endforeach--}}
                                        {{--                                        </select>--}}
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Date of Admission:<span style="color: red;">*</span></label>

                                        <input onchange="getEndDateForVTI();" type="text"  class="form-control text-center datepicker__"
                                               name="vti_admission_date" id="vti_admission_date"
                                               value="{{$data && $data['vti_details']['vti_admission_date'] ? date('d/m/Y',strtotime($data['vti_details']['vti_admission_date'])) : ''}}"
                                               placeholder="Enter Date">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group  col-md-3">
                                        <label>Ending Date:<span style="color: red;">*</span></label>
                                        <input type="text" readonly class="form-control text-center datepickerAll"
                                               name="vti_ending_date" id="vti_ending_date"
                                               value="{{$data && $data['vti_details']['vti_ending_date'] ? date('d/m/Y',strtotime($data['vti_details']['vti_ending_date'])) : ''}}"
                                               placeholder="Enter Date">
                                    </div>
                                    <div class="form-group  col-md-3">
                                        <label>Academic Term:<span style="color: red;">*</span></label>
                                        <select readonly id="vti_scheme_of_study" name="vti_scheme_of_study" onchange="setVtiDualSemesterCategoryDisplay();" class="form-control">
                                            <option value="" selected>--select--</option>
                                            {{--}<option value="0" @if($checkifaf != 0) selected @endif>Annual</option>--}}
                                            @foreach(\Config::get('constants.academic_terms') as $key => $value)
                                                {{--                                                <option value="{{$key}}" {{ $data ? $data['af_details']['bise_academic_term'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
                                                <option  value="{{$key}}" >{{$value}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group  col-md-3">
                                        <label>Shift:<span style="color: red;">*</span></label>
                                        <select name="vti_shift" class="form-control">
                                            <option value="" selected>--select--</option>
                                            @foreach(\Config::get('constants.shift') as $key => $value)
                                                <option value="{{$key}}" {{ $data ? $data['vti_details']['vti_shift'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card shadow p-3 w-100">
                                    <div class="card-body ">
                                        <label for="">Previous Academic Details:</label>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Course:</label>
                                                <input type="text" name="vti_previous_course" value="{{ $data ? $data['vti_details']['vti_previous_course'] : ''}}" class="form-control">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Board / University:</label>
                                                <input type="text" name="vti_board_university" value="{{ $data ? $data['vti_details']['vti_board_university'] : ''}}" class="form-control">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Roll No:</label>
                                                <input type="text" class="form-control text-center" name="vti_previous_roll_no" placeholder="Enter Roll No" value="{{$data ? $data['vti_details']['vti_previous_roll_no'] : ''}}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Passing Date:</label>
                                                <input type="text" class="form-control text-center datepicker" id="previous_passing_date" name="vti_previous_passing_date" value="{{$data && $data['vti_details']['vti_previous_passing_date'] ? date('d/m/Y',strtotime($data['vti_details']['vti_previous_passing_date'])) : ''}}"
                                                       placeholder="Enter Date">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group  col-md-3">
                                                <label>Total Marks:</label>
                                                <input id="previous_total_marks_vti" onkeyup="setPercentageForVti()" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="vti_previous_total_marks" placeholder="Enter Total Marks" value="{{$data ? $data['vti_details']['vti_previous_total_marks'] : ''}}">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Marks Obtained:</label>
                                                <input id="previous_marks_obtained_vti" onkeyup="setPercentageForVti()" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="vti_previous_marks_obtained" placeholder="Enter Marks Obtained" value="{{$data ? $data['vti_details']['vti_previous_marks_obtained'] : ''}}">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>Percentage:</label>
                                                <input id="previous_cgpa_vti" readonly type="text" class="form-control text-center" name="vti_previous_percentage" placeholder="Enter Previous CGPA" value="{{$data ? $data['vti_details']['vti_previous_percentage'] : ''}}">
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label>CGPA:</label>
                                                <input type="text" class="form-control text-center" name="vti_previous_cgpa" placeholder="Enter Previous CGPA" value="{{$data ? $data['vti_details']['vti_previous_cgpa'] : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="card shadow p-3 w-100">
                                    <div class="card-body ">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Registration Status with Affiliated Body:<span style="color: red;">*</span></label>
                                                <select onchange="setVtiRegistrationDateDisplay()" id="vti_registration_status" name="vti_registration_status" class="form-control">
                                                    <option value="" selected>--select--</option>
                                                    @foreach(\Config::get('constants.registration_status') as $key => $value)
                                                        <option value="{{$key}}" {{ $data ? $data['vti_details']['vti_registration_status'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6" id="vti_registration_date">
                                                <label>Date of Registration:<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control text-center datepicker"
                                                       name="vti_date_of_registration" id="registration_date_vti" value="{{$data && $data['vti_details']['vti_date_of_registration'] ? date('d/m/Y',strtotime($data['vti_details']['vti_date_of_registration'])) : ''}}"
                                                       placeholder="Enter Date">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="" style="font-size: 20px;">Registration Fees:</label>
                                        </div>
                                        <div class="card shadow p-3 w-100">
                                            <div class="card-body ">
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label>Actual:<span style="color: red;">*</span></label>
                                                        <input onkeyup="setTotalFeeVti()" id="actual_fee_vti" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center"
                                                               name="vti_registration_actual_fee" value="{{$data ? $data['vti_details']['vti_registration_actual_fee'] : ''}}"
                                                               placeholder="Enter Actual Fee">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Late:<span style="color: red;">*</span></label>
                                                        <input onkeyup="setTotalFeeVti()" id="late_fee_vti" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center "
                                                               name="vti_registration_late_fee" value="{{$data ? $data['vti_details']['vti_registration_late_fee'] : ''}}"
                                                               placeholder="Enter Late Fee">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Total:<span style="color: red;">*</span></label>
                                                        <input id="total_fee_vti" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center"
                                                               name="vti_registration_total_fee" value="{{$data ? $data['vti_details']['vti_registration_total_fee'] : ''}}"
                                                               readonly>
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
        @include('pwwb/pages.page_11')
    </form>
</div>

@section('script_page_7')

    <script>
        function getSessionDatesForCoursesIMS(){
            var ims_course_applied_in_cfe = $('#ims_course_applied_in_cfe').val();
            // alert(ims_course_applied_in_cfe);

            var newims_affiliated_body = $('#ims_affiliated_body').val();
            // alert(newims_affiliated_body);
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.ajax({

                method:'GET',
                data:{},
                url:'getSessionDatesForCourses/'+ims_course_applied_in_cfe,
                success:function(data){
                    console.log('success');
                    console.log (data);
                    console.log("here We go with data");
                    $('#ims_affiliated_body').val(data);
                    getAcademicTerm();
                    if($('#cfe_wing_selection').val() == '3'){

                        $('#course_selected_from_page_07').val($('#ims_course_applied_in_cfe').val());
                        $('#course_selected_from_page_07_name').val($('#ims_course_applied_in_cfe option:selected').text());
                        $('#course_registered_selected_from_page_07').val($('#ims_course_registered').val());
                        $('#course_enrolled_selected_from_page_07').val($('#ims_course_enrolled_in_cfe').val());
                        $('#affiliated_body_selected_from_page_07').val($('#ims_affiliated_body').val());
                        $('#annual_semester_selected_from_page_07').val($('#ims_academic_term').val());
                    }else if($('#cfe_wing_selection').val() == '1'){

                    }else if($('#cfe_wing_selection').val() == '2'){

                    }else if($('#cfe_wing_selection').val() == '4'){

                    }
                },
                error:function(data){
                    console.log('error');
                }
            });
        }

        var getTotalSessionDuration = '';
        {{--var startDateOfSession = "{{$startDateOfSession}}";--}}
        {{--var endDateOfSession = "{{$endDateOfSession}}";--}}

        {{--let start = startDateOfSession.split('/');--}}
        {{--let end = endDateOfSession.split('/');--}}

        {{--const diffInMonths = (end, start) => {--}}
        {{--    var timeDiff_ = Math.abs(end.getTime() - start.getTime());--}}
        {{--    return Math.round(timeDiff_ / (2e3 * 3600 * 365.25));--}}
        {{--}--}}
        {{--var result_ = '';--}}
        {{--result_ = diffInMonths(new Date(end[2], end[1], end[0]), new Date(start[2], start[1], start[0]));--}}
        {{--alert();--}}
        {{--alert(result_);--}}
        checkDateCount();
        $('select[name="bise_registration_status"').each(function (index,value) {
            if($(value).val() == 'registered')
                $(value).parent().next().show();
            else
                $(value).parent().next().hide();
        });
        setTotalFeeBise();
        setTotalFeeIms();
        setTotalFeeAf();
        setTotalFeeVti();
        setWingCorrespondingSectionDisplay();
        setDisplayForAnnualAndSemester();
        setBiseRegistrationDateDisplay();
        setImsSemesterCategoryDisplay();
        setImsRegistrationDateDisplay();
        setAfRegistrationDateDisplay();
        setVtiSemesterCategoryDisplay();
        setAFSemesterCategoryDisplay();
        setDualCourseRegistrationDateDisplay();
        setVtiRegistrationDateDisplay();
        setVtiDualSemesterCategoryDisplay();

        $('#vti_follow_up').datepicker({
            format:'dd/mm/yyyy',
            startDate: new Date(),
            autoclose: true
        });

        function setWingCorrespondingSectionDisplay() {
            let wings_array = {
                '2': 'wing_div_bise',
                '3': 'wing_div_ims',
                '1': 'wing_div_af',
                '4': 'wing_div_vti'
            };
            for (let key in wings_array) {
                $('#' + wings_array[key]).hide();
            }

            $('#' + wings_array[$('#cfe_wing_selection option:selected').val()]).fadeIn();
            // Passing Data to the index tabe for filter adjustments ...
            $('#wing_selected_from_page_07').val($('#cfe_wing_selection').val());
            if($('#cfe_wing_selection').val() == '3' && getAccValue < 3){
                $('#wing_div_bise').hide();
                $('#wing_div_ims').hide();
                $('#wing_div_af').hide();
                $('#wing_div_vti').hide();
                $('#getAccValue').show();

            }
            else if($('#cfe_wing_selection').val() == '1' && getAccValue < 3){
                $('#wing_div_bise').hide();
                $('#wing_div_ims').hide();
                $('#wing_div_af').hide();
                $('#wing_div_vti').hide();
                $('#getAccValue').show();
            }else if($('#cfe_wing_selection').val() == '2' && getAccValue < 3){
                $('#wing_div_bise').show();
                $('#wing_div_ims').hide();
                $('#wing_div_af').hide();
                $('#wing_div_vti').hide();
                $('#getAccValue').hide();
            }else if($('#cfe_wing_selection').val() == '4' && getAccValue < 3){
                $('#wing_div_bise').hide();
                $('#wing_div_ims').hide();
                $('#wing_div_af').hide();
                $('#wing_div_vti').show();
                $('#getAccValue').hide();
            }else{
                $('#getAccValue').hide();
            }

            setBiseFieldsDisplay();
            setVtiFieldsDisplay();
            setVtiFollowUpDate();
            setDualCoursePageDisplay();
            fetchcscources();
        }


        function checkDateCount() {
            // var now = new Date("{{$endDateOfSession}}");
            // var past = new Date("{{$startDateOfSession}}");
            // var nowYear = now.getFullYear();
            // var pastYear = past.getFullYear();
            // var years = nowYear - pastYear;
            // // total_sem_count = years;
            // getTotalSessionDuration = years;
            // $('#ims_duration_of_course').val(getTotalSessionDuration + ' Years');
            // $('#af_duration_of_course').val(getTotalSessionDuration + ' Years');
            // $('#bise_duration_of_course').val(getTotalSessionDuration + ' Years');
            // $('#vti_duration_of_diploma').val(1 + ' Years');


        }

        // function getEndDateForBise(){
        //     var dateOfAdmission = new Date($('#sessionEndDate_').val());
        //     var year = dateOfAdmission.getFullYear();
        //     var month = dateOfAdmission.getMonth();
        //     var day = dateOfAdmission.getDate();
        //     var endingDate = new Date(year + getTotalSessionDuration, month, day);
        //     alert(endingDate);
        // }
        //
        function getEndDateForBise(){
            var dateOfAdmission = $('#bise_admission_date').val().split('/');
            var year = parseInt(dateOfAdmission[2]);
            $('#bise_ending_date').val(dateOfAdmission[0] + "/" + dateOfAdmission[1] + "/" + parseInt(year + getTotalSessionDuration));
        }
        function getEndDateForIMS(){
            var dateOfAdmission = $('#sessionStartDate_').val().split('/');
            var year = parseInt(dateOfAdmission[2]);
            $('#sessionEndDate_').val(dateOfAdmission[0] + "/" + dateOfAdmission[1] + "/" + parseInt(year + getTotalSessionDuration));
        }

        function getEndDateForAF(){
            var dateOfAdmission = $('#af_admission_date').val().split('/');
            var year = parseInt(dateOfAdmission[2]);
            $('#af_ending_date').val(dateOfAdmission[0] + "/" + dateOfAdmission[1] + "/" + parseInt(year + getTotalSessionDuration));
        }

        function getEndDateForVTI(){
            var dateOfAdmission = $('#vti_admission_date').val().split('/');
            var year = parseInt(dateOfAdmission[2]);
            $('#vti_ending_date').val(dateOfAdmission[0] + "/" + dateOfAdmission[1] + "/" + parseInt(year + 1));
        }

        //IMS Wing
        function selectAffiliatedBodyId(){

            var ims_course_applied_in_cfe = $('#ims_course_applied_in_cfe').val();
            // alert(ims_course_applied_in_cfe);

            var newims_affiliated_body = $('#ims_affiliated_body').val();
            // alert(newims_affiliated_body);
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.ajax({

                method:'GET',
                data:{},
                url:'/getIMSAffiliatedID/'+ims_course_applied_in_cfe,
                success:function(data){
                    console.log('success');
                    console.log (data);
                    console.log("here We go with data");
                    $('#ims_affiliated_body').val(data);
                    getAcademicTerm();
                    if($('#cfe_wing_selection').val() == '3'){

                        $('#course_selected_from_page_07').val($('#ims_course_applied_in_cfe').val());
                        $('#course_selected_from_page_07_name').val($('#ims_course_applied_in_cfe option:selected').text());
                        $('#course_registered_selected_from_page_07').val($('#ims_course_registered').val());
                        $('#course_enrolled_selected_from_page_07').val($('#ims_course_enrolled_in_cfe').val());
                        $('#affiliated_body_selected_from_page_07').val($('#ims_affiliated_body').val());
                        $('#annual_semester_selected_from_page_07').val($('#ims_academic_term').val());

                        if(!index_id){
                            $('#sessionStartDate_').val('');
                            $('#sessionEndDate_').val('');
                        }

                    }else if($('#cfe_wing_selection').val() == '1'){

                    }else if($('#cfe_wing_selection').val() == '2'){

                    }else if($('#cfe_wing_selection').val() == '4'){

                    }
                },
                error:function(data){
                    console.log('error');
                }
            });
        }

        //BISC Wing
        function selectAffiliatedBodyId_bise(){
            var bise_course_applied_in = $('#bise_course_applied_in').val();
            // alert(bise_course_applied_in);
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.ajax({

                method:'GET',
                data:{},
                url:'/getIMSAffiliatedID/'+bise_course_applied_in,
                success:function(data){
                    console.log('success');
                    console.log (data);
                    $('#bise_affiliated_body').val(data);
                    getAcademicTerm_bise();
                    if($('#cfe_wing_selection').val() == '3'){

                    }else if($('#cfe_wing_selection').val() == '1'){

                    }else if($('#cfe_wing_selection').val() == '2'){
                        // alert('here');
                        $('#course_selected_from_page_07').val($('#bise_course_applied_in').val());
                        $('#course_selected_from_page_07_name').val($('#bise_course_applied_in option:selected').text());
                        $('#course_registered_selected_from_page_07').val($('#bise_course_registered_in').val());
                        $('#course_enrolled_selected_from_page_07').val($('#bise_course_enrolled_cfe').val());
                        $('#affiliated_body_selected_from_page_07').val($('#bise_affiliated_body').val());
                        $('#annual_semester_selected_from_page_07').val($('#bise_academic_term').val());
                    }else if($('#cfe_wing_selection').val() == '4'){

                    }
                },
                error:function(data){
                    console.log('error');
                }
            });
        }

        //AF Wing
        function selectAffiliatedBodyId_af(){
            var af_course_applied_in = $('#af_course_applied_in').val();

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.ajax({

                method:'GET',
                data:{},
                url:'/getIMSAffiliatedID/'+af_course_applied_in,
                success:function(data){
                    console.log('success');
                    console.log (data);
                    $('#af_affiliated_body').val(data);
                    getAcademicTerm_af();
                    if($('#cfe_wing_selection').val() == '3'){

                    }else if($('#cfe_wing_selection').val() == '1'){
                        $('#course_selected_from_page_07').val($('#af_course_applied_in').val())
                        $('#course_selected_from_page_07_name').val($('#af_course_applied_in option:selected').text());
                        $('#course_registered_selected_from_page_07').val($('#af_course_registered_in').val());
                        $('#course_enrolled_selected_from_page_07').val($('#af_course_enrolled_in').val());
                        $('#affiliated_body_selected_from_page_07').val($('#af_affiliated_body').val());
                        $('#annual_semester_selected_from_page_07').val($('#af_academic_term').val());
                        $('#af_admission_date').val('');
                        $('#af_ending_date').val('');
                        if(!index_id){
                            $('#af_admission_date').val('');
                            $('#af_ending_date').val('');
                        }
                    }else if($('#cfe_wing_selection').val() == '2'){

                    }else if($('#cfe_wing_selection').val() == '4'){

                    }

                },
                error:function(data){
                    console.log('error');
                }
            });
        }

        //VTI Wing
        function selectAffiliatedBodyId_vti(){
            var af_course_applied_in = $('#vti_diploma_applied_in').val();

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.ajax({

                method:'GET',
                data:{},
                url:'/getIMSAffiliatedID/'+af_course_applied_in,
                success:function(data){
                    console.log('success');
                    console.log (data);
                    $('#vti_affiliated_body').val(data);
                    getAcademicTerm_vti();
                    if($('#cfe_wing_selection').val() == '3'){

                    }else if($('#cfe_wing_selection').val() == '1'){

                    }else if($('#cfe_wing_selection').val() == '2'){

                    }else if($('#cfe_wing_selection').val() == '4'){
                        $('#course_selected_from_page_07').val($('#vti_diploma_applied_in').val());
                        $('#course_selected_from_page_07_name').val($('#vti_diploma_applied_in option:selected').text());
                        $('#course_registered_selected_from_page_07').val($('#vti_diploma_registered_in').val());
                        $('#course_enrolled_selected_from_page_07').val($('#vti_diploma_enrolled_in').val());
                        $('#affiliated_body_selected_from_page_07').val($('#vti_affiliated_body').val());
                        $('#annual_semester_selected_from_page_07').val($('#vti_scheme_of_study').val());

                        if(!index_id){
                            $('#vti_admission_date').val('');
                            $('#vti_ending_date').val('');
                        }
                    }

                },
                error:function(data){
                    console.log('error');
                }
            });
        }

        // Fetch Cs Courses.
        function fetchcscources(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var wing_id =0;
            var session_id =0;
            wing_id = $('#cfe_wing_selection').val();
            console.log("wing "+wing_id);
            // alert(wing_id);
            session_id = $('#sessions').val();
            console.log("session "+session_id);
            // alert(session_id);

            var myurl ='';
            if(index_id)
            {
                myurl= '/getCoursesEwingSessions/'+wing_id+'/'+session_id;
            }
            else
            {
                myurl = 'getCoursesEwingSessions/'+wing_id+'/'+session_id;
            }
            $.ajax({

                method:'GET',
                data:{},
                url:myurl,
                success:function(response){
                    console.log('success');
                    // console.log(data[0][0].id);
                    // $.each (data, function () {
                    //     console.log (data);
                    // });
                    $('#ims_course_applied_in_cfe').empty();
                    $('#af_course_applied_in').empty();
                    $('#bise_course_applied_in').empty();
                    $('#vti_diploma_applied_in').empty();
                    $('#ims_course_enrolled_in_cfe').empty();
                    $('#ims_course_registered').empty();

                    $('#af_course_enrolled_in').empty();
                    $('#af_course_registered_in').empty();

                    $('#bise_course_enrolled_cfe').empty();
                    $('#bise_course_registered_in').empty();

                    $('#vti_diploma_enrolled_in').empty();
                    $('#vti_diploma_registered_in').empty();

                    $('#ims_course_applied_in_cfe').append($('<option selected disabled></option>').attr('value', '').text('-- Select Course --'));
                    $('#af_course_applied_in').append($('<option selected disabled></option>').attr('value', '').text('-- Select Course --'));
                    $('#bise_course_applied_in').append($('<option selected disabled></option>').attr('value', '').text('-- Select Course --'));
                    $('#vti_diploma_applied_in').append($('<option selected disabled></option>').attr('value', '').text('-- Select Course --'));
                    $('#ims_course_enrolled_in_cfe').append($('<option selected disabled></option>').attr('value', '').text('-- Select Course --'));
                    $('#ims_course_registered').append($('<option selected disabled></option>').attr('value', '').text('-- Select Course --'));
                    $('#af_course_enrolled_in').append($('<option selected disabled></option>').attr('value', '').text('-- Select Course --'));
                    $('#af_course_registered_in').append($('<option selected disabled></option>').attr('value', '').text('-- Select Course --'));
                    $('#bise_course_enrolled_cfe').append($('<option selected disabled></option>').attr('value', '').text('-- Select Course --'));
                    $('#bise_course_registered_in').append($('<option selected disabled></option>').attr('value', '').text('-- Select Course --'));
                    $('#vti_diploma_enrolled_in').append($('<option selected disabled></option>').attr('value', '').text('-- Select Course --'));
                    $('#vti_diploma_registered_in').append($('<option selected disabled></option>').attr('value', '').text('-- Select Course --'));
                    for(var i=0;i<response.output.length;i++){

                        console.log(response.output[i].id);
                        // console.log(response.output[i].title);
                        // console.log(response.output[i].amount);
                        //response.output[i].id;

                        if(wing_id == 3){
                            if(index_id){
                                var course_rst = {{$checkifims}};
                            }
                            else{
                                course_rst = '0';
                            }

                            if(course_rst != '0'){

                                if(course_rst == response.output[i].id){
                                    $('#ims_course_applied_in_cfe').append($('<option selected></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#ims_course_enrolled_in_cfe').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#ims_course_registered').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    getIMSRegisteredInfo();
                                    getIMSEnrolledInfo();
                                    getAcademicTerm();
                                }
                                else{
                                    $('#ims_course_applied_in_cfe').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#ims_course_enrolled_in_cfe').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#ims_course_registered').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                }

                            }
                            else{
                                $('#ims_course_applied_in_cfe').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                $('#ims_course_enrolled_in_cfe').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                $('#ims_course_registered').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                            }
                            //     // $.each(data, function (key, entry) {
                            //          $('#ims_course_applied_in_cfe').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                            //     // })
                        }else if(wing_id == 1){
                            if(index_id){
                                var course_rst = {{$checkifaf}};
                            }
                            else{
                                course_rst = '0';
                            }
                            if(course_rst != '0'){
                                if(course_rst == response.output[i].id){
                                    $('#af_course_applied_in').append($('<option selected></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#af_course_enrolled_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#af_course_registered_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    getAFRegisteredInfo();
                                    getAFEnrolledInfo();
                                    getAcademicTerm_af();
                                }
                                else{
                                    $('#af_course_applied_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#af_course_enrolled_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#af_course_registered_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                }

                            }
                            else{
                                $('#af_course_applied_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                $('#af_course_enrolled_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                $('#af_course_registered_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                            }
                            //     // $.each(data, function (key, entry) {
                            //          $('#af_course_applied_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                            //     // })
                        }else if(wing_id == 2){
                            if(index_id){
                                var course_rst = {{$checkifbise}};
                            }
                            else{
                                course_rst = '0';
                            }
                            if(course_rst != '0'){
                                if(course_rst == response.output[i].id){
                                    $('#bise_course_applied_in').append($('<option selected></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#bise_course_enrolled_cfe').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#bise_course_registered_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    getBISERegisteredInfo();
                                    getBISEEnrolledInfo();
                                    getAcademicTerm_bise();
                                }
                                else{
                                    $('#bise_course_applied_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#bise_course_enrolled_cfe').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#bise_course_registered_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                }

                            }
                            else{
                                $('#bise_course_applied_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                $('#bise_course_enrolled_cfe').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                $('#bise_course_registered_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                            }
                            //     // $.each(data, function (key, entry) {
                            //          $('#bise_course_applied_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                            //     // })
                        }else if(wing_id == 4){
                            if(index_id){
                                var course_rst = {{$checkifvti}};
                            }
                            else{
                                course_rst = '0';
                            }
                            if(course_rst != '0'){
                                if(course_rst == response.output[i].id){
                                    $('#vti_diploma_applied_in').append($('<option selected></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#vti_diploma_enrolled_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#vti_diploma_registered_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    getVTIRegisteredInfo();
                                    getVTIEnrolledInfo();
                                    getAcademicTerm_vti();
                                }
                                else{
                                    $('#vti_diploma_applied_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#vti_diploma_enrolled_in').append($('<option ></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                    $('#vti_diploma_registered_in').append($('<option ></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                }

                            }
                            else{
                                $('#vti_diploma_applied_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                $('#vti_diploma_enrolled_in').append($('<option ></option>').attr('value', response.output[i].id).text(response.output[i].name));
                                $('#vti_diploma_registered_in').append($('<option ></option>').attr('value', response.output[i].id).text(response.output[i].name));
                            }
                            //     // $.each(data, function (key, entry) {
                            //          $('#vti_diploma_applied_in').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                            //     // })
                        }

                    }
                    if(checkifDataFetchedThroughRNumber == 1){
                        courseIdSelect(getCourseSelectionId);
                    }
                    
                },
                error:function(data){
                    console.log('error');
                }
            });
        }

        //IMS Course Enrolled ...
        function getIMSEnrolledInfo(){
            if(index_id){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                var wing_id =0;
                var session_id =0;
                wing_id = $('#cfe_wing_selection').val();
                console.log("wing "+wing_id);
                // alert(wing_id);
                session_id = $('#sessions').val();
                console.log("session "+session_id);
                // alert(session_id);

                var myurl ='';
                if(index_id)
                {
                    myurl= '/getIMSEnrolledInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                else
                {
                    myurl = 'getIMSEnrolledInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                $.ajax({

                    method:'GET',
                    data:{},
                    url:myurl,
                    success:function(response){
                        for(var i=0;i<response.output.length;i++){
                          
                         // $('#ims_course_enrolled_in_cfe').append($('<option selected></option>').attr('value', ).text(response.output[i].name));
                          // document.getElementById('ims_course_enrolled_in_cfe').value = response.output[i].od;
                          $("#ims_course_enrolled_in_cfe option[value="+response.output[i].id+"]").prop("selected", "selected")
                        }       
                    }, 
                    error:function(response){

                    }
                });
            }
        }

        // IMS Course  registered ...
        function getIMSRegisteredInfo(){
            if(index_id){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                var wing_id =0;
                var session_id =0;
                wing_id = $('#cfe_wing_selection').val();
                console.log("wing "+wing_id);
                // alert(wing_id);
                session_id = $('#sessions').val();
                console.log("session "+session_id);
                // alert(session_id);

                var myurl ='';
                if(index_id)
                {
                    myurl= '/getIMSRegisteredInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                else
                {
                    myurl = 'getIMSRegisteredInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                $.ajax({

                    method:'GET',
                    data:{},
                    url:myurl,
                    success:function(response){
                        for(var i=0;i<response.output.length;i++){
                          
                         // $('#ims_course_enrolled_in_cfe').append($('<option selected></option>').attr('value', ).text(response.output[i].name));
                          // document.getElementById('ims_course_enrolled_in_cfe').value = response.output[i].od;
                          $("#ims_course_registered option[value="+response.output[i].id+"]").prop("selected", "selected")
                        }       
                    }, 
                    error:function(response){

                    }
                });
            }
        }

        //AF Course Enrolled ...
        function getAFEnrolledInfo(){
            if(index_id){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                var wing_id =0;
                var session_id =0;
                wing_id = $('#cfe_wing_selection').val();
                console.log("wing "+wing_id);
                // alert(wing_id);
                session_id = $('#sessions').val();
                console.log("session "+session_id);
                // alert(session_id);

                var myurl ='';
                if(index_id)
                {
                    myurl= '/getAFEnrolledInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                else
                {
                    myurl = 'getAFEnrolledInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                $.ajax({

                    method:'GET',
                    data:{},
                    url:myurl,
                    success:function(response){
                        for(var i=0;i<response.output.length;i++){
                          
                         // $('#AF_course_enrolled_in_cfe').append($('<option selected></option>').attr('value', ).text(response.output[i].name));
                          // document.getElementById('AF_course_enrolled_in_cfe').value = response.output[i].od;
                          $("#af_course_enrolled_in option[value="+response.output[i].id+"]").prop("selected", "selected")
                        }       
                    }, 
                    error:function(response){

                    }
                });
            }
        }

        // AF Course  registered ...
        function getAFRegisteredInfo(){
            if(index_id){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                var wing_id =0;
                var session_id =0;
                wing_id = $('#cfe_wing_selection').val();
                console.log("wing "+wing_id);
                // alert(wing_id);
                session_id = $('#sessions').val();
                console.log("session "+session_id);
                // alert(session_id);

                var myurl ='';
                if(index_id)
                {
                    myurl= '/getAFRegisteredInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                else
                {
                    myurl = 'getAFRegisteredInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                $.ajax({

                    method:'GET',
                    data:{},
                    url:myurl,
                    success:function(response){
                        for(var i=0;i<response.output.length;i++){
                          
                         // $('#AF_course_enrolled_in_cfe').append($('<option selected></option>').attr('value', ).text(response.output[i].name));
                          // document.getElementById('AF_course_enrolled_in_cfe').value = response.output[i].od;
                          $("#af_course_registered_in option[value="+response.output[i].id+"]").prop("selected", "selected")
                        }       
                    }, 
                    error:function(response){

                    }
                });
            }
        }

          //BISE Course Enrolled ...
        function getBISEEnrolledInfo(){
            if(index_id){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                var wing_id =0;
                var session_id =0;
                wing_id = $('#cfe_wing_selection').val();
                console.log("wing "+wing_id);
                // alert(wing_id);
                session_id = $('#sessions').val();
                console.log("session "+session_id);
                // alert(session_id);

                var myurl ='';
                if(index_id)
                {
                    myurl= '/getBISEEnrolledInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                else
                {
                    myurl = 'getBISEEnrolledInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                $.ajax({

                    method:'GET',
                    data:{},
                    url:myurl,
                    success:function(response){
                        for(var i=0;i<response.output.length;i++){
                          
                         // $('#BISE_course_enrolled_in_cfe').append($('<option selected></option>').attr('value', ).text(response.output[i].name));
                          // document.getElementById('BISE_course_enrolled_in_cfe').value = response.output[i].od;
                          $("#bise_course_enrolled_cfe option[value="+response.output[i].id+"]").prop("selected", "selected")
                        }       
                    }, 
                    error:function(response){

                    }
                });
            }
        }

        // BISE Course  registered ...
        function getBISERegisteredInfo(){
            if(index_id){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                var wing_id =0;
                var session_id =0;
                wing_id = $('#cfe_wing_selection').val();
                console.log("wing "+wing_id);
                // alert(wing_id);
                session_id = $('#sessions').val();
                console.log("session "+session_id);
                // alert(session_id);

                var myurl ='';
                if(index_id)
                {
                    myurl= '/getBISERegisteredInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                else
                {
                    myurl = 'getBISERegisteredInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                $.ajax({

                    method:'GET',
                    data:{},
                    url:myurl,
                    success:function(response){
                        for(var i=0;i<response.output.length;i++){
                          
                         // $('#BISE_course_enrolled_in_cfe').append($('<option selected></option>').attr('value', ).text(response.output[i].name));
                          // document.getElementById('BISE_course_enrolled_in_cfe').value = response.output[i].od;
                          $("#bise_course_registered_in option[value="+response.output[i].id+"]").prop("selected", "selected")
                        }       
                    }, 
                    error:function(response){

                    }
                });
            }
        }

           //VTI Course Enrolled ...
        function getVTIEnrolledInfo(){
            if(index_id){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                var wing_id =0;
                var session_id =0;
                wing_id = $('#cfe_wing_selection').val();
                console.log("wing "+wing_id);
                // alert(wing_id);
                session_id = $('#sessions').val();
                console.log("session "+session_id);
                // alert(session_id);

                var myurl ='';
                if(index_id)
                {
                    myurl= '/getVTIEnrolledInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                else
                {
                    myurl = 'getVTIEnrolledInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                $.ajax({

                    method:'GET',
                    data:{},
                    url:myurl,
                    success:function(response){
                        for(var i=0;i<response.output.length;i++){
                          
                         // $('#VTi_course_enrolled_in_cfe').append($('<option selected></option>').attr('value', ).text(response.output[i].name));
                          // document.getElementById('VTi_course_enrolled_in_cfe').value = response.output[i].od;
                          $("#vti_diploma_enrolled_in option[value="+response.output[i].id+"]").prop("selected", "selected")
                        }       
                    }, 
                    error:function(response){

                    }
                });
            }
        }

        // VTI Course  registered ...
        function getVTIRegisteredInfo(){
            if(index_id){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                var wing_id =0;
                var session_id =0;
                wing_id = $('#cfe_wing_selection').val();
                console.log("wing "+wing_id);
                // alert(wing_id);
                session_id = $('#sessions').val();
                console.log("session "+session_id);
                // alert(session_id);

                var myurl ='';
                if(index_id)
                {
                    myurl= '/getVTIRegisteredInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                else
                {
                    myurl = 'getVTIRegisteredInfo/'+wing_id+'/'+session_id+'/'+index_id;
                }
                $.ajax({

                    method:'GET',
                    data:{},
                    url:myurl,
                    success:function(response){
                        for(var i=0;i<response.output.length;i++){
                          
                         // $('#VTi_course_enrolled_in_cfe').append($('<option selected></option>').attr('value', ).text(response.output[i].name));
                          // document.getElementById('VTi_course_enrolled_in_cfe').value = response.output[i].od;
                          $("#vti_diploma_registered_in option[value="+response.output[i].id+"]").prop("selected", "selected")
                        }       
                    }, 
                    error:function(response){

                    }
                });
            }
        }



        // IMS
        function getAcademicTerm(){
            // alert();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var imsAffiliatedBody = '';
            // check wing
            // var wing_name =$('#cfe_wing_selection').val();
            // alert(wing_name);
            // if(wing_name == 1){
            //     imsAffiliatedBody = $('#af_affiliated_body').val();
            // }
            // else if(wing_name == 2){
            //     imsAffiliatedBody = $('#bise_affiliated_body').val();
            // }
            // else if(wing_name ==3){
            //     imsAffiliatedBody = $('#ims_affiliated_body').val();
            // }else if (wing_name == 4){
            //     imsAffiliatedBody = $('#vti_affiliated_body').val();
            // }
            imsAffiliatedBody = $('#ims_affiliated_body').val();
            console.log("imsAffiliatedBody "+imsAffiliatedBody);
            //alert(imsAffiliatedBody);
            var wing_id =0;
            wing_id = $('#cfe_wing_selection').val();
            console.log("wing "+wing_id);
            //alert(wing_id);
            var course_id ='';
            course_id = $('#ims_course_applied_in_cfe').val();
            console.log('course id '+course_id);
            //alert(course_id);
            var c_url = '';
            if(index_id){
                c_url = '/getAcademicTerm/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }else{
                c_url = 'getAcademicTerm/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }
            $.ajax({

                method:'GET',
                data:{},
                url:c_url,
                success:function(data){
                    console.log('success');
                    console.log(data);
                    // alert(data[0].academic_term_id);

                    $('#ims_academic_term').val(data[0].academic_term_id);
                    if($('#cfe_wing_selection').val() == '3'){

                        $('#course_selected_from_page_07').val($('#ims_course_applied_in_cfe').val())
                        $('#course_selected_from_page_07_name').val($('#ims_course_applied_in_cfe option:selected').text());
                        $('#course_registered_selected_from_page_07').val($('#ims_course_registered').val());
                        $('#course_enrolled_selected_from_page_07').val($('#ims_course_enrolled_in_cfe').val());
                        $('#affiliated_body_selected_from_page_07').val($('#ims_affiliated_body').val());
                        $('#annual_semester_selected_from_page_07').val($('#ims_academic_term').val());
                        // alert(data[0].session_end_date);

                        var now = new Date(data[0].session_end_date);
                        var past = new Date(data[0].session_start_date);
                        var nowYear = now.getFullYear();
                        var pastYear = past.getFullYear();
                        var years = nowYear - pastYear;
                        // total_sem_count = years;
                        // alert(getTotalSessionDuration);
                        getTotalSessionDuration = years;
                        $('#ims_duration_of_course').val(getTotalSessionDuration + ' Years');
                        // $('#af_duration_of_course').val(getTotalSessionDuration + ' Years');
                        // $('#bise_duration_of_course').val(getTotalSessionDuration + ' Years');
                        // $('#vti_duration_of_diploma').val(1 + ' Years');




                    }else if($('#cfe_wing_selection').val() == '1'){

                    }else if($('#cfe_wing_selection').val() == '2'){

                    }else if($('#cfe_wing_selection').val() == '4'){

                    }
                    setImsSemesterCategoryDisplay();
                    getAnnualSemesterCount();

                },
                error:function(data){
                    console.log('error');
                }
            });

        }
        //IMS
        function getAnnualSemesterCount(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var imsAffiliatedBody = '';
            imsAffiliatedBody = $('#ims_affiliated_body').val();
            console.log("imsAffiliatedBody "+imsAffiliatedBody);
            var wing_id =0;
            wing_id = $('#cfe_wing_selection').val();
            console.log("wing "+wing_id);
            var course_id ='';
            course_id = $('#ims_course_applied_in_cfe').val();
            console.log('course id '+course_id);
            var c_url = '';
            if(index_id){
                c_url = '/getAnnualSemesterCount/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }
            else{
                c_url = 'getAnnualSemesterCount/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }
            $.ajax({

                method:'GET',
                data:{},
                url:c_url,
                success:function(data){

                    console.log('success');
                    console.log(data);
                    total_sem_count = data;
                    var checkSem = $('#ims_academic_term').val();
                    // if(checkSem == 1){
                    //     if(total_sem_count == 1){
                    //         $('#ims_duration_of_course').val('0.5 Years');
                    //     }
                    //     else if(total_sem_count == 2){
                    //         $('#ims_duration_of_course').val('1 Years');
                    //     }
                    //     else if(total_sem_count == 3){
                    //         $('#ims_duration_of_course').val('1.5 Years');
                    //     }
                    //     else if(total_sem_count == 4){
                    //         $('#ims_duration_of_course').val('2 Years');
                    //     }
                    //     else if(total_sem_count == 5){
                    //         $('#ims_duration_of_course').val('2.5 Years');
                    //     }
                    //     else if(total_sem_count == 6){
                    //         $('#ims_duration_of_course').val('3 Years');
                    //     }
                    //     else if(total_sem_count == 7){
                    //         $('#ims_duration_of_course').val('3.5 Years');
                    //     }
                    //     else if(total_sem_count == 8){
                    //         $('#ims_duration_of_course').val('4 Years');
                    //     }
                    // }
                    // else if(checkSem == 0){
                    //     $('#ims_duration_of_course').val(total_sem_count +' Years');
                    // }

                    // if(checkSem == 1){
                    //         $('#ims_duration_of_course').val(getTotalSessionDuration + ' Years');
                    // }
                    // else if(checkSem == 0){
                    //     $('#ims_duration_of_course').val(getTotalSessionDuration + ' Years');
                    // }

                },
                error:function(data){
                    console.log('error');
                }
            });
        }

        // AF
        function getAcademicTerm_af(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var imsAffiliatedBody = '';
            // check wing
            // var wing_name =$('#cfe_wing_selection').val();
            // alert(wing_name);
            // if(wing_name == 1){
            //     imsAffiliatedBody = $('#af_affiliated_body').val();
            // }
            // else if(wing_name == 2){
            //     imsAffiliatedBody = $('#bise_affiliated_body').val();
            // }
            // else if(wing_name ==3){
            //     imsAffiliatedBody = $('#ims_affiliated_body').val();
            // }else if (wing_name == 4){
            //     imsAffiliatedBody = $('#vti_affiliated_body').val();
            // }
            imsAffiliatedBody = $('#af_affiliated_body').val();
            console.log("afAffiliatedBody "+imsAffiliatedBody);
            var wing_id =0;
            wing_id = $('#cfe_wing_selection').val();
            console.log("wing "+wing_id);
            var course_id ='';
            course_id = $('#af_course_applied_in').val();
            console.log('course id '+course_id);
            if(index_id){
                c_url = '/getAcademicTerm/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }
            else{
                c_url = 'getAcademicTerm/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }
            $.ajax({

                method:'GET',
                data:{},
                url:c_url,
                success:function(data){
                    console.log('success');
                    console.log(data);
                    console.log(data[0].academic_term_id);
                    $('#af_academic_term').val(data[0].academic_term_id);
                    if($('#cfe_wing_selection').val() == '3'){

                    }else if($('#cfe_wing_selection').val() == '1'){
                        $('#course_selected_from_page_07').val($('#af_course_applied_in').val());
                        $('#course_selected_from_page_07_name').val($('#af_course_applied_in option:selected').text());
                        $('#course_registered_selected_from_page_07').val($('#af_course_registered_in').val());
                        $('#course_enrolled_selected_from_page_07').val($('#af_course_enrolled_in').val());
                        $('#affiliated_body_selected_from_page_07').val($('#af_affiliated_body').val());
                        $('#annual_semester_selected_from_page_07').val($('#af_academic_term').val());
                        var now = new Date(data[0].session_end_date);
                        var past = new Date(data[0].session_start_date);
                        var nowYear = now.getFullYear();
                        var pastYear = past.getFullYear();
                        var years = nowYear - pastYear;
                        // total_sem_count = years;
                        // alert(getTotalSessionDuration);
                        getTotalSessionDuration = 1;
                        $('#af_duration_of_course').val(getTotalSessionDuration + ' Years');
                        // $('#af_duration_of_course').val(getTotalSessionDuration + ' Years');
                        // $('#bise_duration_of_course').val(getTotalSessionDuration + ' Years');
                        // $('#vti_duration_of_diploma').val(1 + ' Years');
                    }else if($('#cfe_wing_selection').val() == '2'){

                    }else if($('#cfe_wing_selection').val() == '4'){

                    }
                    setAFSemesterCategoryDisplay();
                    getAnnualSemesterCount_af();
                },
                error:function(data){
                    console.log('error');
                }
            });
        }
        //AF checking Ali
        function getAnnualSemesterCount_af(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var imsAffiliatedBody = '';
            imsAffiliatedBody = $('#af_affiliated_body').val();
            console.log("afAffiliatedBody "+imsAffiliatedBody);
            var wing_id =0;
            wing_id = $('#cfe_wing_selection').val();
            console.log("wing "+wing_id);
            var course_id ='';
            course_id = $('#af_course_applied_in').val();
            console.log('course id '+course_id);
            if(index_id){
                c_url = '/getAnnualSemesterCount/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }
            else{
                c_url = 'getAnnualSemesterCount/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }
            $.ajax({

                method:'GET',
                data:{},
                url:c_url,
                success:function(data){
                    console.log('success');
                    console.log(data);
                    total_sem_count = data;
                    var checkSem = $('#af_academic_term').val();

                    // if(checkSem == 1){
                    //     if(total_sem_count == 1){
                    //         $('#af_duration_of_course').val('0.5 Years');
                    //     }
                    //     else if(total_sem_count == 2){
                    //         $('#af_duration_of_course').val('1 Years');
                    //     }
                    //     else if(total_sem_count == 3){
                    //         $('#af_duration_of_course').val('1.5 Years');
                    //     }
                    //     else if(total_sem_count == 4){
                    //         $('#af_duration_of_course').val('2 Years');
                    //     }
                    //     else if(total_sem_count == 5){
                    //         $('#af_duration_of_course').val('2.5 Years');
                    //     }
                    //     else if(total_sem_count == 6){
                    //         $('#af_duration_of_course').val('3 Years');
                    //     }
                    //     else if(total_sem_count == 7){
                    //         $('#af_duration_of_course').val('3.5 Years');
                    //     }
                    //     else if(total_sem_count == 8){
                    //         $('#af_duration_of_course').val('4 Years');
                    //     }
                    // }
                    // else if(checkSem == 0){
                    //     $('#af_duration_of_course').val(total_sem_count +' Years');
                    // }



                },
                error:function(data){
                    console.log('error');
                }
            });
        }


        // BISE
        function getAcademicTerm_bise(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var imsAffiliatedBody = '';
            // check wing
            // var wing_name =$('#cfe_wing_selection').val();
            // alert(wing_name);
            // if(wing_name == 1){
            //     imsAffiliatedBody = $('#af_affiliated_body').val();
            // }
            // else if(wing_name == 2){
            //     imsAffiliatedBody = $('#bise_affiliated_body').val();
            // }
            // else if(wing_name ==3){
            //     imsAffiliatedBody = $('#ims_affiliated_body').val();
            // }else if (wing_name == 4){
            //     imsAffiliatedBody = $('#vti_affiliated_body').val();
            // }
            imsAffiliatedBody = $('#bise_affiliated_body').val();
            // alert(imsAffiliatedBody);
            console.log("afAffiliatedBody "+imsAffiliatedBody);
            var wing_id =0;
            wing_id = $('#cfe_wing_selection').val();
            console.log("wing "+wing_id);
            var course_id ='';
            course_id = $('#bise_course_applied_in').val();
            // alert(course_id);
            console.log('course id '+course_id);
            if(index_id){
                c_url = '/getAcademicTerm/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }
            else{
                c_url = 'getAcademicTerm/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }
            $.ajax({

                method:'GET',
                data:{},
                url:c_url,
                success:function(data){
                    console.log('success');
                    console.log(data);
                    console.log(data[0].academic_term_id);
                    $('#bise_academic_term').val(data[0].academic_term_id);
                    if($('#cfe_wing_selection').val() == '3'){

                    }else if($('#cfe_wing_selection').val() == '1'){

                    }else if($('#cfe_wing_selection').val() == '2'){
                        $('#course_selected_from_page_07').val($('#bise_course_applied_in').val());
                        $('#course_selected_from_page_07_name').val($('#bise_course_applied_in option:selected').text());
                        $('#course_registered_selected_from_page_07').val($('#bise_course_registered_in').val());
                        $('#course_enrolled_selected_from_page_07').val($('#bise_course_enrolled_cfe').val());
                        $('#affiliated_body_selected_from_page_07').val($('#bise_affiliated_body').val());
                        $('#annual_semester_selected_from_page_07').val($('#bise_academic_term').val());
                        var now = new Date(data[0].session_end_date);
                        var past = new Date(data[0].session_start_date);
                        var nowYear = now.getFullYear();
                        var pastYear = past.getFullYear();
                        var years = nowYear - pastYear;

                        // total_sem_count = years;
                        // alert(getTotalSessionDuration);
                        getTotalSessionDuration = years;
                        $('#bise_duration_of_course').val(getTotalSessionDuration + ' Years');
                        // $('#af_duration_of_course').val(getTotalSessionDuration + ' Years');
                        // $('#bise_duration_of_course').val(getTotalSessionDuration + ' Years');
                        // $('#vti_duration_of_diploma').val(1 + ' Years');
                    }else if($('#cfe_wing_selection').val() == '4'){

                    }
                    // setDisplayForAnnualAndSemester();
                    setDisplayForAnnualAndSemester();
                    getAnnualSemesterCount_bise();
                },
                error:function(data){
                    console.log('error');
                }
            });
        }
        //BISE
        function getAnnualSemesterCount_bise(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var imsAffiliatedBody = '';
            imsAffiliatedBody = $('#bise_affiliated_body').val();
            console.log("afAffiliatedBody "+imsAffiliatedBody);
            var wing_id =0;
            wing_id = $('#cfe_wing_selection').val();
            console.log("wing "+wing_id);
            var course_id ='';
            course_id = $('#bise_course_applied_in').val();
            console.log('course id '+course_id);
            var c_url = 0;
            if(index_id) {
                c_url = '/getAnnualSemesterCount/' + imsAffiliatedBody + '/' + wing_id + '/' + course_id;
            }else{
                c_url ='getAnnualSemesterCount/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }
            $.ajax({

                method:'GET',
                data:{},
                url: c_url,
                success:function(data){
                    console.log('success');
                    console.log(data);
                    total_sem_count = data;
                    var checkSem = $('#bise_academic_term').val();
                    // if(checkSem == 1){
                    //     if(total_sem_count == 1){
                    //         $('#bise_duration_of_course').val('0.5 Years');
                    //     }
                    //     else if(total_sem_count == 2){
                    //         $('#bise_duration_of_course').val('1 Years');
                    //     }
                    //     else if(total_sem_count == 3){
                    //         $('#bise_duration_of_course').val('1.5 Years');
                    //     }
                    //     else if(total_sem_count == 4){
                    //         $('#bise_duration_of_course').val('2 Years');
                    //     }
                    //     else if(total_sem_count == 5){
                    //         $('#bise_duration_of_course').val('2.5 Years');
                    //     }
                    //     else if(total_sem_count == 6){
                    //         $('#bise_duration_of_course').val('3 Years');
                    //     }
                    //     else if(total_sem_count == 7){
                    //         $('#bise_duration_of_course').val('3.5 Years');
                    //     }
                    //     else if(total_sem_count == 8){
                    //         $('#bise_duration_of_course').val('4 Years');
                    //     }
                    // }
                    // else if(checkSem == 0){
                    //     $('#bise_duration_of_course').val(total_sem_count +' Years');
                    // }

                },
                error:function(data){
                    console.log('error');
                }
            });
        }

        // vti
        function getAcademicTerm_vti(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var imsAffiliatedBody = '';
            imsAffiliatedBody = $('#vti_affiliated_body').val();
            console.log("afAffiliatedBody "+imsAffiliatedBody);
            var wing_id =0;
            wing_id = $('#cfe_wing_selection').val();
            console.log("wing "+wing_id);
            var course_id ='';
            course_id = $('#vti_diploma_applied_in').val();
            console.log('course id '+course_id);
            if(index_id){
                c_url = '/getAcademicTerm/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }
            else{
                c_url = 'getAcademicTerm/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }
            $.ajax({

                method:'GET',
                data:{},
                url:c_url,
                success:function(data){
                    console.log('success');
                    console.log(data);
                    console.log(data[0].academic_term_id);
                    //As toled The VTI will remain 1 Annual
                    $('#vti_scheme_of_study').val(data[0].academic_term_id);
                    //$('#vti_scheme_of_study').val(0);
                    if($('#cfe_wing_selection').val() == '3'){

                    }else if($('#cfe_wing_selection').val() == '1'){

                    }else if($('#cfe_wing_selection').val() == '2'){

                    }else if($('#cfe_wing_selection').val() == '4'){
                        $('#course_selected_from_page_07').val($('#vti_diploma_applied_in').val());
                        $('#course_selected_from_page_07_name').val($('#vti_diploma_applied_in option:selected').text());
                        $('#course_registered_selected_from_page_07').val($('#vti_diploma_registered_in').val());
                        $('#course_enrolled_selected_from_page_07').val($('#vti_diploma_enrolled_in').val());
                        $('#affiliated_body_selected_from_page_07').val($('#vti_affiliated_body').val());
                        $('#annual_semester_selected_from_page_07').val($('#vti_scheme_of_study').val());
                        var now = new Date(data[0].session_end_date);
                        var past = new Date(data[0].session_start_date);
                        var nowYear = now.getFullYear();
                        var pastYear = past.getFullYear();
                        var years = nowYear - pastYear;
                        // total_sem_count = years;
                        // alert(getTotalSessionDuration);
                        if(years == 0){
                            years = 1;
                        }
                        getTotalSessionDuration = years;
                        $('#vti_duration_of_diploma').val(getTotalSessionDuration + ' Year');
                        // $('#af_duration_of_course').val(getTotalSessionDuration + ' Years');
                        // $('#bise_duration_of_course').val(getTotalSessionDuration + ' Years');
                        // $('#vti_duration_of_diploma').val(1 + ' Years');
                    }
                    setVtiDualSemesterCategoryDisplay();
                    getAnnualSemesterCount_vti();
                },
                error:function(data){
                    console.log('error');
                }
            });
        }
        //vti cccc
        function getAnnualSemesterCount_vti(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var imsAffiliatedBody = '';
            imsAffiliatedBody = $('#vti_affiliated_body').val();
            console.log("afAffiliatedBody "+imsAffiliatedBody);
            var wing_id =0;
            wing_id = $('#cfe_wing_selection').val();
            console.log("wing "+wing_id);
            var course_id ='';
            course_id = $('#vti_diploma_applied_in').val();
            console.log('course id '+course_id);
            if(index_id){
                c_url = '/getAnnualSemesterCount/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }
            else{
                c_url = 'getAnnualSemesterCount/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
            }
            $.ajax({

                method:'GET',
                data:{},
                url:c_url,
                success:function(data){
                    console.log('success');
                    console.log(data);
                    total_sem_count = data;
                    var checkSem = $('#vti_scheme_of_study').val();
                    // if(checkSem == 1){
                    //     if(total_sem_count == 1){
                    //         $('#vti_duration_of_diploma').val('0.5 Years');
                    //     }
                    //     else if(total_sem_count == 2){
                    //         $('#vti_duration_of_diploma').val('1 Years');
                    //     }
                    //     else if(total_sem_count == 3){
                    //         $('#vti_duration_of_diploma').val('1.5 Years');
                    //     }
                    //     else if(total_sem_count == 4){
                    //         $('#vti_duration_of_diploma').val('2 Years');
                    //     }
                    //     else if(total_sem_count == 5){
                    //         $('#vti_duration_of_diploma').val('2.5 Years');
                    //     }
                    //     else if(total_sem_count == 6){
                    //         $('#vti_duration_of_diploma').val('3 Years');
                    //     }
                    //     else if(total_sem_count == 7){
                    //         $('#vti_duration_of_diploma').val('3.5 Years');
                    //     }
                    //     else if(total_sem_count == 8){
                    //         $('#vti_duration_of_diploma').val('4 Years');
                    //     }
                    // }
                    // else if(checkSem == 0){
                    //     $('#vti_duration_of_diploma').val(total_sem_count +' Years');
                    // }
                    // Hard Corded as was said it is of single annual .
                    // total_sem_count = 1;



                },
                error:function(data){
                    console.log('error');
                }
            });
        }

        function setBiseFieldsDisplay() {
            let selected = $('#bise_course_applied option:selected').val();
            if(selected == 'ics'){
                $('#bise_optional_subject_div').fadeIn();
                $('.bise_optional_subject').fadeIn();
                $('#bise_others_div').fadeOut();
            }
            else
            if(selected == 'fa'){
                $('#bise_optional_subject_div').fadeIn();
                $('#bise_others_div').fadeIn();
            }
            else{
                $('#bise_optional_subject_div').fadeOut();
                $('#bise_others_div').fadeOut();
            }


            if(!index_id){
                $('#bise_admission_date').val('');
                $('#bise_ending_date').val('');
            }

            selectAffiliatedBodyId_bise();
        }

        function setVtiFieldsDisplay() {
            let selected = $('#vti_reason option:selected').val();
            if(selected == 'lessService'){
                $('#vti_further_file_div').fadeIn();
            }
            else{
                $('#vti_further_file_div').fadeOut();
                $('#vti_follow_up_date').fadeOut();
            }
        }
        function setVtiFollowUpDate() {
            let selected = $('#vti_further_file_received option:selected').val();
            if(selected == 'yes'){
                $('#vti_follow_up_date').fadeIn();
            }
            else{
                $('#vti_follow_up_date').fadeOut();
            }
        }

        function setDualCoursePageDisplay() {
            let selected = $('#vti_dual_course option:selected').val();
            let parent = $('#cfe_wing_selection option:selected').val();
            if(selected == 'yes' && parent == '4'){
                $('#dual_course_div').fadeIn();
                // if(container_array.indexOf('#page_11') === -1) {
                //     container_array.splice(7, 0, '#page_11');
                //     api_url_array.splice(7, 0, '/dual_course-details');
                // }
            }
            else{
                $('#dual_course_div').fadeOut();
                // $('#page_11').attr('style','display:none');
                // container_array.splice(7,1);
                // api_url_array.splice(7,1);
            }
        }

        function setDisplayForAnnualAndSemester() {

            //clearing All Pages for annual and semester
            for(let index = 15; index <= 24 ;index++){
                $('#page_'+index).hide();
            }
            container_array.splice(10,container_array.length - 10);
            api_url_array.splice(10,api_url_array.length - 10);
            let term_array = {
                '2': '#bise_academic_term',
                '3': '#ims_academic_term',
                '1': '#af_academic_term',
                '4': '#vti_scheme_of_study'
            };
            let parent = $('#cfe_wing_selection option:selected').val();
            let selectedTerm = $(term_array[parent]).val();
            if(selectedTerm == '0'){
                // alert();
                if(index_id == ''){
                    container_array.splice(10, 0, '#page_15');
                    api_url_array.splice(10, 0, '/annual-part-one');

                    $('.semester-tab').remove();
                    // $('#v-pills-page_14').show();
                    $('#v-pills-page_15-tab').remove();
                    $('#v-pills-page_25-tab').remove();
                    $('#v-pills-tab').append('<a style=" pointer-events: none;" onclick="enableNext();" class="nav-link annual-tab aa" id="v-pills-page_15-tab" data-toggle="pill" href="#v-pills-page_15" role="tab" aria-controls="v-pills-page_15" aria-selected="true">Annual Part 1</a><a  onclick="enableSave();" class="nav-link annual-tab annual-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                    sessionStorage.setItem("semester_check", "");
                }
                else{
                    // alert('check annual');
                    var annual1 =$('#annual1').val();
                    var annual2 =$('#annual2').val();

                    // Annual 1
                    if(annual1 == index_id){
                        // alert('1');
                        container_array.splice(10, 0, '#page_15');
                        api_url_array.splice(10, 0, '/annual-part-one');
                        $('.annual-tab-conversion').remove();
                        $('.semester-tab').remove();

                        $('#v-pills-tab').append('<a style=" pointer-events: none;" onclick="enableNext();"  class="nav-link annual-tab aa" id="v-pills-page_15-tab" data-toggle="pill" href="#v-pills-page_15" role="tab" aria-controls="v-pills-page_15" aria-selected="true">Annual Part 1</a><a onclick="enableSave();" class="nav-link annual-tab annual-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                        $('#page_15').attr('style', 'display:block');
                        // $('#v-pills-page_17').addClass('active');
                        sessionStorage.setItem("semester_check", "");

                        // var sem_reach = '#v-pills-page_17';
                        //
                        // $(sem_reach.toString()).addClass("show");
                        // // $(sem_reach.toString()).addClass("active");
                        //
                        // // $('.nav-pills a[href="'+sem_reach+'"]').addClass("active"); // add class active to the next pill
                        //
                        // $(sem_reach.toString()).attr('style', 'display:block');
                        // console.log('ali');
                        // var sem1 = '<h3>qqqqqq</h3>';
                    }

                    // Annual 2
                    if(annual2 == index_id){
                        // alert('2');
                        container_array.splice(10, 0, '#page_16');
                        api_url_array.splice(10, 0, '/annual-part-two');
                        $('.annual-tab-conversion').remove();
                        $('.semester-tab').remove();
                        $('#page_16').attr('style', 'display:block');
                        $('#v-pills-tab').append('<a onclick="enableNext();" class="nav-link annual-tab aa" id="v-pills-page_16-tab" data-toggle="pill" href="#v-pills-page_16" role="tab" aria-controls="v-pills-page_16" aria-selected="true">Continue 1(Annual Part 2)</a><a onclick="enableSave();" class="nav-link annual-tab annual-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');

                    }
                }
            }
            else if(selectedTerm == '1'){
                check_for_once_run += 1;
                // alert(check_for_once_run);
                // ALi Naeem Edit.
                // original Start.
                // container_array.splice(10, 0, '#page_17');
                // api_url_array.splice(10, 0, '/first-semester');
                // $('.annual-tab').remove();
                // $('#v-pills-tab').append('<a class="nav-link semester-tab aa" id="v-pills-page_17-tab" data-toggle="pill" href="#v-pills-page_17" role="tab" aria-controls="v-pills-page_17" aria-selected="true">1st Semester</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>')
                //
                //
                // sessionStorage.setItem("semester_check", "/first-semester");
                // ALi Naeem Edit.
                // if(check_for_once_run == 2){
                if(index_id == ''){
                    container_array.splice(10, 0, '#page_17');
                    api_url_array.splice(10, 0, '/first-semester');
                    $('.annual-tab').remove();
                    $('#v-pills-page_17-tab').remove();
                    $('#v-pills-page_25-tab').remove();
                    $('#v-pills-tab').append('<a class="nav-link semester-tab aa" id="v-pills-page_17-tab" data-toggle="pill" href="#v-pills-page_17" role="tab" aria-controls="v-pills-page_17" aria-selected="true">1st Semester</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>')


                    sessionStorage.setItem("semester_check", "/first-semester");
                }else {
                    var semester1 =$('#semester1').val();
                    var semester2 =$('#semester2').val();
                    var semester3 =$('#semester3').val();
                    var semester4 =$('#semester4').val();
                    var semester5 =$('#semester5').val();
                    var semester6 =$('#semester6').val();
                    var semester7 =$('#semester7').val();
                    var semester8 =$('#semester8').val();
                    // Semester 1
                    if(semester1 == index_id){
                        container_array.splice(10, 0, '#page_17');
                        api_url_array.splice(10, 0, '/first-semester');
                        $('.semester-tab-conversion').remove();
                        $('.annual-tab').remove();

                        $('#v-pills-tab').append('<a class="nav-link semester-tab aa" id="v-pills-page_17-tab" data-toggle="pill" href="#v-pills-page_17" role="tab" aria-controls="v-pills-page_17" aria-selected="true">1st Semester</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');
                        $('#page_17').attr('style', 'display:block');
                        // $('#v-pills-page_17').addClass('active');
                        sessionStorage.setItem("semester_check", "/first-semester");
                        // var sem_reach = '#v-pills-page_17';
                        //
                        // $(sem_reach.toString()).addClass("show");
                        // // $(sem_reach.toString()).addClass("active");
                        //
                        // // $('.nav-pills a[href="'+sem_reach+'"]').addClass("active"); // add class active to the next pill
                        //
                        // $(sem_reach.toString()).attr('style', 'display:block');
                        // console.log('ali');
                        // var sem1 = '<h3>qqqqqq</h3>';
                    }

                    // Semester 2
                    if(semester2 == index_id){

                        container_array.splice(10, 0, '#page_18');
                        api_url_array.splice(10, 0, '/second-semester');
                        $('.semester-tab-conversion').remove();
                        $('.annual-tab').remove();

                        $('#v-pills-tab').append('<a class="nav-link semester-tab aa" id="v-pills-page_18-tab" data-toggle="pill" href="#v-pills-page_18" role="tab" aria-controls="v-pills-page_18" aria-selected="true">Continue 1(Second Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');

                    }

                    // Semester 3
                    if(semester3 == index_id){
                        container_array.splice(10, 0, '#page_19');
                        api_url_array.splice(10, 0, '/third-semester');
                        $('.semester-tab-conversion').remove();
                        $('.annual-tab').remove();
                        $('#v-pills-tab').append('<a class="nav-link semester-tab aa" id="v-pills-page_19-tab" data-toggle="pill" href="#v-pills-page_19" role="tab" aria-controls="v-pills-page_19" aria-selected="true">Continue 1(Third Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');

                    }

                    // Semester 4
                    if(semester4 == index_id){
                        container_array.splice(10, 0, '#page_20');
                        api_url_array.splice(10, 0, '/fourth-semester');
                        $('.semester-tab-conversion').remove();
                        $('.annual-tab').remove();
                        $('#v-pills-tab').append('<a class="nav-link semester-tab aa" id="v-pills-page_20-tab" data-toggle="pill" href="#v-pills-page_20" role="tab" aria-controls="v-pills-page_20" aria-selected="true">Continue 1(Fourth Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');

                    }

                    // Semester 5
                    if(semester5 == index_id){
                        container_array.splice(10, 0, '#page_21');
                        api_url_array.splice(10, 0, '/fifth-semester');
                        $('.semester-tab-conversion').remove();
                        $('.annual-tab').remove();
                        $('#v-pills-tab').append('<a class="nav-link semester-tab aa" id="v-pills-page_21-tab" data-toggle="pill" href="#v-pills-page_21" role="tab" aria-controls="v-pills-page_21" aria-selected="true">Continue 1(Fifth Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');

                    }

                    // Semester 6
                    if(semester6 == index_id){
                        container_array.splice(10, 0, '#page_22');
                        api_url_array.splice(10, 0, '/sixth-semester');
                        $('.semester-tab-conversion').remove();
                        $('.annual-tab').remove();
                        $('#v-pills-tab').append('<a class="nav-link semester-tab aa" id="v-pills-page_22-tab" data-toggle="pill" href="#v-pills-page_22" role="tab" aria-controls="v-pills-page_22" aria-selected="true">Continue 1(Sixth Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');

                    }

                    // Semester 7
                    if(semester7 == index_id){
                        container_array.splice(10, 0, '#page_23');
                        api_url_array.splice(10, 0, '/seventh-semester');
                        $('.semester-tab-conversion').remove();
                        $('.annual-tab').remove();
                        $('#v-pills-tab').append('<a class="nav-link semester-tab aa" id="v-pills-page_23-tab" data-toggle="pill" href="#v-pills-page_23" role="tab" aria-controls="v-pills-page_23" aria-selected="true">Continue 1(Seventh Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');

                    }

                    // Semester 8
                    if(semester8 == index_id){
                        container_array.splice(10, 0, '#page_24');
                        api_url_array.splice(10, 0, '/eighth-semester');
                        $('.semester-tab-conversion').remove();
                        $('.annual-tab').remove();
                        $('#v-pills-tab').append('<a class="nav-link semester-tab aa" id="v-pills-page_24-tab" data-toggle="pill" href="#v-pills-page_24" role="tab" aria-controls="v-pills-page_24" aria-selected="true">Continue 1(Eighth Semester)</a><a class="nav-link semester-tab semester-tab-conversion aa" id="v-pills-page_25-tab" data-toggle="pill" href="#v-pills-page_25" role="tab" aria-controls="v-pills-page_25" aria-selected="true">Conversion in Next Degree</a>');

                    }
                    // }
                }


            }
            setDisplayForButtons();
            $('input[name="next_appearance_date[]"').datepicker({
                format:'dd/mm/yyyy',
                startDate: new Date(),
                autoclose: true
            });
            $('input[name="last_chance_date[]"').datepicker({
                format:'dd/mm/yyyy',
                startDate: new Date(),
                autoclose: true
            });


            $('.datepicker__').datepicker({
                format:'dd/mm/yyyy',
                // startDate: new Date(),
                autoclose: true
            });
            setBiseRsegistrationDateDisplay();
        }

        function setTotalFeeBise() {
            $('#actual_fee_bise').val(numericOnlyByVal($('#actual_fee_bise').val()));
            $('#late_fee_bise').val(numericOnlyByVal($('#late_fee_bise').val()));
            let actual = $('#actual_fee_bise').val();
            let late = $('#late_fee_bise').val();
            $('#total_fee_bise').val(parseInt(actual)+parseInt(late));
        }
        function setTotalFeeIms() {
            $('#actual_fee_ims').val(numericOnlyByVal($('#actual_fee_ims').val()));
            $('#late_fee_ims').val(numericOnlyByVal($('#late_fee_ims').val()));
            let actual = $('#actual_fee_ims').val();
            let late = $('#late_fee_ims').val();
            $('#total_fee_ims').val(parseInt(actual)+parseInt(late));
        }
        function setTotalFeeAf() {
            $('#actual_fee_af').val(numericOnlyByVal($('#actual_fee_af').val()));
            $('#late_fee_af').val(numericOnlyByVal($('#late_fee_af').val()));
            let actual = $('#actual_fee_af').val();
            let late = $('#late_fee_af').val();
            $('#total_fee_af').val(parseInt(actual)+parseInt(late));
        }
        function setTotalFeeVti() {
            $('#actual_fee_vti').val(numericOnlyByVal($('#actual_fee_vti').val()));
            $('#late_fee_vti').val(numericOnlyByVal($('#late_fee_vti').val()));
            let actual = $('#actual_fee_vti').val();
            let late = $('#late_fee_vti').val();
            $('#total_fee_vti').val(parseInt(actual)+parseInt(late));
        }

        function setTotalFeeDualCourse() {
            $('#actual_fee_dual').val(numericOnlyByVal($('#actual_fee_dual').val()));
            $('#late_fee_dual').val(numericOnlyByVal($('#late_fee_dual').val()));
            let actual = $('#actual_fee_dual').val();
            let late = $('#late_fee_dual').val();
            $('#total_fee_dual').val(parseInt(actual)+parseInt(late));
        }

        function setPercentageForDualCourse() {
            $('#previous_total_marks_dual').val(numericOnlyByVal($('#previous_total_marks_dual').val()));
            $('#previous_marks_obtained_dual').val(numericOnlyByVal($('#previous_marks_obtained_dual').val()));
            let total = parseInt($('#previous_total_marks_dual').val());
            let obtained = parseInt($('#previous_marks_obtained_dual').val());
            // console.log(total);
            // console.log(obtained);
            // console.log(total < obtained);
            if(total < obtained)
            {
                $('#previous_marks_obtained_dual').val('');
                $('#previous_cgpa_dual').val('');
            }
            if(total != 0 && obtained != NaN)
                $('#previous_cgpa_dual').val((parseInt(obtained)/parseInt(total) * 100).toFixed(2));
            else
            {
                $('#previous_cgpa_dual').val('');
            }
        }

        function setPercentageForBise() {
            var previous_total_marks_bise_check = $('#previous_total_marks_bise').val();
            var previous_marks_obtained_bise_check = $('#previous_marks_obtained_bise').val();
            if(previous_total_marks_bise_check < previous_marks_obtained_bise_check){
                
            }
            $('#previous_total_marks_bise').val(numericOnlyByVal($('#previous_total_marks_bise').val()));
            $('#previous_marks_obtained_bise').val(numericOnlyByVal($('#previous_marks_obtained_bise').val()));
            let total = parseInt($('#previous_total_marks_bise').val());
            let obtained = parseInt($('#previous_marks_obtained_bise').val());
            // console.log(total);
            // console.log(obtained);
            // console.log(total < obtained);
            if(total < obtained)
            {
                alert('Total marks should be greater than Obtained Marks.');
                $('#previous_marks_obtained_bise').val('');
                $('#previous_cgpa_bise').val('');
            }
            if(total != 0 && obtained != NaN)
                $('#previous_cgpa_bise').val((parseInt(obtained)/parseInt(total) * 100).toFixed(2));
            else
            {
                $('#previous_cgpa_bise').val('');
            }
        }

        function setPercentageForIms() {
            var previous_total_marks_ims_check = $('#previous_total_marks_ims').val();
            var previous_marks_obtained_ims_check = $('#previous_marks_obtained_ims').val();
            if(previous_total_marks_ims_check < previous_marks_obtained_ims_check){
                
            }
            $('#previous_total_marks_ims').val(numericOnlyByVal($('#previous_total_marks_ims').val()));
            $('#previous_marks_obtained_ims').val(numericOnlyByVal($('#previous_marks_obtained_ims').val()));
            let total = parseInt($('#previous_total_marks_ims').val());
            let obtained = parseInt($('#previous_marks_obtained_ims').val());
            // console.log(total);
            // console.log(obtained);
            // console.log(total < obtained);
            if(total < obtained)
            {
                alert('Total marks should be greater than Obtained Marks.');
                $('#previous_marks_obtained_ims').val('');
                $('#previous_cgpa_ims').val('');
            }
            if(total != 0 && obtained != NaN)
                $('#previous_cgpa_ims').val((parseInt(obtained)/parseInt(total) * 100).toFixed(2));
            else
            {
                $('#previous_cgpa_ims').val('');
            }
        }

        function setPercentageForAf() {
            var previous_total_marks_af_check = $('#previous_total_marks_af').val();
            var previous_marks_obtained_af_check = $('#previous_marks_obtained_af').val();
            if(previous_total_marks_af_check < previous_marks_obtained_af_check){
                
            }
            $('#previous_total_marks_af').val(numericOnlyByVal($('#previous_total_marks_af').val()));
            $('#previous_marks_obtained_af').val(numericOnlyByVal($('#previous_marks_obtained_af').val()));
            let total = parseInt($('#previous_total_marks_af').val());
            let obtained = parseInt($('#previous_marks_obtained_af').val());
            // console.log(total);
            // console.log(obtained);
            // console.log(total < obtained);
            if(total < obtained)
            {
                alert('Total marks should be greater than Obtained Marks.');
                $('#previous_marks_obtained_af').val('');
                $('#previous_cgpa_af').val('');
            }
            if(total != 0 && obtained != NaN)
                $('#previous_cgpa_af').val((parseInt(obtained)/parseInt(total) * 100).toFixed(2));
            else
            {
                $('#previous_cgpa_af').val('');
            }
        }

        function setPercentageForVti() {
            var previous_total_marks_vti_check = $('#previous_total_marks_vti').val();
            var previous_marks_obtained_vti_check = $('#previous_marks_obtained_vti').val();
            if(previous_total_marks_vti_check < previous_marks_obtained_vti_check){
                
            }
            $('#previous_total_marks_vti').val(numericOnlyByVal($('#previous_total_marks_vti').val()));
            $('#previous_marks_obtained_vti').val(numericOnlyByVal($('#previous_marks_obtained_vti').val()));
            let total = parseInt($('#previous_total_marks_vti').val());
            let obtained = parseInt($('#previous_marks_obtained_vti').val());
            // console.log(total);
            // console.log(obtained);
            // console.log(total < obtained);
            if(total < obtained)
            {
                alert('Total marks should be greater than Obtained Marks.');
                $('#previous_marks_obtained_vti').val('');
                $('#previous_cgpa_vti').val('');
            }
            if(total != 0 && obtained != NaN)
                $('#previous_cgpa_vti').val((parseInt(obtained)/parseInt(total) * 100).toFixed(2));
            else
            {
                $('#previous_cgpa_vti').val('');
            }
        }

        function setBiseRsegistrationDateDisplay() {
            if($('#bise_academic_term').val() == 'semester'){
                $('#bise_academic_term_category_div').fadeIn();
            }
            else{
                $('#bise_academic_term_category_div').fadeOut();
            }
            // setDisplayForAnnualAndSemester();
        }

        function setImsRegistrationDateDisplay() {
            if($('#ims_registration_status').val() == 'registered'){
                $('#registration_date_ims').val('');
                $('#ims_registration_date').fadeIn();
            }
            else{
                $('#ims_registration_date').fadeOut();
            }
        }
        function setAfRegistrationDateDisplay() {
            if($('#af_registration_status').val() == 'registered'){
                $('#registration_date_af').val('');
                $('#af_registration_date').fadeIn();
            }
            else{
                $('#af_registration_date').fadeOut();
            }
        }

        function setBISERegistrationDateDisplay() {
            if($('#bise_registration_status').val() == 'registered'){
                $('#registration_date_bise').val('');
                $('#bise_registration_date').fadeIn();
            }
            else{
                $('#bise_registration_date').fadeOut();
            }
        }


        function setVtiRegistrationDateDisplay() {
            if($('#vti_registration_status').val() == 'registered'){
                $('#registration_date_vti').val('');
                $('#vti_registration_date').fadeIn();
            }
            else{
                $('#vti_registration_date').fadeOut();
            }
        }

        function setDualCourseRegistrationDateDisplay() {
            if($('#dual_registration_status').val() == 'registered'){
                $('#registration_date_dual').val('');
                $('#dual_registration_date').fadeIn();
            }
            else{
                $('#dual_registration_date').fadeOut();
            }
        }

        function setImsSemesterCategoryDisplay() {
            $('#ims_academic_term_hidden').val($('#ims_academic_term').val());
            if($('#ims_academic_term').val() == 'semester'){
                $('#ims_semester_category_div').fadeIn();
            }
            else{
                $('#ims_semester_category_div').fadeOut();
            }
            setDisplayForAnnualAndSemester();

        }
        function setImsSemesterCategoryDisplay() {
            $('#ims_academic_term_hidden').val($('#ims_academic_term').val());
            if($('#ims_academic_term').val() == 'semester'){
                $('#ims_semester_category_div').fadeIn();
            }
            else{
                $('#ims_semester_category_div').fadeOut();
            }
            setDisplayForAnnualAndSemester();

        }

        function setVtiSemesterCategoryDisplay() {
            if($('#vti_scheme_of_study').val() == 'semester'){
                $('#vti_semester_category_div').fadeIn();
            }
            else{
                $('#vti_semester_category_div').fadeOut();
            }
            setDisplayForAnnualAndSemester();
        }

        //Ali Naeem Edit .
        function setAFSemesterCategoryDisplay() {
            if($('#af_academic_term').val() == 'semester'){
                $('#af_semester_category_div').fadeIn();
            }
            else{
                $('#af_semester_category_div').fadeOut();
            }
            setDisplayForAnnualAndSemester();
        }


        function setVtiDualSemesterCategoryDisplay() {
            if($('#vti_dual_scheme_of_study').val() == 'semester'){
                $('#vti_dual_semester_category').fadeIn();
            }
            else{
                $('#vti_dual_semester_category').fadeOut();
            }
            setDisplayForAnnualAndSemester();
        }

        function numericOnlyByVal(value){
            let length  = value.length;
            let regex = new RegExp("^[0-9]+$");
            let str = value.substr(length-1,1);
            if (!regex.test(str)) {
                return value.substring(0,length-1);
            }
            return value;
        }

        function onChangeVTIEnrolled(){
            $('#course_enrolled_selected_from_page_07').val($('#vti_diploma_enrolled_in').val());
            $('#course_enrolled_selected_from_page_07_name').val($("#vti_diploma_enrolled_in option:selected").text());


        }

        function onChangeVTIRegistered(){
            $('#course_registered_selected_from_page_07').val($('#vti_diploma_registered_in').val());
            $('#course_registered_selected_from_page_07_name').val($('#vti_diploma_registered_in option:selected').text());
        }

        function  onChangeIMSEnrolled() {
            $('#course_enrolled_selected_from_page_07').val($('#ims_course_enrolled_in_cfe').val());
            $('#course_enrolled_selected_from_page_07_name').val($('#ims_course_enrolled_in_cfe option:selected').text());
        }

        function onChangeIMSRegistered(){
            $('#course_registered_selected_from_page_07').val($('#ims_course_registered').val());
            $('#course_registered_selected_from_page_07_name').val($('#ims_course_registered option:selected').text());
        }

        function onChangeBISEEnrolled(){
            $('#course_enrolled_selected_from_page_07').val($('#bise_course_enrolled_cfe').val());
            $('#course_enrolled_selected_from_page_07_name').val($('#bise_course_enrolled_cfe option:selected').text());
        }

        function onChangeBISERegistered() {
            $('#course_registered_selected_from_page_07').val($('#bise_course_registered_in').val());
            $('#course_registered_selected_from_page_07_name').val($('#bise_course_registered_in option:selected').text());
        }

        function onChangeAFEnrolled(){
            $('#course_enrolled_selected_from_page_07').val($('#af_course_enrolled_in').val());
            $('#course_enrolled_selected_from_page_07_name').val($('#af_course_enrolled_in option:selected').text());
        }

        function onChangeAFRegistered(){
            $('#course_registered_selected_from_page_07').val($('#af_course_registered_in').val());
            $('#course_registered_selected_from_page_07_name').val($('#af_course_registered_in option:selected').text());
        }

        // if(index_id){
        //     getEnrolledAndRegisteredDataVTI();
        // }
        //
        // function getEnrolledAndRegisteredDataVTI(){
        //     alert(index_id);
        //
        // }

    </script>

@endsection
