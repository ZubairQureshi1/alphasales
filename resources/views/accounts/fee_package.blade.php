<div class="tabcontent active" id="feePackage" role="tabpanel">
    <div class="row margin-5">
        <div class="col-12">
            
            @if($fee_package==null)
                <button class="btn btn-primary pull-right m-l-10" onclick="editable('fee')" type="button">
                    <i class="mdi mdi-plus">
                    </i>
                    Add Package
                </button>
            @endif
            @if($fee_package!=null && $fee_package['status_id'] != 1)

                <form action="{{route('accounts.deletePackage')}}" method="POST">
                    @csrf
                    <input name="package_id" required="" type="hidden" value="{{ $fee_package['id'] }}">
                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger pull-right margin-left-5']) !!}
                </form>
                @if(count($fee_instalments)==0)
                    {{-- @if($diff > 0)
                        <button class="btn btn-primary waves-effect waves-light pull-right" data-target=".create_paymentP_model" data-toggle="modal" type="button">
                            Pay Package
                        </button>
                    @else --}}
                        <form action="{{route('accounts.package_paid')}}" method="POST">
                            @csrf
                            <input name="status_id" required="" type="hidden" value="1">
                            <input name="status_name" required="" type="hidden" value="{{config('constants.payment_statuses')[1]}}">
                            <input name="fee_id" required="" type="hidden" value="{{$fee_package['id']}}">
                            {!! Form::submit('Make A Payment', ['class' => 'btn btn-sm btn-success pull-right margin-left-5' , 'id'=>'a{{$index+1}}']) !!}
                        </form>
                    {{-- @endif --}}
                    <div class="margin-left-5">
                        <form action="{{route('accounts.invoicePackage')}}" method="POST">
                            @csrf
                            <input name="status_id" required="" type="hidden" value="0">
                            <input name="status_name" required="" type="hidden" value="{{config('constants.voucher_statuses')[0]}}">
                            <input name="id" required="" type="hidden" value="{{$fee_package['id']}}">
                            <input name="student_id" required="" type="hidden" value="{{$student['id']}}">
                            {!! Form::submit('Print Voucher', ['class' => 'btn btn-sm btn-secondary pull-right' , 'id'=>'a{{$index+1}}']) !!}
                        </form>
                    </div>
                @endif
            @endif
        </div>
    </div>
    @if($fee_package!=null)
        <div class="div-border-rad padding-10">
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4"> 
                    <div class="margin-top-5 acount_instalment">
                    <div class="badge badge-pill {{$fee_package['is_verified']==true?'badge-success':'badge-danger'}}">
                            <span class="{{$fee_package['is_verified']==true?'verification_success_bg':'verification_danger_bg'}} "><i class="mdi mdi-checkbox-blank-circle {{$fee_package['is_verified']==true?'ion-checkmark':'ion-information'}} "></i> </span> 
                            {{$fee_package['is_verified']==true?'Verified':'Un-Verified'}}
                    </div>
                        <!-- <strong class="badge badge-pill {{$fee_package['is_verified']==true?'badge-success':'badge-danger'}} pull-right"  style="position: relative;padding-top: 7px; padding-right: 10px; padding-bottom: 7px; padding-left: 23px; 
">{{$fee_package['is_verified']==true?'Verified':'Un-Verified'}}</strong>
                        <strong class="{{$fee_package['is_verified']==true?'badge-round-success':'badge-round-danger'}} pull-right"><i class="{{$fee_package['is_verified']==true?'ion-checkmark':'ion-information'}}"></i></strong> -->
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6  d-none  d-sm-block">
                    <strong>
                        Labels
                    </strong>
                </div>
                <div class="col-md-6 col-sm-6 pull-right ">
                    <strong>
                        Details
                    </strong>
                </div>
            </div>
            <div class="margin-10">
                <div class="row nth-bg">
                    <div class="col-md-6 col-sm-6">
                        <label>
                            Total Package:
                        </label>
                    </div>
                    <div class="col-md-6 col-sm-6 pull-right">
                        Rs{{$fee_package['total_package']}}/-
                    </div>
                </div>
                <div class="row nth-bg">
                    <div class="col-md-6 col-sm-6">
                        <label>
                            Status:
                        </label>
                    </div>
                    <div class="col-md-6 col-sm-6 pull-right">
                        {{ $fee_package['status_name'] }}
                    </div>
                </div>
                <div class="row nth-bg">
                    <div class="col-md-6 col-sm-6">
                        <label>
                            Discount:
                        </label>
                    </div>
                    <div class="col-md-6 col-sm-6 pull-right">
                        Rs{{ $fee_package['discount'] }}/-
                    </div>
                </div>
                <div class="row nth-bg">
                    <div class="col-md-6 col-sm-6">
                        <label>
                            Discount Percentage:
                        </label>
                    </div>
                    <div class="col-md-6 col-sm-6 pull-right">
                        {{ $fee_package['discount_percentage'] }}%
                    </div>
                </div>
                <div class="row nth-bg">
                    <div class="col-md-6 col-sm-6" >
                        <label>
                            Discount Status:
                        </label>
                    </div>
                    <div class="col-md-6 col-sm-6 pull-right">
                        {{ isset(config('constants.discount_statuses')[$fee_package['discount_status_id']]) ? config('constants.discount_statuses')[$fee_package['discount_status_id']] : ''}}
                    </div>
                </div>
                
                <div class="row nth-bg">
                    <div class="col-md-6 col-sm-6">
                        <label>
                            Late Fee Fine:
                        </label>
                    </div>
                    <div class="col-md-6 col-sm-6 pull-right">
                        {{ $fee_package['late_fee_fine'] }}/-
                    </div>
                </div>
                <div class="row nth-bg">
                    <div class="col-md-6 col-sm-6">
                        <label>
                            Due Date:
                        </label>
                    </div>
                    <div class="col-md-6 col-sm-6 pull-right">
                        {{ $fee_package['due_date'] }}
                    </div>
                </div>
                <div class="row nth-bg">
                    <div class="col-md-6 col-sm-6">
                        <label>
                            Paid Date:
                        </label>
                    </div>
                    <div class="col-md-6 col-sm-6 pull-right">
                        {{ $fee_package['paid_date']!=''?$fee_package['paid_date']: '--/--/----' }}
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('includes.not_found')
        <form action="{{route('accounts.createFeePackage')}}" class="" hidden="true" id="package_form" method="POST">
           <!--  <div class="form-group">
                @if(count($heads)!=0)
                    <table cellspacing="0" class="table table-striped table-bordered" id="switch" width="100%">
                        <thead>
                            <tr>
                                <td>
                                    Name
                                </td>
                                <td>
                                    Actions
                                </td>
                                <td>
                                    Charges
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($heads as $index => $head)
                            <tr>
                                <td>
                                    {{ $head['name'] }}
                                </td>
                                <td>
                                    <div class="text-center">
                                        <input class="check" id="{{ $head['id'] }}" name="heads[]" switch="bool" type="checkbox" value="{{ $head['id'] }}"/>
                                        <label data-off-label="No" data-on-label="Yes" for="{{ $head['id'] }}">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    {{$head['amount']}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    @include('includes/not_found')
                @endif
            </div> -->
            <div class="row">
                <div class="col-3" hidden>
                    <label>
                        Admission Fee:
                    </label>
                    <input class="form-control p-1 mb-2 bg-light text-dark fee" id="admission_fee" name="admission_fee"  type="number">
                </div>
                <div class="col-3">
                    <label>
                        Tution Fee:
                    </label>
                    <input class="form-control p-1 mb-2 bg-light text-dark fee" id="tution_fee" name="tution_fee" required="" value="{{$course_tution_fee}}" type="number">
                </div>
                <div class="col-3" hidden>
                    <label>
                        Total Amount (Admission + Tution):
                    </label>
                    <input class="form-control p-1 mb-2 bg-light text-dark fee" id="total_tution_fee" name="total_tution_fee" readonly=""  type="text">
                </div>
                <div class="col-3">
                    <label>
                        Discount (In Rupee):
                    </label>
                    <input class="form-control p-1 mb-2 bg-light text-dark fee" disabled="" id="discount" name="discount" required="" type="text">
                </div>
                <div class="col-3">
                    <label>
                        Discount (In Percentage):
                    </label>
                    <input class="form-control p-1 mb-2 bg-light text-dark fee" disabled="" id="discount_percentage" name="discount_percentage" required="" type="text" placeholder="Discount Rate">
                </div>
                <div class="col-3">
                    <label>
                        Discount Status:
                    </label>
                    {!! Form::select('discount_id', config('constants.discount_statuses'), null, ['id' => 'discount_id', 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Scholarship','name' => 'discount_status_id' , 'required'] ) !!}
                </div>
                <div class="col-3">
                    <label>
                        Total Amount (After Discount):
                    </label>
                    <input class="form-control p-1 mb-2 bg-light text-dark " id="net_total" name="net_total" readonly="" required="" type="text">
                </div>
                <div class="col-3" hidden>
                    <label>
                        Total Package (Total Amount + Head Amount):
                    </label>
                    <input class="form-control p-1 mb-2 bg-light text-dark fee" id="total_package" name="total_package" readonly=""  type="text">
                </div>
                <div class="col-3">
                    <label>
                        Due Date:
                    </label>
                    <input class="form-control p-1 mb-2 bg-light text-dark fee" data-date-format="YYYY-MM-DD" id="due_date" name="due_date" required="" type="date">
                </div>
            </div>
            <input name="student_id" required="" type="hidden" value="{{$student['id']}}">
            <input name="academic_history_id" type="hidden" value="{{$academic_history_id}}">
            <input name="_token" required="" type="hidden" value="{{ csrf_token() }}">
            {!! Form::submit('Save', ['class' => 'btn btn-primary' , 'id'=>'fee','hidden']) !!}
        </form>
    @endif
    @if($fee_package!=null)
        <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade create_paymentP_model" role="dialog" tabindex="-1">
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
                        <form action="{{route('accounts.package_paid')}}" class="" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>
                                    Payment Date:
                                </label>
                                <input class="form-control" data-parsley-type="paid_date" id="paid_date" name="paid_date" required="" type="date"/>
                                <label>
                                    Voucher Code:
                                </label>
                                <input class="form-control p-1 mb-2 bg-light text-dark " id="voucher_code" name="voucher_code" required="" type="text">
                                    <!--  <label>
                                                        Amount per Installment :
                                                    </label>
                                                    <input required  class="form-control p-1 mb-2 bg-light text-dark " id="amount_per_installment" name="amount_per_installment"  type="text"> -->
                                <input name="status_id" required="" type="hidden" value="1">
                                <input name="status_name" required="" type="hidden" value="{{config('constants.payment_statuses')[1]}}">
                                <input name="fee_id" required="" type="hidden" value="{{$fee_package['id']}}">
                            </div>
                            <button class="btn btn-primary" type="submit">
                                Save
                            </button>
                            <button class="btn btn-secondary" data-dismiss="modal" type="button">
                                Close
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    <!-- /.modal-content -->
    <!-- /.modal-dialog -->
    <!-- /.modal -->
    @endif
</div>
