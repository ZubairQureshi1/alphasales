<div>
    <div class="row">
        <div class="form-group col-sm-4">
            {!! Form::label('enquiry_by', 'Enquiry By:') !!}
            {!! Form::select('user_id', $users, null, ['id' => 'user_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Type ---']) !!}
        </div>
        <div class="form-group col-sm-4">
            {!! Form::label('enquiry_type', 'Enquiry Type:') !!}
            {!! Form::select('enquiry_type', config('constants.enquiry_types'), null, ['id' => 'enquiry_type', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Type ---']) !!}
        </div>
    <div class="col-sm-4 m-b-10">
        <input type="checkbox" onclick="showCASection()" name="ca_section_show" id="is_ca">
        <label class="" for="is_ca"> Is CA/ACCA/AFD</label>
    </div>
    </div>
    <div class="m-b-10">
        <strong>Student Information:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <!-- @csrf -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Student Name:<span class="required-span">*</span></label>
                            <div>
                                <input data-parsley-type="name" type="text"
                                       class="form-control" required
                                       <?php if (isset($enquiry)): ?>
                                           value= {!! $enquiry['student_name'] !!}
                                       <?php endif?>
                                       name="student_name" id="student_name"
                                       placeholder="Enter Student Name"/>
                                <span id="student_name_message"></span>

                            </div>
                        </div>{{-- 
                        <div class="col-md-3">
                            <label>Student Old Roll No:</label>
                            <div>
                                <input name="old_roll_no" id="old_roll_no" required type="text" placeholder="Enter Old Roll No" class="form-control">
                                <span id="student_name_message"></span>
                            </div>
                        </div> --}}
                        <div class="col-md-3">
                            <label>Student CNIC:<span class="required-span">*</span></label>
                            <div>
                                <input name="student_cnic_no" id="student_cnic_no" required type="text" placeholder="XXXXX-XXXXXXX-X" data-mask="99999-9999999-9" class="form-control">
                                <span id="student_cnic_no_message"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Father Name:<span class="required-span">*</span></label>
                            <div>
                                <input data-parsley-type="name" type="text"
                                       class="form-control" required
                                       name="father_name" id="father_name"
                                       <?php if (isset($enquiry)): ?>
                                           value= {!! $enquiry['father_name'] !!}
                                       <?php endif?>
                                       placeholder="Enter Father Name"/>
                                <span id="father_name_message"></span>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Father CNIC:<span class="required-span">*</span></label>
                            <div>
                                <input name="father_cnic_no" id="father_cnic_no" required type="text" placeholder="XXXXX-XXXXXXX-X" data-mask="99999-9999999-9" class="form-control">
                                <span id="father_cnic_no_message"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>D.O.B:<span class="required-span">*</span></label>
                            <div>
                                <input name="d_o_b" id="d_o_b" required type="text" placeholder="DD/MM/YYYY" data-mask="99/99/9999" class="form-control">
                                <span id="d_o_b_message"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Email:<span class="required-span">*</span></label>
                            <div>
                                <input name="email" id="email" required type="email" placeholder="xyz@abc.com" class="form-control">
                                <span id="email_message"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label>Student Cell No:<span class="required-span">*</span></label>
                            <div>
                                <input name="student_cell_no" id="student_cell_no" required type="text"  data-mask="9999-9999999" placeholder="XXXX-XXXXXXX" class="form-control">
                                <span id="student_cell_no_message"></span>
                            </div>
                        </div>
                
                        <div class="col-md-3">
                            <label>Father Cell No:<span class="required-span">*</span></label>
                            <div>
                                <input name="father_cell_no" id="father_cell_no" required type="text"  data-mask="9999-9999999" placeholder="XXXX-XXXXXXX" class="form-control">
                                <span id="father_cell_no_message"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>PTCL No:<span class="required-span">*</span></label>
                            <div>
                                <input name="ptcl_no" id="ptcl_no" required type="text"  data-mask="999-9-9999999" placeholder="XXX-X-XXXXXXX" class="form-control">
                                <span id="ptcl_no_message"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-b-10">
        <strong>Course & Reference:</strong>
        <div class="m-t-10 div-border-rad">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Course:<span class="required-span">*</span></label>
                            <div>
                                {!! Form::select('course_id', $courses, null, ['id' => 'course_id', 'class' => 'form-control select2 select2-multiple', 'placeholder' => '--- Select Course ---']) !!}
                            </div>
                            <span id="course_message"></span>
                        </div>
                        <div class="col-md-3">
                            <label>Reference:<span class="required-span">*</span></label>
                            <div>
                                {!! Form::select('reference_id', $references, null, ['id' => 'reference_id', 'class' => 'form-control select2 select2-multiple', 'placeholder' => '--- Select Reference ---']) !!}
                            </div>
                            <span id="reference_id_message"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-b-10">
        <strong>Gaurdian Detail (Optional):</strong>
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
                                <span id="gaurdian_name_message"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Gaurdian Cell No:</label>
                            <div>
                                <input name="gaurdian_cell_no" id="gaurdian_cell_no" required type="text"  data-mask="9999-9999999" placeholder="XXXX-XXXXXXX" class="form-control">
                                <span id="gaurdian_cell_no_message"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Gaurdian Relationship:</label>
                            <div>
                                <input data-parsley-type="name" type="text"
                                       class="form-control" required
                                       name="gaurdian_relationship" id="gaurdian_relationship"
                                       placeholder="Enter Gaurdian Relationship"/>
                                <span id="gaurdian_relationship_message"></span>
                            </div>
                        </div>
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
                            <label>Present Address:<span class="required-span">*</span></label>
                            <div>
                                <textarea data-parsley-type="present_address" type="text"
                                       class="form-control" required
                                       name="present_address" id="present_address"
                                       placeholder="Enter Present Address"></textarea>
                                <span id="present_address_message"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Permanent Address (Optional):</label>
                            <div>
                                <textarea data-parsley-type="permanent_address" type="text"
                                       class="form-control" required
                                       name="permanent_address" id="permanent_address"
                                       placeholder="Enter Permanent Address"></textarea>
                                <span id="permanent_address_message"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Father Work Address:<span class="required-span">*</span></label>
                            <div>
                                <textarea data-parsley-type="father_work_address" type="text"
                                       class="form-control" required
                                       name="father_work_address" id="father_work_address"
                                       placeholder="Enter Father Work Address"></textarea>
                                <span id="father_work_address_message"></span>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-b-10" id="ca_section" hidden="true">
        <strong>CA History (For CA Students):</strong>
        <div class="m-t-10 div-border-rad" style="">
            <div class="margin-10">
                <div class="form-group">
                    <div class="row" id="course_div">
                        <div class="col-md-4">
                            <label>AFC/CAF/CFAP/MSA:</label>
                            <div>
                                <textarea data-parsley-type="ca_subject" type="text"
                                       class="form-control" required
                                       name="ca_subject" id="ca_subject"
                                       placeholder="Enter Subject"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Status:</label>
                            <div>
                                {!! Form::select('ca_status', config('constants.academic_statuses'), null, ['id' => 'ca_status', 'class' => 'form-control select2', 'placeholder' => '--- Select Status ---']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>RAET/Institution:</label>
                            <div>
                                <input name="raet_institution" id="raet_institution" required type="text" placeholder="Enter RAET/Institution" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>ICAP CRN:</label>
                            <div>
                                <input name="icap_crn" id="icap_crn" required type="number" placeholder="Enter ICAP CRN" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>ICAP Roll No:</label>
                            <div>
                                <input name="icap_roll_no" id="icap_roll_no" required type="number" placeholder="Enter ICAP Roll No" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-t-10">
        <button type="button" onclick="saveEnquiry()" class="btn btn-primary">Save</button>
        <a class="btn btn-secondary" href="{{ route('enquiries.index') }}">Close</a>
    </div>
</div>
