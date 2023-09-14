<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade create_installment_model" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Make
                    <strong>
                        Installments
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('accounts.installment') }}" class="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>
                            Net total :
                        </label>
                        <input  class="form-control p-1 mb-2 bg-light text-dark " id="net_total" name="net_total" readonly="" type="text" value="{{$fee_package['net_total']}}">
                            <label>
                                Course Duration (yrs):
                            </label>
                            <input "="" class="form-control p-1 mb-2 bg-light text-dark " id="course_duration" name="course_duration" readonly="" type="text" value="{{$course['duration']}}">
                                <label>
                                    No of semesters/yrs :
                                </label>
                                <input "="" class="form-control p-1 mb-2 bg-light text-dark " id="no_of_semesters" name="no_of_semesters" readonly="" type="text" value="{{$course['no_of_semesters']}}">
                                    <label>
                                        Duration per Semester :
                                    </label>
                                    <input "="" class="form-control p-1 mb-2 bg-light text-dark " id="duration_per_semester" name="duration_per_semester" readonly="" type="text" value="{{$course['duration_per_semester']}}">
                                        <label>
                                            Student will pay fee after __ month(s)
                                        </label>
                                        <input class="form-control" data-parsley-type="installment_interval" id="installment_interval" name="installment_interval" placeholder="no. of month(s)" required="" type="number"/>
                                        <label>
                                            Due Date
                                        </label>
                                        <input class="form-control" data-mask="99-99-9999" data-parsley-type="due_date" id="due_date" name="due_date" required="" type="text"/>
                                        <label>
                                            No Of Installments :
                                        </label>
                                        <input "="" class="form-control p-1 mb-2 bg-light text-dark " id="no_of_installments" name="no_of_installments" readonly="" type="text">
                                            <label>
                                                Amount per Installment :
                                            </label>
                                            <input "="" class="form-control p-1 mb-2 bg-light text-dark " id="amount_per_installment" name="amount_per_installment" readonly="" type="text">
                                                <input name="package_id" type="hidden" value="{{$fee_package['id']}}">
                                                    <input name="status_id" type="hidden" value="0">
                                                        <input name="status_name" type="hidden" value="{{config('constants.voucher_status')[0]}}">
                                                        </input>
                                                    </input>
                                                </input>
                                            </input>
                                        </input>
                                    </input>
                                </input>
                            </input>
                        </input>
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
