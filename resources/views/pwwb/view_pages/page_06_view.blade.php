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
            <h1>Personal Data of Student</h1>
            </div><br>
        <div class="col-md-12 mt-4">
            <label class="styling">Personal Data of Student:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label @if( !$data['student_personal_detail']['name']) class="text-danger" @endif><strong>Name:</strong></label>
                        <label>
                            {{$data && $data['student_personal_detail']['name'] ? $data['student_personal_detail']['name'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-6">
                        <label @if( !$data['student_personal_detail']['father_name']) class="text-danger" @endif><strong>Father's Name:</strong></label>
                        <label>
                            {{$data && $data['student_personal_detail']['father_name'] ? $data['student_personal_detail']['father_name'] : '--'}}
                        </label>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="" class="styling">Student's CNIC/B-Form No:</label>
                </div>
                <div class="card shadow p-3 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label @if( !$data['student_personal_detail']['cnic_no']) class="text-danger" @endif><strong>CNIC/B-Form No:</strong></label>
                                <label>
                                    {{$data && $data['student_personal_detail']['cnic_no'] ? $data['student_personal_detail']['cnic_no'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group col-md-4">
                                <label @if( !$data['student_personal_detail']['quantity'] || $data['student_personal_detail']['quantity'] < 4 ) class="text-danger" @endif><strong>Quantity(min 04):</strong></label>
                                <label>
                                    {{$data && $data['student_personal_detail']['quantity'] ? $data['student_personal_detail']['quantity'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group col-md-4">
                                <label @if( !$data['student_personal_detail']['student_cnic_attested']) class="text-danger" @endif><strong>Attested by Gazzeted Officer:</strong></label>
                                <label>
                                    {{$data && $data['student_personal_detail']['student_cnic_attested'] ? $data['student_personal_detail']['student_cnic_attested'] : '--'}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow p-3 mt-4 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group  col-md-4">
                                <label @if( !$data['student_personal_detail']['date_of_birth']) class="text-danger" @endif><strong>Date of Birth:</strong></label>
                                <label>
                                    {{$data && $data['student_personal_detail']['date_of_birth'] ? $data['student_personal_detail']['date_of_birth'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group col-md-4">
                                <label @if( !$data['student_personal_detail']['present_address']) class="text-danger" @endif><strong>Present Address:</strong></label>
                                <label>
                                    {{$data && $data['student_personal_detail']['present_address'] ? $data['student_personal_detail']['present_address'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group col-md-4">
                                <label @if( !$data['student_personal_detail']['marital_status']) class="text-danger" @endif><strong>Marital Status:</strong></label>
                                <label>
                                    {{$data && $data['student_personal_detail']['marital_status'] ? $data['student_personal_detail']['marital_status'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group col-md-4">
                                <label @if( !$data['student_personal_detail']['postal_address']) class="text-danger" @endif><strong>Postal Address:</strong></label>
                                <label>
                                    {{$data && $data['student_personal_detail']['postal_address'] ? $data['student_personal_detail']['postal_address'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group col-md-4">
                                <label @if( !$data['student_personal_detail']['email']) class="text-danger" @endif><strong>Email:</strong></label>
                                <label>
                                    {{$data && $data['student_personal_detail']['email'] ? $data['student_personal_detail']['email'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group col-md-4">
                                <label @if( !$data['student_personal_detail']['signature']) class="text-danger" @endif><strong>Signature on page2(once)& 3(twice):</strong></label>
                                <label>
                                    {{$data && $data['student_personal_detail']['signature'] ? $data['student_personal_detail']['signature'] : '--'}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
            <label for="" class="styling">Student's Contact Numbers:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                @if($data['student_contact_numbers'])
                    @foreach($data['student_contact_numbers'] as $student_contacts)
                <div class="form-row ">
                    <div class="form-group col-md-3">
                        {{-- <label><strong>Serial No.</strong></label> --}}
                        <label @if( !$student_contacts['serial_no']) class="text-danger" @endif><strong>Serial No:</strong></label>
                        <label >
                            {{$student_contacts['serial_no']? $student_contacts['serial_no'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-3">
                        {{-- <label><strong>Contact No:</strong></label> --}}
                        <label @if( !$student_contacts['contact_no']) class="text-danger" @endif><strong>Contact No:</strong></label>
                        <label >
                            {{$student_contacts['contact_no']? $student_contacts['contact_no'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-3">
                        {{-- <label><strong>Student's Relationship:</strong></label> --}}
                        <label @if( !$student_contacts['student_contact_relationship']) class="text-danger" @endif><strong>Student's Relationship:</strong></label>
                        <label >
                            {{$student_contacts['student_contact_relationship']? $student_contacts['student_contact_relationship'] : '--'}}
                           </label>
                    </div>
                    <div class="form-group col-md-3">
                        {{-- <label><strong>Specify Relationship:</strong></label> --}}
                        <label @if( !$student_contacts['specify_relationship']) class="text-danger" @endif><strong>Specify Relationship:</strong></label>
                        <label >
                             {{$student_contacts['specify_relationship']? $student_contacts['specify_relationship'] : '--'}}
                           </label>
                    </div>
                </div>
                <div style="border-bottom:  1px solid black;"></div><br>
                @endforeach
                @endif
            </div>
        </div>
            </div>
        </div>
