{{-- Followup INFORMATION --}}
<div class="card shadow mt-4">
    <div class="card-header card-custom-header p-0">
        <div class="card-header card-custom-header clearfix">
            <div class="float-left">
                <h5 class="card-title mb-1 font-weight-bold">Enquiry Followup</h5>
                <span class="text-muted"><i class="fa fa-clock-o"></i> Last Followup:
                    {{ $enquiry->enquiryFollowups()->count() > 0? $enquiry->enquiryFollowups()->get()->last()->created_at->diffForHumans(): '----' }}</span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            {{-- ENQUIRY Followup Table --}}
            @can(['view_followups', 'update_followups'])
                @if (count($enquiry->enquiryFollowups) > 0)
                    <div class="col-12">
                        <span class="text-danger"><b>Note: </b><u>Last followup will be shown at top in below
                                history</u></span>
                        <table cellspacing="0" class="table table-striped table-bordered table-hover" isdefault="true"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Called By</th>
                                    <th>Call Status</th>
                                    <th>Answered By</th>
                                    <th>Revised Enquiry Status</th>
                                    <th>Revised Enquiry Ranking</th>
                                    <th>Followup Date</th>
                                    <th>Remarks</th>
                                    <th class="text-center" style="width: 5%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enquiry->enquiryFollowups()->latest()->get()
        as $key => $followup)
                                    <tr class="{{ $followup->status_id == 2 ? 'table-danger' : '' }}">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $followup->called_by ?? '---' }}</td>
                                        <td>{{ $followup->call_status_name ?? '---' }}</td>
                                        <td>{{ $followup->answered_by ?? '---' }}</td>
                                        <td>{{ $followup->status ?? '---' }}</td>
                                        <td>{{ $followup->interest_level ?? '---' }}</td>
                                        <td>{{ $followup->next_date ?? '---' }}</td>
                                        <td>{{ $followup->remarks ?? '---' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('followups.deleteEnquiryFollowUp', $followup->id) }}"
                                                class="btn btn-danger btn-sm" title="Delete"><i class="mdi mdi-delete"></i>
                                                | Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endcan
            {{-- ENQUIRY Followup Form --}}
            @can(['create_followups', 'update_followups'])
                @if ($enquiry->enquiryFollowups()->count() > 0
    ? $enquiry->enquiryFollowups()->get()->last()->status_id != 2
    : true)
                    <div class="col-12 mt-2">
                        <form action="{{ route('followups.store') }}" method="post">
                            @csrf
                            <div class="div-border-rad padding-10">
                                <input hidden="true" id="enquiry_id" name="enquiry_id" value="{{ $enquiry->id }}" />
                                <input hidden="true" id="followup_type_id" name="followup_type_id" value="0" />
                                <div class="form-row">
                                    <input hidden="hidden" type="text" id="followup_id" name="followup_id" />
                                    <div class="col-md-4 form-group">
                                        <label>Called By: </label>
                                        <input class="form-control" name="called_by" placeholder="Enter Called By"
                                            required="" type="input" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        {!! Form::label('status', 'Call Status:') !!}
                                        {!! Form::select('call_status', config('constants.call_statuses'), null, ['id' => 'call_status_id', 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Status', 'onchange' => 'onCallStatusSelect()', 'required']) !!}
                                    </div>
                                    <div class="col-md-4 form-group">
                                        {!! Form::label('status', 'Status:') !!}
                                        {!! Form::select('status', [], null, ['id' => 'followup_statuses', 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Status', 'onchange' => 'onFollowupStatusSelect()', 'required']) !!}
                                    </div>
                                    <div class="col-md-4 form-group" id="answered_by_div">
                                        <label>Answered By: </label>
                                        <input class="form-control" name="answered_by" id="answered_by"
                                            placeholder="Enter Answered By" required="" type="input" />
                                    </div>
                                    <div class="col-md-4 form-group" id="attendant_relationship_div">
                                        <label>Attendant Relationship (With Customer): </label>
                                        <input class="form-control" name="student_relationship_with_attendant"
                                            id="attendant_relationship" placeholder="Enter Attendant Relationship"
                                            required="" type="input" />
                                    </div>
                                    <div class="col-md-4 form-group" id="followup_interested_level_div" hidden="true">
                                        {!! Form::label('ranking', 'Followup Ranking:') !!}
                                        {!! Form::select('interest_level_id', config('constants.follow_up_interested_levels'), null, ['id' => 'interest_level_id', 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Followup Ranking', 'required']) !!}
                                    </div>
                                    <div class="col-md-4 form-group" id="followup_date_div" hidden="true">
                                        <label>Next Follow-Up Date:</label>
                                        <input class="form-control" data-date-format="YYYY-MM-DD" name="next_date"
                                            id="next_date"
                                            min="{{ $enquiry->enquiryFollowups()->first()->next_date ?? Date('Y-m-d') }}"
                                            placeholder="Enter Next Follow-Up Date" required=type="date" type="date" />
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Remarks:</label>
                                        <textarea class="form-control letter_capitalize" name="remarks" id="remarks"
                                            required="" rows="2"></textarea>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <button class="btn btn-dark btn-sm" type="submit"><i class="fa fa-plus fa-fw"></i> |
                                            Add To Follow-ups</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            @endcan
        </div>
    </div>
</div>
