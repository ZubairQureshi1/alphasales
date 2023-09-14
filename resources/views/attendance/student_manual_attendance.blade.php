{{-- <div aria-hidden="true" aria-labelledby="mySmallModalLabel" id="{{ $attendance['id']}}" class="modal fade student_manual_attendance" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Update
                    <strong>
                        Attendance
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('attendance.manualAttendance', $attendance->id) }}" class="" method="POST">
                    @csrf
                    <div class="form-group">
                        <div>
                          <label>
                              Checkin Time
                          </label>
                          <input class="form-control" data-parsley-type="check_in_time" id="check_in_time" name="check_in_time" placeholder="Select Checkin" required="" type="datetime-local"/>
                          <label>
                              Checkout Time
                          </label>
                          <input class="form-control" data-parsley-type="check_out_time" id="check_out_time" name="check_out_time" placeholder="Select Checkout" required="" type="datetime-local"/>
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
</div> --}}