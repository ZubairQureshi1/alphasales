<div class="tabcontent" id="fee_fine" role="tabpanel" style="display:none">
    <div id="accordion" role="tablist">
        @if($fee_instalments!=null && !empty($fee_instalments) && count($fee_instalments)!=0)
            <div class="row margin-top-5 margin-bottom-5">
                <div class="col-md-12">
                        {!! Form::open(['route' => ['accounts.generateFine', ''] ]) !!}
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-3">
                                    {{ Form::select('installment_id', $fee_instalments->where('status_id', '=', '0')->pluck('due_date', 'id'), null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group col-md-3">
                                    {{ Form::date('fine_date', null, ['class' => 'form-control',  'data-date-format' => 'YYYY-MM-DD']) }}
                                </div>
                                <div class="form-group col-md-3">
                                    <button class="btn btn-default btn-sm" type="submit">Generate Fine</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                </div>
            </div>
            @foreach($fee_instalments as $index => $instalment)
                <div class="custom-accordion" id="headingroles" role="tab">
                    <h5 class="mb-0">
                        <a aria-controls="{{$instalment->id}}" aria-expanded="true" data-toggle="collapse" href="#instalment_fine_{{$instalment->id}}">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 class="m-0">Instalment No - {{$index+1}}</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6 class="m-0">Installment Amount (Rs) - {{ number_format($instalment->amount_per_installment) }}</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6 class="m-0">Installment Due Date - {{ ($instalment->due_date) }}</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6 class="m-0">Total Fine (Rs) - {{ number_format($instalment->late_fee_fine + $instalment->remaining_balance_late_fine) }}</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6 class="m-0">Divide's In - {{ count($instalment->feeFines) }} Parts</h6>
                                </div>
                            </div>
                        </a>
                    </h5>
                </div>
                <div aria-labelledby="headingroles" class="collapse panel" data-parent="#accordion" id="instalment_fine_{{$instalment->id}}" role="tabpanel">
                    @foreach($instalment->feeFines as $fine_index => $fee_fine)
                        <div class="row div-border-black m-b-5">
                            <div class="col-md-2 form-group">
                                <label>
                                    Amount:
                                </label>
                                <label>
                                    {{$fee_fine->amount==null?'---':number_format($fee_fine->amount)}}
                                </label>
                            </div>
                            <div class="col-md-2 form-group">
                                <label>
                                    Amount Waived:
                                </label>
                                <label>
                                    {{$fee_fine->amount_waived==null?'---':number_format($fee_fine->amount_waived)}}
                                </label>
                            </div>
                            <div class="col-md-2 form-group">
                                <label>
                                    Amount After Waived:
                                </label>
                                <label>
                                    {{$fee_fine->amount_after_waived==null?'---':number_format($fee_fine->amount_after_waived)}}
                                </label>
                            </div>
                            <div class="col-md-2 form-group">
                                <label>
                                    Paid Amount:
                                </label>
                                <label>
                                    {{$fee_fine->paid_amount==null?'---':number_format($fee_fine->paid_amount)}}
                                </label>
                            </div>
                            <div class="col-md-2 form-group">
                                <label>
                                    Paid Date:
                                </label>
                                <label>
                                    {{$fee_fine->paid_date==null?'---':date('d-M-Y', strtotime($fee_fine->paid_date)) }}
                                </label>
                            </div>
                            <div class="col-md-2 form-group">
                                <label>
                                    Fine Voucher Code:
                                </label>
                                <label>
                                    {{$fee_fine->voucher_number==null?'---':$fee_fine->voucher_number}}
                                </label>
                            </div>
                            <div class="col-md-2 form-group">
                                <label>
                                    Balance:
                                </label>
                                <label>
                                    {{$fee_fine->balance==null?'---':number_format($fee_fine->balance)}}
                                </label>
                            </div>
                            <div class="col-md-2 form-group">
                                @if ($fee_fine->paid_date == null)
                                    <button class="btn btn-success btn-sm" data-target=".installment_{{$index+1}}_fine_{{$fine_index+1}}" data-toggle="modal" type="button">Pay Fine</button>
                                @endif
                            </div>
                        </div>
                    @include('accounts.installment_fine_model')
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
    <div class="row">
        <div class="col-md-6">
            <div>
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="div-border margin-top-5 padding-top-5">
                {!! Form::open(['route' => ['accounts.pay_fine', ''] ]) !!}
                    @csrf
                    {!! Form::text('overall_paid', true, ['class' => 'form-control', 'hidden'=>'hidden']) !!}
                    {!! Form::text('package_id', $fee_package->id, ['class' => 'form-control', 'hidden'=>'hidden']) !!}
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        {!! Form::label('total_fine', 'Total Fine Payable:') !!}
                        {!! Form::text('total_fine', $total_fine_on_installment, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        {!! Form::label('voucher_number', 'Voucher Code:') !!}
                        {!! Form::text('voucher_number', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        {!! Form::label('paid_date', 'Paid Date:') !!}
                        {!! Form::date('paid_date', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        {!! Form::label('fine_waived', 'Fine Waived:') !!}
                        {!! Form::text('amount_waived', null, ['class' => 'form-control']) !!}
                        <span style="color: red;">Note: Above entered value will be consider in <b>Percentages</b></span>
                    </div>
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        {!! Form::label('amount_deferred', 'Fine Deferred:') !!}
                        {!! Form::text('amount_deferred', null, ['class' => 'form-control']) !!}
                        <span style="color: red;">Note: Above entered value will be consider in <b>Percentages</b></span>
                    </div>
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        {!! Form::submit('Pay Overall', ['class' => 'btn btn-success']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
