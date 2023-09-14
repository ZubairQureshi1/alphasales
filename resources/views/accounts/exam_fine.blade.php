<div class="tabcontent" id="exam_fine" role="tabpanel" style="display:none">
    <div class="row div-border padding-top-10 padding-bottom-10 margin-bottom-5">
        {{--
        <div class="col-md-4">
            <label>
                Sessions:
            </label>
            {!! Form::select('session_id', App\Models\Session::pluck('session_name', 'id'), null, ['id' => 'session_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Gender ---']) !!}
            <span id="session_message" style="color: red;">
            </span>
        </div>
        --}}
        <div class="col-md-3">
            <label>
                Exam Types:
            </label>
            {!! Form::select('exam_type_id', App\Models\ExamType::pluck('exam_type', 'id'), null, ['id' => 'exam_type_id', 'onchange' => "getDateSheets($student->session_id, $student->course_id, $student->section_id)", 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Type ---']) !!}
            <span id="exam_type_message" style="color: red;">
            </span>
        </div>
        <div class="col-md-4" hidden="" id="date_sheet_div_exam">
            <label>
                Date-Sheets:
            </label>
            {!! Form::select('date_sheet_id', [], null, ['id' => 'date_sheet_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Date Sheet ---']) !!}
        </div>
        <div class="col-md-12 text-center m-t-5" hidden="" id="calculate_div">
            <input name="academic_history_id" id="academic_history_id" type="hidden" value="{{$academic_history_id}}">
            <button class="btn btn-success" onclick="calculateExamFine({{$student['id']}})" type="button">
                <i class="mdi mdi-filter">
                </i>
                Calculate
            </button>
            <button class="btn btn-secondary" type="reset">
                <i class="mdi mdi-recycle">
                </i>
                Reset
            </button>
        </div>
    </div>
    @foreach($exam_fines as $fine_index => $fine)
        <div class="row div-border-black m-b-5">
            <div class="col-2 form-group">
                <label>
                    Fine For:
                </label>
                <label>
                    {{$fine->exam_type_name==null?'---':$fine->exam_type_name}}
                </label>
            </div>
            <div class="col-2 form-group">
                <label>
                    Amount:
                </label>
                <label>
                    {{$fine->amount==null?'---':$fine->amount}}
                </label>
            </div>
            <div class="col-2 form-group">
                <label>
                    Amount Waived:
                </label>
                <label>
                    {{$fine->amount_waived==null?'---':$fine->amount_waived}}
                </label>
            </div>
            <div class="col-2 form-group">
                <label>
                    Amount After Waived:
                </label>
                <label>
                    {{$fine->amount_after_waived==null?'---':$fine->amount_after_waived}}
                </label>
            </div>
            <div class="col-2 form-group">
                <label>
                    Paid Amount:
                </label>
                <label>
                    {{$fine->paid_amount==null?'---':$fine->paid_amount}}
                </label>
            </div>
            <div class="col-2 form-group">
                <label>
                    Paid Date:
                </label>
                <label>
                    {{$fine->paid_date==null?'---':$fine->paid_date}}
                </label>
            </div>
            <div class="col-2 form-group">
                <label>
                    Fine Voucher Code:
                </label>
                <label>
                    {{$fine->voucher_number==null?'---':$fine->voucher_number}}
                </label>
            </div>
            <div class="col-2 form-group">
                <label>
                    Balance:
                </label>
                <label>
                    {{$fine->balance==null?'---':$fine->balance}}
                </label>
            </div>
            <div class="col-2 form-group">
                @if($fine->paid_date==null)
                    <button class="btn btn-success btn-flat btn-sm" data-target=".exam_fine_{{$fine_index+1}}" data-toggle="modal" type="button">
                        Pay Fine
                    </button>
                @endif
            </div>
            <div class="col-2 form-group">
                {!! Form::open(['route' => ['accounts.deleteExamFine', $fine->id], 'method' => 'delete']) !!}

                    <button class="btn btn-danger btn-flat btn-sm" type="submit">
                        Delete Fine
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
        @include('accounts.exam_fine_model')
    @endforeach

    <div  class="row">
        <div class="col-md-6">
            <div>
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="div-border margin-top-5 padding-top-5">
                {!! Form::open(['route' => 'accounts.payExamFine' ]) !!}
                    
                    {!! Form::text('overall_paid', true, ['class' => 'form-control', 'hidden'=>'hidden']) !!}
                    {!! Form::text('student_id', $student->id, ['class' => 'form-control', 'hidden'=>'hidden']) !!}
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        {!! Form::label('total_fine', 'Total Fine Payable:') !!}
                        {!! Form::text('total_fine', $exam_fines->where('paid_date', '=', null)->sum('amount'), ['class' => 'form-control', 'disabled'=>'disabled']) !!}
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
