<div class="tabcontent" id="miscellaneous" role="tabpanel" style="display:none">
                                <form action="{{ route('accounts.addFines') }}" class="" method="POST">
                                    <label>
                                        Charges Reason :
                                    </label>
                                    <input class="form-control p-1 mb-2 bg-light text-dark fee" id="name" name="name" type="text">
                                        <label>
                                            Charges Amount:
                                        </label>
                                        <input class="form-control p-1 mb-2 bg-light text-dark fee" id="amount" name="amount" type="number">
                                            <label>
                                                Due Date
                                            </label>
                                            <input class="form-control" data-mask="99-99-9999" data-parsley-type="due_date" id="due_date" name="due_date" required="" type="text"/>
                                            <input name="student_id" type="hidden" value="{{$student['id']}}">
                                                <input name="course_id" type="hidden" value="{{$student['course_id']}}">
                                                    <input name="status_id" type="hidden" value="0">
                                                        <input name="status_name" type="hidden" value="{{config('constants.payment_statuses')[0]}}">
                                                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                                                <br>
                                                                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                                                </br>
                                                            </input>
                                                        </input>
                                                    </input>
                                                </input>
                                            </input>
                                        </input>
                                    </input>
                                </form>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card m-b-30">
                                            <div class="card-body">
                                                <label>
                                                    <strong>
                                                        Summary
                                                    </strong>
                                                </label>
                                                @if(count($fines)!=0)
                                                <table cellspacing="0" class="table table-striped table-bordered" id="datatable-buttons" isdefault="true" width="100%">
                                                    <thead>
                                                        <tr>
                                                            @foreach ($fine_keys as $key)

                                        @if($key != "replaced_name" && $key != "created_at" && $key != "updated_at" && $key != "deleted_at" && $key != "course_id" && $key != "student_id" )
                                                            <th>
                                                                {{ $key }}
                                                            </th>
                                                            @endif
                                        @endforeach
                                                            <th>
                                                                Actions
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($fines as $fine)
                                                        <tr>
                                                            @foreach ($fine_keys as $index => $key)

                                       @if($key != "replaced_name" && $key != "created_at" && $key != "updated_at" && $key != "deleted_at" && $key != "course_id" && $key != "student_id" )
                                                            <td>
                                                                {{ $fine[$key] }}
                                                            </td>
                                                            @elseif ($key == "id")
                                                            <td>
                                                                {{ $index+1 }}
                                                            </td>
                                                            @endif

                                        @endforeach
                                                            <td>
                                                                <div aria-label="Toolbar with button groups" class="btn-toolbar" role="toolbar">
                                                                    <div aria-label="First group" class="btn-group mr-2" role="group">
                                                                        {{-- For Editing a specific object/row --}}
                                                                        <form action="{{route('accounts.invoiceFine')}}" method="POST">
                                                                            <input name="id" type="hidden" value="{{$fine['id']}}">
                                                                                <input name="status_id" type="hidden" value="0">
                                                                                    <input name="status_name" type="hidden" value="{{config('constants.voucher_statuses')[0]}}">
                                                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                                                                            <button class="btn btn-success" type="submit">
                                                                                                <i class="fa fa-print">
                                                                                                </i>
                                                                                            </button>
                                                                                            <!-- {!! Form::submit('', ['class' => 'btn btn-primary fa fa-print']) !!} -->
                                                                                        </input>
                                                                                    </input>
                                                                                </input>
                                                                            </input>
                                                                        </form>
                                                                        <!-- <form action="{{route('accounts.fine_paid')}}" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="status_id" value="1">
                                                                            <input <input="" name="status_name" type="hidden" value="{{config('voucher_statuses')[1]}}">
                                                                                <input name="id" type="hidden" value="{{$fine['id']}}">
                                                                                    {!! Form::submit('Paid', ['class' => 'btn btn-primary pull-right' , 'id'=>'a{{$index+1}}']) !!}
                                                                                </input>
                                                                            </input>
                                                                        </form> -->



                                                                         <button class="btn btn-primary waves-effect waves-light pull-right" data-target=".create_paymentF_model" data-toggle="modal"  type="button">
                                                                                          Paid
                                                                    </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @else
                        No Courses found
                        @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

  @if(count($fines)!=0)
<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade create_paymentF_model" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Make
                    <strong>
                      Payment
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('accounts.fine_paid')}}" class="" method="POST">
                    @csrf
                    <div class="form-group">




                                        <label>
                                            Payment Date
                                        </label>
                                        <input class="form-control" data-mask="99-99-9999" data-parsley-type="paid_date" id="paid_date" name="paid_date" required="" type="text"/>
                                        <label>
                                            Voucher Code :
                                        </label>
                                        <input  class="form-control p-1 mb-2 bg-light text-dark " id="voucher_code" name="voucher_code"  type="text">
                                           <!--  <label>
                                                Amount per Installment :
                                            </label>
                                            <input  class="form-control p-1 mb-2 bg-light text-dark " id="amount_per_installment" name="amount_per_installment"  type="text"> -->
                                                <input name="status_id" type="hidden" value="1">
                                        <input name="status_name" type="hidden" value="{{config('constants.payment_statuses')[1]}}">
                                       <input name="id" type="hidden" value="{{$fine['id']}}">
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
@endif
