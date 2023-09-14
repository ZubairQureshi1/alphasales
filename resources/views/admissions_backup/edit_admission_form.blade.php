<div>
    <div class="m-b-10">
        <strong>Student Information:</strong>
        <div class="m-t-10" style="border: solid lightgrey 1px;border-radius: 1px">
            <div style="margin: 10px">
                <!-- @csrf -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Student Name:</label>
                            <div>
                                <input data-parsley-type="name" type="text"
                                       class="form-control" required
                                       value="{{ $admission['student_name'] }}"
                                       name="student_name" id="student_name"
                                       placeholder="Enter Student Name"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Student CNIC:</label>
                            <div>
                                <input 
                                value="{{ $admission['student_cnic_no'] }}" name="student_cnic_no" id="student_cnic_no" required type="text" placeholder="XXXXX-XXXXXXX-X" data-mask="99999-9999999-9" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Father Name:</label>
                            <div>
                                <input data-parsley-type="name" type="text"
                                       class="form-control" required
                                       value="{{ $admission['father_name'] }}"
                                       name="father_name" id="father_name"
                                       placeholder="Enter Student Name"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Father CNIC:</label>
                            <div>
                                <input 
                                value="{{ $admission['father_cnic_no'] }}" name="father_cnic_no" id="father_cnic_no" required type="text" placeholder="XXXXX-XXXXXXX-X" data-mask="99999-9999999-9" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>D.O.B:</label>
                            <div>
                                <input 
                                value="{{ $admission['d_o_b'] }}" name="d_o_b" id="d_o_b" required type="text" placeholder="DD/MM/YYYY" data-mask="99/99/9999" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Email:</label>
                            <div>
                                <input 
                                value="{{ $admission['email'] }}" name="email" id="email" required type="email" placeholder="xyz@abc.com" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Reference:</label>
                            <div>
                                <input data-parsley-type="reference" type="text"
                                       class="form-control" required
                                       value="{{ $admission['reference'] }}"
                                       name="reference" id="reference"
                                       placeholder="Enter Reference"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Student Cell No:</label>
                            <div>
                                <input 
                                value="{{ $admission['student_cell_no'] }}" name="student_cell_no" id="student_cell_no" required type="text"  data-mask="999-9999999" placeholder="XXX-XXXXXXX" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Father Cell No:</label>
                            <div>
                                <input 
                                value="{{ $admission['father_cell_no'] }}" name="father_cell_no" id="father_cell_no" required type="text"  data-mask="999-9999999" placeholder="XXX-XXXXXXX" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>PTCL No:</label>
                            <div>
                                <input 
                                value="{{ $admission['ptcl_no'] }}" name="ptcl_no" id="ptcl_no" required type="text"  data-mask="999-9-9999999" placeholder="XXX-X-XXXXXXX" class="form-control">
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-b-10">
        <strong>Gaurdian Detail:</strong>
        <div class="m-t-10" style="border: solid lightgrey 1px;border-radius: 1px">
            <div style="margin: 10px">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Gaurdian Name:</label>
                            <div>
                                <input data-parsley-type="name" type="text"
                                       class="form-control" required
                                       value="{{ $admission['gaurdian_name'] }}"
                                       name="gaurdian_name" id="gaurdian_name"
                                       placeholder="Enter Gaurdian Name"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Gaurdian Cell No:</label>
                            <div>
                                <input 
                                value="{{ $admission['gaurdian_cell_no'] }}" name="gaurdian_cell_no" id="gaurdian_cell_no" required type="text"  data-mask="999-9999999" placeholder="XXX-XXXXXXX" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Gaurdian Relationship:</label>
                            <div>
                                <input data-parsley-type="name" type="text"
                                       class="form-control" required
                                       value="{{ $admission['gaurdian_relationship'] }}"
                                       name="gaurdian_relationship" id="gaurdian_relationship"
                                       placeholder="Enter Gaurdian Relationship"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-b-10">
        <strong>Addresses:</strong>
        <div class="m-t-10" style="border: solid lightgrey 1px;border-radius: 1px">
            <div style="margin: 10px">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Present Address:</label>
                            <div>
                                <textarea data-parsley-type="present_address" type="text"
                                       class="form-control" required
                                       name="present_address" id="present_address"
                                       placeholder="Enter Present Address">{{ $admission['present_address'] }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Permanent Address:</label>
                            <div>
                                <textarea data-parsley-type="permanent_Address" type="text"
                                       class="form-control" required
                                       name="permanent_address" id="permanent_address"
                                       placeholder="Enter Permanent Address">{{ $admission['permanent_address'] }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Father Work Address:</label>
                            <div>
                                <textarea data-parsley-type="permanent_Address" type="text"
                                       class="form-control" required
                                       name="father_work_address" id="father_work_address"
                                       placeholder="Enter Permanent Address">{{ $admission['father_work_address'] }}</textarea>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <button type="button" id="add_academic" name="add_academic" class="btn btn-secondary waves-effect m-l-5 m-t-10 m-b-10 pull-right">
            Add
        </button>
        <div class="form-group">
                <div class="table-rep-plugin">
                    <div class="table-responsive b-0">
                        <table id="academic_table_body" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Adcadmic Type</td>
                                    <td>Year</td>
                                    <td>Marks</td>
                                    <td>Division/Grade</td>
                                    <td>School/Collage</td>
                                    <td>Board/University</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($acadmicRecords as $index => $record)
                                    <tr>
                                        <td>
                                            <div class='form-group row'>
                                                <div class='col-sm-12'>
                                                    {!! Form::select('academic_type', config('constants.academic_types'), $record['type_id'], ['id' => 'academic_type_{{$index}}', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Type ---']) !!}
                                                </div>
                                            </div>
                                        </td>
                                        <td><div class='form-group col-md-12'><input value="{{$record['year']}}" id='academic_year_{{$index}}' type='text' placeholder='YYYY' data-mask='9999' class='form-control'></div></td>
                                        <td><div class='form-group col-md-12'><input value="{{$record['marks']}}" id='academic_marks_{{$index}}' type='text' placeholder='Marks' class='form-control'></div></td>
                                        <td><div class='form-group col-md-12'><input value="{{$record['grade']}}" id='academic_grade_{{$index}}' type='text' placeholder='Grades' class='form-control'></div></td>
                                        <td><div class='form-group col-md-12'><input value="{{$record['school_college']}}" id='academic_school_{{$index}}' type='text' placeholder='School/College' class='form-control'></div></td>
                                        <td><div class='form-group col-md-12'><input value="{{$record['board_uni']}}" id='academic_board_uni_{{$index}}' type='text' placeholder='Board/University' class='form-control'></div></td>
                                        <td><div class='form-group col-md-12'><div row_index='{{$index}}' class='deleteRowButton'><i class='mdi mdi-delete'></i></div></div></td>
                                        <input type='hidden' name='academic_row_state_{{$index}}' id='academic_row_state_{{$index}}' value='unchanged'></input>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="form-group margin-top-10">

                        </div>
                    </div>
                </div>
        </div>
    </div>
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
                                    @if(count($course->courseSessions()->get())!=0)
                                        <div class="text-center">
                                            @if ($course['isChecked'])
                                                <input name="course_id" type="checkbox" id="{{ $course['id'] }}" checked="true" onclick="onCourseSelect('{{ $course['id'] }}')" switch="bool" value="{{ $course['id'] }}"/>
                                                <label for="{{ $course['id'] }}" data-on-label="Yes" data-off-label="No"></label>
                                            @else
                                                <input name="course_id" type="checkbox" id="{{ $course['id'] }}" onclick="onCourseSelect('{{ $course['id'] }}')" switch="bool" value="{{ $course['id'] }}"/>
                                                <label for="{{ $course['id'] }}" data-on-label="Yes" data-off-label="No"></label>
                                            @endif
                                        </div>
                                        <input name="course_name" id="course_name" hidden value="{{ $course['name'] }}">
                                        <input name="session_name" id="session_name" hidden value="{{ $course->courseSessions()->get()[count($course->courseSessions()->get())-1]->session->session_name }}">
                                        <input name="session_id" id="session_id" hidden value="{{ $course->courseSessions()->get()[count($course->courseSessions()->get())-1]->session->id }}">
                                    @else
                                        @include('includes/course_without_session')
                                    @endif
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            @include('includes/not_found')
        @endif
    </div>
    <div class="">
        <button type="button" onclick="saveAdmission('{{ $admission['form_no'] }}')" class="btn btn-primary">Save</button>
        <a class="btn btn-secondary" href="{{ route('admissions.index') }}">Close</a>
    </div>
</div>
