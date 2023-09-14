<div id="roadMap{{ ($sessionCourseKey+1) }}">
    @foreach($session_course->sessionCourseSubjectAnnualSemesterGroups as $annual_semester_key => $session_course_subject_annual_semester_group)
        <div class="row p-t-10">
            <div class="col-md-6">
                <u><b>{{config('constants.academic_terms')[$session_course->academic_term_id]}} {{$session_course_subject_annual_semester_group->annual_semester}}</b></u>
                <input type="hidden" name="academic_timespans[]" value="{{$session_course_subject_annual_semester_group->annual_semester}}">
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-sm btn-info pull-right" onclick="addNewCourses(event, true, {{ ($annual_semester_key+1) }}, '0', {{ ($sessionCourseKey+1) }}, {{ ($session_course->sessionCourseSubjectGroups('annual_semester', $session_course_subject_annual_semester_group->annual_semester)->get()->count() + 1)
            }})"><span class="fa fa-plus"></span> Courses</button>
                <!-- <button type="button" class="btn btn-sm btn-danger pull-right"><span class="fa fa-trash"></span></button> -->
            </div>
        </div>
        <div class="padding-10 margin-top-10 div-border-rad" id="newCourses{{ ($sessionCourseKey+1) }}-{{$session_course_subject_annual_semester_group->annual_semester}}-0">
            @foreach($session_course->sessionCourseSubjectGroups('annual_semester', $session_course_subject_annual_semester_group->annual_semester)->get() as $subject_key => $session_course_subject_group)
                    <div class="row" id="courseAddedRow{{ ($sessionCourseKey+1) }}-{{ $session_course_subject_annual_semester_group->annual_semester }}-{{($subject_key + 1)}}">
                        <div class="col-md-2 form-group">
                            <label>Subjects / Courses</label>
                            <input type="text" name="subject_names[{{($annual_semester_key+1)}}][]" id="subjectName{{ ($sessionCourseKey+1) }}-{{ $session_course_subject_annual_semester_group->annual_semester }}-{{($subject_key + 1)}}" autocomplete="off" onkeyup="autoCompleteSubjectName({{ $session_course_subject_annual_semester_group->annual_semester }}, {{($subject_key + 1)}}, {{ ($sessionCourseKey+1) }})" required="required" value="{{$session_course_subject_group->subject_name}}" class="form-control">
                            <div id="subjectNameSuggestions{{ ($sessionCourseKey+1) }}-{{ $session_course_subject_annual_semester_group->annual_semester }}-{{($subject_key + 1)}}"></div>
                            <input type="hidden" name="subject_ids[{{($annual_semester_key+1)}}][]" value="{{$session_course_subject_group->subject_id}}" id="subjectId{{ ($sessionCourseKey+1) }}-{{ $session_course_subject_annual_semester_group->annual_semester }}-{{($subject_key + 1)}}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Subject / Course Code <small class="text-danger">Only for new subjects</small></label>
                            <input type="text" name="subject_codes[{{($annual_semester_key+1)}}][]" id="subjectCode{{ ($sessionCourseKey+1) }}-{{ $session_course_subject_annual_semester_group->annual_semester }}-{{($subject_key + 1)}}" value="{{$session_course_subject_group->subject_code}}" class="form-control">
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Credit Hours</label>
                            <input type="number" name="credit_hours[{{($annual_semester_key+1)}}][]" min="1" max="6" value="{{$session_course_subject_group->credit_hours!=null?$session_course_subject_group->credit_hours:'0'}}" id="creditHour{{ ($sessionCourseKey+1) }}-{{ $session_course_subject_annual_semester_group->annual_semester }}-{{($subject_key + 1)}}" class="form-control text-right">
                        </div>
                        <div class="col-md-2 form-group" {{ ($subject_key)==0?'hidden': ''}}>
                            <label>Prerequisite Subjects</label>
                            {{ Form::select('prerequisite_subjects['.($annual_semester_key+1).'][]', App\Models\Subject::pluck('name', 'id'), $session_course_subject_group->prerequisite_id!=null?$session_course_subject_group->prerequisite_id:null, ['class' => 'form-control select2', 'id' => ($sessionCourseKey+1).'-'.$session_course_subject_annual_semester_group->annual_semester.'-'.($subject_key + 1), 'placeholder' => '--- Select Prerequisite Subject ---']) }}
                        </div>
                        <div class="col-md-2" {{ ($subject_key)==0?'hidden': ''}}>
                            <button type="button" class="btn btn-sm btn-danger pull-right" onclick="removeCourseAddRow({{ $session_course_subject_annual_semester_group->annual_semester }}, {{ ($subject_key + 1) }} , {{ ($sessionCourseKey+1) }})"><span class="fa fa-trash"></span></button>
                        </div>
                    </div>
            @endforeach
        </div>
    @endforeach
</div>