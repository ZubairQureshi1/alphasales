<div aria-hidden="true" aria-labelledby="mySmallModalLabel" id="{{$headstudent['id']}}" class="modal fade create_head_edit_model"  role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                   Edit
                    <strong>
                        Heads
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('accounts.edit_headFine')}}" class="" method="POST">
                    @csrf
                    <div class="form-group">
<div class="form-group">

        <label>
            Enter Due Date
        </label>
        <input type="date" name="due_date" id="due_date" value="{{$headstudent['due_date']}}" data-date-format="YYYY-MM-DD" />


    </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary"  type="submit">
                            Save
                        </button>
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                            Close
                        </button>
                    </div>



                    <input type="text" hidden name="id" value="{{$headstudent['id']}}">
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
