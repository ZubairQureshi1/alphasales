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
            <h1>Factory Manager's Details</h1>
            </div><br>
 @if($data['factory_death_manager_details']['death_grant_claimed'] != null )
        <div class="col-md-12 mt-4">
            <label class="styling">Death/Retirement:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-4">
                        <label @if( !$data['factory_death_manager_details']['death_date_of_worker']) class="text-danger" @endif><strong>Death Date of Worker:</strong></label>
                        <label>
                            {{$data && $data['factory_death_manager_details']['death_date_of_worker'] ? $data['factory_death_manager_details']['death_date_of_worker'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['factory_death_manager_details']['death_grant_claimed']) class="text-danger" @endif><strong>Death Grant Claimed:</strong></label>
                        <label>
                            {{$data && $data['factory_death_manager_details']['death_grant_claimed'] ? $data['factory_death_manager_details']['death_grant_claimed'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['factory_death_manager_details']['retirement_date_of_worker']) class="text-danger" @endif><strong>Retirement Date of Worker:</strong></label>
                        <label>
                            {{$data && $data['factory_death_manager_details']['retirement_date_of_worker'] ? $data['factory_death_manager_details']['retirement_date_of_worker'] : '--'}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
         @endif
        <div class="col-md-12 mt-4">
            <label for=""class="styling">Factory Manager's Details:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="form-row">
                    <div class="form-group  col-md-4">
                        <label @if( !$data['factory_death_manager_details']['factory_manager_name']) class="text-danger" @endif><strong>Name:</strong></label>
                        <label>
                            {{$data && $data['factory_death_manager_details']['factory_manager_name'] ? $data['factory_death_manager_details']['factory_manager_name'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label @if( !$data['factory_death_manager_details']['factory_manager_designation']) class="text-danger" @endif><strong>Designation:</strong></label>
                        <label>
                            {{$data && $data['factory_death_manager_details']['factory_manager_designation'] ? $data['factory_death_manager_details']['factory_manager_designation'] : '--'}}
                        </label>
                    </div>
                    <!-- <div class="form-group col-md-4">
                        <label @if( !$data['factory_death_manager_details']['factory_manager_contact_no']) class="text-danger" @endif><strong>Contact No:</strong></label>
                        <label>
                            {{$data && $data['factory_death_manager_details']['factory_manager_contact_no'] ? $data['factory_death_manager_details']['factory_manager_contact_no'] : '--'}}
                        </label>
                    </div> -->
                    <div class="form-group col-md-4">
                        <label @if( !$data['factory_death_manager_details']['factory_manager_email']) class="text-danger" @endif><strong>Email:</strong></label>
                        <label>
                            {{$data && $data['factory_death_manager_details']['factory_manager_email'] ? $data['factory_death_manager_details']['factory_manager_email'] : '--'}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <label for=""class="styling">Manager's Contact Numbers:</label>
        </div>
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                @if($data['factory_death_manager_detail_contacts'])
                    @foreach($data['factory_death_manager_detail_contacts'] as $manager_contacts)
                <div class="form-row ">
                    <div class="form-group col-md-6">
                        {{-- <label><strong>Serial No.</strong></label> --}}
                        <label @if( !$manager_contacts['serial_no']) class="text-danger" @endif><strong>Serial No:</strong></label>
                        <label >
                            {{$manager_contacts['serial_no']? $manager_contacts['serial_no'] : '--'}}
                        </label>
                    </div>
                    <div class="form-group col-md-6">
                        {{-- <label><strong>Contact No:</strong></label> --}}
                        <label @if( !$manager_contacts['contact_number']) class="text-danger" @endif><strong>Contact No:</strong></label>
                        <label >
                            {{$manager_contacts['contact_number']? $manager_contacts['contact_number'] : '--'}}
                        </label>
                    </div>
                   {{--  <div class="form-group col-md-3">
                        <label><strong>Manager's Relationship:</strong></label>
                        <label >
                            {{$manager_contacts['manager_contact_relationship']? $manager_contacts['manager_contact_relationship'] : '--'}}
                           </label>
                    </div>
                    <div class="form-group col-md-3">
                        <label><strong>Specify Relationship:</strong></label>
                        <label >
                             {{$manager_contacts['manager_specify_relationship']? $manager_contacts['manager_specify_relationship'] : '--'}}
                           </label>
                    </div> --}}
                </div>
                 <div style="border-bottom:  1px solid black;"></div><br>
                @endforeach
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="mt-4">
                    <label class="styling">PWWB Scholorship Form Attested by Factory Manager:</label>
                </div>
                <div class="card shadow p-3">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label @if( !$data['factory_death_manager_details']['form_attested_by_manager_sign']) class="text-danger" @endif><strong>Sign:</strong></label>
                                <label>
                                    {{$data && $data['factory_death_manager_details']['form_attested_by_manager_sign'] ? $data['factory_death_manager_details']['form_attested_by_manager_sign'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label @if( !$data['factory_death_manager_details']['form_attested_by_manager_stamp']) class="text-danger" @endif><strong>Stamp:</strong></label>
                                <label>
                                    {{$data && $data['factory_death_manager_details']['form_attested_by_manager_stamp'] ? $data['factory_death_manager_details']['form_attested_by_manager_stamp'] : '--'}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="mt-4">
                    <label class="styling">PWWB Scholarship Form Attested by DOL Dir. Labor:</label>
                </div>
                <div class="card shadow p-3">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                <label @if( !$data['factory_death_manager_details']['form_attested_by_dol_sign']) class="text-danger" @endif><strong>Sign:</strong></label>
                                <label>
                                    {{$data && $data['factory_death_manager_details']['form_attested_by_dol_sign'] ? $data['factory_death_manager_details']['form_attested_by_dol_sign'] : '--'}}
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label @if( !$data['factory_death_manager_details']['form_attested_by_dol_stamp']) class="text-danger" @endif><strong>Stamp:</strong></label>
                                <label>
                                    {{$data && $data['factory_death_manager_details']['form_attested_by_dol_stamp'] ? $data['factory_death_manager_details']['form_attested_by_dol_stamp'] : '--'}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>