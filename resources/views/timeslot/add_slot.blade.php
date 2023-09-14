<div class="modal fade add_slot" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-large modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Create <strong>Time Slot</strong></h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('timeslots.store') }}" class="" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="row nth-bg align-center m-b-10 padding-10">
                            <div class="col-md-3">Name</div>
                            <div class="col-md-9">
                                <input class="form-control" data-parsley-type="name" id="name" name="name" placeholder="Enter Name" required="true" type="text"/>
                            </div>
                        </div>
                        <div class="row nth-bg align-center m-b-10 padding-10">
                            <div class="col-md-3">Start Time</div>
                            <div class="col-md-9">
                                <input class="form-control" type="time" name="start_time" data-parsley-type="start_time"  required="true" value="hh:mm:ss" id="start_time">
                            </div>
                        </div>
                        <div class="row nth-bg align-center m-b-10 padding-10">
                            <div class="col-md-3">End Time</div>
                            <div class="col-md-9">
                                <input class="form-control" type="time" name="end_time" data-parsley-type="end_time"  required="true" value="hh:mm:ss" id="end_time">
                            </div>
                        </div>
                        <div class="row nth-bg align-center m-b-10 padding-10">
                            <div class="col-md-3">Buffer Start</div>
                            <div class="col-md-9">
                                <input class="form-control" type="time" name="buffer_start_time" data-parsley-type="buffer_start_time"  required="true" value="hh:mm:ss" id="buffer_start_time">
                            </div>
                        </div> 
                        <div class="row nth-bg align-center m-b-10 padding-10">
                            <div class="col-md-3">Buffer End</div>
                            <div class="col-md-9">
                                <input class="form-control" type="time" name="buffer_end_time" data-parsley-type="buffer_end_time"  required="true" value="hh:mm:ss" id="buffer_end_time">
                            </div>
                        </div>
                        <div class="row nth-bg align-center m-b-10 padding-10">
                            <div class="col-md-3">Slot Type</div>
                            <div class="col-md-9">
                                {!! Form::select('slot_type_id', config('constants.time_slot_types'), null, ['id' => 'slot_type_id', 'class' => 'form-control', 'placeholder' => '--- Select Type ---', 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-3 text-right">
                        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-cloud-upload fa-fw"></i> | Create Time Slot</button>
                        <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Cancel</button> 
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
