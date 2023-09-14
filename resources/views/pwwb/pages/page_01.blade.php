<style type="text/css">
    label{
        font-weight: bold;
        color: black;
        font-family: 'Balsamiq Sans', cursive;
    }
    h1{
        font-weight: bold;
        text-align: center;
        font-family: 'Balsamiq Sans', cursive;
        background: #17202A;
        color: white;
        padding: 15px;
        position: relative;
        top: -20px;
    }
    input{
        text-transform: capitalize;
    }
</style>
<div id="page_01">
    <h1>Receipt and Submission <span class="float-right">Page # 01</span></h1><br>
    <form id="page_01_form">
        <div class="form-row">
            <div class="form-group pt-3 col-md-4">
                <label for="session">Session:<span style="color: red;">*</span></label>
                <select disabled id="sessions" name="" class="form-control">
                    <option value="" selected>Select Session</option>
{{--                    @foreach(\Config::get('constants.sessions') as $key => $sessionDate)--}}
{{--                            <option value="{{$key}}" {{ $data ? $data['session'] == $key ? 'selected' : '' : ''}}>{{$sessionDate}}</option>--}}
{{--                    @endforeach--}}
                    @foreach($sessions as $session)
{{--                            {{ $session ? $session->id == $key ? 'selected' : '' : ''}}--}}
{{--                    ($session->id==Illuminate\Support\Facades\Session::get('selected_session_id')?selected:'')--}}
                        <option value="{{$session->id}}" {{ $session ? $session->id == $selectedSession ? 'selected' : '' : ''}}>{{$session->session_name}}</option>
                    @endforeach
                </select>
                <input type="hidden" value="{{$selectedSession}}" name="session">
                <input type="hidden" value="{{$selectedSession}}" name="organization_campus_id">
                <input type="hidden" value="{{$data ? $data['educational_wing_cfe']['educational_wing_cfe'] : ''}}" name="wing_selected_from_page_07" id="wing_selected_from_page_07">
                <input type="hidden" value="" name="course_selected_from_page_07" id="course_selected_from_page_07">
                <input type="hidden" value="{{$data ? $data['course_name'] : ''}}" name="course_selected_from_page_07_name" id="course_selected_from_page_07_name">
                <input type="hidden" value="" name="course_registered_selected_from_page_07" id="course_registered_selected_from_page_07">
                <input type="hidden" value="" name="course_enrolled_selected_from_page_07" id="course_enrolled_selected_from_page_07">
                <input type="hidden" value="{{$data ? $data['course_registered_name'] : ''}}" name="course_registered_selected_from_page_07_name" id="course_registered_selected_from_page_07_name">
                <input type="hidden" value="{{$data ? $data['course_enrolled_name'] : ''}}" name="course_enrolled_selected_from_page_07_name" id="course_enrolled_selected_from_page_07_name">
                <input type="hidden" value="{{$data ? $data['dual_course'] : '0'}}" name="dual_course_from_page_07" id="dual_course_from_page_07">
                <input type="hidden" value="" name="affiliated_body_selected_from_page_07" id="affiliated_body_selected_from_page_07">
                <input type="hidden" value="" name="annual_semester_selected_from_page_07" id="annual_semester_selected_from_page_07">
            </div>
            <div class="form-group pt-3 col-md-4">
                <label for="districts">District:<span style="color: red;">*</span></label>
                <select onchange="checkifothers();" id="districts" name="district" class="form-control">
                    <option value="" selected>Select District Name</option>
                    @foreach(\Config::get('constants.districts') as $key => $districtName)
                        <option value="{{$key}}" {{ $data ? $data['district'] == $key ? 'selected' : '' : ''}}>{{$districtName}}</option>
                    @endforeach
{{--                    @foreach($cities as $city)--}}
{{--                        <option value="{{$city->id}}" {{ $data ? $data['district'] == $city->id ? 'selected' : '' : ''}}>{{$city->name}}</option>--}}
{{--                    @endforeach--}}
                </select>
            </div>
            <div id="other_div_page_1" style="display: none" class="form-group pt-3 col-md-4">
                <label for="other">Other:<span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="district_other" name="district_other" value="{{$data && $data['district_other'] ? $data['district_other'] : ''}}">
            </div>

        </div>
        <div class="col-md-12">
            <label for="" style="font-size: 20px;">Receipt and Submission:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>File Received No:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" onblur="checkrifnotexists(); getDataAgainstFileReceivedNumber();" id="file_received_no_page1" placeholder="R-" name="file_received_number" value="{{$data ? $data['file_received_number'] : ''}}">
                        <label style="color: red;" id="ridredalert"></label>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Data Entry Date:<span style="color: red;">*</span></label>
                        <input class="form-control datepicker" type="text" placeholder="Enter Date" name="receiving_date" value="{{$data && $data['receiving_date'] ? date('d/m/Y',strtotime($data['receiving_date'])) : ''}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>File Receipt Voucher No:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="file_receipt_voucher_no_page1" placeholder="00000" name="file_receipt_voucher_number" value="{{$data ? $data['file_receipt_voucher_number'] : ''}}">
                    </div>
                </div>
                <div class="form-row">
                     {{-- Add M- Number Start --}}
                    <div class="form-group col-md-4">
                        <label>File Module Number:<span style="color: red;">*</span></label>
                        <input type="text" onblur="checkMifnotexists();" class="form-control" id="file_module_number" placeholder="M-" name="file_module_number" value="{{$data ? $data['file_module_number'] : ''}}">
                        <label style="color: red;" id="midredalert"></label>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Admission Set Submitted:<span style="color: red;">*</span></label>
                        <select name="admission_set_submitted" id="admission_set_submitted" class="form-control">
                            <option value="" selected>Select Admission Set Submitted</option>
                            @foreach(\Config::get('constants.admission_set_submitted') as $key => $admission_set_submitted)
                                <option value="{{$key}}" {{ $data ? $data['admission_set_submitted'] == $key ? 'selected' : '' : ''}}>{{$admission_set_submitted}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>File Submitted To PWWB:<span style="color: red;">*</span></label>
                        <select name="file_submitted_to_pwwb" id="file_submitted_to_pwwb" class="form-control">
                            <option value="" selected>Select File Submitted To PWWB</option>
                            @foreach(\Config::get('constants.file_submitted_to_pwwb') as $key => $file_submitted_to_pwwb)
                                <option value="{{$key}}" {{ $data ? $data['file_submitted_to_pwwb'] == $key ? 'selected' : '' : ''}}>{{$file_submitted_to_pwwb}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Add M- Number End --}}
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>FRV Date:<span style="color: red;">*</span></label>
                        <input class="form-control datepicker" type="text" placeholder="Enter Date" name="file_receipt_voucher_date" value="{{$data && $data['file_receipt_voucher_date'] ? date('d/m/Y',strtotime($data['file_receipt_voucher_date'])) : ''}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Fresh File Submission in PWWB No:<span style="color: red;">*</span></label>
                        <input onkeyup="appendSDash(event)" onblur="checkifsidexists();" type="text" class="form-control" id="fresh_file_submission_page1" placeholder="S-" name="fresh_file_submission_in_pwwb_number" value="{{$data ? $data['fresh_file_submission_in_pwwb_number'] : ''}}">
                        <label style="color: red;" id="sidredalert"></label>
                    </div>
                    {{-- Ali Naeem Edit. --}}
                    <div class="form-group col-md-4">
                        <label>Submission Date:<span style="color: red;">*</span></label>
                        <input class="form-control datepicker" type="text" placeholder="Enter Date" name="submission_date" value="{{$data && $data['submission_date'] ? date('d/m/Y',strtotime($data['submission_date'])) : ''}}">
                    </div>
                </div>
                <div class="form-row ">
                    <div class="form-group col-md-4">
                        <label>Priority of Submission:<span style="color: red;">*</span></label>
                        <select name="priority_of_submission" class="form-control">
                            <option value="" selected>Select Priority</option>
                            @foreach(\Config::get('constants.priority_of_submission') as $key => $priority_of_submission)
                                <option value="{{$key}}" {{ $data ? $data['priority_of_submission'] == $key ? 'selected' : '' : ''}}>{{$priority_of_submission}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>PWWB Diary No:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="diary_no_page1" placeholder="INT" name="pwwb_diary_number" value="{{$data ? $data['pwwb_diary_number'] : ''}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>PWWB Diary Date:<span style="color: red;">*</span></label>
                        <input class="form-control datepicker" type="text" placeholder="Enter Date" name="pwwb_diary_date" value="{{$data && $data['pwwb_diary_date'] ? date('d/m/Y',strtotime($data['pwwb_diary_date'])) : ''}}">
                    </div>
                </div>
                <div class="form-row ">
                    <div class="form-group col-md-4">
                        <label>Pending Files (With Remarks):<span style="color: red;">*</span></label>
                        <input style="text-transform: none;" type="text" class="form-control" id="inputAddress" placeholder="Enter Remarks" name="pending_files_with_remarks" value="{{$data ? $data['pending_files_with_remarks'] : ''}}">
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Details -->
        <div class="card shadow mt-5 p-3 w-100">
            <div class="card-body" id="worker_detail_parent">
                <div class="form-row">
                    <div class="">
                        <label style="font-size: 20px;">Worker's Eligible Family Members:</label>
                    </div>
                    <div class="float-right ml-auto">
                        <button type="button" class="btn btn-primary float-right" onclick="cloneFamilyDetails()"> + Add Details</button><br/><br/>
                        <button type="button" class="btn btn-primary float-right" id="clearButton" onclick="cloneFamilyDetailsExtra()">Clear Tree Info.</button>
                    </div>

                </div>
                <div class="form-row pt-3">
                    <div class="border border-bottom-0 col-md-1 text-center">
                        <label>Serial No:<span style="color: red;">*</span></label>
                    </div>
                    <div class="border border-bottom-0 col-md-2 text-center">
                        <label>Worker's Name:<span style="color: red;">*</span></label>
                    </div>
                    <div class="border border-bottom-0 col-md-2 text-center">
                        <label>Worker's CNIC:<span style="color: red;">*</span></label>
                    </div>
                    <div class="border border-bottom-0 col-md-1 text-center">
                        <label>Student's Name:<span style="color: red;">*</span></label>
                    </div>
                    <div class="border border-bottom-0 col-md-1 text-center">
                        <label>Passed Degree:<span style="color: red;">*</span></label>
                    </div><div class="border border-bottom-0 col-md-1 text-center">
                        <label>Potential Degree:<span style="color: red;">*</span></label>
                    </div><div class="border border-bottom-0 col-md-1 text-center">
                        <label>File Received Status:<span style="color: red;">*</span></label>
                    </div><div class="border border-bottom-0 col-md-2 text-center">
                        <label>Follow-up:<span style="color: red;">*</span></label>
                    </div>
                </div>
                @if($data && isset($data['worker_family_member_details']) && count($data['worker_family_member_details']))
                    @foreach($data['worker_family_member_details'] as $worker_details)
                        <div class="form-row" id="worker_detail">
                            <div class="border border-bottom-0 col-md-1 p-0">
                                <input readonly id="worker_family_serial_no" type="text" class="form-control rounded-0 text-center" name="serial_no[]" placeholder="1" value="{{$worker_details['serial_no']}}">
                            </div>
                            <div class="border border-bottom-0 col-md-2 p-0">
                                <input onkeypress="return lettersOnly(event)" class="form-control rounded-0" type="text" name="worker_name[]" placeholder="Enter Name" value="{{$worker_details['worker_name']}}" id="workerName1">
                            </div>
                            <div class="border border-bottom-0 col-md-2 p-0">
                                <input type="text" class="form-control rounded-0" onkeyup="workerCNICFamilyAlert(event);"  name="worker_cnic[]" id="workerCNIC1" placeholder="00000-0000000-0" value="{{$worker_details['worker_cnic']}}"
                                >
                            </div>
                            <div class="border border-bottom-0 col-md-1 p-0">
                                <input onkeypress="return lettersOnly(event)"  type="text" class="form-control rounded-0" name="student_name[]" placeholder="Enter Name" value="{{$worker_details['student_name']}}" id="studentName1">
                            </div>
                            <div class="border border-bottom-0 col-md-1 p-0">
                                <input type="text" class="form-control rounded-0" name="passed_degree[]" placeholder="Enter Degree" value="{{$worker_details['passed_degree']}}">
                            </div>
                            <div class="border border-bottom-0 col-md-1 p-0">
                                <select id="districts" name="potential_degree[]" class="form-control rounded-0">
                                    <option value="" selected>Select Potential Degree</option>
{{--                                    @foreach(\Config::get('constants.potential_degree') as $key => $potential_degree)--}}
{{--                                        <option value="{{$key}}" {{ $worker_details ? $worker_details['potential_degree'] == $key ? 'selected' : '' : ''}}>{{$potential_degree}}</option>--}}
{{--                                    @endforeach--}}

                                        @foreach($courseList as $course)
                                            <option value="{{$course->name}}" {{ $worker_details ? $worker_details['potential_degree'] == $course->name ? 'selected' : '' : ''}}>{{$course->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="border border-bottom-0 col-md-1 p-0">
                                <select onchange="fileReceivedStatusPage1Check(event)" id="worker_eligibility_1" name="file_received_status[]" class="form-control rounded-0">
                                    <option value="" selected>Select Status</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $file_received_status)
                                        <option value="{{$key}}" {{ $worker_details ? $worker_details['file_received_status'] == $key ? 'selected' : '' : ''}}>{{$file_received_status}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="border border-bottom-0 col-md-2 p-0">
                                <input type="text" class="form-control rounded-0 datepickerFollowup" name="follow_up[]" id="worker_eligibility_1"  placeholder="Enter Date" value="{{$worker_details['follow_up'] ? date('d/m/Y',strtotime($worker_details['follow_up'])) : ''}}">
                            </div>
                            <div class="col-md-1">
                                <button id="removeFamilyDetailButton" type="button" class="btn btn-danger" onclick="removeFamilyDetail(event)"
                                @if ($worker_details == reset($data['worker_family_member_details'])) {{'disabled'}} @endif>-</button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="form-row" name="worker_detail_name1" id="worker_detail">
                        <div class="border border-bottom-0 col-md-1 p-0">
                            <input readonly id="worker_family_serial_no" type="text" class="form-control rounded-0 text-center" name="serial_no[]" value="1">
                        </div>
                        <div class="border border-bottom-0 col-md-2 p-0">
                            <input onkeypress="return lettersOnly(event)" class="form-control rounded-0" type="text" name="worker_name[]" placeholder="Enter Name" id="workerName1">
                        </div>
                        <div class="border border-bottom-0 col-md-2 p-0">
                            <input type="text" class="form-control rounded-0" onkeyup="workerCNICFamilyAlert(event);" name="worker_cnic[]" placeholder="00000-0000000-0" id="workerCNIC1">
                        </div>
                        <div class="border border-bottom-0 col-md-1 p-0">
                            <input onkeypress="return lettersOnly(event)"  type="text" class="form-control rounded-0" name="student_name[]" placeholder="Enter Name" id="studentName1">
                        </div>
                        <div class="border border-bottom-0 col-md-1 p-0">
                            <input type="text" class="form-control rounded-0" name="passed_degree[]" placeholder="Enter Degree">
                        </div>
                        <div class="border border-bottom-0 col-md-1 p-0">
                            <select name="potential_degree[]" id="potential_degree" class="form-control rounded-0">
                                <option value="" selected>Select Potential Degree</option>
{{--                                @foreach(\Config::get('constants.potential_degree') as $key => $potential_degree)--}}
{{--                                    <option value="{{$key}}">{{$potential_degree}}</option>--}}
{{--                                @endforeach--}}
                                @foreach($courseList as $course)
                                    <option value="{{$course->name}}" {{ $data ? $data['potential_degree'] == $course->name ? 'selected' : '' : ''}}>{{$course->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="border border-bottom-0 col-md-1 p-0">
                            <select onchange="fileReceivedStatusPage1Check(event)" name="file_received_status[]" class="form-control rounded-0">
                                <option value="" selected>Select Status</option>
                                @foreach(\Config::get('constants.general_yes_no') as $key => $file_received_status)
                                    <option value="{{$key}}">{{$file_received_status}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="border border-bottom-0 col-md-2 p-0">
                            <input type="text" class="form-control rounded-0 datepickerFollowup" name="follow_up[]" id="worker_eligibility_1"  placeholder="Enter Date">
                        </div>
                        <div class="col-md-1">
                            <button id="removeFamilyDetailButton" type="button" class="btn btn-danger" disabled onclick="removeFamilyDetail(event)">-</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </form>
</div>
<!-- Modal -->
{{-- Ali Naeem Edit. --}}
<div class="modal fade" id="worker_cnic_family_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CNIC Details.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <label id="cnic_no_rst"></label>
            </div>
            <div class="modal-footer">
{{--                <button type="button" class="btn btn-secondary" id="checkno" onclick="checkno_check();" data-dismiss="modal">No</button>--}}
                <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
@section('script_page_1')
    <script>
        checkifothers();
       
        $('input[name="worker_cnic[]"').each(function (index,value) {
            $(value).mask('00000-0000000-0');
        });

        $('select[name="file_received_status[]"').each(function (index,value) {
            if($(value).val() == 'no')
                $(value).parent().next().show();
            else
                $(value).parent().next().hide();
        });

        function appendSDash(event) {
            let value = $(event.target).val().replace('S-','');
            $(event.target).val('');
            $(event.target).val('S-'+value);
            numericOnly(event);
        }

        $('#file_received_no_page1').mask('R-#');
        $('#fresh_file_submission_page1').mask('S-#');
        $('#file_receipt_voucher_no_page1').mask('#');
        $('#diary_no_page1').mask('#');
        $('#file_module_number').mask('M-#');

        function alphabetsOnly(e) {
            let value = $(e.target).val();
            let length  = value.length;
            let regex = new RegExp("^[a-zA-Z ]+$");
            let str = value.substr(length-1,1);
            if (!regex.test(str)) {
                $(e.target).val(value.substring(0,length-1));
            }
        }

        function numericOnly(e) {
            let value = $(e.target).val();
            let length  = value.length;
            let regex = new RegExp("^[0-9]+$");
            let str = value.substr(length-1,1);
            if (!regex.test(str)) {
                $(e.target).val(value.substring(0,length-1));
            }
        }

        function fileReceivedStatusPage1Check(e){
            if($(e.target).val() == 'no') {
                //here is the problem

                // $('#worker_eligibility_1').val('');


                $(e.target).parent().next().find('#worker_eligibility_1').val('');
                $(e.target).parent().next().show();
            }
            else {
                $(e.target).parent().next().hide();
            }
        }

        $('.datepickerFollowup').datepicker({
            format:'dd/mm/yyyy',
            startDate: new Date(),
            autoclose: true
        });

        function cloneFamilyDetailsExtra(){
            let clone = $('#worker_detail').clone();
            clone.find('.datepickerFollowup').datepicker({
                format:'dd/mm/yyyy',
                startDate: new Date(),
                autoclose: true
            });

            clone.find('input:text').val('');
            $('#worker_detail_parent').append(clone);
            // let button = clone.find('#removeFamilyDetailButton').removeAttr('disabled');
            clone.find('#worker_family_serial_no').val(1);


            $('input[name="worker_cnic[]"').each(function (index,value) {
                $(value).mask('00000-0000000-0');
            });
             $('#worker_detail').remove();

            if(!index_id){
                $('#worker_eligibility_1').parent().hide();
            }else{
                $('#worker_eligibility_1_').parent().hide();
            }
            
            

        }

        function cloneFamilyDetails(){
            let clone = $('#worker_detail').clone();
            clone.find('.datepickerFollowup').datepicker({
                format:'dd/mm/yyyy',
                startDate: new Date(),
                autoclose: true
            });

            clone.find('input:text').val('');
            $('#worker_detail_parent').append(clone);
            let button = clone.find('#removeFamilyDetailButton').removeAttr('disabled');            
            var total_serial_count = $('#worker_detail input[name="serial_no[]"').length;
            // alert(total_serial_count);
            $('input[name="worker_cnic[]"').each(function (index,value) {
                $(value).mask('00000-0000000-0');
            });
            if($('#worker_detail input[name="serial_no[]"').length > 1){
                $('#clearButton').fadeOut();
            }
            else{
             $('#clearButton').fadeIn();
            }
            let workerDetailCount = $('#worker_detail input[name="serial_no[]"').length;
            // alert(workerDetailCount);
            clone.find('#worker_family_serial_no').val($('#worker_detail input[name="serial_no[]"').length);
            clone.find('#workerCNIC1').attr('id', 'workerCNIC'+workerDetailCount);
            clone.find('#workerName1').attr('id', 'workerName'+workerDetailCount);
            clone.find('#studentName1').attr('id', 'studentName'+workerDetailCount);    
            // $('input[name="worker_cnic[]"').val($('#worker_cnic').val());
        }

        function removeFamilyDetail(event) {
            if(index_id) {
                let csrf_token = $('meta[name="csrf-token"]').attr('content');
                let request = $.ajax({
                    url: '/worker-family-detail-delete',
                    method: "POST",
                    data: {
                        'index_id' : index_id,
                        'serial_no' : $(event.target).parent().parent().find('#worker_family_serial_no').val()
                    },
                    headers:{
                        'X-CSRF-TOKEN':csrf_token
                    }
                });

                request.done(function (response) {
                });

                request.fail(function (jqXHR, textStatus) {
                    // alert("Request failed: " + textStatus);
                });
            }
            $(event.target).parent().parent().remove();
            $('#worker_detail input[name="serial_no[]"').each(function (index,value) {
                $(value).val(index+1);
            });

            if($('#worker_detail input[name="serial_no[]"').length > 1){
                $('#clearButton').fadeOut();
            }
            else{
             $('#clearButton').fadeIn();
            }
        }
        // Ali Naeem Edit.
        function checkrifnotexists(){
            var newridnumber =$('#file_received_no_page1').val();
                $.ajax({
                url:"checkrifnotexists/"+newridnumber,
                method:'get',
                data:{},
                dataType:'json',
                success:function(data){
                    console.log('success');
                    console.log(data);
                    $('#ridredalert').text(data);
                },
                error:function(data){
                    console.log('error');
                }
            });

        }

        function checkMifnotexists(){
            var newridnumber =$('#file_module_number').val();
                $.ajax({
                url:"checkMifnotexists/"+newridnumber,
                method:'get',
                data:{},
                dataType:'json',
                success:function(data){
                    console.log('success');
                    console.log(data);
                    $('#midredalert').text(data);
                },
                error:function(data){
                    console.log('error');
                }
            });
        }


//         function testInput(event) {
//    var value = String.fromCharCode(event.which);
//    var pattern = new RegExp(/[a-zåäö ]/i);
//    return pattern.test(value);
// }

// $('#workerName').bind('keypress', testInput);
// $('#studentName').bind('keypress', testInput);
// $('#passdegree').bind('keypress', testInput);

        // Ali Naeem Edit.
        function checkifsidexists(){
            var newridnumber =$('#fresh_file_submission_page1').val();
                $.ajax({
                url:"checkifsidexists/"+newridnumber,
                method:'get',
                data:{},
                dataType:'json',
                success:function(data){
                    console.log('success');
                    console.log(data);
                    $('#sidredalert').text(data);
                },
                error:function(data){
                    console.log('error');
                }
            });

        }

        function checkifothers(){
            var other = $('#districts').val();
            if(other == 'Other')
            {
                $('#other_div_page_1').show();
            }
            else
            {
                $('#other_div_page_1').hide();
            }
            var if_lahore = $('#districts').val();
            if(if_lahore == 'Lahore'){
                $('#factory_registration_certificate_attested_by_director_show_hide').hide();
            }
            else{
                $('#factory_registration_certificate_attested_by_director_show_hide').show();
            }

        }

        function clearTreeInfo(){
            $('#worker_detail input[name="worker_name[]"').each(function (index,value) {
                $(value).val('');
            });
             $('#worker_detail input[name="worker_cnic[]"').each(function (index,value) {
                $(value).val('');
            });
              $('#worker_detail input[name="student_name[]"').each(function (index,value) {
                $(value).val('');
            });
              $('#worker_detail input[name="passed_degree[]"').each(function (index,value) {
                $(value).val('');
            });
              $('#worker_detail input[name="potential_degree[]"').each(function (index,value) {
                $('input[name="potential_degree[]').hide();

                // $(value).find('option:selected').text('Select Potential Degree');
                // $('#potential_degree  option:eq(1)').find('option:selected').attr('selected', true);
                // $("#potential_degree").val(2).change();
                // $("#potential_degree").val("Associate Degree in Arts -B.A-PU");
                // $('#potential_degree option').filter(function() {
                //     return ($(this).text() == 'Select Potential Degree'); //To select Blue
                // }).prop('selected', true);




                // $('#potential_degree option:eq(1)').attr('selected', true);

            });
               $('#worker_detail input[name="file_received_status[]"').each(function (index,value) {
                $(value).text('Select Potential Degree');
            });
               $('#worker_detail input[name="follow_up[]"').each(function (index,value) {
                $(value).val('');
            });
        }

        function workerCNICFamilyAlert(event){
            var newridnumber = $(event.target).val();
            $.ajax({
                url:"workerCNICFamilyAlert/"+newridnumber,
                method:'get',
                data:{},
                dataType:'json',
                success:function(data){
                    console.log('success');
                    console.log(data);
                    if(data == ''){

                    }
                    else{
                        $('#cnic_no_rst').text(data);
                        $("#worker_cnic_family_model").modal();    
                    }
                    
                    // $(event.target)parent().next().show();
                },
                error:function(data){
                    console.log('error');
                }
            });
        }

        function getDataAgainstFileReceivedNumber(){
            var parentId = 0;
            var enquiryId = 0;
            var courseId = 0;
            if(!index_id){
                var fileReceivedNumber =$('#file_received_no_page1').val();
                    $.ajax({
                        url:"getDataAgainstFileReceivedNumber/"+fileReceivedNumber,
                        method:'get',
                        data:{},
                        dataType:'json',
                        success:function(data){
                            console.log('success');
                            // Current Enquiry ID ...
                            parentId = data.id;
                            enquiryId = data.id;
                            courseId = data.course_id;
                            // Page 1 data
                            $('#file_module_number').val(data.file_module_number);
                            $('#pending_files_with_remarks').val(data.remarks);
                            // Page 6 Student Personal Details
                            $('#personal_data_student_name').val(data.name);
                            $('#personal_data_father_name').val(data.father_name);
                            $('#cnic_no').val(data.student_cnic_no);
                            $('#email_06').val(data.email);
                            $('#personal_data_present_address').val(data.present_address);
                            $('#personal_data_postal_address').val(data.permanent_address);

                            // Page 2 Worker personal Detail
                            $('#worker_personal_details_worker_name').val(data.father_name);
                            $('#worker_cnic').val(data.father_cnic_no);

                            // Pagw 3 Worker Social Security Details...
                            $('#permanent_address_page03_id').val(data.permanent_address);
                            $('#temporary_address_page03_id').val(data.present_address);
                            // Page 7 Educational Wings Page.
                            // Page 12 Transport Page.
                            // $('#transport_facility_page12').val(data.is_transport);


                            if(data.is_transport == 0){
                                $('#transport_facility_page12').val('yes');
                                setBusStopDisplayPage12();                            
                                $('#bus_stop_12').show();
                                $('#bus_stop_12').val(data.transport_stop);
                            }else if(data.is_transport == 1){
                                setBusStopDisplayPage12();    
                                $('#transport_facility_page12').val('no');
                                $('#bus_stop_12').val('');
                            }else if(data.is_transport == 3){
                                setBusStopDisplayPage12();    
                                $('#transport_facility_page12').val('undecided');
                                $('#bus_stop_12').val('');
                            }else{
                                setBusStopDisplayPage12();    
                                $('#transport_facility_page12').val('');
                                $('#bus_stop_12').val('');
                            }

                            // Fetching Follow Ups List From The Enquery Followups table...
                            // Worker Followups list... Worker Prospect List...
                            var abcCount = 1;
                            $.ajax({
                                url:"getEnquiryFollowupsList/"+parentId,
                                method:'get',
                                data:{},
                                dataType:'json',
                                success:function(response){
                                    console.log('success');
                                    // Enquiry Followups List...
                                    // Begin Working From This Part . For Followups From enquiry_followups Table.....
                                    var totalcount  = 0;
                                    var countMinusOne = 0;
                                    for(var i=0;i<response.output.length;i++){
                                        console.log(response.output[i].id);
                                        console.log(response.output[i].form_code);
                                        console.log(response.output[i].father_name);
                                        console.log(response.output[i].name);
                                        console.log(response.output[i].provisional_letter_application_recieved);
                                        if(i == response.output.length-1){
                                            $('#workerCNIC'+$('#worker_detail input[name="serial_no[]"').length+'').val(response.output[i].father_cnic_no);
                                            $('#workerName'+$('#worker_detail input[name="serial_no[]"').length+'').val(response.output[i].father_name);
                                            $('#studentName'+$('#worker_detail input[name="serial_no[]"').length+'').val(response.output[i].name);
                                            // cloneFamilyDetails();
                                            
                                        }else{
                                            $('#workerCNIC'+$('#worker_detail input[name="serial_no[]"').length+'').val(response.output[i].father_cnic_no);
                                            $('#workerName'+$('#worker_detail input[name="serial_no[]"').length+'').val(response.output[i].father_name);
                                            $('#studentName'+$('#worker_detail input[name="serial_no[]"').length+'').val(response.output[i].name);
                                            cloneFamilyDetails();
                                        }                                                        
                                     }
                                    console.log("success test");
                                    checkifDataFetchedThroughRNumber = 1;
                                },
                                error:function(data){
                                    console.log('error');
                                    checkifDataFetchedThroughRNumber = 0;
                                }
                            });
                            

                            $.ajax({
                                url:"getEnquiryFactoryFollowupsList/"+enquiryId,
                                method:'get',
                                data:{},
                                dataType:'json',
                                success:function(response){
                                    console.log('success');
                                    // Enquiry Followups List...
                                    // Begin Working From This Part . For Followups From enquiry_followups Table.....
                                    var totalcount  = 0;
                                    var countMinusOne = 0;
                                    for(var i=0;i<response.output.length;i++){
                                        console.log(response.output[i].id);
                                        console.log(response.output[i].enquiry_id);
                                        console.log(response.output[i].factory_name);
                                        if(i == response.output.length-1){
                                            $('#Nameoffactorymanager'+$('#service_detail input[name="serial_no[]"').length+'').val(response.output[i].factory_name);
                                        }else{
                                            $('#Nameoffactorymanager'+$('#service_detail input[name="serial_no[]"').length+'').val(response.output[i].factory_name);
                                            cloneServiceDetails();
                                        }                                                        
                                     }
                                    console.log("success test");
                                },
                                error:function(data){
                                    console.log('error');
                                }
                            });

                            // Educational Wing Information Get And Set...
                             $.ajax({
                                url:"getEducationalWingFollowupsList/"+courseId,
                                method:'get',
                                data:{},
                                dataType:'json',
                                success:function(response){
                                    console.log('success');
                                    // Enquiry Followups List...
                                    // Begin Working From This Part . For Followups From enquiry_followups Table.....
                                    var totalcount  = 0;
                                    var countMinusOne = 0;

                                        console.log(response.id);
                                        console.log(response.wing_id);
                                        console.log(response.name);
                                        if(response.wing_id != null || response.wing_id != ''){
                                            $('#cfe_wing_selection').val(response.wing_id);
                                            setWingCorrespondingSectionDisplay(); 
                                            // let wings_array = {
                                            //     '2': 'wing_div_bise',
                                            //     '3': 'wing_div_ims',
                                            //     '1': 'wing_div_af',
                                            //     '4': 'wing_div_vti'
                                           // };

                                           getCourseSelectionId = response.id;
                                            if(response.id == 2){
                                                $("#bise_course_applied_in option[value="+response.id+"]").prop("selected", "selected");
                                            }

                                        }

                                            
                                    console.log("success test");
                                },
                                error:function(data){
                                    console.log('error');
                                }
                            });

                             // Student Personal Contact Infos...
                            $.ajax({
                                url:"getStudentContactsInfos/"+enquiryId,
                                method:'get',
                                data:{},
                                dataType:'json',
                                success:function(response){
                                    console.log('success');
                                    // Enquiry Followups List...
                                    // Begin Working From This Part . For Followups From enquiry_followups Table.....
                                    var totalcount  = 0;
                                    var countMinusOne = 0;
                                    for(var i=0;i<response.output.length;i++){  
                                        var contacTypeId = response.output[i].contact_type_id;
                                        if(i == response.output.length-1){
                                            
                                            if(contacTypeId == '0'){ // Father father
                                                $('#student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length+'').val('father');
                                                $('#contact_no'+$('#student_contact_number input[name="serial_no[]"').length+'').val(response.output[i].phone_no);
                                            }else if(contacTypeId == '1'){ // Mother mother
                                                $('#student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length+'').val('mother');
                                                $('#contact_no'+$('#student_contact_number input[name="serial_no[]"').length+'').val(response.output[i].phone_no);
                                            }else if(contacTypeId == '2'){ // Brother brother but its not in our constant
                                                $('#student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length+'').val('brother');
                                                $('#contact_no'+$('#student_contact_number input[name="serial_no[]"').length+'').val(response.output[i].phone_no);
                                            }else if(contacTypeId == '3'){ // Sister sister
                                                $('#student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length+'').val('sister');
                                                $('#contact_no'+$('#student_contact_number input[name="serial_no[]"').length+'').val(response.output[i].phone_no);
                                            }else if(contacTypeId == '4'){ // Guardian guardian
                                                $('#student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length+'').val('guardian');
                                                $('#contact_no'+$('#student_contact_number input[name="serial_no[]"').length+'').val(response.output[i].phone_no);
                                            }else if(contacTypeId == '5'){ // Self self
                                                $('#student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length+'').val('self');
                                                $('#contact_no'+$('#student_contact_number input[name="serial_no[]"').length+'').val(response.output[i].phone_no);
                                            }else if(contacTypeId == '6'){ // Other other
                                                $('#student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length+'').val('other');
                                                $('#contact_no'+$('#student_contact_number input[name="serial_no[]"').length+'').val(response.output[i].phone_no);
                                            }
                                        }else{
                                            if(contacTypeId == '0'){ // Father father
                                                $('#student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length+'').val('father');
                                                $('#contact_no'+$('#student_contact_number input[name="serial_no[]"').length+'').val(response.output[i].phone_no);
                                            }else if(contacTypeId == '1'){ // Mother mother
                                                $('#student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length+'').val('mother');
                                                $('#contact_no'+$('#student_contact_number input[name="serial_no[]"').length+'').val(response.output[i].phone_no);
                                            }else if(contacTypeId == '2'){ // Brother brother but its not in our constant
                                                $('#student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length+'').val('brother');
                                                $('#contact_no'+$('#student_contact_number input[name="serial_no[]"').length+'').val(response.output[i].phone_no);
                                            }else if(contacTypeId == '3'){ // Sister sister
                                                $('#student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length+'').val('sister');
                                                $('#contact_no'+$('#student_contact_number input[name="serial_no[]"').length+'').val(response.output[i].phone_no);
                                            }else if(contacTypeId == '4'){ // Guardian guardian
                                                $('#student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length+'').val('guardian');
                                                $('#contact_no'+$('#student_contact_number input[name="serial_no[]"').length+'').val(response.output[i].phone_no);
                                            }else if(contacTypeId == '5'){ // Self self
                                                $('#student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length+'').val('self');
                                                $('#contact_no'+$('#student_contact_number input[name="serial_no[]"').length+'').val(response.output[i].phone_no);
                                            }else if(contacTypeId == '6'){ // Other other
                                                $('#student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length+'').val('other');
                                                $('#contact_no'+$('#student_contact_number input[name="serial_no[]"').length+'').val(response.output[i].phone_no);
                                            }
                                            cloneStudentContactNumber();
                                        }                                                        
                                     }
                                    console.log("success test");
                                },
                                error:function(data){
                                    console.log('error');
                                }
                            });


                        },
                        error:function(data){
                            console.log('error');
                        }
                    });
            }
        }

        function courseIdSelect(courseId){
            // Educational Wing Information Get And Set...
             $.ajax({
                url:"getEducationalWingFollowupsList/"+courseId,
                method:'get',
                data:{},
                dataType:'json',
                success:function(response){
                    console.log('success');
                    // Enquiry Followups List...
                    // Begin Working From This Part . For Followups From enquiry_followups Table.....
                    var totalcount  = 0;
                    var countMinusOne = 0;

                        console.log(response.id);
                        console.log(response.wing_id);
                        console.log(response.name);
                        if(response.wing_id != null || response.wing_id != ''){
                            $('#cfe_wing_selection').val(response.wing_id);
                            // setWingCorrespondingSectionDisplay(); 
                            // let wings_array = {
                            //     '2': 'wing_div_bise',
                            //     '3': 'wing_div_ims',
                            //     '1': 'wing_div_af',
                            //     '4': 'wing_div_vti'
                           // };


                            if(response.id == 2){
                                $("#bise_course_applied_in option[value="+response.id+"]").prop("selected", "selected");
                                setBiseFieldsDisplay();
                                setBiseFieldsDisplay();
                            }else if(response.id == 1){
                                $("#af_course_applied_in option[value="+response.id+"]").prop("selected", "selected");
                                selectAffiliatedBodyId_af();
                            }else if(response.id == 3){
                                $("#ims_course_applied_in_cfe option[value="+response.id+"]").prop("selected", "selected");
                                selectAffiliatedBodyId();
                            }else if(response.id == 4){
                                $("#vti_diploma_applied_in option[value="+response.id+"]").prop("selected", "selected");
                                selectAffiliatedBodyId_vti();
                            }

                        }

                            
                    console.log("success test");
                },
                error:function(data){
                    console.log('error');
                }
            });
        }

        // // Asad Edit.
        // $(function() {

        //     $(document).on('blur', '#workerName', function(e) {
        //         e.preventDefault();
        //         sessionStorage.setItem('workerName', $(this).val());
        //         $('input:text[name=worker_name]').val(sessionStorage.getItem('workerName'));
        //     })
        //     $(document).on('blur', '#workerCNIC', function(e) {
        //         e.preventDefault();
        //         sessionStorage.setItem('workerCNIC', $(this).val());
        //         $('input:text[name=worker_cnic]').val(sessionStorage.getItem('workerCNIC'));
        //     })
        //     // $(document).on('blur', '#rollNumber', function(e) {
        //     //         e.preventDefault();
        //     //         sessionStorage.setItem('rollNumber', $(this).val());
        //     //         $('input:text[name=roll_no]').val(sessionStorage.getItem('rollNumber'));
        //     //     })
        //     //

        // })


    </script>
@endsection
