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
<div class="col-md-12">
            <h1>Receipt and Submission</h1>
            </div><br>
        <div class="form-row" style="margin-left: 8px;">
            <div class="form-group pt-3 col-md-2">
                <label  for="session" @if( !$data['session']) class="text-danger" @endif><strong>Session:</strong></label>
                <label >
                        {{$session_name->session_name}}
{{--                    {{$data && $data['session'] ? $data['session'] : '--'}}--}}
                </label>
            </div>
            <div class="form-group pt-3 col-md-4">
                <label for="districts"@if( !$data['district']) class="text-danger" @endif><strong>District:</strong></label>
                <label >
{{--                    {{$city_name && $city_name->name ? $city_name->name : '--'}}--}}
                    @if($data['district'] == 'Other')
                        {{$data && $data['district_other'] ? $data['district_other'] : '--'}}
                    @elseif($data['district'] != 'other')
                        {{$data && $data['district'] ? $data['district'] : '--'}}
                    @endif

                </label>
            </div>
        </div>
        <div class="col-md-12">
            <label for="" class="styling">Receipt and Submission:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label @if( !$data['file_received_number']) class="text-danger" @endif><strong>File Received No:</strong></label>
                        <label>
                            {{$data && $data['file_received_number'] ? $data['file_received_number'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['receiving_date']) class="text-danger" @endif><strong>Receiving Date:</strong></label>
                        <label >
                            {{$data && $data['receiving_date'] ? $data['receiving_date'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['file_receipt_voucher_number']) class="text-danger" @endif><strong>File Receipt Voucher No:</strong></label>
                        <label >
                            {{$data && $data['file_receipt_voucher_number'] ? $data['file_receipt_voucher_number'] : '--'}}
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label @if( !$data['file_module_number']) class="text-danger" @endif><strong>File Module Number:</strong></label>
                        <label>
                            {{$data && $data['file_module_number'] ? $data['file_module_number'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['admission_set_submitted']) class="text-danger" @endif><strong>Admission Set Submitted:</strong></label>
                        <label >
                            {{$data && $data['admission_set_submitted'] ? $data['admission_set_submitted'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['file_submitted_to_pwwb']) class="text-danger" @endif><strong>File Submitted in PWWB:</strong></label>
                        <label >
                            {{$data && $data['file_submitted_to_pwwb'] ? $data['file_submitted_to_pwwb'] : '--'}}
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label @if( !$data['file_receipt_voucher_date']) class="text-danger" @endif><strong>FRV Date:</strong></label>
                        <label >
                            {{$data && $data['file_receipt_voucher_date'] ? $data['file_receipt_voucher_date'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['fresh_file_submission_in_pwwb_number']) class="text-danger" @endif><strong>Fresh Fle Submission in PWWB No:</strong></label>
                        <label >
                            {{$data && $data['fresh_file_submission_in_pwwb_number'] ? $data['fresh_file_submission_in_pwwb_number'] : '--'}}
                        </label>
                    </div>
                     <div class="form-group col-md-4">
                        <label @if( !$data['submission_date']) class="text-danger" @endif><strong>Submission Date:</strong></label>
                        <label >
                            {{$data && $data['submission_date'] ? $data['submission_date'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['priority_of_submission']) class="text-danger" @endif><strong>Priority of Submission:</strong></label>
                        <label >
                            {{$data && $data['priority_of_submission'] ? $data['priority_of_submission'] : '--'}}
                        </label>
                    </div>
                     <div class="form-group col-md-4">
                        <label @if( !$data['pwwb_diary_number']) class="text-danger" @endif><strong>PWWB Diary No:</strong></label>
                        <label >
                            {{$data && $data['pwwb_diary_number'] ? $data['pwwb_diary_number'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label >
                        <label @if( !$data['pwwb_diary_date']) class="text-danger" @endif><strong>PWWB Diary Date:</strong></label>
                            {{$data && $data['pwwb_diary_date'] ? $data['pwwb_diary_date'] : '--'}}
                        </label>
                    </div>
                </div>
                <div class="form-row ">
                    <div class="form-group col-md-4">
                        <label @if( !$data['pending_files_with_remarks']) class="text-danger" @endif><strong>Pending Files(With Remarks):</strong></label>
                        <label >
                            {{$data && $data['pending_files_with_remarks'] ? $data['pending_files_with_remarks'] : '--'}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Details -->
        <div class="card shadow mt-5 p-3 w-100">
            <div class="card-body" id="worker_detail_parent">
                <div class="form-row">
                    <div class="">
                        <label class="styling">Worker's Eligible Family Members:</label>
                    </div>
                </div>
                <div class="form-row pt-3">
                    <div class="border col-md-1 text-center">
                        <label ><strong>Serial No.</strong></label>
                    </div>
                    <div class="border col-md-2 text-center">
                        <label ><strong>Worker Name</strong></label>
                    </div>
                    <div class="border col-md-2 text-center">
                        <label ><strong>Worker's CNIC</strong></label>
                    </div>
                    <div class="border col-md-1 text-center">
                        <label ><strong>Student Name</strong></label>
                    </div>
                    <div class="border col-md-1 text-center">
                        <label ><strong>Passed Degree</strong></label>
                    </div>
                    <div class="border col-md-1 text-center">
                        <label ><strong>Potential Degree</strong></label>
                    </div>
                    <div class="border col-md-1 text-center">
                        <label ><strong>File Received Status</strong></label>
                    </div>
                    <div class="border col-md-1 text-center">
                        <label ><strong>Follow-up</strong></label>
                    </div>
                </div>
                @if($data['worker_family_member_details'])
                    @foreach($data['worker_family_member_details'] as $worker_details)
                        <div class="form-row" id="worker_detail">
                            <div class="border col-md-1 p-0">
                                <label>
                                    {{$worker_details['serial_no']? $worker_details['serial_no'] : '--'}}
                                </label>
                            </div>
                            <div class="border col-md-2 p-0">
                                <label>
                                    {{$worker_details['worker_name']? $worker_details['worker_name'] : '--'}}
                                </label>
                            </div>
                            <div class="border col-md-2 p-0">
                                <label>
                                    {{$worker_details['worker_cnic']? $worker_details['worker_cnic'] : '--'}}
                                </label>
                            </div>
                            <div class="border col-md-1 p-0">
                                <label>
                                    {{$worker_details['student_name']? $worker_details['student_name'] : '--'}}
                                </label>
                            </div>
                            <div class="border col-md-1 p-0">
                                <label>
                                    {{$worker_details['passed_degree']? $worker_details['passed_degree'] : '--'}}
                                </label>
                            </div>
                            <div class="border col-md-1 p-0">
                                <label>
                                    {{$worker_details['potential_degree']? $worker_details['potential_degree'] : '--'}}
                                </label>
                            </div>
                            <div class="border col-md-1 p-0">
                                <label>
                                    {{$worker_details['file_received_status']? $worker_details['file_received_status'] : '--'}}
                                </label>
                            </div>
                            <div class="border col-md-1 p-0">
                                <label>
                                    {{$worker_details['follow_up']? $worker_details['follow_up'] : '--'}}
                                </label>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
