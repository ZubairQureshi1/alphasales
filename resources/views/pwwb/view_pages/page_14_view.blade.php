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
            <h1>Provisional Letter Status / Claim Status</h1>
            </div><br>

    <div class="col-md-12 mt-2">
        <label for="" class="styling">Provisional Letter Status / Claim Status:</label>
    </div>
    <div class="card shadow p-3 w-100">
        <div class="card-body ">
            <div class="form-row">
                <div class="form-group  col-md-2">
                    <label @if( !$data['provisional_claim_details']['status']) class="text-danger" @endif><strong>Status:</strong></label>
                    <label>
                        {{$data && $data['provisional_claim_details']['status'] ? $data['provisional_claim_details']['status'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['provisional_claim_details']['provisional_letter_date']) class="text-danger" @endif><strong>Date:</strong></label>
                    <label>
                        {{$data && $data['provisional_claim_details']['provisional_letter_date'] ? $data['provisional_claim_details']['provisional_letter_date'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-4">
                    <label @if( !$data['provisional_claim_details']['scrutiny_committee']) class="text-danger" @endif><strong>Scrutiny committee meeting date:</strong></label>
                    <label>
                        {{$data && $data['provisional_claim_details']['scrutiny_committee'] ? $data['provisional_claim_details']['scrutiny_committee'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-3">
                    <label @if( !$data['provisional_claim_details']['bactch_number']) class="text-danger" @endif><strong>Batch number:</strong></label>
                    <label>
                        {{$data && $data['provisional_claim_details']['bactch_number'] ? $data['provisional_claim_details']['bactch_number'] : '--'}}
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-2">
        <label for="" class="styling">Claim From PWWB:</label>
    </div>
    <div class="col-md-12 mt-4">
        <label for="" class="styling">Claim Head:</label>
    </div>
    <div class="card shadow p-3 w-100">
        <div class="card-body">
            @if($data['claims'])
                    @foreach($data['claims'] as $claims)
                    @if($claims['page_number'] == 14)
            <div class="form-row">
                <div class="form-group col-md-2">
                    {{-- <label><strong>Serial No:</strong></label> --}}
                    <label @if( !$claims['serial_no']) @endif><strong>Serial No:</strong></label>
                    <label>
                        {{$claims['serial_no']? $claims['serial_no'] : '--'}}
                        </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Amount of Claim Due:</strong></label> --}}
                    <label @if( !$claims['claim_head_default']) @endif><strong>Claim Head:</strong></label>
                    <label>
                        {{$claims['claim_head_default']? $claims['claim_head_default'] : '--'}}
                    </label>
                </div>
                <div class="form-group col-md-2">
                    <label><strong>{{-- Type of Claim --}}</strong></label>
                    <label @if( !$claims['claim_amount_due_default']) @endif><strong>Amount Due:</strong></label>
                    <label>
                       {{$claims['claim_amount_due_default']? $claims['claim_amount_due_default'] : '0'}}
                    </label>
                </div>
                
            </div>
            <div style="border-bottom:  1px solid black;"></div><br>
            @endif
            @endforeach
            <div class="form-row">
                <div class="form-group col-md-2">
                    {{-- <label><strong>Serial No:</strong></label> --}}
                    <label><strong>Total:</strong></label>
                    {{-- <label>
                        {{ 'Total' }}
                        </label> --}}
                </div>
                
                <div class="form-group col-md-2"></div>
                 <div class="form-group col-md-2">
                    <label><strong>{{-- Type of Claim --}}</strong></label>
                    <label @if( !$claims['total_amount_due_default']) @endif><strong>Amount Due:</strong></label>
                    <label>
                       {{$claims['total_amount_due_default']? $claims['total_amount_due_default'] : '0'}}
                    </label>
                </div>
                
            </div>
                @endif
        </div>
    </div>

    <div class="card shadow p-3 w-100">
        <div class="card-body ">
            <div class="form-row">
                @if(isset($data['claims'][0]))
                <div class="form-group  col-md-2">
                    <label @if( !$data['claims'][0]['claim_due']) class="text-danger" @endif><strong>Claim Due:</strong></label>
                    <label>
                        {{$data && $data['claims'][0]['claim_due'] ? $data['claims'][0]['claim_due'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-2">
                    <label @if( !$data['claims'][0]['claim_status']) class="text-danger" @endif><strong>Claim Status:</strong></label>
                    <label>
                        {{$data && $data['claims'][0]['claim_status'] ? $data['claims'][0]['claim_status'] : '--'}}
                    </label>
                </div>
                <div class="form-group  col-md-2">
                    <label @if( !$data['claims'][0]['reason']) class="text-danger" @endif><strong>Reason:</strong></label>
                    <label>
                        {{$data && $data['claims'][0]['reason'] ? $data['claims'][0]['reason'] : '--'}}
                    </label>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <label for="" class="styling">Claim Status:</label>
    </div>
    <div class="card shadow p-3 w-100">
        <div class="card-body">
            @if($data['claims'])
                    @foreach($data['claims'] as $claims)
                    @if($claims['page_number'] == 14)
            <div class="form-row">
                <div class="form-group col-md-2">
                    {{-- <label><strong>Serial No:</strong></label> --}}
                    <label @if( !$claims['serial_no']) @endif><strong>Serial No:</strong></label>
                    <label>
                        {{$claims['serial_no']? $claims['serial_no'] : '--'}}
                        </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Amount of Claim Due:</strong></label> --}}
                    <label @if( !$claims['claim_head']) @endif><strong>Claim Head:</strong></label>
                    <label>
                        {{$claims['claim_head']? $claims['claim_head'] : '--'}}
                    </label>
                </div>
                 <div class="form-group col-md-2">
                    <label><strong>{{-- Type of Claim --}}</strong></label>
                    <label @if( !$claims['amount_due']) @endif><strong>Amount Due:</strong></label>
                    <label>
                       {{$claims['amount_due']? $claims['amount_due'] : '0'}}
                    </label>
                </div>
                 <div class="form-group col-md-2">
                    {{-- <label><strong>Claim Type:</strong></label> --}}
                    <label @if( !$claims['amount_received']) @endif><strong>Amount Received:</strong></label>
                    <label>
                       {{$claims['amount_received']? $claims['amount_received'] : '0'}}
                    </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Status of Claim Received:</strong></label> --}}
                    <label @if( !$claims['amount_balance']) @endif><strong>Amount Balance:</strong></label>
                    <label>
                       {{$claims['amount_balance']? $claims['amount_balance'] : '0'}}
                    </label>
                </div>
                
            </div>
            <div style="border-bottom:  1px solid black;"></div><br>
            @endif
            @endforeach
            <div class="form-row">
                <div class="form-group col-md-2">
                    {{-- <label><strong>Serial No:</strong></label> --}}
                    <label><strong>Total:</strong></label>
                    {{-- <label>
                        {{ 'Total' }}
                        </label> --}}
                </div>
                
                <div class="form-group col-md-2"></div>
                 <div class="form-group col-md-2">
                    <label><strong>{{-- Type of Claim --}}</strong></label>
                    <label @if( !$data['claims'][0]['total_amount_due'] ) @endif><strong>Amount Due:</strong></label>
                    <label>
                       {{$data['claims'][0]['total_amount_due']? $data['claims'][0]['total_amount_due'] : '0'}}
                    </label>
                </div>
                 <div class="form-group col-md-2">
                    {{-- <label><strong>Claim Type:</strong></label> --}}
                    <label @if( !$data['claims'][0]['total_amount_received']) @endif><strong>Total Received:</strong></label>
                    <label>
                       {{$data['claims'][0]['total_amount_received']? $data['claims'][0]['total_amount_received'] : '0'}}
                    </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Status of Claim Received:</strong></label> --}}
                    <label @if( !$data['claims'][0]['total_amount_balance']) @endif><strong>Total Balance:</strong></label>
                    <label>
                       {{$data['claims'][0]['total_amount_balance']? $data['claims'][0]['total_amount_balance'] : '0'}}
                    </label>
                </div>
                
            </div>
                @endif
        </div>
    </div>
    <br>
    <div class="card shadow p-3 w-100">
        <div class="card-body">
            @if($data['claims'])
            <div class="form-row">
                <div class="form-group col-md-2">
                    {{-- <label><strong>Amount of Claim Due:</strong></label> --}}
                    <label @if( !$claims['amount_received_last']) @endif><strong>Amount Received:</strong></label>
                    <label>
                        {{$claims['amount_received_last']? $claims['amount_received_last'] : '--'}}
                    </label>
                </div>
                 <div class="form-group col-md-2">
                    <label><strong>{{-- Type of Claim --}}</strong></label>
                    <label @if( !$claims['total_amount_cheque']) @endif><strong>Total Amount Cheque:</strong></label>
                    <label>
                       {{$claims['total_amount_cheque']? $claims['total_amount_cheque'] : '0'}}
                    </label>
                </div>
                 <div class="form-group col-md-2">
                    {{-- <label><strong>Claim Type:</strong></label> --}}
                    <label @if( !$claims['cheque_date']) @endif><strong>Cheque Date:</strong></label>
                    <label>
                       {{$claims['cheque_date']? $claims['cheque_date'] : '0'}}
                    </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Status of Claim Received:</strong></label> --}}
                    <label @if( !$claims['cheque_no']) @endif><strong>Cheque No:</strong></label>
                    <label>
                       {{$claims['cheque_no']? $claims['cheque_no'] : '0'}}
                    </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Status of Claim Received:</strong></label> --}}
                    <label @if( !$claims['bank_name']) @endif><strong>Bank Name:</strong></label>
                    <label>
                       {{$claims['bank_name']? $claims['bank_name'] : '0'}}
                    </label>
                </div>
                <div class="form-group col-md-2">
                    {{-- <label><strong>Status of Claim Received:</strong></label> --}}
                    <label @if( !$claims['reason_remarks']) @endif><strong>Reason / Remarks:</strong></label>
                    <label>
                       {{$claims['reason_remarks']? $claims['reason_remarks'] : '0'}}
                    </label>
                </div>
                
            </div>
            <div style="border-bottom:  1px solid black;"></div><br>
                @endif
        </div>
    </div>
