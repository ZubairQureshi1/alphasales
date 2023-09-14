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
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
</style>
<div id="page_03">
    <h1>Worker's Social Security Details<span class="float-right">Page # 03</span></h1><br>
    <form id="page_03_form">
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-4">
                        <label>Social Security R-8 No. &amp;/or CNIC of worker:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center" name="social_security"
                               value="{{$data ? $data['worker_bank_security_details']['social_security'] : ''}}"
                               placeholder="Worker CNIC = Social Security">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Worker's Social Security Card Attested by Factory Manager:<span style="color: red;">*</span></label>
                        <select name="social_security_attested" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['worker_bank_security_details']['social_security_attested'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Social Security Local Office Name</label>
                        <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="social_security_office_name"
                               value="{{$data ? $data['worker_bank_security_details']['social_security_office_name'] : ''}}"
                               placeholder="Enter Name" id="localofficesname">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <label for="" style="font-size: 20px;">Worker's EOBI Details:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label>EOBI No:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center" name="eobi_number"
                               value="{{$data ? $data['worker_bank_security_details']['eobi_number'] : ''}}"
                               placeholder="Enter EOBI Number">
                    </div>
                    <div class="form-group col-md-6">
                        <label>EOBI Card Attested by Factory Manager:<span style="color: red;">*</span></label>
                        <select name="eobi_card_attested" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['worker_bank_security_details']['eobi_card_attested'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <label for="" style="font-size: 20px;">Worker's Bank Details:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-4">
                        <label>Name of Bank:<span style="color: red;">*</span></label>
                        <input onkeypress="return lettersOnly(event)" type="text" class="form-control text-center" name="name_of_bank"
                               value="{{$data ? $data['worker_bank_security_details']['name_of_bank'] : ''}}"
                               placeholder="Enter Bank Name" id="bankerName">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Branch Address:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center" name="bank_branch_address"
                               value="{{$data ? $data['worker_bank_security_details']['bank_branch_address'] : ''}}"
                               placeholder="Enter Branch Address">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Branch Code:<span style="color: red;">*</span></label>
                        <input onkeyup="numericOnly(event)" type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" name="bank_branch_code"
                               value="{{$data ? $data['worker_bank_security_details']['bank_branch_code'] : ''}}"
                               placeholder="Enter Branch Code">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group  col-md-4">
                        <label>IBAN:<span style="color: red;">*</span></label>
                        <input maxlength="24" type="text" class="form-control text-center" name="bank_iban"
                               value="{{$data ? $data['worker_bank_security_details']['bank_iban'] : ''}}"
                               placeholder="Enter IBAN Number">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <label for="" style="font-size: 20px;">Postal Address of Worker:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Permanent:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center" name="permanent_address" id="permanent_address_page03_id"
                               value="{{$data ? $data['worker_bank_security_details']['permanent_address'] : ''}}"
                               placeholder="Enter Permanent Address">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Temporary:<span style="color: red;">*</span></label>
                        <input type="text" class="form-control text-center" name="temporary_address" id="temporary_address_page03_id"
                               value="{{$data ? $data['worker_bank_security_details']['temporary_address'] : ''}}"
                               placeholder="Enter Temporary Address">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@section('script_page_3')
<script type="text/javascript">



function textAlphabetical(event) {
   var value = String.fromCharCode(event.which);
   var pattern = new RegExp(/[a-zåäö ]/i);
   return pattern.test(value);
}

$('#bankerName').bind('keypress', textAlphabetical);
$('#localofficesname').bind('keypress', textAlphabetical);
function alphabetsOnly(e) {
            let value = $(e.target).val();
            let length  = value.length;
            let regex = new RegExp("^[a-zA-Z ]+$");
            let str = value.substr(length-1,1);
            if (!regex.test(str)) {
                $(e.target).val(value.substring(0,length-1));
            }
        }
        function numericOnly(event) {
            let value = $(event.target).val();
            let length  = value.length;
            let regex = new RegExp("^[0-9]+$");
            let str = value.substr(length-1,1);
            if (!regex.test(str)) {
                $(event.target).val(value.substring(0,length-1));
            }
        }

        </script>
@endsection
