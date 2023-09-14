<div class="tabcontent" id="attendance_fine" role="tabpanel" style="display:none">
    <div class="row div-border padding-top-10 padding-bottom-10" style="margin-left: 1px;margin-right: 1px">
    	<div class="col-md-4">
    		<label>From:</label>
	        <input class="form-control" id="from_date" name="from_date" type="date"/>
    	</div>
    	<div class="col-md-4">
    		<label>To:</label>
	        <input class="form-control" id="to_date" name="to_date" type="date"/>
    	</div>
    	<div class="col-md-4">
    		<label>Actions:</label><br>
            <input name="academic_history_id" id="academic_history_id" type="hidden" value="{{$academic_history_id}}">
	        <button class="btn btn-success" onclick="attendanceFine({{$student['id']}})" type="button">
	            Calculate
	        </button>
	        <button class="btn btn-secondary" type="reset">
	            Reset
	        </button>
    	</div>
    </div>

    <div id="accordion" role="tablist">
        @if($attendance_fines!=null && !empty($attendance_fines) && count($attendance_fines)!=0)
            @foreach($attendance_fines as $key => $fines)
                <div class="custom-accordion margin-top-5" id="headingroles" role="tab">
                    <h5 class="mb-0">
                        <a aria-controls="{{$key}}" aria-expanded="true" data-toggle="collapse" href="#attendance_fine_{{$key}}">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 class="m-0">Month of - {{$fines['month_of']}}</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6 class="m-0">Fine Charged <i>(In Times)</i> - {{ count($fines['fine_nodes']) }}</h6>
                                </div>
                            </div>
                        </a>
                    </h5>
                </div>
                <div aria-labelledby="headingroles" class="collapse panel div-border" data-parent="#accordion" id="attendance_fine_{{$key}}" role="tabpanel">
                    @foreach($fines['fine_nodes'] as $fine_index => $node)
                        <div class="row m-b-5">
                            <div class="col-2 form-group">
                                <label>
                                    Amount:
                                </label>
                                <label>
                                    {{$node->amount==null?'---':$node->amount}}
                                </label>
                            </div>
                            <div class="col-2 form-group">
                                <label>
                                    Amount Waived:
                                </label>
                                <label>
                                    {{$node->amount_waived==null?'---':$node->amount_waived}}
                                </label>
                            </div>
                            <div class="col-2 form-group">
                                <label>
                                    Amount After Waived:
                                </label>
                                <label>
                                    {{$node->amount_after_waived==null?'---':$node->amount_after_waived}}
                                </label>
                            </div>
                            <div class="col-2 form-group">
                                <label>
                                    Paid Amount:
                                </label>
                                <label>
                                    {{$node->paid_amount==null?'---':$node->paid_amount}}
                                </label>
                            </div>
                            <div class="col-2 form-group">
                                <label>
                                    Paid Date:
                                </label>
                                <label>
                                    {{$node->paid_date==null?'---':$node->paid_date}}
                                </label>
                            </div>
                            <div class="col-2 form-group">
                                <label>
                                    Voucher Code:
                                </label>
                                <label>
                                    {{$node->voucher_number==null?'---':$node->voucher_number}}
                                </label>
                            </div>
                            <div class="col-2 form-group">
                                <label>
                                    Balance:
                                </label>
                                <label>
                                    {{$node->balance==null?'---':$node->balance}}
                                </label>
                            </div>
                            <div class="col-2 form-group">
                                <button class="{{ $node->paid_date==null?'btn btn-success':'btn btn-default' }}" data-target=".attendance_{{$key}}_fine_{{$fine_index+1}}" data-toggle="modal" type="button">Pay Fine</button>
                            </div>
                                            
                            <div class="col-2 form-group">
                                {!! Form::open(['route' => ['accounts.deleteAttendanceFine', $node->id], 'method' => 'delete']) !!}

                                    <button class="btn btn-danger btn-flat btn-sm" type="submit">
                                        Delete Fine
                                    </button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @include('accounts.attendance_fine_model')
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
</div>
