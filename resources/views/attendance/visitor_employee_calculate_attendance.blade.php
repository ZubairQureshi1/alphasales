<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade calculate_attendance" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Calculate
                    <strong>
                        Attendance
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('attendance.calculateVisitorAttendance') }}" class="" method="POST">
                    @csrf
                    <div class="form-group">
                        <div>
                          <label>
                              Start Date
                          </label>
                          <input class="form-control" data-parsley-type="start_date" id="start_date" name="start_date" placeholder="Enter Start Date" required="" type="date"/>
                          <label>
                              End Date
                          </label>
                          <input class="form-control" data-parsley-type="end_date" id="end_date" name="end_date" placeholder="Enter End Date" required="" type="date"/>
                          <input type="checkbox" name="is_all_selected" value="false"> Select All<br>
                          <label>
                              Users 
                          </label>
                          {!! Form::select('users[]', $users, null, ['id' => 'users', 'class' => 'form-control select2 select2-multiple', 'multiple', 'data-placeholder' => '--- Select User ---']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">
                            Save
                        </button>
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>