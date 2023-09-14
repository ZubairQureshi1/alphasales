<div>
    <?php if (isset($enquiry)): ?>
        <input name="enquiry_id" id="enquiry_id" hidden type="text" class="form-control" value="{!! $enquiry['enquiry_id'] !!}">
    <?php endif?>
    <div class="m-b-10">
        <strong>Student Information:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <!-- @csrf -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Student Name:</label>
                            <div>
                                <input data-parsley-type="name" type="text"
                                       class="form-control" required
                                       <?php if (isset($enquiry)): ?>
                                           value= {!! $enquiry['student_name'] !!}
                                       <?php endif?>
                                       name="student_name" id="student_name"
                                       placeholder="Enter Student Name"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Student Old Roll No:</label>
                            <div>
                                <input name="old_roll_no" id="old_roll_no" required type="text" placeholder="Enter Old Roll No" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Student CNIC:</label>
                            <div>
                                <input name="student_cnic_no" id="student_cnic_no" required type="text" placeholder="XXXXX-XXXXXXX-X" data-mask="99999-9999999-9" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Father Name:</label>
                            <div>
                                <input data-parsley-type="name" type="text"
                                       class="form-control" required
                                       name="father_name" id="father_name"
                                       <?php if (isset($enquiry)): ?>
                                           value= {!! $enquiry['father_name'] !!}
                                       <?php endif?>
                                       placeholder="Enter Student Name"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Father CNIC:</label>
                            <div>
                                <input name="father_cnic_no" id="father_cnic_no" required type="text" placeholder="XXXXX-XXXXXXX-X" data-mask="99999-9999999-9" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>D.O.B:</label>
                            <div>
                                <input name="d_o_b" id="d_o_b" required type="date"  data-date-format="YYYY-MM-DD" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Email:</label>
                            <div>
                                <input name="email" id="email" required type="email" placeholder="xyz@abc.com" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Reference:</label>
                            <div>
                                {!! Form::select('reference_id', $references, (isset($enquiry)&&$enquiry!=null)?$enquiry['reference_id']:null, ['id' => 'reference_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Reference ---']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Student Cell No:</label>
                            <div>
                                <input name="student_cell_no" id="student_cell_no" required type="text"  data-mask="9999-9999999" placeholder="XXXX-XXXXXXX" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Father Cell No:</label>
                            <div>
                                <input name="father_cell_no" id="father_cell_no" required type="text"  data-mask="9999-9999999" placeholder="XXXX-XXXXXXX" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>PTCL No:</label>
                            <div>
                                <input name="ptcl_no" id="ptcl_no" required type="text"  data-mask="999-9-9999999" placeholder="XXX-X-XXXXXXX" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Admission Form Type:</label>
                            <div>
                                {!! Form::select('student_category_id', config('constants.student_categories'), null, ['id' => 'student_category_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Admission Type ---']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-b-10">
        <strong>Gaurdian Detail:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Gaurdian Name:</label>
                            <div>
                                <input data-parsley-type="name" type="text"
                                       class="form-control" required
                                       name="gaurdian_name" id="gaurdian_name"
                                       placeholder="Enter Gaurdian Name"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Gaurdian Cell No:</label>
                            <div>
                                <input name="gaurdian_cell_no" id="gaurdian_cell_no" required type="text"  data-mask="9999-9999999" placeholder="XXXX-XXXXXXX" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Gaurdian Relationship:</label>
                            <div>
                                <input data-parsley-type="name" type="text"
                                       class="form-control" required
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
        <strong>Is Worker:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                        {!! Form::select('student_category_id', config('constants.student_categories'), (isset($enquiry)&&$enquiry!=null)?$enquiry['student_category_id']:null, ['id' => 'student_category_id', 'onchange' => 'onWorkerSelect()', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select ------']) !!}
                        </div>
                    </div>
                    <div class="row" id="worker_details">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-b-10">
        <strong>Addresses:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Present Address:</label>
                            <div>
                                <textarea data-parsley-type="present_address" type="text"
                                       class="form-control" required
                                       name="present_address" id="present_address"
                                       placeholder="Enter Present Address"><?php if (isset($enquiry)): ?>{!! $enquiry['present_address']!=null?$enquiry['present_address']:'' !!}<?php endif?></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Permanent Address:</label>
                            <div>
                                <textarea data-parsley-type="permanent_address" type="text"
                                       class="form-control" required
                                       name="permanent_address" id="permanent_address"
                                       placeholder="Enter Permanent Address"><?php if (isset($enquiry)): ?>{!! $enquiry['permanent_address']!=null?$enquiry['permanent_address']:'' !!}<?php endif?></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Father Work Address:</label>
                            <div>
                                <textarea data-parsley-type="father_work_address" type="text"
                                       class="form-control" required
                                       name="father_work_address" id="father_work_address"
                                       placeholder="Enter Father Work Address"></textarea>
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

                            </tbody>
                        </table>
                        <div class="form-group margin-top-10">

                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="m-b-10">
        <strong>Courses\Degree:</strong>
        <div class="m-t-10 div-border-rad" style="">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row" id="course_div">
                        <div id="course_select" class="col-3">
                            <strong>Courses:</strong>
                            @if(count($courses)!=0)
                                {!! Form::select('course_id', $courses, null, ['id' => 'course_id', 'onChange' => 'onCourseSelect()', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Course ---']) !!}
                            @else
                                @include('includes/not_found')
                            @endif

                        </div>
                        <div id="section_select">
                        </div>
                        <div id="session_select">
                        </div>
                        <div id="session_select" class="element-flex-end">
                            <button type="button" class="btn btn-secondary waves-effect waves-light pull-right"  data-toggle="modal" data-target="#course_subjects">View Books</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <button type="button" onclick="saveAdmission()" class="btn btn-primary">Save</button>
        <a class="btn btn-secondary" href="{{ route('admissions.index') }}">Close</a>
    </div>
</div>
@include('admissions/courses_model')
