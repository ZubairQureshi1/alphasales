<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade calculate_attendance" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title">Calculate <strong>Employee Attendance</strong></h5>
        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
      </div>
      <div class="modal-body">
        <form action="{{ route('attendance.calculateAttendance') }}" method="POST">
          @csrf
          <div class="form-row">
            <div class="form-group col-6">
              <label for="start_date">Start Date</label>
              <input class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" type="date" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required />
              @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group col-6">
              <label for="end_date">End Date</label>
              <input class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" type="date" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required />
              @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group col-12">
              <label>Users</label>
              {!! Form::select('users[]', $users, null, ['id' => 'users', 'class' => 'form-control select2 select2-multiple', 'multiple', 'data-placeholder' => '--- Select User ---']) !!}
              @error('users') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="custom-control custom-checkbox ml-1">
              <input type="checkbox" class="custom-control-input" id="usersCheck" name="is_all_selected" onchange="usersCheckForLogs()">
              <label class="custom-control-label" for="usersCheck">Select All Users</label>
            </div>

            <div class="col-12 mt-3">
              <button class="btn btn-light active" data-dismiss="modal" type="button">Cancel</button>
              <button class="btn btn-success" type="submit">Calculate Attendance</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>