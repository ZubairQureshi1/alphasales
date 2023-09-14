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
<div id="page_04">
    <h1>Factory Details<span class="float-right">Page # 04</span></h1><br>
    <form id="page_04_form">
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-4">
                        <label>Name of Factory/ Establishment:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center" placeholder="Enter Factory Name" name="factory_name" value="{{$data ? $data['factory_details']['factory_name'] : ''}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Address of Factory/ Establishment:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center" placeholder="Enter Factory Address" name="factory_address" value="{{$data ? $data['factory_details']['factory_address'] : ''}}">

                    </div>
                    <div class="form-group col-md-4">
                        <label>Factory/ Establishment Registration No:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center" id="" placeholder="Enter Factory Reg. No"
                               name="factory_registration_number" value="{{$data ? $data['factory_details']['factory_registration_number'] : ''}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label>Date of Factory/Establishment Registration:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center datepicker" name="factory_registration_date"
                               placeholder="Enter Date" value="{{$data && $data['factory_details']['factory_registration_date'] ? date('d/m/Y',strtotime($data['factory_details']['factory_registration_date'])) : ''}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Factory Registration Certificate Attested by Factory Manager:<span style="color: red;">*</span></label>
                        <select name="factory_registration_certificate_attested_by_manager" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['factory_details']['factory_registration_certificate_attested_by_manager'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-7">
                        <label>Factory Registration Certificate Attested by District Officer Labor(DOL):<span style="color: red;">*</span></label>
                        <select name="factory_registration_certificate_attested_by_officer" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['factory_details']['factory_registration_certificate_attested_by_officer'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="factory_registration_certificate_attested_by_director_show_hide" class="form-group  col-md-5">
                        <label>Factory Registration Certificate Attested by Dir. Labor:<span style="color: red;">*</span></label>
                        <select name="factory_registration_certificate_attested_by_director" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['factory_details']['factory_registration_certificate_attested_by_director'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <label for="" style="font-size: 20px;">Signatures:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label>Signature of worker on pg 1 & 3 of PWWB form:<span style="color: red;">*</span></label>
                        <select name="signature_of_worker" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['factory_details']['signature_of_worker'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Date of form Submission:<span style="color: red;">*</span></label>
                        <input onchange="setAccumulatedYears()" type="text" id="date_of_form_submission" class="form-control text-center datepickerAll" name="date_of_submission"
                               placeholder="Enter Date" value="{{$data && $data['factory_details']['date_of_submission'] ? date('d/m/Y',strtotime($data['factory_details']['date_of_submission'])) : ''}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <label for="" style="font-size: 20px;">Service Details:</label>
        </div>
        <div class="card shadow mt-2 p-3 w-100">
            <div class="card-body" id="service_detail_parent">
                <div class="form-row">
                    <div>
                        <label style="font-size: 20px;">Factory Details (Eligible):</label>

                    </div>
                    <div class="float-right ml-auto">
                        <button type="button" class="btn btn-primary float-right" onclick="cloneServiceDetails()">
                            + Add Details
                        </button>
                    </div>
                </div>
                <div id="appointment_check" style="color: red" class="text-center"></div>
                <div id="job_leaving_check" style="color: red" class="text-center"></div>
                <div id="job_in_between_check" style="color: red" class="text-center"></div>
                <label style="font-size: 11px;color:red;" >Jobs must be filled latest to oldest.</label>
                <div class="form-row pt-4">
                    <div class="border border-bottom-0 col-md-1 text-center">
                        <label>Serial.</label>
                    </div>
                    <div class="border border-bottom-0 col-md-1 text-center">
                        <label>Name</label>
                    </div>
                    <div class="border border-bottom-0 col-md-1 text-center">
                        <label>Appointment Date</label>
                    </div>
                    <div class="border border-bottom-0 col-md-1 text-center">
                        <label>Job Leaving Date</label>
                    </div>
                    <div class="border border-bottom-0 col-md-1 text-center">
                        <label>Total Period</label>
                    </div>
                    <div class="border border-bottom-0 col-md-2 text-center">
                        <label>Completion Date of 3 years Service Period</label>
                    </div>
                    <div class="border border-bottom-0 col-md-1 text-center">
                        <label>Service Period Completion Status</label>
                    </div>
                    <div class="border border-bottom-0 col-md-1 text-center">
                        <label>Attested by Factory Manager</label>
                    </div>
                    <div class="border border-bottom-0 col-md-1 text-center">
                        <label>Attestation by DOL</label>
                    </div>
                    <div class="border border-bottom-0 col-md-1 text-center">
                        <label>Attestation by Dir. Labor</label>
                    </div>
                </div>
                @if(isset($data['service_details']) && count($data['service_details']))
                    @foreach($data['service_details'] as $service_details)
                        <div class="form-row accumulatedRows" id="service_detail">
                            <div class="border border-bottom-0 col-md-1 p-0">
                                <input type="text" id="service_serial_no" name="serial_no[]" class="form-control rounded-0 text-center"
                                       placeholder="1" value="{{$service_details['serial_no']}}" readonly>
                            </div>
                            <div class="border border-bottom-0 col-md-1 p-0">
                                <input  class="form-control rounded-0" name="name[]" type="text" placeholder="XXXXX" value="{{$service_details['name']}}" id="Nameoffactorymanager1">
                            </div>
                            <div class="border border-bottom-0 col-md-1 p-0">
                                <input onchange="appointmentDateCheck(event); compare_appointment_dates(); checkifworkinginbetween();" onblur="compare_appointment_dates(); checkifworkinginbetween();" type="text" class="form-control rounded-0 datepickerAccumulated" name="appointment_date[]"
                                       placeholder="Enter Date" value="{{$service_details['appointment_date'] ? date('d/m/Y',strtotime($service_details['appointment_date'])) : ''}}">
                            </div>
                            <div class="border border-bottom-0 col-md-1 p-0">
                                <input onblur="compare_job_leaving_date(); checkifworkinginbetween();" onchange="appointmentDateCheck(event); compare_job_leaving_date(); checkifworkinginbetween();" type="text" class="form-control rounded-0 datepickerAccumulated" name="job_leaving_date[]"
                                       placeholder="Enter Date" value="{{$service_details['job_leaving_date'] ? date('d/m/Y',strtotime($service_details['job_leaving_date'])) : ''}}">
                            </div>
                            <div class="border border-bottom-0 col-md-1 p-0">
                                <input type="text" class="form-control rounded-0" name="total_period[]" placeholder="XXXXX" value="{{$service_details['total_period']}}">
                            </div>
                            <div class="border border-bottom-0 col-md-2 p-0">
                                <input readonly type="text" class="form-control rounded-0" name="completion_date[]" value="{{ $service_details['completion_date'] ? date('d/m/Y',strtotime($service_details['completion_date'])) : ''}}"
                                       placeholder="Enter Date">
                            </div>
                            <div class="border border-bottom-0 col-md-1 p-0">
                                <select disabled id="service_completion_status1" readonly name="service_completion_status[]" class="form-control rounded-0">
                                    <option value="" selected>--select--</option>
                                    <option value="yes" {{ $service_details ? $service_details['service_completion_status'] == 'yes' ? 'selected' : '' : ''}}>Yes</option>
                                    <option value="no" {{ $service_details ? $service_details['service_completion_status'] == 'no' ? 'selected' : '' : ''}}>No</option>
                                </select>
                            </div>
                            <div class="border border-bottom-0 col-md-1 p-0">
                                <select id="" name="attested_by_factory_manager[]" class="form-control rounded-0">
                                    <option value="" selected>--select--</option>
                                    <option value="yes" {{ $service_details ? $service_details['attested_by_factory_manager'] == 'yes' ? 'selected' : '' : ''}}>Yes</option>
                                    <option value="no" {{ $service_details ? $service_details['attested_by_factory_manager'] == 'no' ? 'selected' : '' : ''}}>No</option>
                                </select>
                            </div>
                            <div class="border border-bottom-0 col-md-1 p-0">
                                <select id="" name="attested_by_dol[]" class="form-control rounded-0">
                                    <option value="" selected>--select--</option>
                                    <option value="yes" {{ $service_details ? $service_details['attested_by_dol'] == 'yes' ? 'selected' : '' : ''}}>Yes</option>
                                    <option value="no" {{ $service_details ? $service_details['attested_by_dol'] == 'no' ? 'selected' : '' : ''}}>No</option>
                                </select>
                            </div>
                            <div class="border border-bottom-0 col-md-1 p-0">
                                <select id="" name="attested_by_director[]" class="form-control rounded-0">
                                    <option value="" selected>--select--</option>
                                    <option value="yes" {{ $service_details ? $service_details['attested_by_director'] == 'yes' ? 'selected' : '' : ''}}>Yes</option>
                                    <option value="no" {{ $service_details ? $service_details['attested_by_director'] == 'no' ? 'selected' : '' : ''}}>No</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button id="removeServiceDetailButton" type="button" class="btn btn-danger"
                                        onclick="removeServiceDetail(event)"
                                @if ($service_details == reset($data['service_details'])) {{'disabled'}} @endif><strong>-</strong></button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="form-row accumulatedRows" id="service_detail">
                        <div class="border border-bottom-0 col-md-1 p-0">
                            <input type="text" id="service_serial_no" name="serial_no[]" class="form-control rounded-0 text-center"
                                   value="1"  readonly>
                        </div>
                        <div class="border border-bottom-0 col-md-1 p-0">
                            <input class="form-control rounded-0" name="name[]"  type="text" placeholder="Enter Name" id="Nameoffactorymanager1">
                        </div>
                        <div class="border border-bottom-0 col-md-1 p-0">
                            <input onchange="appointmentDateCheck(event); compare_appointment_dates(); checkifworkinginbetween();" type="text" onblur="compare_appointment_dates(); checkifworkinginbetween();" class="form-control rounded-0 datepickerAccumulated" id="appointment_date1" name="appointment_date[]"
                                   placeholder="Enter Date">
                        </div>
                        <div class="border border-bottom-0 col-md-1 p-0">
                            <input type="text" class="form-control rounded-0 datepickerAccumulated" onblur="compare_job_leaving_date(); checkifworkinginbetween();" id="job_leaving_date1" name="job_leaving_date[]"
                                   onchange="appointmentDateCheck(event); compare_job_leaving_date(); checkifworkinginbetween();" placeholder="Enter Date">
                        </div>
                        <div class="border border-bottom-0 col-md-1 p-0">
                            <input type="text" class="form-control rounded-0" name="total_period[]" placeholder="XXXXX">
                        </div>
                        <div class="border border-bottom-0 col-md-2 p-0">
                            <input readonly type="text" class="form-control rounded-0" name="completion_date[]"
                                   placeholder="Enter Date">
                        </div>
                        <div class="border border-bottom-0 col-md-1 p-0">
                            <select disabled id="service_completion_status1" name="service_completion_status[]" class="form-control rounded-0">
                                <option value="" selected>--select--</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="border border-bottom-0 col-md-1 p-0">
                            <select id="" name="attested_by_factory_manager[]" class="form-control rounded-0">
                                <option value="" selected>--select--</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="border border-bottom-0 col-md-1 p-0">
                            <select id="" name="attested_by_dol[]" class="form-control rounded-0">
                                <option value="" selected>--select--</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="border border-bottom-0 col-md-1 p-0">
                            <select id="" name="attested_by_director[]" class="form-control rounded-0">
                                <option value="" selected>--select--</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button id="removeServiceDetailButton" type="button" class="btn btn-danger" disabled onclick="removeServiceDetail(event)"><strong>-</strong></button>
                        </div>
                    </div>
                @endif
            </div>
            <input type="hidden" name="service_completion_statusSave" id="service_completion_statusSave">
            <div class="form-row">
                <div class="float-right ml-auto">
                    <label class="float-right" id="accumulated_years">Accumulated Service Period : 0 Years</label>
                </div>
            </div>
        </div>
    </form>
</div>
@section('script_page_4')
    <script>
        var getAccValue = 0;
       // testfunc();
       // function testfunc(){
       //     // const diffInMonths = (end, start) => {
       //     //     var timeDiff = Math.abs(end.getTime() - start.getTime());
       //     //     return Math.round(timeDiff / (2e3 * 3600 * 365.25));
       //     // }
       //     //
       //     // const result = diffInMonths(new Date(2019, 12, 31), new Date(2017, 1, 1));
       //     //
       //     // console.log(result);
       // }
        setAccumulatedYears();
        $('.datepickerAccumulated').each(function (index, pick) {
            let picker = $(pick).datepicker({
                format: 'dd/mm/yyyy',
            }).on('changeDate', function (ev) {
                setAccumulatedYears();
                picker.hide();
            }).data('datepicker');
        });

        function testInput(event) {
           var value = String.fromCharCode(event.which);
           var pattern = new RegExp(/[a-zåäö ]/i);
           return pattern.test(value);
        }

        // $('#Nameoffactorymanager').bind('keypress', testInput);

        function alphabetsOnly(e) {
            let value = $(e.target).val();
            let length  = value.length;
            let regex = new RegExp("^[a-zA-Z ]+$");
            let str = value.substr(length-1,1);
            if (!regex.test(str)) {
                $(e.target).val(value.substring(0,length-1));
            }
        }
        var total_serial = '';
        function cloneServiceDetails() {
            let clone = $('#service_detail').clone();
            clone.find('.datepicker').each(function (index, pick) {
                let picker = $(pick).datepicker({
                    format: 'dd/mm/yyyy',
                }).on('changeDate', function (ev) {
                    setAccumulatedYears();
                    picker.hide();
                }).data('datepicker');
            });

            clone.find('.datepickerAccumulated').each(function (index, pick) {
                let picker = $(pick).datepicker({
                    format: 'dd/mm/yyyy',
                }).on('changeDate', function (ev) {
                    setAccumulatedYears();
                    picker.hide();
                }).data('datepicker');
            });

            clone.find('input:text').val('');

            $('#service_detail_parent').append(clone);
            let button = clone.find('#removeServiceDetailButton').removeAttr('disabled');

            clone.find('#service_serial_no').val($('#service_detail input[name="serial_no[]"').length);

            total_serial = $('#service_detail input[name="serial_no[]"').length;

            clone.find('#appointment_date1').attr('id', 'appointment_date'+$('#service_detail input[name="serial_no[]"').length);
            clone.find('#job_leaving_date1').attr('id', 'job_leaving_date'+$('#service_detail input[name="serial_no[]"').length);
            let factoryCount = $('#service_detail input[name="serial_no[]"').length;
            // alert(factoryCount);
            clone.find('#Nameoffactorymanager1').attr('id', 'Nameoffactorymanager'+factoryCount);
            setAccumulatedYears();
        }

        function removeServiceDetail(event) {
            if(index_id) {
                let csrf_token = $('meta[name="csrf-token"]').attr('content');
                let request = $.ajax({
                    url: '/service-detail-delete',
                    method: "POST",
                    data: {
                        'index_id' : index_id,
                        'serial_no' : $(event.target).parent().parent().find('#service_serial_no').val()
                    },
                    headers:{
                        'X-CSRF-TOKEN':csrf_token
                    }
                });

                request.done(function (response) {
                });

                request.fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            }
            // $(event.target).parent().parent().remove();
            // $(event.target).parents()[1].remove();
            $(event.target).parents('#service_detail').remove();
            $('#service_detail input[name="serial_no[]"').each(function (index,value) {
                $(value).val(index+1);
            });
            setAccumulatedYears();
        }

        function setAccumulatedYears() {
            let totalYears = 0;
            let newRst = 0;
            let date1array_check = [];
            let date2array_check = [];
            let j = 1;
            let new1arary = '';
            let secondDateArray = $('#date_of_form_submission').val().split('/');
            $('.accumulatedRows').each(function (index, element) {
                let date1Array = $(element).find('input[name="appointment_date[]"]').val().split('/');
                let date2Array = $(element).find('input[name="job_leaving_date[]"]').val().split('/');
                let date2Array__ = $(element).find('input[name="job_leaving_date[]"]').val().split('/');
                let completionDate = $(element).find('input[name="completion_date[]"]');
                // console.log(date2Array__);
                // console.log(date1Array);


                const diffInMonths = (end, start) => {
                    var timeDiff_ = Math.abs(end.getTime() - start.getTime());
                    return Math.round(timeDiff_ / (2e3 * 3600 * 365.25));
                }
                var result_ = '';
                if(date2Array__ == '') {
                    result_ = diffInMonths(new Date(secondDateArray[2], secondDateArray[1], secondDateArray[0]), new Date(date1Array[2], date1Array[1], date1Array[0]));
                }else{
                    result_ = diffInMonths(new Date(date2Array__[2], date2Array__[1], date2Array__[0]), new Date(date1Array[2], date1Array[1], date1Array[0]));
                }
                sum = (result_ /12).toFixed(1);
                if(sum >=0.01 || sum < 0.12)
                    $(element).find('input[name="total_period[]"]').val('');
                    $(element).find('input[name="total_period[]"]').val(parseFloat(sum));
                    totalYears += parseFloat(sum);

            });



            let value = totalYears;
            if(value >= 3){
                getAccValue = value;

                $('#accumulated_years').attr('style','color:green');
                $('#service_completion_status1').val('yes');
                $('#service_completion_statusSave').val($('#service_completion_status1').val());
            }
            else{
                getAccValue = 0;
                $('#accumulated_years').attr('style','color:red');
                $('#service_completion_status1').val('no');
                $('#service_completion_statusSave').val($('#service_completion_status1').val());
            }
            if(value.toFixed(2) == 'NaN'){
                $('#accumulated_years').text('Accumulated Service Period : '+0+' Years');
            }
            else{
                $('#accumulated_years').text('Accumulated Service Period : '+value.toFixed(2)+' Years');
            }
            // $('#accumulated_years').text('Accumulated Service Period : '+value.toFixed(2)+' Years'); Old Code


        }

        // function monthDiff(dt1, dt2) {
        //     var diff =(dt2.getTime() - dt1.getTime()) / 1000;
        //     diff /= (60 * 60 * 24 * 7 * 4);
        //     return Math.abs(Math.round(diff));
        // }

        function monthDiff(dt1,dt2) {
            return dt2.getMonth() - dt1.getMonth();
        }

        function yearsDiff(d1, d2) {
            return d2.getFullYear() - d1.getFullYear();
        }

        function appointmentDateCheck(e) {
            let appointmentField = $(e.target).parent().parent().find('input[name="appointment_date[]"]').val();
            let leavingField = $(e.target).parent().parent().find('input[name="job_leaving_date[]"]').val();
            if(leavingField !== ''){
                let appointmentArray = appointmentField.split('/');
                let leavingArray = leavingField.split('/');

                let leavingDate = new Date(leavingArray[2],leavingArray[1]-1,leavingArray[0]);
                let appointmentDate = new Date(appointmentArray[2],appointmentArray[1]-1,appointmentArray[0]);
                if(leavingDate < appointmentDate){
                    $(e.target).val('');
                }
            }
            setAccumulatedYears();
        }

    </script>

    <script>
        function  compare_appointment_dates(){
            var app_date = '';
            var app_data_one = $('#appointment_date1').val();

            for(var i = 1; i <= total_serial; i++ ){
                console.log(i);

                app_date = $('#appointment_date'+i).val();
                console.log(app_date);

                if(total_serial > 1){
                    if(app_data_one == app_date){
                        $('#appointment_check').text('Appointment Date Cannot Be THe Same For 2 Or More Jobs.');
                    }
                    else{
                        $('#appointment_check').text('');
                    }
                }
            }




        }

        function checkifworkinginbetween(){
            var app_date = '';
            var app_date_prev = '';
            var app_data_one = $('#appointment_date1').val().split('/');
            app_data_one = new Date(app_data_one[2], app_data_one[1], app_data_one[0]);
            // app_data_one = app_data_one[0] + app_data_one[1] + app_data_one[2];
            var leave_date = '';
            var leave_date_prev = '';
            var leave_date_one = $('#job_leaving_date1').val().split('/');
            leave_date_one = new Date(leave_date_one[2], leave_date_one[1], leave_date_one[0]);
            // leave_date_one = leave_date_one[0] + leave_date_one[1] +leave_date_one[2];
            var j = 1;
            for(var i = 1; i <= total_serial; i++ ){
                // console.log(i);
                //


                app_date = $('#appointment_date'+i).val().split('/');
                // console.log(app_date);

                leave_date = $('#job_leaving_date'+i).val().split('/');



                // console.log(leave_date);
                // console.log('//////////////////////////////////'+ leave_date + '////////////////////////////////');
                if(total_serial > 1){
                    // if(app_data_one <= app_date && leave_date_one >= leave_date){
                    //     $('#job_in_between_check').text('Start and end dates cannot be in between previous job.');
                    //
                    // }
                    // else{
                    //     // alert();
                    //     $('#job_in_between_check').text('');
                    // }
                    // app_date = new Date(app_date[2], app_date[1], app_date[0]);
                    // leave_date = new Date(leave_date[2], leave_date[1], leave_date[0]);



                    // app_date = app_date[0] + app_date[1] +app_date[2];
                    // leave_date = leave_date[0] + leave_date[1] +leave_date[2];
                    // app_data_one =app_data_one - 0;
                    // leave_date_one =leave_date_one - 0;
                    // leave_date =leave_date - 0;
                    // app_date =app_date - 0;
                    if(i > 1){
                        j = i-j;


                        app_date_prev = $('#appointment_date'+j).val().split('/');
                        // console.log(app_date);
                        // alert(app_date_prev);

                        leave_date_prev = $('#job_leaving_date'+j).val().split('/');
                    }


                    leave_date = new Date(leave_date[2], leave_date[1], leave_date[0]);
                    app_date = new Date(app_date[2], app_date[1], app_date[0]);


                    leave_date_prev = new Date(leave_date_prev[2], leave_date_prev[1], leave_date_prev[0]);
                    app_date_prev = new Date(app_date_prev[2], app_date_prev[1], app_date_prev[0]);
                    console.log(app_data_one + ' vs ' + leave_date);
                    // var aa = 10;
                    // aa = aa + app_data_one;
                    console.log(app_data_one + ' vs ' + leave_date);
                    if((app_date_prev <= leave_date && leave_date_prev >= app_date)){
                        console.log('checking condition');
                        $('#job_in_between_check').text('Start and end dates cannot be in between previous job.');

                    }
                    else{
                        console.log('not checking condition');
                        // alert();
                        $('#job_in_between_check').text('');
                    }

                    // if(app_data_one <= leave_date){
                    //     $('#job_in_between_check').text('Start and end dates cannot be in between previous job.');
                    //     console.log(app_data_one + '<=' + leave_date);
                    // }
                    // else{
                    //     $('#job_in_between_check').text('');
                    // }
                    //
                    // if(leave_date_one >= app_date){
                    //     $('#job_in_between_check').text('Start and end dates cannot be in between previous job.');
                    //     console.log(leave_date_one + ">=" + app_date);
                    // }
                    // else{
                    //     $('#job_in_between_check').text('');
                    // }


                }

                // if(total_serial > 1){
                //     if(leave_date_one == leave_date){
                //
                //     }
                //     else{
                //
                //     }
                // }
            }

        }

        function compare_job_leaving_date(){
            var leave_date = '';
            var leave_date_one = $('#job_leaving_date1').val();
            for(var i = 1; i <= total_serial; i++ ){
                console.log(i);

                leave_date = $('#job_leaving_date'+i).val();
                console.log(leave_date);

                if(total_serial > 1){
                    if(leave_date_one == leave_date){
                        // alert('Job Leaving Date Cannot Be THe Same For 2 Or More Jobs.');
                        $('#job_leaving_check').text('Job Leaving Date Cannot Be THe Same For 2 Or More Jobs.');
                    }
                    else{
                        $('#job_leaving_check').text('');
                    }
                }
            }
        }
    </script>
@endsection
