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
<div id="page_02">
    <h1>Worker's Personal Details<span class="float-right">Page # 02</span></h1><br>
    <form id="page_02_form">
        <div class="col-md-12">
            <label for="" style="font-size: 20px;">Photograph of Student:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-3">
                        <label>Photograph Attached:<span style="color: red;">*</span></label>
                        <select name="photograph_uploaded" id="photograph_uploaded" class="form-control text-center" onchange="setPhotographUploaded(event)">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $general_yes_no)
                                <option value="{{$key}}" {{ $data ? $data['worker_personal_details']['photograph_uploaded'] == $key ? 'selected' : '' : ''}}>{{$general_yes_no}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-5" id="photograph_attested_page_02" style="display: none;">
                        <label>Photograph Attested by Gazzeted Officer :<span style="color: red;">*</span></label>
                        <select name="photograph_attested" class="form-control" id="photograph_attested_page_">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $general_yes_no)
                                <option value="{{$key}}" {{ $data ? $data['worker_personal_details']['photograph_attested'] == $key ? 'selected' : '' : ''}}>{{$general_yes_no}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4" id="photograph_quantity_page_02" style="display: none;">
                        <label>Photographs Quantity (Min. 6):<span style="color: red;">*</span></label>
                        <input type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" onblur="checkifminimum();" class="form-control text-center photograph_quantity_q" placeholder="INT"
                               id="photograph_quantity" name="photograph_quantity" value="{{$data ? $data['worker_personal_details']['photograph_quantity'] : ''}}">
                    </div>
                </div>
            </div>
        </div><br>
        <div class="col-md-12 mt-1">
            <label for="" style="font-size: 20px;">Worker's Personal Details:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Name of Worker:<span style="color: red;">*</span></label>
                        <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="worker_name" id="worker_personal_details_worker_name" placeholder="Enter Name"
                               value="{{$data ? $data['worker_personal_details']['worker_name'] : ''}}" id="Nameofworker">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Worker's Current Status:<span style="color: red;">*</span></label>
                        <select onchange="workerDeathStatus(event)" id="worker_current_status" name="worker_current_status" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.workers_current_status') as $key => $workers_current_status)
                                <option value="{{$key}}" {{ $data ? $data['worker_personal_details']['worker_current_status'] == $key ? 'selected' : '' : ''}}>{{$workers_current_status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Worker's CNIC Number.:<span style="color: red;">*</span></label>
                        <input type="text" onkeyup="woerkCNICAlert();" class="form-control text-center" name="worker_cnic" id="worker_cnic"
                               placeholder="00000-00000000-0" value="{{$data ? $data['worker_personal_details']['worker_cnic'] : ''}}">
                       <label style="color: red;" id="worker_cnic_alert"></label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Worker's CNIC Attested By Gazzeted Officer:<span style="color: red;">*</span></label>
                        <select name="worker_cnic_attested" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $general_yes_no)
                                <option value="{{$key}}" {{ $data ? $data['worker_personal_details']['worker_cnic_attested'] == $key ? 'selected' : '' : ''}}>{{$general_yes_no}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div id="widowofworker" name="widowofworker" style="display:none" class="form-group col-md-4">
                        <label>Applicant's Name (Widow of Worker):<span style="color: red;">*</span></label>
                        <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="applicant_name" id="widow_page_4" placeholder="Enter Name"
                               value="{{$data ? $data['worker_personal_details']['applicant_name'] : ''}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Worker's Job Nature:<span style="color: red;">*</span></label>
                        <select name="worker_job_nature" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.workers_job_nature') as $key => $workers_job_nature)
                                <option value="{{$key}}" {{ $data ? $data['worker_personal_details']['worker_job_nature'] == $key ? 'selected' : '' : ''}}>{{$workers_job_nature}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row ">
                    <div class="form-group col-md-3">
                        <label>Factory Status:<span style="color: red;">*</span></label>
                        <select name="factory_status" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.factory_status') as $key => $factory_status)
                                <option value="{{$key}}" {{ $data ? $data['worker_personal_details']['factory_status'] == $key ? 'selected' : '' : ''}}>{{$factory_status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Worker's Relationship with Student:<span style="color: red;">*</span></label>
                        <select name="worker_relationship" onchange="setRelationship(event)" id="setworkerrelationship" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.worker_relationship') as $key => $worker_relationship)
                                <option value="{{$key}}" {{ $data ? $data['worker_personal_details']['worker_relationship'] == $key ? 'selected' : '' : ''}}>{{$worker_relationship}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="workerrelationship" class="form-group col-md-3" style="display: none;">
                        <label>Specify Relationship:<span style="color: red;">*</span></label>
                        <input onkeypress="return lettersOnly(event)" id="worker_set_relationship_1" type="text" class="form-control text-center" name="specify_relationship" placeholder="Enter Relationship"
                               value="{{$data ? $data['worker_personal_details']['specify_relationship'] : ''}}" id="specifyrelationship">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Date of Birth:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control datepicker" name="date_of_birth" placeholder="Enter Date"
                               value="{{$data && $data['worker_personal_details']['date_of_birth'] ? date('d/m/Y',strtotime($data['worker_personal_details']['date_of_birth'])) : '' }}">
                    </div>
                </div>
                <div class="card shadow mt-5 p-3 w-100">
                    <div class="card-body" id="worker_contact_number_parent">
                        <div class="form-row">
                            <div class="">
                                <label style="font-size: 20px;">Worker's Contact Numbers:</label>
                            </div>
                            <div class="float-right ml-auto">
                                <button type="button" class="btn btn-primary float-right" onclick="cloneWorkerContactNumber()">+ Add Details</button>
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
                       <label>Worker's Relationship<span style="color: red;">*</span></label>
                    </div>
                    <div class="border border-bottom-0 col-md-3 text-center">
                       <label>Specify Relationship<span style="color: red;">*</span></label>
                    </div>
                </div>
                        @if($data && isset($data['worker_contact_numbers']) && count($data['worker_contact_numbers']))
                            @foreach($data['worker_contact_numbers'] as $workerContactNumber)
                                <div class="form-row" id="worker_contact_number">
                                    <div class="border border-bottom-0 col-md-1 p-0">

                                        <input readonly id="worker_contact_number_serial_no" type="text" class="form-control rounded-0 text-center" name="serial_no[]" placeholder="1" value="{{$workerContactNumber['serial_no']}}">
                                    </div>
                                    <div class="border border-bottom-0 col-md-3 p-0">

                                        <input onkeyup="appendPhonePrefix_(event); workersContactNumberAlert(event);" onclick="appendPhonePrefix_(event)" type="text" class="form-control rounded-0" name="contact_no[]" placeholder="+92-000-0000000" value="{{$workerContactNumber['contact_no']}}">
                                    </div>
                                    <div class="border border-bottom-0 col-md-4 p-0">

                                        <select name="worker_contact_relationship[]" onchange="setWorkerContactRelationship(event)" class="form-control rounded-0" id="workercontactrelationsip">
                                            <option value="" selected>Select Relation</option>
                                            @foreach(\Config::get('constants.worker_relationship') as $key => $worker_relationship)
                                                <option value="{{$key}}" {{ $workerContactNumber ? $workerContactNumber['worker_contact_relationship'] == $key ? 'selected' : '' : ''}}>{{$worker_relationship}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="workerrelationship3" class="border border-bottom-0 col-md-3 p-0" style="display: none;">

                                        <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="specify_relationship_2[]" id="worker_relationship_1" placeholder="Enter Relationship"
                                               value="{{$workerContactNumber['specify_relationship_2']}}">
                                    </div>
                                    <div class="col-md-1">
                                        <button id="removeContactNumberButton" type="button" class="btn btn-danger" onclick="removeContactNumber_02(event)"
                                        @if ($workerContactNumber == reset($data['worker_contact_numbers'])) {{'disabled'}} @endif>-</button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="form-row" id="worker_contact_number">
                                <div class="border border-bottom-0 col-md-1 p-0">

                                    <input readonly id="worker_contact_number_serial_no" type="text" class="form-control rounded-0 text-center" name="serial_no[]" value="1">
                                </div>
                                <div class="border border-bottom-0 col-md-3 p-0">

                                    <input onkeyup="appendPhonePrefix_(event); workersContactNumberAlert(event); " onclick="appendPhonePrefix_(event)" class="form-control rounded-0" type="text" name="contact_no[]" placeholder="+92-000-0000000">
                                </div>
                                <div class="border border-bottom-0 col-md-4 p-0">

                                    <select name="worker_contact_relationship[]" class="form-control rounded-0" id="workercontactrelationsip" onchange="setWorkerContactRelationship(event)">
                                        <option value="" selected>Select Relation</option>
                                        @foreach(\Config::get('constants.worker_relationship') as $key => $worker_relationship)
                                            <option value="{{$key}}">{{$worker_relationship}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="workerrelationship3" class="border border-bottom-0 col-md-3 p-0" style="display: none;">

                                    <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="specify_relationship_2[]" id="worker_relationship_1" placeholder="Enter Relationship">
                                </div>
                                <div class="col-md-1">
                                    <button id="removeContactNumberButton" type="button" class="btn btn-danger" disabled onclick="removeContactNumber_02(event)">-</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <label for="" style="font-size: 20px;">Worker's Designation As Per:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row ">
                    <div class="form-group col-md-4">
                        <label>PWWB Scholarship Form:<span style="color: red;">*</span></label>
                        <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="pwwb_scholarship_form"
                               placeholder="Enter Form" value="{{$data ? $data['worker_personal_details']['pwwb_scholarship_form'] : ''}}" id="sform">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Factory Card:<span style="color: red;">*</span></label>
                        <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="factory_card" placeholder="Enter Factory Card"
                               value="{{$data ? $data['worker_personal_details']['factory_card'] : ''}}" id="factorycard">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Service Letter:<span style="color: red;">*</span></label>
                        <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="service_letter" placeholder="Enter Service Letter"
                               value="{{$data ? $data['worker_personal_details']['service_letter'] : ''}}" id="serviceletter">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal -->
{{-- Ali Naeem Edit. --}}
<div class="modal fade" id="photographs_qty_" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Photographs Quantity (Min. 6).</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do You Want To Store Less Then Given Quantity ?
            </div>
            <div class="modal-footer">
{{--                <button type="button" class="btn btn-secondary" id="checkno" onclick="checkno_check();" data-dismiss="modal">No</button>--}}
                <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
{{-- Ali Naeem Edit. --}}
<div class="modal fade" id="worker_contact_number_alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CNIC Details.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <label id="contact_no_rst"></label>
            </div>
            <div class="modal-footer">
{{--                <button type="button" class="btn btn-secondary" id="checkno" onclick="checkno_check();" data-dismiss="modal">No</button>--}}
                <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
@section('script_page_2')

    <script>
        $('input[name="worker_cnic"]').each(function (index,value) {
            $(value).mask('00000-0000000-0');
        });

        $('input[name="contact_no[]"]').each(function (index,value) {
            $(value).mask('+92-000-0000000');
        });
        $('#contact_no_page5').each(function (index,value) {
            $(value).mask('+92-000-0000000');
        });
        $('select[name="worker_contact_relationship[]"').each(function (index,value) {

            if($(value).val() == 'other')
                $(value).parent().next().show();
            else
                $(value).parent().next().hide();
        });
        $('select[name="manager_contact_relationship[]"').each(function (index,value) {
            if($(value).val() == 'other')
                $(value).parent().next().show();
            else
                $(value).parent().next().hide();
        });

        worker_current_status();
        function worker_current_status(){
            var worker_current_status = $('#worker_current_status').val();
            if(worker_current_status == 'died'){
                $('#widow_page_4').val('');
                $('#current_status_card_page5').show();
                $('#death_date_page5_header').show();
                $('#retirement_date_worker_page5').show();
                $('#death_grant_claimed_page5').show();
                $('#death_date_page5').show();
                $('#widowofworker').show();
            }
            else if(worker_current_status == 'retired'){
                $('#current_status_card_page5').show();
                $('#death_date_page5_header').show();
                $('#retirement_date_worker_page5').show();
                $('#death_grant_claimed_page5').hide();
                $('#death_date_page5').hide();
                $('#widowofworker').hide();
            }
            else{
                if(!index_id){
                    $('#widow_page_4').val('');
                }
                $('#current_status_card_page5').hide();
                $('#death_date_page5_header').hide();
                $('#widowofworker').hide();
            }
        }

        function check_photo_yes(){
           var photograph_uploaded = $('#photograph_uploaded').val();
           if(photograph_uploaded == 'yes')
           {
                $('#photograph_attested_page_02').show();
                $('#photograph_quantity_page_02').show();
           }
           else{

                $('#photograph_attested_page_02').hide();
                $('#photograph_quantity_page_02').hide();
           }
        }


        // $('select[name="photograph_uploaded"').each(function (index,value) {
        //    if($(value).val() == 'yes')
        //         $('#photograph_attested_page_02').show();
        //         $('#photograph_quantity_page_02').show();
        //     else
        //         $('#photograph_attested_page_02').hide();
        //         $('#photograph_quantity_page_02').hide();

        // });




        check_photo_yes();
        setRelationship();
        setWorkerContactRelationship();
        workerDeathStatusFirstTime();
        setPhotographUploaded();
        setManagerContactRelationship();

        function setRelationship(e) {
            let selected = $('#setworkerrelationship').val();
            if(selected == 'other'){
                $('#worker_set_relationship_1').val('');
                $(e.target).parent().next().show();
            }
            else{
                $(e.target).parent().next().hide();
            }
        }
        function setWorkerContactRelationship(e) {
            if(e.target.value == 'other'){
                $(e.target).parent().next().show();/$('#studentrelationship').show()/;
            }
            else{
                $(e.target).parent().next().hide();
                $(e.target).parent().next().find('#worker_relationship_1').val('');
                // $('#studentrelationship').hide();
            }
        }
        function setManagerContactRelationship(e) {
            if(e.target.value == 'other'){
                $(e.target).parent().next().show();
            }
            else{
                if(!index_id){
                    // $('#manager_relationship_1').val('');
                }
                $(e.target).parent().next().hide();
                $(e.target).parent().next().find('#manager_relationship_1').val('');

                // $('#studentrelationship').hide();
            }
        }
         function setPhotographUploaded(e) {
            let selected = $('select[name="photograph_uploaded"]').val();
           if(selected == 'yes'){
                $('#photograph_attested_page_02').show();
                $('#photograph_quantity_page_02').show();

            }
            else{
               if(!index_id){
                   $('#photograph_attested_page_').val('');
                   $('.photograph_quantity_q').val('');
               }
                $('#photograph_attested_page_02').hide();
                $('#photograph_quantity_page_02').hide();
            }
        }
        function workerDeathStatusFirstTime(){
            let selected = $('select[name="worker_current_status"]').val();
            if(selected == 'died'){
                $('#widow_page_4').val('');
                $('#current_status_card_page5').show();
                $('#death_date_page5_header').show();

            }
            else if(selected == 'retired'){
                $('#current_status_card_page5').show();
                $('#death_date_page5_header').show();
                $('#retirement_date_worker_page5').show();
                $('#death_grant_claimed_page5').hide();
                $('#death_date_page5').hide();

            }
            else {
                if(!index_id){
                    $('#widow_page_4').val('');
                }
                $('#current_status_card_page5').hide();
                $('#death_date_page5_header').hide();

            }
        }

        function appendPhonePrefix_(event) {
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

        function workerDeathStatus(e){
            if($(e.target).val() == 'died'){
                $('#widow_page_4').val('');
                $('#current_status_card_page5').show();
                $('#death_date_page5_header').show();
                $('#retirement_date_worker_page5').show();
                $('#death_grant_claimed_page5').show();
                $('#death_date_page5').show();
                $('#widowofworker').show();
            }
            else if($(e.target).val() == 'retired'){
                $('#current_status_card_page5').show();
                $('#death_date_page5_header').show();
                $('#retirement_date_worker_page5').show();
                $('#death_grant_claimed_page5').hide();
                $('#death_date_page5').hide();
                $('#widowofworker').hide();
            }
            else{
                if(!index_id){
                    $('#widow_page_4').val('');
                }
                $('#current_status_card_page5').hide();
                $('#death_date_page5_header').hide();
                $('#widowofworker').hide();
            }
        }

        function cloneWorkerContactNumber(){
            let clone = $('#worker_contact_number').clone();

            clone.find('input:text').val('');
            $('#worker_contact_number_parent').append(clone);
            let button = clone.find('#removeContactNumberButton').removeAttr('disabled');
            clone.find('#worker_contact_number_serial_no').val($('#worker_contact_number input[name="serial_no[]"').length);
            $('input[name="contact_no[]"]').each(function (index,value) {
                $(value).mask('+92-000-0000000');
            });
        }

        function removeContactNumber_02(event) {
            if(index_id) {
                let csrf_token = $('meta[name="csrf-token"]').attr('content');
                let request = $.ajax({
                    url: '/worker-contact-number-delete',
                    method: "POST",
                    data: {
                        'index_id' : index_id,
                        'serial_no' : $(event.target).parent().parent().find('#worker_contact_number_serial_no').val()
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
            $('#worker_contact_number input[name="serial_no[]"').each(function (index,value) {
                $(value).val(index+1);
            });
        }

        // Ali Naeem Edit.
        function checkifminimum(){

            var minimum = $('#photograph_quantity').val();
            if (minimum != '') {
                if (minimum < 6) {
                    $("#photographs_qty_").modal();

                }
            }
        }
        function checkno_check(){
            $('#photograph_quantity').focus();
        }

        // Ali Naeem Edit.
        function woerkCNICAlert(){
            var newridnumber =$('#worker_cnic').val();
                $.ajax({
                url:"woerkCNICAlert/"+newridnumber,
                method:'get',
                data:{},
                dataType:'json',
                success:function(data){
                    console.log('success');
                    console.log(data);
                    $('#worker_cnic_alert').text(data);
                },
                error:function(data){
                    console.log('error');
                }
            });

        }

        function workersContactNumberAlert(event){
            if($(event.target).val() != '' ){
                var newridnumber = $(event.target).val();
                $.ajax({
                    url:"workersContactNumberAlert/"+newridnumber,
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
                                $('#contact_no_rst').text(data);
                                $("#worker_contact_number_alert").modal();    
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
