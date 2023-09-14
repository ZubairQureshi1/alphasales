@if($session->sessionCourses()->where('course_id', $course_id)->where('wing_id', $wing_id)->where('affiliated_body_id', $affiliated_body_id)->get()->count() > 0)
    @foreach($session->sessionCourses()->where('course_id', $course_id)->where('wing_id', $wing_id)->where('affiliated_body_id', $affiliated_body_id)->get() as $sessionCourseKey => $session_course)
    <div id="sessionDetailRow{{ ($sessionCourseKey+1) }}" class="margin-bottom-10 padding-left-10 padding-right-10 div-border">
        <form id="session_form_{{ $sessionCourseKey }}" method="POST" action="{{ route('sessions.update', $session->id)}}">
            @csrf
            <div class="row p-t-10">
                <div class="col-md-10">
                    <u class="text-danger"><b>Note:</b> Any empty field will be considered as unlimited. Degree having "0" no. of seats will not be considered.</u>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-sm btn-danger pull-right" onclick="removeDegreeFromSession(event, {{ ($sessionCourseKey+1) }}, {{$session->id}}, {{$session_course->course_id}})"><span class="fa fa-trash"></span></button>
                </div>
            </div>
            <div class="padding-10 margin-top-10 div-border-rad">
                <div class="row">
                    <div class="col-md-2 form-group">
                        <label>Wings</label>
                        {{ Form::select('wing_id', App\Models\Wing::pluck('name', 'id'), $session_course->wing_id, ['class' => 'form-control select2', 'id' => 'wingId'. ($sessionCourseKey+1), 'onchange' => 'getWingCampuses('. ($sessionCourseKey+1).')', 'placeholder' => '--- Select Wing ---']) }}
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Affiliated Body</label>
                        <div id="course_affiliated_body_div{{ ($sessionCourseKey+1)}}">
                            {{ Form::select('affiliated_body_id', App\Models\AffiliatedBody::pluck('name', 'id'), $session_course->affiliated_body_id, ['class' => 'form-control select2', 'id' => 'affiliated_body'. ($sessionCourseKey+1), 'onchange' => 'clearSearchedCourse('. ($sessionCourseKey+1).')', 'placeholder' => '--- Select Affiliated Body ---']) }}
                        </div>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Degree</label>
                        <input type="text" name="course_name" autocomplete="off" id="courseName{{ ($sessionCourseKey+1)}}" onkeyup="autoCompleteCourseName({{ ($sessionCourseKey+1)}})" required="required" value="{{$session_course->course->name}}" class="form-control course_name">
                        <div id="courseNameSuggestions{{ ($sessionCourseKey+1)}}"></div>
                        <input type="hidden" name="course_id" value="{{$session_course->course_id}}" id="courseId{{ ($sessionCourseKey+1)}}">
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Academic Term</label>
                        <select name="academic_term_id" class="form-control select2" onchange="createRoadMap({{ ($sessionCourseKey+1)}})" id="academicTerm{{ ($sessionCourseKey+1)}}">
                            <option {{$session_course->academic_term_id == null ? 'selected' : ''}} value="">--- Select Academic Term ---</option>
                            @foreach(config('constants.academic_terms') as $key=> $academic_term)
                            <option {{$session_course->academic_term_id == $key ? 'selected' : ''}} value="{{$key}}">{{$academic_term}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Degree Code <small class="text-danger">Only for new degree</small></label>
                        <input type="text" name="course_code" value="{{$session_course->course_code}}" id="courseCode{{ ($sessionCourseKey+1)}}" class="form-control">
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Session Start Date</label>
                        <input name="session_start_date" value="{{$session_course->session_start_date}}" id="sessionStartDate{{ ($sessionCourseKey+1)}}" onchange="checkBackDate({{ ($sessionCourseKey+1)}}), createRoadMap({{ ($sessionCourseKey+1)}})" required type="month" data-date-format="YYYY-MM-DD" class="form-control">
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Session End Date</label>
                        <input name="session_end_date" id="sessionEndDate{{ ($sessionCourseKey+1)}}" onchange="checkBackDate({{ ($sessionCourseKey+1)}}), createRoadMap({{ ($sessionCourseKey+1)}})" value="{{$session_course->session_end_date}}" required type="month" data-date-format="YYYY-MM-DD" class="form-control">
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Tuition Fee</label>
                        <input type="number" value="{{$session_course->tuition_fee}}" class="form-control text-right" min="0" max="999999" name="tuition_fee" placeholder=""/>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>CFE Admission Fee</label>
                        <div>
                            <input type="number" class="form-control text-right" id="cfe_admission_fee-{{ ($sessionCourseKey+1)}}" value="{{$session_course->cfe_admission_fee}}" onchange="calculateAdmissionRegistrationFee({{ ($sessionCourseKey+1)}})" min="0" max="99999" required name="cfe_admission_fee" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Marketer Incentive</label>
                        <div>
                            <input type="number" class="form-control text-right" id="marketer_incentive-{{ ($sessionCourseKey+1)}}" value="{{$session_course->marketer_incentive}}" onchange="calculateAdmissionRegistrationFee({{ ($sessionCourseKey+1)}})" min="0" max="99999" required name="marketer_incentive" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Registration Fee</label>
                        <div>
                            <input type="number" class="form-control text-right" id="registration_fee-{{ ($sessionCourseKey+1)}}" value="{{$session_course->registration_fee}}" onchange="calculateAdmissionRegistrationFee({{ ($sessionCourseKey+1)}})" min="0" max="9999999" required name="registration_fee" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Admission/Registration Fee</label>
                        <div>
                            <input type="number" readonly="" class="form-control text-right" id="admission_registration_fee-{{ ($sessionCourseKey+1)}}" min="0" max="99999" required value="{{$session_course->admission_registration_fee}}" name="admission_registration_fee" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Transport Charges</label>
                        <div>
                            <input type="number" class="form-control text-right" min="0" max="99999" value="{{$session_course->transport_charges}}" required name="transport_charge" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Miscellaneous</label>
                        <div>
                            <input type="number" class="form-control text-right" min="0" max="99999" value="{{$session_course->miscellaneous}}" required name="miscellaneou" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Exam Fee</label>
                        <input type="number" value="{{$session_course->exam_fee}}" class="form-control text-right" min="0" max="99999" value="0" name="exam_fee" placeholder=""/>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Exam Stationary</label>
                        <input type="number" value="{{$session_course->exam_stationery}}" class="form-control text-right" min="0" max="99999" value="0" name="exam_stationerie" placeholder=""/>
                    </div>
                    <!-- <div class="col-md-2 form-group">
                        <label>CFE Publication</label>
                        <input type="number" value="{{$session_course->cfe_publication}}" class="form-control text-right" min="0" max="99999" value="0" name="cfe_publication" placeholder=""/>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Student Card Fee</label>
                        <input type="number" value="{{$session_course->student_card_fee}}" class="form-control text-right" min="0" max="99999" value="0" name="student_card_fee" placeholder=""/>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Trasnport Card Fee</label>
                        <input type="number" value="{{$session_course->trasnport_card_fee}}" class="form-control text-right" min="0" max="99999" value="0" name="trasnport_card_fee" placeholder=""/>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Uniform Charges</label>
                        <input type="number" value="{{$session_course->uniform_charges}}" class="form-control text-right" min="0" max="99999" value="0" name="uniform_charge" placeholder=""/>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Library Card Fee</label>
                        <input type="number" value="{{$session_course->library_card_fee}}" class="form-control text-right" min="0" max="99999" value="0" name="library_card_fee" placeholder=""/>
                    </div> -->
                </div>
                <input type="hidden" class="form-control text-right" name="row_count" value="{{  ($sessionCourseKey+1) }}" />
                @include('sessions/edit/session_campus_details')
            </div>
            @include('sessions/edit/session_course_details')
            <!-- for session detail appending the new row -->
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateDegreeInSession(event, {{ $sessionCourseKey }})" id="session_submit">Save</button>
                <a class="btn btn-secondary" href="{{ route('sessions.index') }}">Close</a>
            </div>
        </form>

    </div>


    @endforeach
@else
    @include('includes/not_found_red')
@endif
