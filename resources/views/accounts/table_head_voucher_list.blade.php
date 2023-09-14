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
                            Head Name
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
                            Head Status
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
                        @isset($student->headFineStudents)
                            @foreach($student->headFineStudents as $headFineStudent)
                                @if ($headFineStudent->status_id != 0)
                                    <tr>
                                        <td>{{ $student->roll_no }}</td>
                                        <td>{{ $student->old_roll_no }}</td>
                                        <td>{{ $student->student_name }}</td>
                                        <td>{{ $headFineStudent->headFine()->get()->first()->name }}</td>
                                        <td>{{ $headFineStudent->headFine()->get()->first()->amount}}</td>
                                        <td>{{$headFineStudent->due_date}}</td>
                                        @if ($headFineStudent->status_id == 2)
                                            <td>{{ $headFineStudent->paid_amount!=''?$headFineStudent->paid_amount: $headFineStudent->headFine()->get()->first()->amount }}</td>
                                            <td>{{ $headFineStudent->paid_date}}</td>
                                            <td>{{ $headFineStudent->voucher_code}}</td>
                                            <td>{{ $headFineStudent->status_name}}</td>
                                        @endif  
                                        @if ($headFineStudent->remaining_balance != '' && $headFineStudent->status_id == 1)
                                            <td>{{ $headFineStudent->headFine()->get()->first()->amount - $headFineStudent->paid_amount}}</td>
                                            <td>{{ $headFineStudent->remaining_balance_paid_date}}</td>
                                            <td>{{ $headFineStudent->remaining_balance_voucher_id}}</td>
                                            <td>{{ $headFineStudent->status_name}}</td>
                                        @endif
                                        @if ($headFineStudent->remaining_balance == '' && $headFineStudent->status_id == 1)
                                            <td>{{ $headFineStudent->paid_amount!=''?$headFineStudent->paid_amount: $headFineStudent->headFine()->get()->first()->amount}}</td>
                                            <td>{{ $headFineStudent->paid_date}}</td>
                                            <td>{{ $headFineStudent->voucher_code}}</td>
                                            <td>{{ $headFineStudent->status_name}}</td>
                                        @endif
                                        @if(!$headFineStudent->payment_verification)
                                            <td>Un-Verified</td>
                                            <td>
                                                <form action="{{route('accounts.verifyPayments')}}" method="POST">
                                                    @csrf
                                                    <input name="head_student_id" required="" type="hidden" value="{{ $headFineStudent['id'] }}">
                                                    <input name="payment_type" required="" type="hidden" value="heads">
                                                    {!! Form::submit('Verify Payment', ['class' => 'btn btn-success pull-right']) !!}
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
                </tbody>
            </table>
        </div>
    </div>
</div>
 