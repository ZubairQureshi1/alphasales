<div id="dual_course_div" class="mt-4" style="display:none;">
    <div class="col-md-12 mt-2">
        <label for="">Dual Course(For CFE purpose):</label>
    </div>
    <div class="card shadow p-3 w-100">
        <div class="card-body ">
            <div class="form-row">
                <div class="form-group  col-md-3">
                    <label>Course:</label>

                    <input type="hidden" id="check_session_index_id" value="@if(isset($data['index_id'])) {{$data['index_id']}} @endif">
                    <select onchange="selectAffiliatedBodyId_dual(); checkDateCountDual(); getCourseToIndexTable();" name="course" id="course" class="form-control">
                        <option value="" selected>--select--</option>
{{--                        @foreach(\Config::get('constants.course') as $key => $value)--}}
{{--                            <option value="{{$key}}" {{ $data ? $data['dual_course_details']['course'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
{{--                        @endforeach--}}
                    </select>
                    @php
                        $checkifvtidual = 0;
                        if(isset($data['dual_course_details']['course'])){
                            $checkifvtidual = $data['dual_course_details']['course'];
                        }
                    @endphp
                </div>
            </div>
            <div class="form-row">
                <div class="form-group  col-md-3">
                    <label>Roll No:</label>
                    <input type="text" class="form-control text-center" name="roll_no" placeholder="Enter Roll No"
                    value="{{$data ? $data['dual_course_details']['roll_no'] : ''}}">
                </div>
                <div class="form-group  col-md-3">
                    <label>Affiliated Body:</label>
                    <select readonly name="affiliated_body" id="affiliated_body" class="form-control">
                        <option value="" selected>--select--</option>
{{--                        @foreach(\Config::get('constants.affiliated_body') as $key => $value)--}}
{{--                            <option value="{{$key}}" {{ $data ? $data['dual_course_details']['affiliated_body'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
{{--                        @endforeach--}}
                        @foreach($affiliated_bodies as $affiliated_body)
                            <option value="{{$affiliated_body->id}}" {{ $data ? $data['dual_course_details']['affiliated_body'] == $affiliated_body->id ? 'selected' : '' : ''}}>{{$affiliated_body->code}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group  col-md-3">
                    <label>Duration of Course:</label>
                    <input readonly type="text" name="duration_of_course" id="duration_of_course" value="{{ $data ? $data['dual_course_details']['duration_of_course'] : ''}}" class="form-control">
{{--                    <select  name="duration_of_course" class="form-control">--}}
{{--                        <option value="" selected disabled>--select--</option>--}}
{{--                        @foreach(\Config::get('constants.duration_of_course') as $key => $value)--}}
{{--                            <option value="{{$key}}" {{ $data ? $data['dual_course_details']['duration_of_course'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
                </div>
                <div class="form-group  col-md-3">
                    <label>Date of Admission:</label>
                    <input onchange="getEndDateForDual();" type="text" class="form-control text-center datepicker__" name="admission_date" id="admission_date"
                           placeholder="Enter Date"
                           value="{{$data && $data['dual_course_details']['admission_date'] ? date('d/m/Y',strtotime($data['dual_course_details']['admission_date'])) : ''}}"
                           
                    >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group  col-md-3">
                    <label>Ending Date:</label>
                    <input readonly type="text" class="form-control text-center datepickerAll" name="ending_date" id="ending_date"
                           placeholder="Enter Date"
                          value="{{$data && $data['dual_course_details']['ending_date'] ? date('d/m/Y',strtotime($data['dual_course_details']['ending_date'])) : ''}}"
                         
                    >
                </div>
                <div class="form-group  col-md-3">
                    <label>Scheme of Study:</label>
                    <select readonly="" name="scheme_of_study" class="form-control" id="vti_dual_scheme_of_study">
                        <option value="" selected>--select--</option>
                        @foreach(\Config::get('constants.academic_terms') as $key => $value)
                            <option value="{{$key}}" {{ $sessionStartEndDate ? $sessionStartEndDate->academic_term_id == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3" id="vti_dual_semester_category">
                    <label>Semester Category:</label>
                    <select name="semester_category" class="form-control">
                        <option value="" selected>--select--</option>
                        @foreach(\Config::get('constants.semester_category') as $key => $value)
                            <option value="{{$key}}" {{ $data ? $data['dual_course_details']['semester_category'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group  col-md-3">
                    <label>Shift:</label>
                    <select  name="shift" class="form-control">
                        <option value="" selected>--select--</option>
                        @foreach(\Config::get('constants.shift') as $key => $value)
                            <option value="{{$key}}" {{ $data ? $data['dual_course_details']['shift'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
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
                                            <input type="text" name="previous_course" id="previous_course" value="{{ $data ? $data['dual_course_details']['previous_course'] : ''}}" class="form-control">
                                        </div>
                                        <div class="form-group  col-md-3">
                                            <label>Board / University:</label>
                                            <input type="text" name="board_university" id="board_university" value="{{ $data ? $data['dual_course_details']['board_university'] : ''}}" class="form-control">
                                        </div>
                                        <div class="form-group  col-md-3">
                                            <label>Roll No:</label>
                                            <input type="text" class="form-control text-center" id="previous_roll_no" name="previous_roll_no" placeholder="Enter Roll No" value="{{$data ? $data['dual_course_details']['previous_roll_no'] : ''}}">
                                        </div>
                                         <div class="form-group col-md-3">
                                            <label>Passing Date:</label>
                                            <input type="text" class="form-control text-center datepicker" id="previous_passing_date" name="previous_passing_date" value="{{$data && $data['dual_course_details']['previous_passing_date'] ? date('d/m/Y',strtotime($data['dual_course_details']['previous_passing_date'])) : ''}}"
                                            placeholder="Enter Date">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group  col-md-3">
                                            <label>Total Marks:</label>
                                            <input id="previous_total_marks_dual" onkeyup="setPercentageForDualCourse()" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="previous_total_marks" placeholder="Enter Total Marks" value="{{$data ? $data['dual_course_details']['previous_total_marks'] : ''}}">
                                        </div>
                                        <div class="form-group  col-md-3">
                                            <label>Marks Obtained:</label>
                                            <input id="previous_marks_obtained_dual" onkeyup="setPercentageForDualCourse()" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="previous_marks_obtained" placeholder="Enter Marks Obtained" value="{{$data ? $data['dual_course_details']['previous_marks_obtained'] : ''}}">
                                        </div>
                                        <div class="form-group  col-md-3">
                                            <label>Percentage:</label>
                                            <input id="previous_cgpa_dual" readonly type="text" class="form-control text-center" name="previous_percentage" placeholder="Enter Previous CGPA" value="{{$data ? $data['dual_course_details']['previous_cgpa'] : ''}}">
                                        </div>
                                        <div class="form-group  col-md-3">
                                            <label>CGPA:</label>
                                            <input id="previous_cgpa" type="text" class="form-control text-center" name="previous_cgpa" placeholder="Enter Previous CGPA" value="{{$data ? $data['dual_course_details']['previous_cgpa'] : ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div><br>
            <div class="card shadow p-3 w-100">
                <div class="card-body ">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Registration Status with Affiliated Body:</label>
                            <select onchange="setDualCourseRegistrationDateDisplay()" id="dual_registration_status" name="registration_status" class="form-control">
                                <option value="" selected>--select--</option>
                                @foreach(\Config::get('constants.registration_status') as $key => $value)
                                    <option value="{{$key}}" {{ $data ? $data['dual_course_details']['registration_status'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3" id="dual_registration_date">
                            <label>Date of Registration:</label>
                            <input type="text" class="form-control text-center datepicker" name="registration_date"
                                   placeholder="Enter Date" value="{{$data && $data['dual_course_details']['registration_date'] ? date('d/m/Y',strtotime($data['dual_course_details']['registration_date'])) : ''}}">
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="">Registration Fees:</label>
                    </div>
                    <div class="card shadow p-3 w-100">
                        <div class="card-body ">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Actual:</label>
                                    <input id="actual_fee_dual" onkeyup="setTotalFeeDualCourse()" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="actual_fee"
                                           placeholder="XXXXX" value="{{$data ? $data['dual_course_details']['actual_fee'] : ''}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Late:</label>
                                    <input id="late_fee_dual" onkeyup="setTotalFeeDualCourse()" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center " name="late_fee"
                                           placeholder="XXXXX" value="{{$data ? $data['dual_course_details']['late_fee'] : ''}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Total:</label>
                                    <input id="total_fee_dual" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="total_fee"
                                           readonly value="{{$data ? $data['dual_course_details']['total_fee'] : ''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var index_id_session = $('#check_session_index_id').val();
    getCourseList_dual();
    function getCourseList_dual(){
        // alert('b');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var session_id =0;
        session_id = $('#sessions').val();
        console.log("session "+session_id);
        var myurl ='';
        if(index_id_session)
        {
            myurl= '/getCoursesEwingSessions_dual/'+session_id;
        }
        else
        {
            myurl = 'getCoursesEwingSessions_dual/'+session_id;
        }
        $.ajax({

            method:'GET',
            data:{},
            url:myurl,
            success:function(response){
                console.log('success');
                // alert('ss');
                // console.log(data[0][0].id);
                // $.each (data, function () {
                //     console.log (data);
                // });
                $('#course').empty();
                $('#course').append($('<option selected disabled></option>').attr('value', '').text('-- Select Course --'));
                for(var i=0;i<response.output.length;i++) {

                    console.log(response.output[i].id);
                    // console.log(response.output[i].title);
                    // console.log(response.output[i].amount);
                    //response.output[i].id;


                    if (index_id_session) {
                        var course_rst = {{$checkifvtidual}};
                    } else {
                        course_rst = '0';
                    }

                    if (course_rst != '0') {

                        if (course_rst == response.output[i].id) {
                            $('#course').append($('<option selected></option>').attr('value', response.output[i].id).text(response.output[i].name));
                            // $('#ims_course_enrolled_in_cfe').append($('<option selected></option>').attr('value', response.output[i].id).text(response.output[i].name));
                            // $('#ims_course_registered').append($('<option selected></option>').attr('value', response.output[i].id).text(response.output[i].name));
                            getAcademicTerm_dual();
                        } else {
                            $('#course').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                            // $('#ims_course_enrolled_in_cfe').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                            // $('#ims_course_registered').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                        }

                    } else {
                        $('#course').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                        // $('#ims_course_enrolled_in_cfe').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                        // $('#ims_course_registered').append($('<option></option>').attr('value', response.output[i].id).text(response.output[i].name));
                    }
                }
            },
            error:function(data){
                // alert('ee');
                console.log('error');
            }
        });
    }
    //IMS Wing
    function selectAffiliatedBodyId_dual(){

        var ims_course_applied_in_cfe = $('#course').val();
        // alert(ims_course_applied_in_cfe);

        var newims_affiliated_body = $('#affiliated_body').val();
        // alert(newims_affiliated_body);
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({

            method:'GET',
            data:{},
            url:'getIMSAffiliatedID/'+ims_course_applied_in_cfe,
            success:function(data){
                console.log('success');
                console.log (data);
                console.log("here We go with data");
                $('#affiliated_body').val(data);
                getAcademicTerm_dual();
            },
            error:function(data){
                console.log('error');
            }
        });
    }

    function getAcademicTerm_dual(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var imsAffiliatedBody = '';
        imsAffiliatedBody = $('#affiliated_body').val();
        console.log("imsAffiliatedBody "+imsAffiliatedBody);
        // var wing_id =0;
        // wing_id = $('#cfe_wing_selection').val();
        // console.log("wing "+wing_id);
        var course_id ='';
        course_id = $('#course').val();
        console.log('course id '+course_id);
        var c_url = '';
        if(index_id_session){
            c_url = '/getAcademicTerm/'+imsAffiliatedBody+'/'+wing_id+'/'+course_id;
        }else{
            c_url = 'getAcademicTerm_dual/'+imsAffiliatedBody+'/'+course_id;
        }
        $.ajax({

            method:'GET',
            data:{},
            url:c_url,
            success:function(data){
                console.log('success');
                console.log(data);
                // alert(data[0].academic_term_id);

                $('#vti_dual_scheme_of_study').val(data[0].academic_term_id);
                // setImsSemesterCategoryDisplay();
                var now = new Date(data[0].session_end_date);
                        var past = new Date(data[0].session_start_date);
                        var nowYear = now.getFullYear();
                        var pastYear = past.getFullYear();
                        var years = nowYear - pastYear;
                        // total_sem_count = years;
                        // alert(getTotalSessionDuration);
                        getTotalSessionDuration = years;
                        $('#duration_of_course').val(getTotalSessionDuration + ' Years');
                        // $('#af_duration_of_course').val(getTotalSessionDuration + ' Years');
                        // $('#bise_duration_of_course').val(getTotalSessionDuration + ' Years');
                        // $('#vti_duration_of_diploma').val(1 + ' Years');
                         $('#admission_date').val('');
                        $('#ending_date').val('');
                getAnnualSemesterCount_dual();

            },
            error:function(data){
                console.log('error');
            }
        });
    }

    function getAnnualSemesterCount_dual(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var imsAffiliatedBody = '';
        imsAffiliatedBody = $('#affiliated_body').val();
        console.log("imsAffiliatedBody "+imsAffiliatedBody);
        var course_id ='';
        course_id = $('#course').val();
        console.log('course id '+course_id);
        var c_url = '';
        if(index_id_session){
            c_url = '/getAnnualSemesterCount/'+imsAffiliatedBody+'/'+course_id;
        }
        else{
            c_url = 'getAnnualSemesterCount_dual/'+imsAffiliatedBody+'/'+course_id;
        }
        $.ajax({

            method:'GET',
            data:{},
            url:c_url,
            success:function(data){
                console.log('success');
                console.log(data);
                total_sem_count_dual = data;
                var checkSem = $('#vti_dual_scheme_of_study').val();
                if(checkSem == 1){
                    if(total_sem_count_dual == 1){
                        $('#duration_of_course').val('0.5 Years');
                    }
                    else if(total_sem_count_dual == 2){
                        $('#duration_of_course').val('1 Years');
                    }
                    else if(total_sem_count_dual == 3){
                        $('#duration_of_course').val('1.5 Years');
                    }
                    else if(total_sem_count_dual == 4){
                        $('#duration_of_course').val('2 Years');
                    }
                    else if(total_sem_count_dual == 5){
                        $('#duration_of_course').val('2.5 Years');
                    }
                    else if(total_sem_count_dual == 6){
                        $('#duration_of_course').val('3 Years');
                    }
                    else if(total_sem_count_dual == 7){
                        $('#duration_of_course').val('3.5 Years');
                    }
                    else if(total_sem_count_dual == 8){
                        $('#duration_of_course').val('4 Years');
                    }
                }
                else if(checkSem == 0){
                    $('#duration_of_course').val(total_sem_count_dual +' Years');
                }
                x
            },
            error:function(data){
                console.log('error');
            }
        });
    }
        function getEndDateForDual(){
            var dateOfAdmission = $('#admission_date').val().split('/');
            var year = parseInt(dateOfAdmission[2]);
            $('#ending_date').val(dateOfAdmission[0] + "/" + dateOfAdmission[1] + "/" + parseInt(year + getTotalSessionDuration));
        }
        function checkDateCountDual() {
            // var now = new Date("{{$endDateOfSession}}");
            // var past = new Date("{{$startDateOfSession}}");
            // var nowYear = now.getFullYear();
            // var pastYear = past.getFullYear();
            // var years = nowYear - pastYear;
            // // total_sem_count = years;
            // getTotalSessionDuration = years;
            // $('#duration_of_course').val(getTotalSessionDuration + ' Years');

        }

        function getCourseToIndexTable(){
            // alert($('#course').val());
            $('#course_selected_from_page_07').val($('#course').val());
            $('#course_selected_from_page_07_name').val($('#course option:selected').text());
            $('#dual_course_from_page_07').val('1');
        }
</script>
