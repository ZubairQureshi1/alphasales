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
<div id="page_05">
    <h1>Factory Manager's Details<span class="float-right">Page # 05</span></h1><br>
    <form id="page_05_form">
        <div class="col-md-12 mt-4" id="death_date_page5_header" style="display: none">
            <label>Death/ Retirement:<span style="color: red;">*</span></label>
        </div>
        <div class="card shadow p-3 w-100" id="current_status_card_page5" style="display: none">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group col-md-4" id="death_date_page5">
                        <label>Death Date of Worker:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center datepicker" name="death_date_of_worker" value="{{$data && $data['factory_death_manager_details']['death_date_of_worker'] ? date('d/m/Y',strtotime($data['factory_death_manager_details']['death_date_of_worker'])) : ''}}" placeholder="Enter Date">
                    </div>
                    <div class="form-group col-md-4" id="death_grant_claimed_page5">
                        <label>Death Grant Claimed:<span style="color: red;">*</span></label>
                        <select name="death_grant_claimed" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['factory_death_manager_details']['death_grant_claimed'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                            <option value="na" {{ $data ? $data['factory_death_manager_details']['death_grant_claimed'] == 'na' ? 'selected' : '' : ''}}>N/A</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4" id="retirement_date_worker_page5">
                        <label>Retirement Date of Worker:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center datepicker" name="retirement_date_of_worker" value="{{$data && $data['factory_death_manager_details']['retirement_date_of_worker']? date('d/m/Y',strtotime($data['factory_death_manager_details']['retirement_date_of_worker'])) : ''}}" placeholder="Enter Date">
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Manager's Name:<span style="color: red;">*</span></label>
                        <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="factory_manager_name"
                               placeholder="Enter Name"
                               value="{{$data ? $data['factory_death_manager_details']['factory_manager_name'] : ''}}" id="managername">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Designation:<span style="color: red;">*</span></label>
                        <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="factory_manager_designation"
                               placeholder="Enter Designation"
                               value="{{$data ? $data['factory_death_manager_details']['factory_manager_designation'] : ''}}" id="designationofmanager">
                    </div>
                    <!-- <div class="form-group col-md-3">
                        <label>Contact No:<span style="color: red;">*</span></label>
                        <input id="contact_no_page5" onkeyup="appendPhonePrefix_yes(event)" type="text" class="form-control text-center" name="factory_manager_contact_no"
                               placeholder="+92-XXX-XXXXXXX"
                               value="{{$data ? $data['factory_death_manager_details']['factory_manager_contact_no'] : ''}}">
                    </div> -->
                    <div class="form-group col-md-3">
                        <label>Email:<span style="color: red;">*</span></label>
                        <input onblur="validateEmail();" style="text-transform: none;" type="email" class="form-control text-center" id="factory_manager_email" name="factory_manager_email"
                               value="{{$data ? $data['factory_death_manager_details']['factory_manager_email'] : ''}}"
                               placeholder="example@gmail.com">
                    <label style="display: none;color: red;font-size:14px;" id="emailmessage_check">Email Format Is Incorrect.</label>
                    </div>

                </div>
            </div>
        </div>
        <div class="card shadow mt-5 p-3 w-100">
            <div class="card-body" id="manager_contact_number_parent">
                <div class="form-row">
                    <div class="">
                        <label style="font-size: 20px;">Factory Manager's Contact Numbers:</label>
                    </div>
                    <div class="float-right ml-auto">
                        <button type="button" class="btn btn-primary float-right" onclick="cloneFactoryManagersContactNumber()">+ Add Details</button>
                    </div>
                </div><br>
                <div class="form-row pt-3">
                    <div class="border border-bottom-0 col-md-4 text-center">
                        <label>Serial No.<span style="color: red;">*</span></label>
                    </div>
                    <div class="border border-bottom-0 col-md-4 text-center">
                       <label>Contact No<span style="color: red;">*</span></label>
                    </div>
                   {{--  <div class="border border-bottom-0 col-md-4 text-center">
                       <label>Manager's Relationship<span style="color: red;">*</span></label>
                    </div>
                    <div class="border border-bottom-0 col-md-3 text-center">
                       <label>Specify Relationship<span style="color: red;">*</span></label>
                    </div> --}}
                </div>
                @if($data && isset($data['factory_death_manager_detail_contacts']) && count($data['factory_death_manager_detail_contacts']))
                            @foreach($data['factory_death_manager_detail_contacts'] as $managerContactNumber)
                                <div class="form-row" id="manager_contact_number">
                                    <div class="border border-bottom-0 col-md-4 p-0">

                                        <input readonly id="manager_contact_number_serial_no" type="text" class="form-control rounded-0 text-center" name="serial_no[]" placeholder="1" value="{{$managerContactNumber['serial_no']}}">
                                    </div>
                                    <div class="border border-bottom-0 col-md-4 p-0">

                                        <input onkeyup="appendPhonePrefix_yes(event); factoryManagerContactNoAlert(event);" onclick="appendPhonePrefix_yes(event)" type="text" class="form-control rounded-0" name="contact_number[]" placeholder="+92-000-0000000" value="{{$managerContactNumber['contact_number']}}">
                                    </div>
                                    {{-- <div class="border border-bottom-0 col-md-4 p-0">

                                        <select name="manager_contact_relationship[]" onchange="setManagerContactRelationship(event)" class="form-control rounded-0" id="workercontactrelationsip">
                                            <option value="" selected disabled>Select Relation</option>
                                            @foreach(\Config::get('constants.worker_relationship') as $key => $worker_relationship)
                                                <option value="{{$key}}" {{ $managerContactNumber ? $managerContactNumber['manager_contact_relationship'] == $key ? 'selected' : '' : ''}}>{{$worker_relationship}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="border border-bottom-0 col-md-3 p-0" style="display: none;">

                        <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="manager_specify_relationship[]" id="manager_relationship_1" placeholder="Enter Relationship"
                               value="{{$managerContactNumber['manager_specify_relationship']}}">
                    </div> --}}
                                    <div class="col-md-1">
                                        <button id="removeContactNumberButton" type="button" class="btn btn-danger" onclick="removeContactNumber_05(event)"
                                        @if ($managerContactNumber == reset($data['factory_death_manager_detail_contacts'])) {{'disabled'}} @endif>-</button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="form-row" id="manager_contact_number">
                    <div class="border border-bottom-0 col-md-4 p-0">

                                    <input readonly id="manager_contact_number_serial_no" type="text" class="form-control text-center" name="serial_no[]" value="1">
                                </div>
                    <div class="border border-bottom-0 col-md-4 p-0">

                        <input maxlength="15" id="contact_no_page5" onkeyup="appendPhonePrefix_yes(event); factoryManagerContactNoAlert(event);" onclick="appendPhonePrefix_yes(event)" type="text" class="form-control text-center" name="contact_number[]"
                               placeholder="+92-000-0000000">
                    </div>
                {{-- <div class="border border-bottom-0 col-md-4 p-0">

                                    <select name="manager_contact_relationship[]" class="form-control rounded-0" id="workercontactrelationsip" onchange="setManagerContactRelationship(event)">
                                        <option value="" selected disabled>Select Relation</option>
                                        @foreach(\Config::get('constants.worker_relationship') as $key => $worker_relationship)
                                            <option value="{{$key}}">{{$worker_relationship}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                 <div class="border border-bottom-0 col-md-3 p-0" style="display: none;">

                                  <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="manager_specify_relationship[]" id="manager_relationship_1" placeholder="Enter Relationship">
                    </div> --}}
                    <div class="col-md-1">
                        <button id="removeContactNumberButton" type="button" class="btn btn-danger" disabled onclick="removeContactNumber_05(event)">-</button>
                    </div>
            </div>
                             @endif
                </div>
            </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="mt-4">
                    <label style="font-size: 20px;">PWWB Scholarship Form Attested by Factory Manager:</label>
                </div>
                <div class="card shadow p-3">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Sign:<span style="color: red;">*</span></label>
                                <select name="form_attested_by_manager_sign" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['factory_death_manager_details']['form_attested_by_manager_sign'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Stamp:<span style="color: red;">*</span></label>
                                <select name="form_attested_by_manager_stamp" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['factory_death_manager_details']['form_attested_by_manager_stamp'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="mt-4">
                    <label style="font-size: 20px;">PWWB Scholarship Form Attested by DOL &amp; Dir. Labor:</label>
                </div>
                <div class="card shadow p-3">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                <label>Sign:<span style="color: red;">*</span></label>
                                <select name="form_attested_by_dol_sign" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['factory_death_manager_details']['form_attested_by_dol_sign'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Stamp:<span style="color: red;">*</span></label>
                                <select name="form_attested_by_dol_stamp" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['factory_death_manager_details']['form_attested_by_dol_stamp'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal -->
{{-- Ali Naeem Edit. --}}
<div class="modal fade" id="factory_contact_number_alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CNIC Details.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <label id="factory_contact_no_rst"></label>
            </div>
            <div class="modal-footer">
{{--                <button type="button" class="btn btn-secondary" id="checkno" onclick="checkno_check();" data-dismiss="modal">No</button>--}}
                <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function cloneFactoryManagersContactNumber(){
            let clone = $('#manager_contact_number').clone();

            clone.find('input:text').val('');
            $('#manager_contact_number_parent').append(clone);
            let button = clone.find('#removeContactNumberButton').removeAttr('disabled');
            clone.find('#manager_contact_number_serial_no').val($('#manager_contact_number input[name="serial_no[]"').length);
            $('input[name="contact_number[]"]').each(function (index,value) {
                $(value).mask('+92-000-0000000');
            });
        }
         function lettersOnly()
{
            var charCode = event.keyCode;

            if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8)

                return true;
            else
                return false;
}

        function removeContactNumber_05(event) {
            if(index_id) {
                let csrf_token = $('meta[name="csrf-token"]').attr('content');
                let request = $.ajax({
                    url: '/manager-contact-number-delete',
                    method: "POST",
                    data: {
                        'index_id' : index_id,
                        'serial_no' : $(event.target).parent().parent().find('#manager_contact_number_serial_no').val()
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
            $('#manager_contact_number input[name="serial_no[]"').each(function (index,value) {
                $(value).val(index+1);
            });
        }

        function appendPhonePrefix_yes(event) {
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
        function validateEmail() {
            var emailID = $('#factory_manager_email').val();
            atpos = emailID.indexOf("@");
            dotpos = emailID.lastIndexOf(".");
            if (atpos < 1 || (dotpos - atpos < 2)) {
                //document.getElementById('factory_manager_email').focus();
                $('#emailmessage_check').show();
                return false;

            } else {
                $('#emailmessage_check').hide();
            }
            return (true);
        }

        function factoryManagerContactNoAlert(event){
            if($(event.target).val() != '' ){
                var newridnumber = $(event.target).val();
                $.ajax({
                    url:"factoryManagerContactNoAlert/"+newridnumber,
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
                                $('#factory_contact_no_rst').text(data);
                                $("#factory_contact_number_alert").modal();    
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
