<style type="text/css">
    label{
        font-weight: bold;
        color: black;
        font-family: 'PT Serif', serif;
    }
    h1{
        font-weight: bold;
        text-align: center;
        font-family: 'PT Serif', serif;
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
<div id="page_06">
    <h1>Personal Data of Student<span class="float-right">Page # 06</span></h1><br>
    <form id="page_06_form">
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label>Name:<span style="color: red;">*</span></label>
                        <input onkeypress="return lettersOnly(event)" type="text" name="name" id="personal_data_student_name" class="form-control text-center" placeholder="Enter Name"
                               value="{{$data ? $data['student_personal_detail']['name'] : ''}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Father's / Husband Name:<span style="color: red;">*</span></label>
                        <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="father_name" id="personal_data_father_name" placeholder="Enter Father's Name"
                               value="{{$data ? $data['student_personal_detail']['father_name'] : ''}}">
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="" style="font-size: 20px;">Student's CNIC/ B-Form No:</label>
                </div>
                <div class="card shadow p-3 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>CNIC/ B-Form No:<span style="color: red;">*</span></label>
                                <input type="text" onkeyup="CNICNoAlert();" class="form-control text-center" name="cnic_no" id="cnic_no"
                                       value="{{$data ? $data['student_personal_detail']['cnic_no'] : ''}}"
                                       placeholder="00000-0000000-0">
                                       <label style="color: red;" id="cnic_no_alert"></label>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Quantity Min. (06):<span style="color: red;">*</span></label>
                                <input onkeyup="numericOnly(event)" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" id="quantity_min_" onchange="checkminimumqty();" name='quantity' placeholder="Enter Quantity"
                                       value="{{$data ? $data['student_personal_detail']['quantity'] : ''}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Attested by Gazetted Officer:<span style="color: red;">*</span></label>
                                <select name="student_cnic_attested" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['student_personal_detail']['student_cnic_attested'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow p-3 mt-4 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Date of Birth:<span style="color: red;">*</span></label>
                                <input type="text" class="form-control text-center datepicker" name="date_of_birth"
                                       placeholder="Enter Date"
                                       value="{{$data && $data['student_personal_detail']['date_of_birth'] ? date('d/m/Y',strtotime($data['student_personal_detail']['date_of_birth'])) : ''}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Present Address:<span style="color: red;">*</span></label>
                                <input type="text" class="form-control text-center" name="present_address" id="personal_data_present_address"
                                       placeholder="Enter Address"
                                       value="{{$data ? $data['student_personal_detail']['present_address'] : ''}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Marital Status:<span style="color: red;">*</span></label>
                                <select name="marital_status" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.marital_status') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['student_personal_detail']['marital_status'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Postal Address:<span style="color: red;">*</span></label>
                                <input type="text" class="form-control text-center" name="postal_address" id="personal_data_postal_address"
                                       placeholder="Enter Address"
                                       value="{{$data ? $data['student_personal_detail']['postal_address'] : ''}}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Email:<span style="color: red;">*</span></label>
                                <input onblur="validateEmail_06();" style="text-transform: none;" type="email" class="form-control text-center" name="email" id="email_06"
                                       value="{{$data ? $data['student_personal_detail']['email'] : ''}}"
                                       placeholder="example@gmail.com">
                                       <label style="display: none;color: red;font-size:14px;" id="emailmessage_check_06">Email Format Is Incorrect.</label>
                            </div>
                            <div class="form-group col-md-5">
                                <label>Signature on Page 2 (Once) &amp; 3 (Twice):<span style="color: red;">*</span></label>
                                <select name="signature" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['student_personal_detail']['signature'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        </div>
                </div>
                <div class="card shadow mt-5 p-3 w-100">
                    <div class="card-body" id="student_contact_number_parent">
                        <div class="form-row">
                            <div class="">
                                <label style="font-size: 20px;">Student Contact Numbers:</label>
                            </div>
                            <div class="float-right ml-auto">
                                <button type="button" class="btn btn-primary float-right" onclick="cloneStudentContactNumber()">+ Add Details</button>
                            </div>
                        </div><br>
                        <div class="form-row pt-3">
                    <div class="border border-bottom-0 col-md-1 text-center">
                        <label>Serial No.<span style="color: red;">*</span></label>
                    </div>
                    <div class="border border-bottom-0 col-md-3 text-center">
                       <label>Contact No<span style="color: red;">*</span></label>
                    </div>
                    <div class="border border-bottom-0 col-md-4 text-center">
                       <label>Student's Relationship<span style="color: red;">*</span></label>
                    </div>
                    <div class="border border-bottom-0 col-md-3 text-center">
                       <label>Specify Relationship<span style="color: red;">*</span></label>
                    </div>
                </div>
                         @if($data && isset($data['student_contact_numbers']) && count($data['student_contact_numbers']))
                            @foreach($data['student_contact_numbers'] as $studentContactNumber)
                                <div class="form-row" id="student_contact_number">
                                    <div class="border border-bottom-0 col-md-1 p-0">

                                        <input readonly id="student_contact_number_serial_no" type="text" class="form-control rounded-0 text-center" name="serial_no[]" placeholder="1" value="{{$studentContactNumber['serial_no']}}">
                                    </div>
                                    <div class="border border-bottom-0 col-md-3 p-0">

                                        <input onkeyup="appendPhonePrefix_no(event); studetnPersonalContactNoAlert(event);" onclick="appendPhonePrefix_no(event)" type="text" class="form-control rounded-0" name="contact_no[]" id="contact_no1" placeholder="+92-000-0000000" value="{{$studentContactNumber['contact_no']}}">
                                    </div>
                                    <div class="border border-bottom-0 col-md-4 p-0">

                                        <select name="student_contact_relationship[]" onchange="setContactRelationship(event)" class="form-control rounded-0" id="student_contact_relationship1">
                                            <option value="" selected>Select Relation</option>
                                            @foreach(\Config::get('constants.worker_relationship') as $key => $worker_relationship)
                                                <option value="{{$key}}" {{ $studentContactNumber ? $studentContactNumber['student_contact_relationship'] == $key ? 'selected' : '' : ''}}>{{$worker_relationship}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="workerrelationship3" class="border border-bottom-0 col-md-3 p-0" style="display: none;">

                        <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="specify_relationship[]" id="student_relationship_1" placeholder="Enter Relationship"
                               value="{{$studentContactNumber['specify_relationship']}}">
                    </div>
                                    <div class="col-md-1">
                                        <button id="removeStudentContactNumberButton" type="button" class="btn btn-danger" onclick="removeContactNumber(event)"
                                        @if ($studentContactNumber == reset($data['student_contact_numbers'])) {{'disabled'}} @endif>-</button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                           <div class="form-row" id="student_contact_number">
                            <div class="border border-bottom-0 col-md-1 p-0">

                                    <input readonly id="student_contact_number_serial_no" type="text" class="form-control rounded-0 text-center" name="serial_no[]" value="1">
                                </div>
                            <div class="border border-bottom-0 col-md-3 p-0">

                                <input onkeyup="appendPhonePrefix_no(event); studetnPersonalContactNoAlert(event);" onclick="appendPhonePrefix_no(event)" class="form-control rounded-0 text-center" type="text" name="contact_no[]" id="contact_no1" placeholder="+92-000-0000000">
                            </div>
                            <div class="border border-bottom-0 col-md-4 p-0">
                        <select name="student_contact_relationship[]" onchange="setContactRelationship(event)" id="student_contact_relationship1" class="form-control rounded-0">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.worker_relationship') as $key => $worker_relationship)
                                <option value="{{$key}}" {{ $data ? $data['worker_personal_details']['worker_relationship'] == $key ? 'selected' : '' : ''}}>{{$worker_relationship}}</option>
                            @endforeach
                        </select>
                    </div>
                     <div id="studentrelationship" class="border border-bottom-0 col-md-3 p-0" style="display: none;">
                        <input onkeypress="return lettersOnly(event)" type="text" class="form-control rounded-0 text-center" name="specify_relationship[]" id="student_relationship_1" placeholder="Enter Relationship">
                    </div>
                            <div class="form-group col-md-1">
                                <button id="removeStudentContactNumberButton" type="button" class="btn btn-danger" disabled onclick="removeContactNumber(event)">-</button>
                            </div>
                        </div>
                             @endif
                        </div>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- Ali Naeem Edit. --}}
<div class="modal fade" id="quantity_min_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Quantity Min. (06)*</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do You Want To Store Less Then Given Quantity ?
      </div>
      <div class="modal-footer">
{{--        <button type="button" class="btn btn-secondary" id="checkno" onclick="checkno_check();" data-dismiss="modal">No</button>--}}
        <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
{{-- Ali Naeem Edit. --}}
<div class="modal fade" id="student_personal_contact_number_alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CNIC Details.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <label id="student_personal_contact_no_rst"></label>
            </div>
            <div class="modal-footer">
{{--                <button type="button" class="btn btn-secondary" id="checkno" onclick="checkno_check();" data-dismiss="modal">No</button>--}}
                <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
@section('script_page_6')
    <script>
        $('input[name="cnic_no"]').each(function (index,value) {
            $(value).mask('00000-0000000-0');
        });
        $('input[name="contact_no_1"]').each(function (index,value) {
            $(value).mask('+92-000-0000000');
        });
        $('input[name="contact_no_2"]').each(function (index,value) {
            $(value).mask('+92-000-0000000');
        });
         $('select[name="student_contact_relationship[]"').each(function (index,value) {
            if($(value).val() == 'other')
                $(value).parent().next().show();
            else
                $(value).parent().next().hide();
        });
        setContactRelationship();
        function testInput(event) {
           var value = String.fromCharCode(event.which);
           var pattern = new RegExp(/[a-zåäö ]/i);
           return pattern.test(value);
        }

        $('#studentName').bind('keypress', testInput);
        $('#studentFatherName').bind('keypress', testInput);

        function setContactRelationship(e) {
            if(e.target.value == 'other'){
                // $('#student_relationship_1').val('');
                $(e.target).parent().next().show();/*$('#studentrelationship').show()*/;
            }
            else{
                $(e.target).parent().next().hide();
                $(e.target).parent().next().find('#student_relationship_1').val('');
                // $('#studentrelationship').hide();
            }
        }

        function cloneStudentContactNumber(){
            let clone = $('#student_contact_number').clone();

            clone.find('input:text').val('');
            $('#student_contact_number_parent').append(clone);
            let button = clone.find('#removeStudentContactNumberButton').removeAttr('disabled');
            clone.find('#student_contact_number_serial_no').val($('#student_contact_number input[name="serial_no[]"').length);
            $('input[name="contact_no[]"]').each(function (index,value) {
                $(value).mask('+92-000-0000000');
            });
            clone.find('#student_contact_relationship1').attr('id', 'student_contact_relationship'+$('#student_contact_number input[name="serial_no[]"').length);
            clone.find('#contact_no1').attr('id', 'contact_no'+$('#student_contact_number input[name="serial_no[]"').length);
        }
        function removeContactNumber(event) {

            if(index_id) {
                let csrf_token = $('meta[name="csrf-token"]').attr('content');
                let request = $.ajax({
                    url: '/student-contact-number-delete',
                    method: "POST",
                    data: {
                        'index_id' : index_id,
                        'serial_no' : $(event.target).parent().parent().find('#student_contact_number_serial_no').val()
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
            $('#student_contact_number input[name="serial_no[]"').each(function (index,value) {
                $(value).val(index+1);
            });
        }
       function appendPhonePrefix_no(event) {
            let value = $(event.target).val().replace('+92-','');
            if(value == '+92'){
                $(event.target).val('');
                $(event.target).val('+92-');
            }
            else{
            $(event.target).val('');
            $(event.target).val('+92-'+value);
            }
        }

        // Ali Naeem Edit.
        function checkminimumqty(){
            var minimum  = $('#quantity_min_').val();
            if (minimum != '') {
                if(minimum < 6){
                    $("#quantity_min_modal").modal();
                }
            }
        }
        function checkno_check(){
            $('#photograph_quantity').focus();
        }

        function validateEmail_06() {
            var emailID = $('#email_06').val();
            atpos = emailID.indexOf("@");
            dotpos = emailID.lastIndexOf(".");
            if (atpos < 1 || (dotpos - atpos < 2)) {
                // document.getElementById('email_06').focus();
                $('#emailmessage_check_06').show();
                return false;

            } else {
                $('#emailmessage_check_06').hide();
            }
            return (true);
    }

    function CNICNoAlert(){
        var newridnumber =$('#cnic_no').val();
        $.ajax({
            url:"CNICNoAlert/"+newridnumber,
            method:'get',
            data:{},
            dataType:'json',
            success:function(data){
                console.log('success');
                console.log(data);
                $('#cnic_no_alert').text(data);
            },
            error:function(data){
                console.log('error');
            }
        });
    }

    function studetnPersonalContactNoAlert(event){
            if($(event.target).val() != '' ){
                var newridnumber = $(event.target).val();
                $.ajax({
                    url:"studetnPersonalContactNoAlert/"+newridnumber,
                    method:'get',
                    data:{},
                    dataType:'json',
                    success:function(data){
                        console.log('success');
                        console.log(data);
                        if(data == ''){

                        }
                        else{
                            if(data != '(+92-)  Contact has been used in previous files.'){
                                $('#student_personal_contact_no_rst').text(data);
                                $("#student_personal_contact_number_alert").modal();    
                            }
                        }
                        
                        // $(event.target)parent().next().show();
                    },
                    error:function(data){
                        console.log('error');
                    }
                });
            }
            
        }
    </script>
    
@endsection
