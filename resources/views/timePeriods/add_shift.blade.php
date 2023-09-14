<div id="smartwizard" class="sw-main mr-2 sw-theme-arrows">
    <ul>
        <li><a href="#step-1">Course Selection<br /><small>Select course for Time Periods</small></a></li>
        <li><a href="#step-2">Subject Selection<br /><small>Select Subject Sections to Implement</small></a></li>
        <!-- <li><a href="#step-3">Section Selection<br /><small>Select course Sections to Implement</small></a></li> -->
        <li><a href="#step-4">Make and Assign Period<br /><small>Assign to Room and Instructor</small></a></li>
        <!-- <li><a href="#step-4">Date Range for Time Period<br /><small>Select when from and when to implement time period</small></a></li> -->
    </ul>

    <div>
        <div id="step-1" class="">
            <div class="m-b-10">
                <strong>Courses/Degrees</strong>
            </div>
            <div class="form-group">
                @if(count($courses)!=0)
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Actions</td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($courses as $index => $course)
                        <tr>
                            <td>{{ $course['name'] }}</td>
                            <td>
                                <div class="text-center">
                                    <input name="courses" class="courses" type="checkbox" id="{{ $course['name'] }}" switch="bool" value="{{ $course['id'] }}"/>

                                    <label for="{{ $course['name'] }}" data-on-label="Yes" data-off-label="No"></label>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                @include('includes/not_found')
                @endif
            </div>
        </div>

        <div id="step-2" class="">

            <div class="m-b-10">
                <strong>Subjects</strong>
            </div>

            <div class="form-group">

                <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="subject_table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Actions</td>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td></td>
                            <td>
                                <div class="text-center">

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>

        <div id="step-3" class="">
            <div class="m-b-10">
                <strong>Sections</strong>
            </div>
            <div class="form-group">
                <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="section_table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Actions</td>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

        <div id="step-4" class="">
            <div class="m-b-10">
                <strong>Roster</strong>
            </div>

            <form  class="" id="InputForm" method="POST" action="{{ route('timePeriods.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label>Start Date:</label>
                        <div>
                            <input class="form-control" type="date" name="start_date" data-date-format="yyyy-mm-dd" required="true" id="start_date">
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-12 m-t-10">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="is_repeat" class="custom-control-input" id="is_repeat" onclick="isRepeat()">
                            <label class="custom-control-label" for="is_repeat">Is Repeat</label>
                        </div>
                    </div>
                </div>
                <div class="row is_repeat_section m-t-10" hidden="hidden">
                    <div class="col-md-3">
                        <label>End Date:</label>
                        <div>
                            <input class="form-control" type="date" name="end_date" data-date-format="yyyy-mm-dd" id="end_date">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label>Shift Working Days:</label>
                        <div>
                            {!! Form::select('selected_days[]', config('constants.week_days'), null, ['id' => 'selected_days', 'class' => 'form-control select2 select2-multiple', 'multiple', 'data-placeholder' => '--- Select Working Days ---']) !!}
                        </div>
                    </div>
                </div>
                
                <br>
                {!! Form::label('session', 'Session:') !!}
                <div id="session_courses">
                    {!! Form::select('session_id', $sessions, null, ['id' => 'session_id', 'class' => 'form-control select2-multiple', 'placeholder' => 'Please Select', 'required' => 'required']) !!}
                </div>

                {!! Form::label('semester','Semester')!!}
                {!! Form::select('semester_id', config('constants.semesters_years'), null, ['id' => 'semester_id', 'onchange' => 'onSemesterSelect()', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Semester/Year No ---', 'required' => 'required']) !!}

                {!! Form::label('timeSlot', 'Time Slot:') !!}
                {!! Form::select('timeSlot_id', $timeSlots, null, ['id' => 'timeSlot_id', 'class' => 'form-control select2-multiple', 'placeholder' => 'Please Select', 'required' => 'required']) !!}


                {!! Form::label('room', 'Rooms:') !!}
                {!! Form::select('room_id', $rooms, null, ['id' => 'room_id', 'class' => 'form-control select2-multiple room', 'placeholder' => 'Please Select', 'required' => 'required']) !!}

                {!! Form::label('user', 'Faculty:') !!}
                {!! Form::select('user_id', $users, null, ['id' => 'user_id', 'class' => 'form-control select2-multiple', 'placeholder' => 'Please Select', 'required' => 'required']) !!}
                

                <input type="hidden" name="course_id" id="course_id">
                <input type="hidden" name="subject_id" id="subject_id">
                <input type="hidden" name="section_id" id="section_id">

                <div class="row m-t-10">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Save</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
