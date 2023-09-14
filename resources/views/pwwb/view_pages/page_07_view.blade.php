<style type="text/css">
    label{
        color: black;
         font-family: 'Roboto', sans-serif;
         font-size: 18px;
         text-transform: capitalize;
    }
    h1{
        font-weight: bold;
        text-align: center;
        font-family: 'Balsamiq Sans', cursive;
        background: #17202A;
        color: white;
        padding: 15px;
        position: relative;
        }
    input{
        text-transform: capitalize;
    }
    .styling{
        font-weight: bold;
        font-size: 22px;
    }
</style>
<br>
<div class="col-md-12">
{{--            <h1>Educational Wing of CFE: <span style="text-transform: uppercase;">{{$data && $data['educational_wing_cfe']['educational_wing_cfe'] ? $data['educational_wing_cfe']['educational_wing_cfe'] : '--'}}</span></h1>--}}
            <h1>Educational Wing of CFE: <span style="text-transform: uppercase;">{{$wing->short_name}}</span></h1>
            </div><br>
<div class="card shadow p-3 w-100">
    <div class="card-body ">
        <div class="form-row">
            <div class="form-group  col-md-4">
                <label class="styling">Educational Wing of CFE:</label>
                <label>
{{--                    <strong>{{$data && $data['educational_wing_cfe']['educational_wing_cfe'] ? $data['educational_wing_cfe']['educational_wing_cfe'] : '--'}}</strong>--}}
                    <strong>{{$wing->short_name}}</strong>
                </label>
            </div>
        </div>

        <div id="wing_parent_div">
            @if($wing && $wing->short_name=='CS')
            <div id="wing_div_bise">
                <div class="col-md-12 mt-2">
                    <label for="" class="styling">BISE:</label>
                </div>
                <div class="card shadow p-3 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group col-md-4">
{{--                                <label @if( !$data['bise_details']['bise_course_applied_in']) class="text-danger" @endif><strong>Course Applied in:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['bise_details']['bise_course_applied_in'] ? $data['bise_details']['bise_course_applied_in'] : '--'}}--}}
{{--                                </label>--}}
                                <label @if( !$coursec) class="text-danger" @endif><strong>Course Applied in CFE:</strong></label>
                                <label>
                                    {{$coursec && $coursec->name ? $coursec->name : '--'}}
                                </label>
                            </div>
                            <div class="form-group col-md-3" id="bise_optional_subject_div" style="display: none">
                                <label @if( !$data['bise_details']['bise_optional_subject']) class="text-danger" @endif><strong>Optional Subject:</strong></label>
                                <label>
                                    {{$data && $data['bise_details']['bise_optional_subject'] ? $data['bise_details']['bise_optional_subject'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group col-md-3" id="bise_others_div" style="display: none">
                                <label @if( !$data['bise_details']['bise_others']) class="text-danger" @endif><strong>Others:</strong></label>
                                <label>
                                    {{$data && $data['bise_details']['bise_others'] ? $data['bise_details']['bise_others'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">
                                <label @if( !$courseEnrolledInc) class="text-danger" @endif><strong>Course Enrolled in CFE:</strong></label>
                                <label>
                                    {{$courseEnrolledInc && $courseEnrolledInc->name ? $courseEnrolledInc->name : '--'}}
                                    {{--                                    {{$data && $data['ims_details']['ims_course_enrolled_in_cfe'] ? $data['ims_details']['ims_course_enrolled_in_cfe'] : '--'}}--}}
                                </label>
                            </div>


{{--                            <div class="form-group col-md-3">--}}
{{--                                <label @if( !$data['bise_details']['bise_course_enrolled_cfe']) class="text-danger" @endif><strong>Course Enrolled in CFE:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['bise_details']['bise_course_enrolled_cfe'] ? $data['bise_details']['bise_course_enrolled_cfe'] : '--'}}--}}
{{--                                </label>--}}
{{--                            </div>--}}
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-4">
                                <label @if( !$courseRegisteredInc) class="text-danger" @endif><strong>Course Registered in:</strong></label>
                                <label>
                                    {{$courseRegisteredInc && $courseRegisteredInc->name ? $courseRegisteredInc->name : '--'}}
                                    {{--                                    {{$data && $data['ims_details']['ims_course_registered'] ? $data['ims_details']['ims_course_registered'] : '--'}}--}}
                                </label>
                            </div>
{{--                            <div class="form-group col-md-4">--}}
{{--                                <label @if( !$data['bise_details']['bise_course_registered_in']) class="text-danger" @endif><strong>Course Registered in:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['bise_details']['bise_course_registered_in'] ? $data['bise_details']['bise_course_registered_in'] : '--'}}--}}
{{--                                </label>--}}
{{--                            </div>--}}
                            <div class="form-group col-md-4">
                                <label @if( !$data['roll_no']) class="text-danger" @endif><strong>Roll No:</strong></label>
                                <label>
                                    {{-- {{$data && $data['bise_details']['bise_roll_no'] ? $data['bise_details']['bise_roll_no'] : '--'}} --}}
                                    {{$data ? $data['roll_no'] : '---'}}
                                </label>
                            </div>
                            <div class="form-group col-md-4">


                                <label @if( !$affiliatedBodyc) class="text-danger" @endif><strong>Affiliated Body:</strong></label>
                                <label>
                                    {{$affiliatedBodyc && $affiliatedBodyc->code ? $affiliatedBodyc->code : '--'}}
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label @if( !$data['bise_details']['bise_duration_of_course']) class="text-danger" @endif><strong>Duration of Course:</strong></label>
                                <label>
                                    {{$data && $data['bise_details']['bise_duration_of_course'] ? $data['bise_details']['bise_duration_of_course'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group col-md-4">
                                <label @if( !$data['bise_details']['bise_admission_date']) class="text-danger" @endif><strong>Date of Admission:</strong></label>
                                <label>
                                    {{$data && $data['bise_details']['bise_admission_date'] ? $data['bise_details']['bise_admission_date'] : '--'}}
                                </label>


                            </div>
                            <div class="form-group col-md-4">
                                <label @if( !$data['bise_details']['bise_ending_date']) class="text-danger" @endif><strong>Ending Date:</strong></label>
                                <label>
                                    {{$data && $data['bise_details']['bise_ending_date'] ? $data['bise_details']['bise_ending_date'] : '--'}}
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
{{--                                <label @if( !$data['bise_details']['bise_academic_term']) class="text-danger" @endif><strong>Academic Term:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['bise_details']['bise_academic_term'] ? $data['bise_details']['bise_academic_term'] : '--'}}--}}
{{--                                </label>--}}
                                <label @if( $data['bise_details']['bise_academic_term'] == '') class="text-danger" @endif><strong>Academic Term:</strong></label>
                                <label>
                                    @if($data['bise_details']['bise_academic_term'] == '0' && $data['bise_details']['bise_academic_term'] != '')
                                        {{'Annual'}}
                                    @elseif($data['bise_details']['bise_academic_term'] == '1' && $data['bise_details']['bise_academic_term'] != '')
                                        {{'Semester'}}
                                    @else
                                        {{$data && $data['bise_details']['bise_academic_term'] ? $data['bise_details']['bise_academic_term'] : '--'}}
                                    @endif
                                </label>
                            </div>
                            <div class="form-group col-md-4">
                                <label @if( !$data['bise_details']['bise_shift']) class="text-danger" @endif><strong>Shift:</strong></label>
                                <label>
                                    {{$data && $data['bise_details']['bise_shift'] ? (is_numeric($data['bise_details']['bise_shift']) ? config('constants.shift')[$data['bise_details']['bise_shift']] : $data['bise_details']['bise_shift']) : '--'}}
                                </label>
                            </div>
                        </div>
                        <div class="card shadow p-3 w-100">
                            <div class="card-body ">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label @if( !$data['bise_details']['bise_registration_status']) class="text-danger" @endif><strong>Registration Status with Affiliated Body:</strong></label>
                                        <label>
                                            {{$data && $data['bise_details']['bise_registration_status'] ? $data['bise_details']['bise_registration_status'] : '--'}}
                                        </label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label @if( !$data['bise_details']['bise_registration_date']) class="text-danger" @endif><strong>Date of Registration:</strong></label>
                                        <label>
                                            {{$data && $data['bise_details']['bise_registration_date'] ? $data['bise_details']['bise_registration_date'] : '--'}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="" class="styling">Registration Fees</label>
                                </div>
                                <div class="card shadow p-3 w-100">
                                    <div class="card-body ">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label @if( !$data['bise_details']['bise_actual_fee']) class="text-danger" @endif><strong>Actual:</strong></label>
                                                <label>
                                                    {{$data && $data['bise_details']['bise_actual_fee'] ? $data['bise_details']['bise_actual_fee'] : '--'}}
                                                </label>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label @if( !$data['bise_details']['bise_late_fee']) class="text-danger" @endif><strong>Late:</strong></label>
                                                <label>
                                                    {{$data && $data['bise_details']['bise_late_fee'] ? $data['bise_details']['bise_late_fee'] : '--'}}
                                                </label>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label @if( !$data['bise_details']['bise_total_fee']) class="text-danger" @endif><strong>Total:</strong></label>
                                                <label>
                                                    {{$data && $data['bise_details']['bise_total_fee'] ? $data['bise_details']['bise_total_fee'] : '--'}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
        <label for="" class="styling">Previous Academic Details:</label>
    </div>
    <div class="card shadow p-3 w-100">
        <div class="card-body ">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label @if( !$data['bise_details']['bise_previous_course']) class="text-danger" @endif><strong>Course:</strong></label>
                    <label>
                        {{$data && $data['bise_details']['bise_previous_course'] ? $data['bise_details']['bise_previous_course'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['bise_details']['bise_board_university']) class="text-danger" @endif><strong>Board / University:</strong></label>
                    <label>
                        {{$data && $data['bise_details']['bise_board_university'] ? $data['bise_details']['bise_board_university'] : '--'}}
                    </label>
                </div>
                   <div class="form-group  col-md-3">
                    <label @if( !$data['bise_details']['bise_previous_roll_no']) class="text-danger" @endif><strong>Roll No:</strong></label>
                    <label>
                        {{$data && $data['bise_details']['bise_previous_roll_no'] ? $data['bise_details']['bise_previous_roll_no'] : '--'}}
                    </label>
                </div>
                <div class="form-group col-md-3">
                    <label @if( !$data['bise_details']['bise_previous_passing_date']) class="text-danger" @endif><strong>Passing Date:</strong></label>
                    <label>
                        {{$data && $data['bise_details']['bise_previous_passing_date'] ? $data['bise_details']['bise_previous_passing_date'] : '--'}}
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group  col-md-3">
                    <label @if( !$data['bise_details']['bise_previous_total_marks']) class="text-danger" @endif><strong>Total Marks:</strong></label>
                    <label>
                        {{$data && $data['bise_details']['bise_previous_total_marks'] ? $data['bise_details']['bise_previous_total_marks'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['bise_details']['bise_previous_marks_obtained']) class="text-danger" @endif><strong>Marks Obtained:</strong></label>
                    <label>
                        {{$data && $data['bise_details']['bise_previous_marks_obtained'] ? $data['bise_details']['bise_previous_marks_obtained'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['bise_details']['bise_previous_percentage']) class="text-danger" @endif><strong>Percentage:</strong></label>
                    <label>
                        {{$data && $data['bise_details']['bise_previous_percentage'] ? $data['bise_details']['bise_previous_percentage'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['bise_details']['bise_previous_cgpa']) class="text-danger" @endif><strong>CGPA:</strong></label>
                    <label>
                        {{$data && $data['bise_details']['bise_previous_cgpa'] ? $data['bise_details']['bise_previous_cgpa'] : '--'}}
                    </label>
                </div>
            </div>
        </div>
    </div>
            </div>
            @elseif($wing && $wing->short_name=='IMS')
            <div id="wing_div_ims">
                <div class="col-md-12 mt-2">
                    <label for="" class="styling">IMS:</label>
                </div>
                <div class="card shadow p-3 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group  col-md-4">
{{--                                <label @if( !$data['ims_details']['ims_course_applied_in_cfe']) class="text-danger" @endif><strong>Course Applied in CFE:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['ims_details']['ims_course_applied_in_cfe'] ? $data['ims_details']['ims_course_applied_in_cfe'] : '--'}}--}}
{{--                                </label>--}}

                                <label @if( !$course) class="text-danger" @endif><strong>Course Applied in CFE:</strong></label>
                                <label>
                                    {{$course && $course->name ? $course->name : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">
                                <label @if( !$courseEnrolledIn) class="text-danger" @endif><strong>Course Enrolled in CFE:</strong></label>
                                <label>
                                    {{$courseEnrolledIn && $courseEnrolledIn->name ? $courseEnrolledIn->name : '--'}}
{{--                                    {{$data && $data['ims_details']['ims_course_enrolled_in_cfe'] ? $data['ims_details']['ims_course_enrolled_in_cfe'] : '--'}}--}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">
                                <label @if( !$courseRegisteredIn) class="text-danger" @endif><strong>Course Registered in:</strong></label>
                                <label>
                                    {{$courseRegisteredIn && $courseRegisteredIn->name ? $courseRegisteredIn->name : '--'}}
{{--                                    {{$data && $data['ims_details']['ims_course_registered'] ? $data['ims_details']['ims_course_registered'] : '--'}}--}}
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-4">
                                <label @if( !$data['roll_no']) class="text-danger" @endif><strong>Roll No:</strong></label>
                                <label>
                                    {{-- {{$data && $data['ims_details']['ims_roll_no'] ? $data['ims_details']['ims_roll_no'] : '--'}} --}}
                                    {{$data ? $data['roll_no'] : '---'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">
{{--                                <label @if( !$data['ims_details']['ims_affiliated_body']) class="text-danger" @endif><strong>Affiliated Body:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['ims_details']['ims_affiliated_body'] ? $data['ims_details']['ims_affiliated_body'] : '--'}}--}}
{{--                                </label>--}}
                                <label @if( !$affiliatedBody) class="text-danger" @endif><strong>Affiliated Body:</strong></label>
                                <label>
                                    {{$affiliatedBody && $affiliatedBody->code ? $affiliatedBody->code : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">
                                <label @if( !$data['ims_details']['ims_duration_of_course']) class="text-danger" @endif><strong>Duration of Course:</strong></label>
                                <label>
                                    {{$data && $data['ims_details']['ims_duration_of_course'] ? $data['ims_details']['ims_duration_of_course'] : '--'}}
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-4">
                                <label @if( !$data['ims_details']['ims_admission_date']) class="text-danger" @endif><strong>Date of Admission:</strong></label>
                                <label>
                                    {{$data && $data['ims_details']['ims_admission_date'] ? $data['ims_details']['ims_admission_date'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">
                                <label @if( !$data['ims_details']['ims_ending_date']) class="text-danger" @endif><strong>Ending date:</strong></label>
                                <label>
                                    {{$data && $data['ims_details']['ims_ending_date'] ? $data['ims_details']['ims_ending_date'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">


                                <label @if( $data['ims_details']['ims_academic_term'] == '') class="text-danger" @endif><strong>Academic Term:</strong></label>
                                <label>
                                    @if($data['ims_details']['ims_academic_term'] == '0' && $data['ims_details']['ims_academic_term'] != '')
                                        {{'Annual'}}
                                    @elseif($data['ims_details']['ims_academic_term'] == '1' && $data['ims_details']['ims_academic_term'] != '')
                                        {{'Semester'}}
                                    @else
                                        {{$data && $data['ims_details']['ims_academic_term'] ? $data['ims_details']['ims_academic_term'] : '--'}}
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-4">
                                <label @if( !$data['ims_details']['ims_semester_category']) class="text-danger" @endif><strong>Semester Category:</strong></label>
                                <label>
                                    {{$data && $data['ims_details']['ims_semester_category'] ? $data['ims_details']['ims_semester_category'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">
                                <label @if( !$data['ims_details']['ims_shift']) class="text-danger" @endif><strong>Shift:</strong></label>
                                <label>
                                    {{$data && $data['ims_details']['ims_shift'] ?  config('constants.shift')[$data['ims_details']['ims_shift']] : '--'}}
                                </label>
                            </div>
                        </div>
                        <div class="card shadow p-3 w-100">
                            <div class="card-body ">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label @if( !$data['ims_details']['ims_registration_status']) class="text-danger" @endif><strong>Registration Status with Affiliated Body:</strong></label>
                                        <label>
                                            {{$data && $data['ims_details']['ims_registration_status'] ? $data['ims_details']['ims_registration_status'] : '--'}}
                                        </label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label @if( !$data['ims_details']['ims_registration_date']) class="text-danger" @endif><strong>Date of Registration:</strong></label>
                                        <label>
                                            {{$data && $data['ims_details']['ims_registration_date'] ? $data['ims_details']['ims_registration_date'] : '--'}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="" class="styling">Registration Fees</label>
                                </div>
                                <div class="card shadow p-3 w-100">
                                    <div class="card-body ">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label @if( !$data['ims_details']['ims_actual_fee']) class="text-danger" @endif><strong>Actual:</strong></label>
                                                <label>
                                                    {{$data && $data['ims_details']['ims_actual_fee'] ? $data['ims_details']['ims_actual_fee'] : '--'}}
                                                </label>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label @if( !$data['ims_details']['ims_late_fee']) class="text-danger" @endif><strong>Late:</strong></label>
                                                <label>
                                                    {{$data && $data['ims_details']['ims_late_fee'] ? $data['ims_details']['ims_late_fee'] : '--'}}
                                                </label>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label @if( !$data['ims_details']['ims_total_fee']) class="text-danger" @endif><strong>Total:</strong></label>
                                                <label>
                                                    {{$data && $data['ims_details']['ims_total_fee'] ? $data['ims_details']['ims_total_fee'] : '--'}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
        <label for="" class="styling">Previous Academic Details:</label>
    </div>
    <div class="card shadow p-3 w-100">
        <div class="card-body ">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label @if( !$data['ims_details']['ims_previous_course']) class="text-danger" @endif><strong>Course:</strong></label>
                    <label>
                        {{$data && $data['ims_details']['ims_previous_course'] ? $data['ims_details']['ims_previous_course'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['ims_details']['ims_board_university']) class="text-danger" @endif><strong>Board / University:</strong></label>
                    <label>
                        {{$data && $data['ims_details']['ims_board_university'] ? $data['ims_details']['ims_board_university'] : '--'}}
                    </label>
                </div>
                   <div class="form-group  col-md-3">
                    <label @if( !$data['ims_details']['ims_previous_roll_no']) class="text-danger" @endif><strong>Roll No:</strong></label>
                    <label>
                        {{$data && $data['ims_details']['ims_previous_roll_no'] ? $data['ims_details']['ims_previous_roll_no'] : '--'}}
                    </label>
                </div>
                <div class="form-group col-md-3">
                    <label @if( !$data['ims_details']['ims_previous_passing_date']) class="text-danger" @endif><strong>Passing Date:</strong></label>
                    <label>
                        {{$data && $data['ims_details']['ims_previous_passing_date'] ? $data['ims_details']['ims_previous_passing_date'] : '--'}}
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group  col-md-3">
                    <label @if( !$data['ims_details']['ims_previous_total_marks']) class="text-danger" @endif><strong>Total Marks:</strong></label>
                    <label>
                        {{$data && $data['ims_details']['ims_previous_total_marks'] ? $data['ims_details']['ims_previous_total_marks'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['ims_details']['ims_previous_marks_obtained']) class="text-danger" @endif><strong>Marks Obtained:</strong></label>
                    <label>
                        {{$data && $data['ims_details']['ims_previous_marks_obtained'] ? $data['ims_details']['ims_previous_marks_obtained'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['ims_details']['ims_previous_percentage']) class="text-danger" @endif><strong>Percentage:</strong></label>
                    <label>
                        {{$data && $data['ims_details']['ims_previous_percentage'] ? $data['ims_details']['ims_previous_percentage'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['ims_details']['ims_previous_cgpa']) class="text-danger" @endif><strong>CGPA:</strong></label>
                    <label>
                        {{$data && $data['ims_details']['ims_previous_cgpa'] ? $data['ims_details']['ims_previous_cgpa'] : '--'}}
                    </label>
                </div>
            </div>
        </div>
    </div>
            </div>
            @elseif($wing && $wing->short_name =='AF')
            <div id="wing_div_af">
                <div class="col-md-12 mt-2">
                    <label for="" class="styling">AF:</label>
                </div>
                <div class="card shadow p-3 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group  col-md-4">
{{--                                <label @if( !$data['af_details']['af_course_applied_in']) class="text-danger" @endif><strong>Course Applied in:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['af_details']['af_course_applied_in'] ? $data['af_details']['af_course_applied_in'] : '--'}}--}}
{{--                                </label>--}}
                                <label @if( !$coursea) class="text-danger" @endif><strong>Course Applied in CFE:</strong></label>
                                <label>
                                    {{$coursea && $coursea->name ? $coursea->name : '--'}}
                                </label>
                            </div>
{{--                            <div class="form-group  col-md-4">--}}
{{--                                <label @if( !$data['af_details']['af_course_enrolled_in']) class="text-danger" @endif><strong>Course Enrolled in CFE:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['af_details']['af_course_enrolled_in'] ? $data['af_details']['af_course_enrolled_in'] : '--'}}--}}
{{--                                </label>--}}
{{--                            </div>--}}
                            <div class="form-group  col-md-4">
                                <label @if( !$courseEnrolledIna) class="text-danger" @endif><strong>Course Enrolled in CFE:</strong></label>
                                <label>
                                    {{$courseEnrolledIna && $courseEnrolledIna->name ? $courseEnrolledIna->name : '--'}}
                                    {{--                                    {{$data && $data['ims_details']['ims_course_enrolled_in_cfe'] ? $data['ims_details']['ims_course_enrolled_in_cfe'] : '--'}}--}}
                                </label>
                            </div>
{{--                            <div class="form-group  col-md-4">--}}
{{--                                <label @if( !$data['af_details']['af_course_registered_in']) class="text-danger" @endif><strong>Course Registered in:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['af_details']['af_course_registered_in'] ? $data['af_details']['af_course_registered_in'] : '--'}}--}}
{{--                                </label>--}}
{{--                            </div>--}}
                            <div class="form-group  col-md-4">
                                <label @if( !$courseRegisteredIna) class="text-danger" @endif><strong>Course Registered in:</strong></label>
                                <label>
                                    {{$courseRegisteredIna && $courseRegisteredIna->name ? $courseRegisteredIna->name : '--'}}
                                    {{--                                    {{$data && $data['ims_details']['ims_course_registered'] ? $data['ims_details']['ims_course_registered'] : '--'}}--}}
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-4">
                                <label @if( !$data['roll_no']) class="text-danger" @endif><strong>Roll No:</strong></label>
                                <label>
                                    {{-- {{$data && $data['af_details']['af_roll_no'] ? $data['af_details']['af_roll_no'] : '--'}} --}}
                                    {{$data ? $data['roll_no'] : '---'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">
{{--                                <label @if( !$data['af_details']['af_affiliated_body']) class="text-danger" @endif><strong>Affiliated Body:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['af_details']['af_affiliated_body'] ? $data['af_details']['af_affiliated_body'] : '--'}}--}}
{{--                                </label>--}}
                                <label @if( !$affiliatedBodya) class="text-danger" @endif><strong>Affiliated Body:</strong></label>
                                <label>
                                    {{$affiliatedBodya && $affiliatedBodya->code ? $affiliatedBodya->code : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">
                                <label @if( !$data['af_details']['af_duration_of_course']) class="text-danger" @endif><strong>Duration of Course:</strong></label>
                                <label>
                                    {{$data && $data['af_details']['af_duration_of_course'] ? $data['af_details']['af_duration_of_course'] : '--'}}
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-4">
                                <label @if( !$data['af_details']['af_admission_date']) class="text-danger" @endif><strong>Date of Admission:</strong></label>
                                <label>
                                    {{$data && $data['af_details']['af_admission_date'] ? $data['af_details']['af_admission_date'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">
                                <label @if( !$data['af_details']['af_ending_date']) class="text-danger" @endif><strong>Ending date:</strong></label>
                                <label>
                                    {{$data && $data['af_details']['af_ending_date'] ? $data['af_details']['af_ending_date'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">
{{--                                <label @if( !$data['af_details']['af_academic_term']) class="text-danger" @endif><strong>Academic Term:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['af_details']['af_academic_term'] ? $data['af_details']['af_academic_term'] : '--'}}--}}
{{--                                </label>--}}

                                <label @if( $data['af_details']['af_academic_term'] == '') class="text-danger" @endif><strong>Academic Term:</strong></label>
                                <label>
                                    @if($data['af_details']['af_academic_term'] == '0' && $data['af_details']['af_academic_term'] != '')
                                        {{'Annual'}}
                                    @elseif($data['af_details']['af_academic_term'] == '1' && $data['af_details']['af_academic_term'] != '')
                                        {{'Semester'}}
                                    @else
                                        {{$data && $data['af_details']['af_academic_term'] ? $data['af_details']['af_academic_term'] : '--'}}
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-4">
                                <label @if( !$data['af_details']['af_shift']) class="text-danger" @endif><strong>Shift:</strong></label>
                                <label>
                                    {{$data && $data['af_details']['af_shift'] ?  config('constants.shift')[$data['af_details']['af_shift']] : '--'}}
                                </label>
                            </div>
                        </div>
                        <div class="card shadow p-3 w-100">
                            <div class="card-body ">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label @if( !$data['af_details']['af_registration_status']) class="text-danger" @endif><strong>Registration Status with Affiliated Body:</strong></label>
                                        <label>
                                            {{$data && $data['af_details']['af_registration_status'] ? $data['af_details']['af_registration_status'] : '--'}}
                                        </label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label @if( !$data['af_details']['af_registration_date']) class="text-danger" @endif><strong>Date of Registration:</strong></label>
                                        <label>
                                            {{$data && $data['af_details']['af_registration_date'] ? $data['af_details']['af_registration_date'] : '--'}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="" class="styling">Registration Fees</label>
                                </div>
                                <div class="card shadow p-3 w-100">
                                    <div class="card-body ">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label @if( !$data['af_details']['af_actual_fee']) class="text-danger" @endif><strong>Actual:</strong></label>
                                                <label>
                                                    {{$data && $data['af_details']['af_actual_fee'] ? $data['af_details']['af_actual_fee'] : '--'}}
                                                </label>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label @if( !$data['af_details']['af_late_fee']) class="text-danger" @endif><strong>Late:</strong></label>
                                                <label>
                                                    {{$data && $data['af_details']['af_late_fee'] ? $data['af_details']['af_late_fee'] : '--'}}
                                                </label>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label @if( !$data['af_details']['af_total_fee']) class="text-danger" @endif><strong>Total:</strong></label>
                                                <label>
                                                    {{$data && $data['af_details']['af_total_fee'] ? $data['af_details']['af_total_fee'] : '--'}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
        <label for="" class="styling">Previous Academic Details:</label>
    </div>
    <div class="card shadow p-3 w-100">
        <div class="card-body ">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label @if( !$data['af_details']['af_previous_course']) class="text-danger" @endif><strong>Course:</strong></label>
                    <label>
                        {{$data && $data['af_details']['af_previous_course'] ? $data['af_details']['af_previous_course'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['af_details']['af_board_university']) class="text-danger" @endif><strong>Board / University:</strong></label>
                    <label>
                        {{$data && $data['af_details']['af_board_university'] ? $data['af_details']['af_board_university'] : '--'}}
                    </label>
                </div>
                   <div class="form-group  col-md-3">
                    <label @if( !$data['af_details']['af_previous_roll_no']) class="text-danger" @endif><strong>Roll No:</strong></label>
                    <label>
                        {{$data && $data['af_details']['af_previous_roll_no'] ? $data['af_details']['af_previous_roll_no'] : '--'}}
                    </label>
                </div>
                <div class="form-group col-md-3">
                    <label @if( !$data['af_details']['af_previous_passing_date']) class="text-danger" @endif><strong>Passing Date:</strong></label>
                    <label>
                        {{$data && $data['af_details']['af_previous_passing_date'] ? $data['af_details']['af_previous_passing_date'] : '--'}}
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group  col-md-3">
                    <label @if( !$data['af_details']['af_previous_total_marks']) class="text-danger" @endif><strong>Total Marks:</strong></label>
                    <label>
                        {{$data && $data['af_details']['af_previous_total_marks'] ? $data['af_details']['af_previous_total_marks'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['af_details']['af_previous_marks_obtained']) class="text-danger" @endif><strong>Marks Obtained:</strong></label>
                    <label>
                        {{$data && $data['af_details']['af_previous_marks_obtained'] ? $data['af_details']['af_previous_marks_obtained'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['af_details']['af_previous_percentage']) class="text-danger" @endif><strong>Percentage:</strong></label>
                    <label>
                        {{$data && $data['af_details']['af_previous_percentage'] ? $data['af_details']['af_previous_percentage'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['af_details']['af_previous_cgpa']) class="text-danger" @endif><strong>CGPA:</strong></label>
                    <label>
                        {{$data && $data['af_details']['af_previous_cgpa'] ? $data['af_details']['af_previous_cgpa'] : '--'}}
                    </label>
                </div>
            </div>
        </div>
    </div>
            </div>
            @elseif($wing && $wing->short_name=='VTI')
            <div id="wing_div_vti">
                <div class="col-md-12 mt-2">
                    <label for="" class="styling">VTI:</label>
                </div>
                <div class="card shadow p-3 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group  col-md-3">
{{--                                <label @if( !$data['vti_details']['vti_diploma_applied_in']) class="text-danger" @endif><strong>Diploma Applied in:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['vti_details']['vti_diploma_applied_in'] ? $data['vti_details']['vti_diploma_applied_in'] : '--'}}--}}
{{--                                </label>--}}
                                <label @if( !$coursev) class="text-danger" @endif><strong>Diploma Applied in:</strong></label>
                                <label>
                                    {{$coursev && $coursev->name ? $coursev->name : '--'}}
                                </label>
                            </div>

                            <div class="form-group  col-md-3">
                                <label @if( !$courseEnrolledInv) class="text-danger" @endif><strong>Diploma Enrolled in:</strong></label>
                                <label>
                                    {{$courseEnrolledInv && $courseEnrolledInv->name ? $courseEnrolledInv->name : '--'}}
                                    {{--                                    {{$data && $data['ims_details']['ims_course_enrolled_in_cfe'] ? $data['ims_details']['ims_course_enrolled_in_cfe'] : '--'}}--}}
                                </label>
                            </div>
                            <div class="form-group  col-md-3">
                                <label @if( !$courseRegisteredInv) class="text-danger" @endif><strong>Diploma Registered in:</strong></label>
                                <label>
                                    {{$courseRegisteredInv && $courseRegisteredInv->name ? $courseRegisteredInv->name : '--'}}
                                    {{--                                    {{$data && $data['ims_details']['ims_course_registered'] ? $data['ims_details']['ims_course_registered'] : '--'}}--}}
                                </label>
                            </div>

{{--                            <div class="form-group  col-md-2">--}}
{{--                                <label @if( !$data['vti_details']['vti_diploma_enrolled_in']) class="text-danger" @endif><strong>Diploma Enrolled in:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['vti_details']['vti_diploma_enrolled_in'] ? $data['vti_details']['vti_diploma_enrolled_in'] : '--'}}--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="form-group  col-md-2">--}}
{{--                                <label @if( !$data['vti_details']['vti_diploma_registered_in']) class="text-danger" @endif><strong>Diploma Registered in:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['vti_details']['vti_diploma_registered_in'] ? $data['vti_details']['vti_diploma_registered_in'] : '--'}}--}}
{{--                                </label>--}}
{{--                            </div>--}}
                            <div class="form-group  col-md-3">
                                <label @if( !$data['vti_details']['vti_dual_course']) class="text-danger" @endif><strong>Dual course:</strong></label>
                                <label>
                                    {{$data && $data['vti_details']['vti_dual_course'] ? $data['vti_details']['vti_dual_course'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-3">
                                <label @if( !$data['vti_details']['vti_reason']) class="text-danger" @endif><strong>Reason:</strong></label>
                                <label>
                                    {{$data && $data['vti_details']['vti_reason'] ? $data['vti_details']['vti_reason'] : '--'}}
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3" style="display: none" id="vti_further_file_div">
                                <label @if( !$data['vti_details']['vti_further_file_received']) class="text-danger" @endif><strong>Further File to be Received:</strong></label>
                                <label>
                                    {{$data && $data['vti_details']['vti_further_file_received'] ? $data['vti_details']['vti_further_file_received'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-3" style="display: none" id="vti_follow_up_date">
                                <label @if( !$data['vti_details']['vti_follow_up']) class="text-danger" @endif><strong>Follow-Up Date:</strong></label>
                                <label>
                                    {{$data && $data['vti_details']['vti_follow_up'] ? $data['vti_details']['vti_follow_up'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-3">
                                <label @if( !$data['roll_no']) class="text-danger" @endif><strong>Roll No:</strong></label>
                                <label>
                                    {{-- {{$data && $data['vti_details']['vti_roll_no'] ? $data['vti_details']['vti_roll_no'] : '--'}} --}}
                                    {{$data ? $data['roll_no'] : '---'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-3">
{{--                                <label @if( !$data['vti_details']['vti_affiliated_body']) class="text-danger" @endif><strong>Affiliated Body:</strong></label>--}}
{{--                                <label>--}}
{{--                                    {{$data && $data['vti_details']['vti_affiliated_body'] ? $data['vti_details']['vti_affiliated_body'] : '--'}}--}}
{{--                                </label>--}}
                                <label @if( !$affiliatedBodyv) class="text-danger" @endif><strong>Affiliated Body:</strong></label>
                                <label>
                                    {{$affiliatedBodyv && $affiliatedBodyv->code ? $affiliatedBodyv->code : '--'}}
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-4">
                                <label @if( !$data['vti_details']['vti_duration_of_diploma']) class="text-danger" @endif><strong>Duration of Diploma:</strong></label>
                                <label>
                                    {{$data && $data['vti_details']['vti_duration_of_diploma'] ? $data['vti_details']['vti_duration_of_diploma'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">
                                <label @if( !$data['vti_details']['vti_admission_date']) class="text-danger" @endif><strong>Date of Admission:</strong></label>
                                <label>
                                    {{$data && $data['vti_details']['vti_admission_date'] ? $data['vti_details']['vti_admission_date'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">
                                <label @if( !$data['vti_details']['vti_ending_date']) class="text-danger" @endif><strong>Ending Date:</strong></label>
                                <label>
                                    {{$data && $data['vti_details']['vti_ending_date'] ? $data['vti_details']['vti_ending_date'] : '--'}}
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-4">
{{--                                <label><strong>Scheme of Study:</strong></label>--}}
{{--                                <label>--}}
{{--                                    Annual--}}
{{--                                </label>--}}
                                <label @if( $data['vti_details']['vti_ending_date'] == '') class="text-danger" @endif><strong>Scheme of Study:</strong></label>
                                <label>
                                    @if($data['vti_details']['vti_scheme_of_study'] == '0' && $data['vti_details']['vti_scheme_of_study'] != '')
                                        {{'Annual'}}
                                    @elseif($data['vti_details']['vti_scheme_of_study'] == '1' && $data['vti_details']['vti_scheme_of_study'] != '')
                                        {{'Semester'}}
                                    @else
                                        {{$data && $data['vti_details']['vti_scheme_of_study'] ? $data['vti_details']['vti_scheme_of_study'] : '--'}}
                                    @endif
                                </label>
                            </div>


                            <div class="form-group  col-md-4">
                                <label @if( !$data['vti_details']['vti_semester_category']) class="text-danger" @endif><strong>Semester Category:</strong></label>
                                <label>
                                    {{$data && $data['vti_details']['vti_semester_category'] ? $data['vti_details']['vti_semester_category'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group  col-md-4">
                                <label @if( !$data['vti_details']['vti_shift']) class="text-danger" @endif><strong>Shift:</strong></label>
                                <label>
                                    {{$data && $data['vti_details']['vti_shift'] ?  config('constants.shift')[$data['vti_details']['vti_shift']] : '--'}}
                                </label>
                            </div>
                        </div>
                        <div class="card shadow p-3 w-100">
                            <div class="card-body ">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label @if( !$data['vti_details']['vti_registration_status']) class="text-danger" @endif><strong>Registration Status with Affiliated Body:</strong></label>
                                        <label>
                                            {{$data && $data['vti_details']['vti_registration_status'] ? $data['vti_details']['vti_registration_status'] : '--'}}
                                        </label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label @if( !$data['vti_details']['vti_date_of_registration']) class="text-danger" @endif><strong>Date of Registration:</strong></label>
                                        <label>
                                            {{$data && $data['vti_details']['vti_date_of_registration'] ? $data['vti_details']['vti_date_of_registration'] : '--'}}
                                        </label>
                                    </div>
                                 </div>
                                <div class="col-md-12 mt-2">
                                    <label for="" class="styling">Registration Fees</label>
                                </div>
                                <div class="card shadow p-3 w-100">
                                    <div class="card-body ">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label @if( !$data['vti_details']['vti_registration_actual_fee']) class="text-danger" @endif><strong>Actual:</strong></label>
                                                <label>
                                                    {{$data && $data['vti_details']['vti_registration_actual_fee'] ? $data['vti_details']['vti_registration_actual_fee'] : '--'}}
                                                </label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label @if( !$data['vti_details']['vti_registration_late_fee']) class="text-danger" @endif><strong>Late:</strong></label>
                                                <label>
                                                    {{$data && $data['vti_details']['vti_registration_late_fee'] ? $data['vti_details']['vti_registration_late_fee'] : '--'}}
                                                </label>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label @if( !$data['vti_details']['vti_registration_total_fee']) class="text-danger" @endif><strong>Total:</strong></label>
                                                <label>
                                                    {{$data && $data['vti_details']['vti_registration_total_fee'] ? $data['vti_details']['vti_registration_total_fee'] : '--'}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
        <label for="" class="styling">Previous Academic Details:</label>
    </div>
    <div class="card shadow p-3 w-100">
        <div class="card-body ">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label @if( !$data['vti_details']['vti_previous_course']) class="text-danger" @endif><strong>Course:</strong></label>
                    <label>
                        {{$data && $data['vti_details']['vti_previous_course'] ? $data['vti_details']['vti_previous_course'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['vti_details']['vti_board_university']) class="text-danger" @endif><strong>Board / University:</strong></label>
                    <label>
                        {{$data && $data['vti_details']['vti_board_university'] ? $data['vti_details']['vti_board_university'] : '--'}}
                    </label>
                </div>
                   <div class="form-group  col-md-3">
                    <label @if( !$data['vti_details']['vti_previous_roll_no']) class="text-danger" @endif><strong>Roll No:</strong></label>
                    <label>
                        {{$data && $data['vti_details']['vti_previous_roll_no'] ? $data['vti_details']['vti_previous_roll_no'] : '--'}}
                    </label>
                </div>
                <div class="form-group col-md-3">
                    <label @if( !$data['vti_details']['vti_previous_passing_date']) class="text-danger" @endif><strong>Passing Date:</strong></label>
                    <label>
                        {{$data && $data['vti_details']['vti_previous_passing_date'] ? $data['vti_details']['vti_previous_passing_date'] : '--'}}
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group  col-md-3">
                    <label @if( !$data['vti_details']['vti_previous_total_marks']) class="text-danger" @endif><strong>Total Marks:</strong></label>
                    <label>
                        {{$data && $data['vti_details']['vti_previous_total_marks'] ? $data['vti_details']['vti_previous_total_marks'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['vti_details']['vti_previous_marks_obtained']) class="text-danger" @endif><strong>Marks Obtained:</strong></label>
                    <label>
                        {{$data && $data['vti_details']['vti_previous_marks_obtained'] ? $data['vti_details']['vti_previous_marks_obtained'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['vti_details']['vti_previous_percentage']) class="text-danger" @endif><strong>Percentage:</strong></label>
                    <label>
                        {{$data && $data['vti_details']['vti_previous_percentage'] ? $data['vti_details']['vti_previous_percentage'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['vti_details']['vti_previous_cgpa']) class="text-danger" @endif><strong>CGPA:</strong></label>
                    <label>
                        {{$data && $data['vti_details']['vti_previous_cgpa'] ? $data['vti_details']['vti_previous_cgpa'] : '--'}}
                    </label>
                </div>
            </div>
        </div>
    </div>
            </div>
            @endif
        </div>
    </div>
</div>

