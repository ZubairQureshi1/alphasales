<div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="wrapper">
                            <nav class="tabs">
                                <div class="selector">
                                </div>
                                <a aria-controls="feePackage" class="active tablinks" data-toggle="tab" href="#feePackage" onclick="openCity(event, 'feePackage')" role="tab">
                                    <i class="fa fa-burn">
                                    </i>
                                    FEE PACKAGE
                                </a>
                                <a aria-controls="installments" class="tablinks" data-toggle="tab" href="#installments" onclick="openCity(event, 'installments')" role="tab">
                                    <i class="fa fa-bomb">
                                    </i>
                                    INSTALLMENTS
                                </a>
                                <a aria-controls="summary" class="tablinks" data-toggle="tab" href="#summary" onclick="openCity(event, 'summary')" role="tab">
                                    <i class="fa fa-bolt">
                                    </i>
                                    SUMMARY
                                </a>
                                <a aria-controls="miscellaneous" class="tablinks" data-toggle="tab" href="#MISCELLANEOUS" onclick="openCity(event, 'miscellaneous')" role="tab">
                                    <i class="fa fa-superpowers">
                                    </i>
                                    MISCELLANEOUS
                                </a>
                            </nav>
                        </div>
                        <div class="form-control">
                            <label>
                                Name : {{$student['student_name']}}
                            </label>
                            <br>
                                <label>
                                    Roll no. : {{$student['roll_no']}}
                                </label>
                                <br>
                                    <label>
                                        Course Name : {{$student['course_name']}}
                                    </label>
                                    <br>
                                        <label>
                                            Session Name : {{$student['session_name']}}
                                        </label>
                                        <br>
                                        </br>
                                    </br>
                                </br>
                            </br>
                        </div>
                        <!-- div content -->
                        <!-- fee pacakage -->
                        <div class="tab-content">
                            
                            <!-- fee package end -->
                            <!-- installments -->
                            <div class="tabcontent" id="installments" role="tabpanel" style="display:none">
                                <br>
                                    <label>
                                        Net total :
                                    </label>
                                    <input "="" class="form-control p-1 mb-2 bg-light text-dark " disabled="" id="net_total" name="net_total" type="text" value="{{$fee!=null?$fee['net_total']:''}}">
                                        <br>
                                            <button class="btn btn-primary waves-effect waves-light pull-right m-b-10 m-t-15-negative" data-target=".create_installment_model" data-toggle="modal" id="add" type="button">
                                                Installments
                                            </button>
                                            <br>
                                                @if($fee_instalments!=null && count($fee_instalments)!=0)
                                                <div class="container">
                                                    @foreach($fee_instalments as $index => $instalment)
                                                    <div class="form-control">
                                                        <form action="{{route('accounts.installment_paid')}}" method="POST">
                                                            @csrf
                                                            <input name="status_id" type="hidden" value="1">
                                                                <input name="status_name" type="hidden" value="{{config('constants.discount_status')[1]}}">
                                                                    <input name="instalment_id" type="hidden" value="{{$instalment['id']}}">
                                                                        {!! Form::submit('Paid', ['class' => 'btn btn-primary pull-right']) !!}
                                                                    </input>
                                                                </input>
                                                            </input>
                                                        </form>
                                                        <form action="{{route('accounts.invoice')}}" method="POST">
                                                            @csrf
                                                            <input name="installment_id" type="hidden" value="{{$instalment['id']}}">
                                                                <input name="student_id" type="hidden" value="{{$student['id']}}">
                                                                    <input name="count" type="hidden" value="{{$index+1}}">
                                                                        {!! Form::submit('print', ['class' => 'btn btn-success btn-sm']) !!}
                                                                    </input>
                                                                </input>
                                                            </input>
                                                        </form>
                                                        <br>
                                                            <br>
                                                                <br>
                                                                    <label class="control-label col-sm-2">
                                                                        Installment Count : {{$index+1}}
                                                                    </label>
                                                                    <label class="control-label col-sm-2 pull-right">
                                                                        Voucher Id : {{$instalment->feeVoucher()->get()->first()->voucher_code}}
                                                                    </label>
                                                                    <br>
                                                                        <label class="control-label col-sm-2">
                                                                            Status : {{$instalment['status_name']}}
                                                                        </label>
                                                                        <label class="control-label col-sm-2 pull-right">
                                                                            Amount : Rs {{$instalment['amount_per_installment']}}/-
                                                                        </label>
                                                                        <br>
                                                                            <label class="control-label col-sm-2">
                                                                                Paid Date : {{$instalment['paid_date']}}
                                                                            </label>
                                                                            <label class="control-label col-sm-2 pull-right">
                                                                                Due Date : {{$instalment['due_date']}}
                                                                            </label>
                                                                            <br>
                                                                                <label class="control-label col-sm-2">
                                                                                    Remarks :
                                                                                </label>
                                                                                <br>
                                                                                    <textarea cols="50" name="comment" rows="4">
                                                                                    </textarea>
                                                                                </br>
                                                                            </br>
                                                                        </br>
                                                                    </br>
                                                                </br>
                                                            </br>
                                                        </br>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endif
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
                                                                        <input "="" class="form-control p-1 mb-2 bg-light text-dark " id="net_total" name="net_total" readonly="" type="text" value="{{$fee['net_total']}}">
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
                                                                                                <input name="package_id" type="hidden" value="{{$fee['id']}}">
                                                                                                    <input name="status_id" type="hidden" value="0">
                                                                                                        <input name="status_name" type="hidden" value="{{config('constants.discount_status')[0]}}">
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
                                            </br>
                                        </br>
                                    </input>
                                </br>
                            </div>
                            
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
                                                        <input name="status_name" type="hidden" value="{{config('constants.voucher_status')[0]}}">
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
                                                                                <input name="status_id" type="hidden" value="2">
                                                                                    <input name="status_name" type="hidden" value="{{config('constants.voucher_status')[2]}}">
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
                                                                        <form action="{{route('accounts.fine_paid')}}" method="POST">
                                                                            @csrf
                                                                            <!-- <input type="hidden" name="status_id" value="1"> -->
                                                                            <input <input="" name="status_name" type="hidden" value="{{config('voucher_status')[1]}}">
                                                                                <input name="id" type="hidden" value="{{$fine['id']}}">
                                                                                    {!! Form::submit('Paid', ['class' => 'btn btn-primary pull-right' , 'id'=>'a{{$index+1}}']) !!}
                                                                                </input>
                                                                            </input>
                                                                        </form>
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
                            @else
                            <form action="{{route('accounts.update_feePackage')}}" class="" method="POST">
                                <label>
                                    Total Package :
                                </label>
                                <input class="form-control p-1 mb-2 bg-light text-dark fee" disabled="" id="total_package" name="total_package" type="text">
                                    <label>
                                        Scholarship :
                                    </label>
                                    {!! Form::select('discount_id', config('constants.discount_status'), null, ['id' => 'discount_id', 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Scholarship','name' => 'discount_status_id'] ) !!}
                                    <label>
                                        Discount :
                                    </label>
                                    <input "="" class="form-control p-1 mb-2 bg-light text-dark fee" disabled="" id="discount" name="discount" type="text">
                                        <label>
                                            Discount Percentage :
                                        </label>
                                        <input "="" class="form-control p-1 mb-2 bg-light text-dark fee" disabled="" id="discount_percentage" name="discount_percentage" type="text" value=" 0256">
                                            <label>
                                                Net total :
                                            </label>
                                            <input "="" class="form-control p-1 mb-2 bg-light text-dark " id="net_total" name="net_total" readonly="" type="text">
                                                <label>
                                                    Status :
                                                </label>
                                                <input class="form-control p-1 mb-2 bg-light text-dark " disabled="" id="status_name" name="status_name" type="text" value="UnPaid">
                                                    <input name="status_id" type="hidden" value="0">
                                                        <input name="status_name" type="hidden" value="UnPaid">
                                                            <input name="student_id" type="hidden" value="{{$student['id']}}">
                                                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                                                    {!! Form::submit('Save', ['class' => 'btn btn-primary' , 'id'=>'fee','hidden']) !!}
                                                                </input>
                                                            </input>
                                                        </input>
                                                    </input>
                                                </input>
                                            </input>
                                        </input>
                                    </input>
                                </input>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->