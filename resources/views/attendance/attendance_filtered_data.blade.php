<div class="row">
  <div class="col-lg-12">
    <div class="card shadow">
      <div class="card-header clearfix card-custom-header">
        <div class="float-left">
          <h5 class="card-title">Attendance Data</h5>
        </div>
      {{--   <div class="float-right">
          <button onclick="printAttendanceDocument()" class="btn btn-dark btn-sm mb-2">
            <i class="fa fa-print fa-fw"></i> | Print PDF
          </button>
        </div> --}}
      </div>
      <div class="card-body">
       <div class="table-responsive">
         <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>Sr.</th>
              <th>Registration</th>
              <th>Name</th>
              <th>Status Type</th>
            </tr>
          </thead>
          <tbody>
            <input type="hidden" id="students_count" value="{{ count($students) }}">
            @foreach($students as $key => $student)
              <tr>
                <th scope="row">{{ ++$key }}</th>
                <td>{{$student->roll_no ?? null}}</td>
                <td>
                  <input type="hidden" name="student_id" id="student_id_{{$key}}" value="{{ $student->id }}"> 
                  {{$student->student_name ?? null}}
                </td>
                <td>
                  <input type="hidden" name="status">
                  {!! Form::select('attendance_status_id', config('constants.attendance_statuses') , 1, ['id' => 'attendance_status_id_'.$key, 'class' => 'form-control', null]) !!}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-12 text-right mt-3">
      <button class="btn btn-primary" onclick="storeAttendanceData()">Save Attendance</button>
  </div>
</div>