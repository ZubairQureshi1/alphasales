<div class="tabcontent active buttons-group-mobile" id="installments" role="tabpanel">
    <div class="table-rep-plugin">
        <div class="table-responsive b-0">
            <table cellspacing="0" class="verifyPackage tablet table table-striped table-bordered" id="datatable-buttons" isdefault="true" width="100%">
                <thead>
                    <tr>
                        <th>
                            Roll No
                        </th> 
                        <th>
                            Old Roll No
                        </th>   
                        <th>
                            Student Name
                        </th>
                        <th>
                            Due Amount
                        </th>
                        <th>
                            Due Date
                        </th>
                        <th>
                            Paid Amount
                        </th>
                        <th>
                            Paid Date
                        </th>
                        <th>
                            V-No.
                        </th>
                        <th>
                            Late Fee Fine
                        </th>
                        <th>
                            V-No.
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        @isset($student->feePackages)
                            @foreach($student->feePackages as $feePackage)
                                @isset($feePackage->feePackageInstallments)
                                    @foreach($feePackage->feePackageInstallments as $installment)
                                        @if ($installment->status_id == 1 || $installment->status_id == 2)
                                                <tr>
                                                    <td>{{ $student->roll_no }}</td>
                                                    <td>{{ $student->old_roll_no }}</td>
                                                    <td>{{ $student->student_name }}</td>
                                                    <td>{{ $installment->amount_per_installment}}</td>
                                                    <td>{{$installment->due_date}}</td>
                                                    @if ($installment->status_id == 2)
                                                        <td>{{ $installment->paid_amount}}</td>
                                                        <td>{{ $installment->paid_date}}</td>
                                                        <td>{{ $installment->voucher_code}}</td>
                                                        <td>{{ $installment->late_fee_fine!=''? $installment->late_fee_fine: '---'}}</td>
                                                        <td>{{ $installment->late_fee_fine_voucher_code!=''? $installment->late_fee_fine_voucher_code: '---'}}</td>
                                                    @endif
                                                    @if ($installment->remaining_balance != '' && $installment->status_id == 1)
                                                        <td>{{ $installment->remaining_balance_paid_amount}}</td>
                                                        <td>{{ $installment->remaining_balance_paid_date}}</td>
                                                        <td>{{ $installment->remaining_balance_voucher_id}}</td>
                                                        <td>{{ $installment->remaining_balance_late_fine!=''? $installment->remaining_balance_late_fine: '---'}}</td>
                                                        <td>{{ $installment->r_b_late_fee_fine_voucher_code!=''? $installment->r_b_late_fee_fine_voucher_code: '---'}}</td>
                                                    @endif
                                                    @if ($installment->remaining_balance == '' && $installment->status_id == 1)
                                                        <td>{{ $installment->paid_amount}}</td>
                                                        <td>{{ $installment->paid_date}}</td>
                                                        <td>{{ $installment->voucher_code}}</td>
                                                        <td>{{ $installment->late_fee_fine!=''? $installment->late_fee_fine: '---'}}</td>
                                                        <td>{{ $installment->late_fee_fine_voucher_code!=''? $installment->late_fee_fine_voucher_code: '---'}}</td>
                                                    @endif
                                                    @if (!$installment->payment_verification)
                                                        <td>Un-Verified</td>
                                                        <td>
                                                            <form action="{{route('accounts.verifyPayments')}}" method="POST">
                                                                @csrf
                                                                <input name="instalment_id" required="" type="hidden" value="{{ $installment['id'] }}">
                                                                <input name="payment_type" required="" type="hidden" value="instalment">
                                                                {!! Form::submit('Verify Payment', ['class' => 'btn btn-success pull-right margin-left-5']) !!}
                                                            </form>
                                                        </td>
                                                    @else
                                                        <td>---</td>
                                                        <td>---</td>
                                                    @endif
                                                </tr>
                                        @endif
                                    @endforeach
                                @endisset
                            @endforeach
                        @endisset
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
 