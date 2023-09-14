<form id="semester_update" class="" method="POST" action="{{ route('semester.update', $semester['id']) }}">
    @csrf
    <input type="hidden" id="id" name="id" value="{{$semester['id']}}">
    <div class="row">
        <div class="form-group col-sm-3">
            {!! Form::label('course', 'Course:') !!}
            @if(count($courses)!=0)
            {!! Form::select('course_id', $courses, $semester->course_id, ['id' => 'course_id', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select Course ------']) !!}
            @else
            @include('includes/not_found')
            @endif
        </div>
        <div class="form-group col-sm-3">
            {!! Form::label('session', 'Session:') !!}
            {!! Form::select('session_id', $sessions, $semester->session_id, ['id' => 'session_id', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select Session ------']) !!}
        </div>  
        <div class="form-group col-sm-3">
            {!! Form::label('semester','Semester') !!}
            {!! Form::text('semester',$semester->semester,['id' => 'semester','class' => 'form-control', 'placeholder' => 'Enter Semester no'])!!}
        </div>
        <div class="form-group col-sm-3">
            <label>Minumum Discount</label>
            <input type="number" id="min_discount" class="form-control text-right" required="" min="0" max="100" name="min_discount" value="{{$semester['min_discount']}}">
            <span style="color: red;">Note: Above entered value will be consider in <b>Percentages</b></span>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-3">
            <label>Maximum Disc </label>
            <input type="number" id="max_discount" class="form-control text-right" required="" min="0" max="100" name="max_discount" value="{{$semester['max_discount']}}"><span style="color: red;">Note: Above entered value will be consider in <b>Percentages</b></span>
        </div>

        <div class="form-group col-sm-3">
            <label>Minumum Installments</label>
            <input type="number" id="min_installments" value="{{$semester['min_installments']}}" class="form-control text-right" required="" min="0" max="12" name="min_installments">
        </div>
        <div class="form-group col-sm-3">
            <label>Maximum Installments</label>
            <input type="number" id="max_installments" value="{{$semester['max_installments']}}" class="form-control text-right" required="" min="0" max="12" name="max_installments">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="save" class="btn btn-primary">Save</button>
        <button type="cancel" class="btn btn-secondary">Close</button>
    </div>
</form>
