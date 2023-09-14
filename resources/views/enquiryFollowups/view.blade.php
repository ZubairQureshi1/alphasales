@include('includes/header_start')

@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">Follow Up</h3>
    </li>
</ul>
<div class="clearfix"></div>
</nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->

<div class="page-content-wrapper" id="followups">
    <div class="container-fluid">
        <div class="row m-b-10 m-t-20-negative p-20">
            <div class="col-5"></div>
            <div class="col-5"></div>
            <div class="col-2">
                {{-- <a href="{{ route('followups.exportExcel') }}" class="btn btn-info btn-xs waves-effect pull-right">
                 <i class="mdi mdi-file-excel"></i> Export To Excel
            </a> --}}
            </div>
        </div>
         <div class="row target">
            <!-- <div class="col-md-2">-->
            <!--    <div id="enquiry_hierarchy" class="padding-10 background-white">-->
            <!--        <ul style="list-style-type:none;margin-left: -14%;">-->
            <!--            <li><a class="btn {{ $parent_enquiry->last_followup_id != null ? 'btn-primary' : 'btn-secondary' }} btn-sm"-->
            <!--                    href="{{ $parent_enquiry->last_followup_id != null? url('followups/addFollowUpForm', $parent_enquiry->last_followup_id): '#' }}"><i-->
            <!--                        class="{{ $parent_enquiry->id == $followup->enquiry_id ? 'mdi mdi-chevron-right' : '' }}"></i>-->
            <!--                    {{ $parent_enquiry->name . '( ' . $parent_enquiry->form_code . ' )' }}</a>-->
            <!--                <ul style="list-style-type:none;margin-left: -12%;">-->
            <!--                    @foreach ($parent_enquiry->childs as $child_enquiry)-->
            <!--                        <li class="margin-top-5"><a-->
            <!--                                class="btn {{ $child_enquiry->last_followup_id != null ? 'btn-dark' : 'btn-secondary' }} btn-sm"-->
            <!--                                href="{{ $child_enquiry->last_followup_id != null? url('followups/addFollowUpForm', $child_enquiry->last_followup_id): '#' }}"><i-->
            <!--                                    class="{{ $child_enquiry->id == $followup->enquiry_id ? 'mdi mdi-chevron-right' : '' }}"></i>-->
            <!--                                {{ $child_enquiry->name . '( ' . $child_enquiry->form_code . ' )' }}</a>-->
            <!--                        </li>-->
            <!--                    @endforeach-->
            <!--                </ul>-->
            <!--            </li>-->
            <!--        </ul>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="col-md-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="modal-title mt-0">
                            <strong>
                                Enquiry Details: 
                            </strong>
                            <br>
                            ENQ-{{$followup->id}}
                        </h5>
                        <div class="">
                            <div class="m-t-10 m-b-10 div-border">
                                <div class="margin-10">
                                    <div class="row form-group">

                                        <div class="col-md-4">
                                            <label>Enquiry By: </label>
                                            {{-- <p id="enquiry_by">{{ ucfirst($followup->enquiry_data->enquiry_type) }}
                                            </p> --}}
                                            <p id="enquiry_by">
                                                {{ ucfirst($followup->enquiry_data->user_name) }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Enquiry Entered By: </label>
                                            <p id="enquiry_type">{{ ucfirst($followup->enquiry_data->entry_by_name) }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Enquiry Type: </label>
                                            <p id="enquiry_type">{{ ucfirst($followup->enquiry_data->enquiry_type) }}
                                            </p>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Income Range: </label>
                                            <p id="income_range">
                                                {{ isset(config('constants.income_range')[$followup->enquiry_data->income_range])? config('constants.income_range')[$followup->enquiry_data->income_range]: '---' }}
                                            </p>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Enquiry Date: </label>
                                            <p id="enquiry_date">
                                                {{ ucfirst(date('d-m-Y', strtotime($followup->enquiry_data->enquiry_date))) }}
                                            </p>
                                        </div>


                                        <div class="col-md-4">
                                            <label>Customer's Name: </label>
                                            <p id="student_name">{{ ucfirst($followup->enquiry_data->name) }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>CNIC: </label>
                                            <p id="student_name">
                                                {{ ucfirst($followup->enquiry_data->student_cnic_no) }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>D.O.B: </label>
                                            <p id="student_name">{{ ucfirst($followup->enquiry_data->dob) }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>E-mail Address: </label>
                                            <p id="student_name">{{ ucfirst($followup->enquiry_data->email) }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Father's Name: </label>
                                            <p id="father_name">{{ ucfirst($followup->enquiry_data->father_name) }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Gender: </label>
                                            <p id="gender">
                                                {{$followup->enquiry_data->gender_id}}
                                                <!--{{ !isset($followup->enquiry_data->gender_id)? config('constants.genders')[$followup->enquiry_data->gender_id]: '---' }}-->
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>City: </label>
                                            <p id="city">
                                                {{ $followup->enquiry_data->city != null ? ucfirst($followup->enquiry_data->city) : '---' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Present Address: </label>
                                            <p id="present_address">
                                                {{ $followup->enquiry_data->present_address !== null ? $followup->enquiry_data->present_address : '---' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Permanent Address: </label>
                                            <p id="present_address">
                                                {{ $followup->enquiry_data->present_address !== null ? $followup->enquiry_data->present_address : '---' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Mobile 1: </label>
                                            <p id="phone">
                                                {{ $followup->enquiry_data->phone1 !== null ? $followup->enquiry_data->phone1 : '---' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Mobile 2: </label>
                                            <p id="phone">
                                                {{ $followup->enquiry_data->phone2 !== null ? $followup->enquiry_data->phone2 : '---' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Landline: </label>
                                            <p id="landline">
                                                {{ $followup->enquiry_data->landline !== null ? $followup->enquiry_data->landline : '---' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Project: </label>
                                            <p id="project">
                                                {{ $followup->enquiry_data->project_name !== null ? $followup->enquiry_data->project_name : '---' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Product: </label>
                                            <p id="project">
                                                {{ $followup->enquiry_data->product_name !== null ? $followup->enquiry_data->product_name : '---' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Developer: </label>
                                            <p id="project">
                                                {{ $followup->enquiry_data->developer_name !== null ? $followup->enquiry_data->developer_name : '---' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Price Offered:: </label>
                                            <p id="project">
                                                {{ $followup->enquiry_data->price_offer !== null ? $followup->enquiry_data->price_offer : '---' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Source of Information: </label>
                                            <p id="enquiry_source">
                                                {{-- {{ $followup->enquiry_data->source_info_id }} --}}
                                                {{ $followup->enquiry_data->source_info_id !== null? (isset(config('constants.information_sources')[$followup->enquiry_data->source_info_id])? config('constants.information_sources')[$followup->enquiry_data->source_info_id]: '---'): '---' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Enquiry Status: </label>
                                            <p id="enquiry_source">
                                                {{ $followup->enquiry_data->status !== null ? $followup->enquiry_data->status : '---' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Enquiry Ranking: </label>
                                            <p id="enquiry_ranking">
                                                {{ isset(config('constants.follow_up_interested_levels')[$followup->enquiry_data->follow_up_interested_level_id])? config('constants.follow_up_interested_levels')[$followup->enquiry_data->follow_up_interested_level_id]: '---' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Next Follow-Up Date: </label>
                                            <p id="enquiry_ranking">
                                                {{ ucfirst(date('d-m-Y', strtotime($followup->next_date))) }}
                                            </p>
                                        </div>
                                        {{-- <div class="col-md-4">
                                            <label>Course Name: </label>
                                            <p id="course">{{ ucfirst($followup->enquiry_data->course_name) }}</p>
                                        </div> --}}
                                        <div class="col-md-4" style="display: none;">
                                            <label>Enquiry Category: </label>
                                            <p id=" course">{{ $followup->enquiry_data->student_category_name }}</p>
                                        </div>





                                        {{-- <div class="col-md-4">
                                            <label>Passing Year: </label>
                                            <p id="passing_year">
                                                {{ $followup->enquiry_data->passing_year != null ? ucfirst($followup->enquiry_data->passing_year) : '---' }}
                                            </p>
                                        </div> --}}
                                        {{-- <div class="col-md-4">
                                            <label>Total Marks: </label>
                                            <p id="total_marks">
                                                {{ $followup->enquiry_data->total_marks != null ? ucfirst($followup->enquiry_data->total_marks) : '---' }}
                                            </p>
                                        </div> --}}
                                        {{-- <div class="col-md-4">
                                            <label>Marks Obtained: </label>
                                            <p id="marks_obtained">
                                                {{ $followup->enquiry_data->marks_obtained != null ? ucfirst($followup->enquiry_data->marks_obtained) : '---' }}
                                            </p>
                                        </div> --}}
                                        {{-- <div class="col-md-4">
                                            <label>Marks (%): </label>
                                            <p id="marks_percentage">
                                                {{ $followup->enquiry_data->percentage != null ? ucfirst($followup->enquiry_data->percentage) : '---' }}
                                            </p>
                                        </div> --}}


                                        {{-- <div class="col-md-4">
                                            <label>Area/ Town: </label>
                                            <p id="town">
                                                {{ $followup->enquiry_data->area != null ? ucfirst($followup->enquiry_data->area) : '---' }}
                                            </p>
                                        </div> --}}

                                     



                                        <div class="col-md-12">
                                            <label>Remarks: </label>
                                            <textarea id="enquiry_remarks" class="form-control"
                                                disabled="true">{{ $followup->enquiry_data->remarks != null ? ucfirst($followup->enquiry_data->remarks) : '---' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <div class="col-2">
            </div>
            <div class="col-md-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        @if ($enquiry_followups->first()->status_id != 2)
                            {!! Form::open(['route' => ['followups.store'], 'method' => 'post']) !!}
                            <input hidden="true" id="enquiry_id" name="enquiry_id"
                                value="{{ $followup->enquiry_id }}" placeholder="Enter Name" />
                            <input hidden="true" id="followup_type_id" name="followup_type_id" value="0"
                                placeholder="Enter Name" />
                            <div class="div-border-rad padding-10 mb-3">
                                <div class="row form-group">
                                    <input class="form-control" hidden="hidden" type="text" id="followup_id"
                                        name="followup_id" />
                                    <div class="col-md-4">
                                        <label><span style="color: red;">* </span>Called By: </label>
                                        <div>
                                            <input class="form-control" name="called_by" placeholder="Enter Called By"
                                                required="" type="input" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <span style="color: red;">* </span>{!! Form::label('status', 'Call Status:') !!}
                                        {!! Form::select('call_status', config('constants.call_statuses'), null, ['id' => 'call_status_id', 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Status', 'onchange' => 'onCallStatusSelect()', 'required']) !!}
                                    </div>
                                    <div class="col-md-4">
                                    <span style="color: red;">* </span>{!! Form::label('status', 'Status:') !!}
                                        {!! Form::select('status', [], null, ['id' => 'followup_statuses', 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Status', 'onchange' => 'onFollowupStatusSelect()', 'required']) !!}
                                    </div>
                                    {{-- <div class="col-md-4" id="answered_by_div">
                                        <label>Answered By: </label>
                                        <div>
                                            <input class="form-control" name="answered_by" id="answered_by"
                                                placeholder="Enter Answered By" required="" type="input" />
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-md-4" id="attendant_relationship_div">
                                        <label>Attendant Relationship (With Student): </label>
                                        <div>
                                            <input class="form-control" name="student_relationship_with_attendant"
                                                id="attendant_relationship" placeholder="Enter Attendant Relationship"
                                                required="" type="input" />
                                        </div>
                                    </div> --}}
                                    <div class="col-md-4" id="followup_interested_level_div" hidden="true">
                                    <span style="color: red;">* </span>{!! Form::label('ranking', 'Follow Up Ranking:') !!}
                                        {!! Form::select('interest_level_id', config('constants.follow_up_interested_levels'), null, ['id' => 'interest_level_id', 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Follow Up Ranking', 'required']) !!}
                                    </div>
                                    <div class="col-md-4" id="followup_date_div" hidden="true">
                                        <label>
                                            Next Follow Up Date:
                                        </label>
                                        <div>
                                            <input class="form-control" data-date-format="YYYY-MM-DD" name="next_date"
                                                id="next_date" min="{{ $enquiry_followups->first()->next_date }}"
                                                placeholder="Enter Next Follow-Up Date" required="" type="date" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>
                                            Revised Price Offered:
                                        </label>
                                        <div>
                                            <input class="form-control" name="revised_price" id="revised_price"
                                                placeholder="Enter Revised Price Offered" required="" type="number" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>
                                            Remarks:
                                        </label>
                                        <div>
                                            <textarea class="form-control letter_capitalize" name="remarks" id="remarks" required="" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        @endif
                        <span class="text-danger"><b>Note: </b><u>Last followup will be shown at top in below
                                history</u></span>
                        <table cellspacing="0" class="table table-striped table-bordered" isdefault="true" width="100%">
                            <thead>
                                <tr>
                                    <th>
                                        Follow Up No.
                                    </th>
                                    <th>
                                        Called By
                                    </th>
                                    <th>
                                        Call Status
                                    </th>
                                    {{-- <th>
                                        Answered By
                                    </th> --}}
                                    <th>
                                        Revised Enquiry Status
                                    </th>
                                    <th>
                                        Revised Enquiry Ranking
                                    </th>
                                    <th>
                                        Next Follow-up Required
                                    </th>
                                    <th>
                                        Remarks
                                    </th>
                                    <th>
                                        Revised Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enquiry_followups as $key => $followup)
                                    <tr
                                        style="{{ $followup->status_id == 2 ? 'background-color: red;color: white;' : '' }}">
                                        <td>
                                            {{ count($enquiry_followups) - $key }}
                                        </td>
                                        <td>
                                            {{ $followup->called_by != null ? $followup->called_by : '---' }}
                                        </td>
                                        <td>
                                            {{ $followup->call_status_name != null ? $followup->call_status_name : '---' }}
                                        </td>
                                        {{-- <td>
                                            {{ $followup->answered_by != null ? $followup->answered_by : '---' }}
                                        </td> --}}
                                        <td>
                                            {{ $followup->status != null ? $followup->status : '---' }}
                                        </td>
                                        <td>
                                            {{ $followup->interest_level != null ? $followup->interest_level : '---' }}
                                        </td>
                                        <td>
                                            {{ $followup->next_date != null ? date('d-m-Y', strtotime($followup->next_date)) : '---' }}
                                        </td>
                                        <td>
                                            {{ $followup->remarks != null ? $followup->remarks : '---' }}
                                        </td>
                                        <td>
                                            {{ $followup->revised_price != null ? $followup->revised_price : '---' }}
                                        </td>
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('includes/footer_start')



<!-- Datatable init js -->
<script src="{{ asset('js/jstree.js') }}"></script>
<script type="text/javascript">
    var template = '{{ json_encode(config('constants')) }}';
    var constants = JSON.parse(template.replace(/&quot;/g, '"'));

    // $('#enquiry_hierarchy').jstree();
</script>
<script src="{{ asset('js/followup/followup.js') }}"></script>
@include('includes/footer_end')
