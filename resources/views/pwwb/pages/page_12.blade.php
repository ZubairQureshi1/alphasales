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
<div id="page_12">
    <h1>Transport Details<span class="float-right">Page # 08</span></h1><br>
    <form id="page_12_form">
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-4">
                        <label>Transport Facility:<span style="color: red;">*</span></label>
                        <select id="transport_facility_page12" onchange="setBusStopDisplayPage12()" name="transport_facility" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.transport_yes_no_undecided') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['transport_hostel_details']['transport_facility'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="bus_stop_page12" class="form-group col-md-3" style="display: none">
                        <label>Bus Stop:<span style="color: red;">*</span></label>
                        <input id="bus_stop_12" type="text" class="form-control text-center" name="bus_stop" placeholder="Enter Bus Stop"
                        value="{{$data ? $data['transport_hostel_details']['bus_stop'] : ''}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <label for="" style="font-size: 20px;">Hostel Details:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Hostel Facility:<span style="color: red;">*</span></label>
                        <select id="hostel_facility_select" name="hostel_facility" class="form-control" onchange="setHostelRowDisplay()">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['transport_hostel_details']['hostel_facility'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row" id="hostel_facility_div" style="display: none">
                    <div class="form-group col-md-3">
                        <label>Hostel Name:<span style="color: red;">*</span></label>
                        <input onkeyup="alphabetsOnly(event)" type="text" class="form-control text-center" name="hostel_name" placeholder="Enter Hostel Name"
                        value="{{$data ? $data['transport_hostel_details']['hostel_name'] : ''}}" id="hostel">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Address:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center" name="address" id="address" placeholder="Enter Address"
                        value="{{$data ? $data['transport_hostel_details']['address'] : ''}}">
                    </div>
                    <div class="form-group  col-md-3">
                        <label>Manager's Name:<span style="color: red;">*</span></label>
                        <input onkeyup="alphabetsOnly(event)" type="text" class="form-control text-center" name="manager_name" placeholder="Enter Manager's Name"
                        value="{{$data ? $data['transport_hostel_details']['manager_name'] : ''}}" id="manage">
                    </div>
                    <div class="form-group  col-md-3">
                        <label>Manager's Contact No:<span style="color: red;">*</span></label>
                        <input onkeyup="appendPhonePrefix_ok(event)" onclick="appendPhonePrefix_ok(event)" type="text" id="manager_contact" class="form-control text-center" name="manager_contact"
                               placeholder="+92-XXX-XXXXXXX"
                        value="{{$data ? $data['transport_hostel_details']['manager_contact'] : ''}}">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@section('script_page_12')
    <script>
        setHostelRowDisplay();
        setBusStopDisplayPage12();

        $('input[name="manager_contact"]').each(function (index,value) {
            $(value).mask('+92-000-0000000');
        });

        function setHostelRowDisplay() {
            let selected = $('#hostel_facility_select option:selected').val();
            if(selected == 'yes') {
                $('#hostel_facility_div').fadeIn();
            }
            else{
                if(!index_id){
                    $('#hostel').val('');
                    $('#manage').val('');
                    $('#manager_contact').val('');
                    $('#address').val('');

                }
                $('#hostel_facility_div').fadeOut();
            }
        }
        function appendPhonePrefix_ok(event) {
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
        function setBusStopDisplayPage12() {
            let selected = $('#transport_facility_page12').val();
            if(selected == 'yes'){
                $('#bus_stop_page12').show();
            }
            else{
                if(!index_id){
                    $('#bus_stop_12').val('');
                }

                $('#bus_stop_page12').hide();

            }
        }
        function changeText(event) {
           var value = String.fromCharCode(event.which);
           var pattern = new RegExp(/[a-zåäö ]/i);
           return pattern.test(value);
        }

        $('#manage').bind('keypress', changeText);
        $('#hostel').bind('keypress', changeText);
       </script>
@endsection
