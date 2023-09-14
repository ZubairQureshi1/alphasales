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
{{-- Ali Naeem Edit. --}}
<br>
<div class="col-md-12">
            <h1>Worker's Personal Details</h1>
            </div><br>
{{-- Ali Naeem Edit. --}}
        <div class="col-md-12">
            <label for="" class="styling">Photograph of Student:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-4">
                        <label @if( !isset($data['worker_personal_details']['photograph_uploaded'])) class="text-danger" @endif><strong>Photograph Attached:</strong></label>
                        <label>
                            {{$data && $data['worker_personal_details']['photograph_uploaded'] ? $data['worker_personal_details']['photograph_uploaded'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['photograph_attested']) class="text-danger" @endif><strong>Photograph Attested by Gazzeted Officer :</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['photograph_attested'] ? $data['worker_personal_details']['photograph_attested'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['photograph_quantity'] || $data['worker_personal_details']['photograph_quantity'] < 6 ) class="text-danger" @endif><strong>Photographs Quantity (Min. 6):</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['photograph_quantity'] ? $data['worker_personal_details']['photograph_quantity'] : '--'}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-1">
            <label for="" class="styling">Worker's Personal Details:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['worker_name']) class="text-danger" @endif><strong>Name of Worker:</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['worker_name'] ? $data['worker_personal_details']['worker_name'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['applicant_name']) class="text-danger" @endif><strong>Applicant's Name(Widow of Worker):</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['applicant_name'] ? $data['worker_personal_details']['applicant_name'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['worker_cnic']) class="text-danger" @endif><strong>Worker's CNIC Number.</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['worker_cnic'] ? $data['worker_personal_details']['worker_cnic'] : '--'}}
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['worker_cnic_attested']) class="text-danger" @endif><strong>Worker's CNIC Attested By Gazzeted Officer:</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['worker_cnic_attested'] ? $data['worker_personal_details']['worker_cnic_attested'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['worker_current_status']) class="text-danger" @endif><strong>Worker's Current Status:</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['worker_current_status'] ? $data['worker_personal_details']['worker_current_status'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['worker_job_nature']) class="text-danger" @endif><strong>Worker's Job Nature:</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['worker_job_nature'] ? $data['worker_personal_details']['worker_job_nature'] : '--'}}
                        </label>
                    </div>
                </div>
                <div class="form-row ">
                    <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['factory_status']) class="text-danger" @endif><strong>Factory Status:</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['factory_status'] ? $data['worker_personal_details']['factory_status'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['worker_relationship']) class="text-danger" @endif><strong>Worker's Relationship with Students:</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['worker_relationship'] ? $data['worker_personal_details']['worker_relationship'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['date_of_birth']) class="text-danger" @endif><strong>Date of Birth:</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['date_of_birth'] ? $data['worker_personal_details']['date_of_birth'] : '--'}}
                        </label>
                    </div>
                </div>
                <div class="form-row ">
                   {{-- <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['contact_no_1']) class="text-danger" @endif><strong>Contact No. 1:</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['contact_no_1'] ? $data['worker_personal_details']['contact_no_1'] : '--'}}
                        </label>
                    </div> --}}
                    {{--<div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['contact_no_2']) class="text-danger" @endif><strong>Contact No. 2:</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['contact_no_2'] ? $data['worker_personal_details']['contact_no_2'] : '--'}}
                        </label>
                    </div>--}}
                 {{--   <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['contact_no_3']) class="text-danger" @endif><strong>Contact No. 3:</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['contact_no_3'] ? $data['worker_personal_details']['contact_no_3'] : '--'}}
                        </label>
                    </div>--}}
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <label for="" class="styling">Worker's Contact Numbers:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                @if($data['worker_contact_numbers'])
                    @foreach($data['worker_contact_numbers'] as $worker_contacts)
                <div class="form-row ">
                    <div class="form-group col-md-3">
                        {{-- <label><strong>Serial No.</strong></label> --}}
                        <label @if( !$worker_contacts['serial_no']) class="text-danger" @endif><strong>Serial No:</strong></label>
                        <label >
                            {{$worker_contacts['serial_no']? $worker_contacts['serial_no'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-3">
                        {{-- <label><strong>Contact No:</strong></label> --}}
                        <label @if( !$worker_contacts['contact_no']) class="text-danger" @endif><strong>Contact No:</strong></label>
                        <label >
                            {{$worker_contacts['contact_no']? $worker_contacts['contact_no'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-3">
                        {{-- <label><strong>Worker's Relationship:</strong></label> --}}
                        <label @if( !$worker_contacts['worker_contact_relationship']) class="text-danger" @endif><strong>Worker's Relationship:</strong></label>
                        <label >
                            {{$worker_contacts['worker_contact_relationship']? $worker_contacts['worker_contact_relationship'] : '--'}}
                           </label>
                    </div>
                    <div class="form-group col-md-3">
                        {{-- <label><strong>Specify Relationship:</strong></label> --}}
                        <label @if( !$worker_contacts['specify_relationship_2']) class="text-danger" @endif><strong>Specify Relationship:</strong></label>
                        <label >
                             {{$worker_contacts['specify_relationship_2']? $worker_contacts['specify_relationship_2'] : '--'}}
                           </label>
                    </div>
                </div>
                <div style="border-bottom:  1px solid black;"></div><br>
                @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <label for="" class="styling">Worker's Designation as per:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row ">
                    <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['pwwb_scholarship_form']) class="text-danger" @endif><strong>PWWB Scholorship Form:</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['pwwb_scholarship_form'] ? $data['worker_personal_details']['pwwb_scholarship_form'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['factory_card']) class="text-danger" @endif><strong>Factory Card:</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['factory_card'] ? $data['worker_personal_details']['factory_card'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['worker_personal_details']['service_letter']) class="text-danger" @endif><strong>Service Letter:</strong></label>
                        <label >
                            {{$data && $data['worker_personal_details']['service_letter'] ? $data['worker_personal_details']['service_letter'] : '--'}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
