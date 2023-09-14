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
@if($data['dual_course_details']['course'] != null )
    <br>
    <div class="col-md-12">
        <h1>Dual Course(For CFE purpose):</h1>
    </div><br>
    <div class="col-md-12 mt-2">
        <label for="" class="styling">Dual Course(For CFE purpose):</label>
    </div>
    <div class="card shadow p-3 w-100">
        <div class="card-body ">
            <div class="form-row">
                <div class="form-group  col-md-3">
                    {{--                    <label @if( !$data['dual_course_details']['course']) class="text-danger" @endif><strong>Course:</strong></label>--}}
                    {{--                    <label>--}}
                    {{--                        {{$data && $data['dual_course_details']['course'] ? $data['dual_course_details']['course'] : '--'}}--}}
                    {{--                    </label>--}}
                    <label @if( !$coursevD) class="text-danger" @endif><strong>Course:</strong></label>
                    <label>
                        {{$coursevD && $coursevD->name ? $coursevD->name : '--'}}
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group  col-md-3">
                    <label @if( !$data['dual_course_details']['roll_no']) class="text-danger" @endif><strong>Roll No:</strong></label>
                    <label>
                        {{$data && $data['dual_course_details']['roll_no'] ? $data['dual_course_details']['roll_no'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    {{--                    <label @if( !$data['dual_course_details']['affiliated_body']) class="text-danger" @endif><strong>Affiliated Body:</strong></label>--}}
                    {{--                    <label>--}}
                    {{--                        {{$data && $data['dual_course_details']['affiliated_body'] ? $data['dual_course_details']['affiliated_body'] : '--'}}--}}
                    {{--                    </label>--}}
                    <label @if( !$affiliatedBodyvD) class="text-danger" @endif><strong>Affiliated Body:</strong></label>
                    <label>
                        {{$affiliatedBodyvD && $affiliatedBodyvD->code ? $affiliatedBodyvD->code : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['dual_course_details']['duration_of_course']) class="text-danger" @endif><strong>Duration of Course:</strong></label>
                    <label>
                        {{$data && $data['dual_course_details']['duration_of_course'] ? $data['dual_course_details']['duration_of_course'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['dual_course_details']['admission_date']) class="text-danger" @endif><strong>Date of Admission:</strong></label>
                    <label>
                        {{$data && $data['dual_course_details']['admission_date'] ? $data['dual_course_details']['admission_date'] : '--'}}
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group  col-md-3">
                    <label @if( !$data['dual_course_details']['ending_date']) class="text-danger" @endif><strong>Ending Date:</strong></label>
                    <label>
                        {{$data && $data['dual_course_details']['ending_date'] ? $data['dual_course_details']['ending_date'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    {{--                    <label @if( !$data['dual_course_details']['scheme_of_study']) class="text-danger" @endif><strong>Scheme of Study:</strong></label>--}}
                    {{--                    <label>--}}
                    {{--                        {{$data && $data['dual_course_details']['scheme_of_study'] ? $data['dual_course_details']['scheme_of_study'] : '--'}}--}}
                    {{--                    </label>--}}

                    <label @if( $data['dual_course_details']['scheme_of_study'] == '') class="text-danger" @endif><strong>Scheme of Study:</strong></label>
                    <label>
                        @if($data['dual_course_details']['scheme_of_study'] == '0' && $data['dual_course_details']['scheme_of_study'] != '')
                            {{'Annual'}}
                        @elseif($data['dual_course_details']['scheme_of_study'] == '1' && $data['dual_course_details']['scheme_of_study'] != '')
                            {{'Semester'}}
                        @else
                            {{$data && $data['dual_course_details']['scheme_of_study'] ? $data['dual_course_details']['scheme_of_study'] : '--'}}
                        @endif
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['dual_course_details']['semester_category']) class="text-danger" @endif><strong>Semester Category:</strong></label>
                    <label>
                        {{$data && $data['dual_course_details']['semester_category'] ? $data['dual_course_details']['semester_category'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['dual_course_details']['shift']) class="text-danger" @endif><strong>Shift:</strong></label>
                    <label>
                        {{$data && $data['dual_course_details']['shift'] ? $data['dual_course_details']['shift'] : '--'}}
                    </label>
                </div>
            </div>
            <div class="card shadow p-3 w-100">
                <div class="card-body ">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label @if( !$data['dual_course_details']['registration_status']) class="text-danger" @endif><strong>Registration Status with Affiliated Body:</strong></label>
                            <label>
                                {{$data && $data['dual_course_details']['registration_status'] ? $data['dual_course_details']['registration_status'] : '--'}}
                            </label>
                        </div>
                        <div class="form-group col-md-3">
                            <label @if( !$data['dual_course_details']['registration_date']) class="text-danger" @endif><strong>Date of Registration:</strong></label>
                            <label>
                                {{$data && $data['dual_course_details']['registration_date'] ? $data['dual_course_details']['registration_date'] : '--'}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="" class="styling">Registration Fees:</label>
                    </div>
                    <div class="card shadow p-3 w-100">
                        <div class="card-body ">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label @if( !$data['dual_course_details']['actual_fee']) class="text-danger" @endif><strong>Actual:</strong></label>
                                    <label>
                                        {{$data && $data['dual_course_details']['actual_fee'] ? $data['dual_course_details']['actual_fee'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group col-md-4">
                                    <label @if( !$data['dual_course_details']['late_fee']) class="text-danger" @endif><strong>Late:</strong></label>
                                    <label>
                                        {{$data && $data['dual_course_details']['late_fee'] ? $data['dual_course_details']['late_fee'] : '--'}}
                                    </label>
                                </div>
                                <div class="form-group col-md-4">
                                    <label @if( !$data['dual_course_details']['total_fee']) class="text-danger" @endif><strong>Total:</strong></label>
                                    <label>
                                        {{$data && $data['dual_course_details']['total_fee'] ? $data['dual_course_details']['total_fee'] : '--'}}
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
                    <label @if( !$data['dual_course_details']['previous_course']) class="text-danger" @endif><strong>Course:</strong></label>
                    <label>
                        {{$data && $data['dual_course_details']['previous_course'] ? $data['dual_course_details']['previous_course'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['dual_course_details']['board_university']) class="text-danger" @endif><strong>Board / University:</strong></label>
                    <label>
                        {{$data && $data['dual_course_details']['board_university'] ? $data['dual_course_details']['board_university'] : '--'}}
                    </label>
                </div>
                   <div class="form-group  col-md-3">
                    <label @if( !$data['dual_course_details']['previous_roll_no']) class="text-danger" @endif><strong>Roll No:</strong></label>
                    <label>
                        {{$data && $data['dual_course_details']['previous_roll_no'] ? $data['dual_course_details']['previous_roll_no'] : '--'}}
                    </label>
                </div>
                <div class="form-group col-md-3">
                    <label @if( !$data['dual_course_details']['previous_passing_date']) class="text-danger" @endif><strong>Passing Date:</strong></label>
                    <label>
                        {{$data && $data['dual_course_details']['previous_passing_date'] ? $data['dual_course_details']['previous_passing_date'] : '--'}}
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group  col-md-3">
                    <label @if( !$data['dual_course_details']['previous_total_marks']) class="text-danger" @endif><strong>Total Marks:</strong></label>
                    <label>
                        {{$data && $data['dual_course_details']['previous_total_marks'] ? $data['dual_course_details']['previous_total_marks'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['dual_course_details']['previous_marks_obtained']) class="text-danger" @endif><strong>Marks Obtained:</strong></label>
                    <label>
                        {{$data && $data['dual_course_details']['previous_marks_obtained'] ? $data['dual_course_details']['previous_marks_obtained'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['dual_course_details']['previous_percentage']) class="text-danger" @endif><strong>Percentage:</strong></label>
                    <label>
                        {{$data && $data['dual_course_details']['previous_percentage'] ? $data['dual_course_details']['previous_percentage'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['dual_course_details']['previous_cgpa']) class="text-danger" @endif><strong>CGPA:</strong></label>
                    <label>
                        {{$data && $data['dual_course_details']['previous_cgpa'] ? $data['dual_course_details']['previous_cgpa'] : '--'}}
                    </label>
                </div>
            </div>
        </div>
    </div>
@endif
