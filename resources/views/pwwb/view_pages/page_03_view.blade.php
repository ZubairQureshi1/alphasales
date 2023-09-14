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
<br>
<div class="col-md-12">
            <h1>Worker's Social Security Details</h1>
            </div><br>
        <div class="col-md-12 mt-4">
            <label for="" class="styling">Worker's Social Security Details:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label @if( !$data['worker_bank_security_details']['social_security']) class="text-danger" @endif><strong>Social Security R-8 No. &amp;/or CNIC of worker:</strong></label>
                        <label>
                            {{$data && $data['worker_bank_security_details']['social_security'] ? $data['worker_bank_security_details']['social_security'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-6">
                        <label @if( !$data['worker_bank_security_details']['social_security_attested']) class="text-danger" @endif><strong>Worker's Social Security Card Attested by Factory Manager:</strong></label>
                        <label>
                            {{$data && $data['worker_bank_security_details']['social_security_attested'] ? $data['worker_bank_security_details']['social_security_attested'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-6">
                        <label @if( !$data['worker_bank_security_details']['social_security_office_name']) class="text-danger" @endif><strong>Social Security Local Office Name:</strong></label>
                        <label>
                            {{$data && $data['worker_bank_security_details']['social_security_office_name'] ? $data['worker_bank_security_details']['social_security_office_name'] : '--'}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <label for="" class="styling">Worker's EOBI Details:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label @if( !$data['worker_bank_security_details']['eobi_number']) class="text-danger" @endif><strong>EOBI Number:</strong></label>
                        <label>
                            {{$data && $data['worker_bank_security_details']['eobi_number'] ? $data['worker_bank_security_details']['eobi_number'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-6">
                        <label @if( !$data['worker_bank_security_details']['eobi_card_attested']) class="text-danger" @endif><strong>EOBI Card Attested by Factory Manager:</strong></label>
                        <label>
                            {{$data && $data['worker_bank_security_details']['eobi_card_attested'] ? $data['worker_bank_security_details']['eobi_card_attested'] : '--'}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <label for="" class="styling">Worker's Bank Details:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-3">
                        <label @if( !$data['worker_bank_security_details']['name_of_bank']) class="text-danger" @endif><strong>Name of Bank:</strong></label>
                        <label>
                            {{$data && $data['worker_bank_security_details']['name_of_bank'] ? $data['worker_bank_security_details']['name_of_bank'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-3">
                        <label @if( !$data['worker_bank_security_details']['bank_branch_address']) class="text-danger" @endif><strong>Branch Address:</strong></label>
                        <label>
                            {{$data && $data['worker_bank_security_details']['bank_branch_address'] ? $data['worker_bank_security_details']['bank_branch_address'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-3">
                        <label @if( !$data['worker_bank_security_details']['bank_branch_code']) class="text-danger" @endif><strong>Branch Code:</strong></label>
                        <label>
                            {{$data && $data['worker_bank_security_details']['bank_branch_code'] ? $data['worker_bank_security_details']['bank_branch_code'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group  col-md-3">
                        <label @if( !$data['worker_bank_security_details']['bank_iban']) class="text-danger" @endif><strong>IBAN:</strong></label>
                        <label>
                            {{$data && $data['worker_bank_security_details']['bank_iban'] ? $data['worker_bank_security_details']['bank_iban'] : '--'}}
                        </label>
                    </div>
                </div>
                  </div>
        </div>
        <div class="col-md-12 mt-4">
            <label for="" class="styling">Postal Address of Worker:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label @if( !$data['worker_bank_security_details']['permanent_address']) class="text-danger" @endif><strong>Permanent:</strong></label>
                        <label>
                            {{$data && $data['worker_bank_security_details']['permanent_address'] ? $data['worker_bank_security_details']['permanent_address'] : '--'}}
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label @if( !$data['worker_bank_security_details']['temporary_address']) class="text-danger" @endif><strong>Temporary:</strong></label>
                        <label>
                            {{$data && $data['worker_bank_security_details']['temporary_address'] ? $data['worker_bank_security_details']['temporary_address'] : '--'}}
                        </label>
                    </div>
                </div>
            </div>
        </div>