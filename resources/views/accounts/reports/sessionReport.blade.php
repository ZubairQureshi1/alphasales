<table id="reportExport" class="table table-striped table-responsive table-bordered" cellspacing=0 border=transparent width="100%">
    <thead class="text-center">
        <tr>
            <th style=min-width:50px colspan="{{ 13 + (count($month_cols)*2) + 2 + 3 }}"><b>Course: </b>{{ $fileHeader['course'] }} | <b>Part: </b>{{ $fileHeader['semesters_years'] }} | <b>Section: </b>{{ $fileHeader['section'] }} | <b>Category: </b>{{ $fileHeader['category'] }} | <b>Shift: </b>{{ $fileHeader['shift'] }}</th>
        </tr>
        <tr>
            <th style=min-width:50px colspan="8">Student Information</th>
            @foreach($month_cols as $due_date)
            <th style=min-width:100px colspan="2"> {{ date('M Y', strtotime($due_date)) }} </th>
            @endforeach
            {{-- Total Section --}}
            <th style=min-width:50px colspan="2">Total</th>
            {{-- Total Difference --}}
            <th style=min-width:50px;vertical-align:middle;></th>
            {{-- Head Section --}}
            <th style=min-width:50px colspan="2">Other Heads</th>
            {{-- Transport Head Section --}}
            <th style=min-width:50px colspan="2">Transport Heads</th>
            {{-- Overall Fine Section --}}
            <th style=min-width:50px colspan="3">Overall Fine</th>
        </tr>
        <tr>
            @foreach($table_columns as $column)
                <th style=min-width:50px>{{ $column }}</th>
            @endforeach
            @foreach($month_cols as $due_date)
                <th style=min-width:50px>Fee</th>
                <th style=min-width:50px>Paid</th>
            @endforeach
            {{-- Total Section Vertical --}}
            <th style=min-width:50px>Fee</th>
            <th style=min-width:50px>Paid</th>
            {{-- Total Difference --}}
            <th style=min-width:50px;vertical-align:middle;>Diff.</th>
            {{-- Head Section --}}
            <th style=min-width:50px>Amount</th>
            <th style=min-width:50px>Paid</th>
            {{-- Transport Head Section --}}
            <th style=min-width:50px>Amount</th>
            <th style=min-width:50px>Paid</th>
            {{-- Overall Fine Section --}}
            <th style=min-width:50px>Amount</th>
            <th style=min-width:50px>Waived</th>
            <th style=min-width:50px>Paid</th>
        </tr>
    </thead>
    <tbody class="text-center vertical-center">
            
        @foreach($reportData as $data)
            <tr>
                @foreach($table_columns as $key => $column)
                    @if ($key == 'tuition_fee')
                        <td style=min-width:50px>{{ number_format($data[$key]) }}</td>
                    @else
                        <td style=min-width:50px>{{ $data[$key] }}</td>
                    @endif
                @endforeach
                @foreach($month_cols as $date_keys => $due_date)
                    @if(App\Models\FeePackageInstallment::where('package_id', $data['package_id'])->where('due_date', 'LIKE', date('Y-m', strtotime($due_date)).'%')->count() == 1)
                        @foreach(App\Models\FeePackageInstallment::where('package_id', $data['package_id'])->where('due_date', 'LIKE', date('Y-m', strtotime($due_date)).'%')->get() as $key => $installment)
                            <td style=min-width:50px>{{ number_format($installment['amount_per_installment']) }}</td>
                            @if ($installment->status_id == 1)
                                <td style=min-width:50px>{{ number_format($installment['amount_per_installment']) }}</td>
                            @elseif($installment->status_id == 2)
                                <td style="border:1px solid #000000;min-width:50px; background-color:red;color:white;">{{ number_format($installment['amount_per_installment'] - $installment['remaining_balance']) }}</td>
                            @elseif($installment->status_id == 0)
                                <td style=min-width:50px>0</td>
                            @endif
                            
                        @endforeach
                
                    @elseif(App\Models\FeePackageInstallment::where('package_id', $data['package_id'])->where('due_date', 'LIKE', date('Y-m', strtotime($due_date)).'%')->count() > 1)
                        <td style=min-width:50px>
                            @foreach(App\Models\FeePackageInstallment::where('package_id', $data['package_id'])->where('due_date', 'LIKE', date('Y-m', strtotime($due_date)).'%')->get() as $key => $installment)
                                {{ number_format($installment['amount_per_installment']) }}
                                <br><hr>
                            @endforeach
                        </td>
                        <td style=min-width:50px>
                            @foreach(App\Models\FeePackageInstallment::where('package_id', $data['package_id'])->where('due_date', 'LIKE', date('Y-m', strtotime($due_date)).'%')->get() as $key => $installment)
                                @if ($installment->status_id == 1)
                                    {{ number_format($installment['amount_per_installment']) }}
                                @elseif($installment->status_id == 2)
                                    {{ number_format($installment['amount_per_installment'] - $installment['remaining_balance']) }}
                                @elseif($installment->status_id == 0)
                                    0
                                @endif
                                <br><hr>
                            @endforeach
                        </td>
                
                    @else
                        <td style=min-width:50px>0</td>
                        <td style=min-width:50px>0</td>
                    @endif

                @endforeach

                {{-- Total Section Vertical --}}
                <td style=min-width:50px>{{ isset($data['total_installments_due'])?number_format($data['total_installments_due']):'0' }}</td>
                <td style=min-width:50px>{{ isset($data['total_installment_paid'])?number_format($data['total_installment_paid']):'0' }}</td>
                {{-- Difference Vertical --}}
                <td style=min-width:50px>{{ isset($data['installment_difference'])?number_format($data['installment_difference']):(isset($data['total_installments_due'])?number_format($data['tuition_fee']-$data['total_installments_due']):'0') }}</td>
                {{-- Head Section --}}
                <td style=min-width:50px>{{ number_format($data['heads_due']) }}</td>
                <td style=min-width:50px>{{ number_format($data['heads_paid']) }}</td>
                {{-- Transport Head Section --}}
                <td style=min-width:50px>{{ number_format($data['transport_heads_due']) }}</td>
                <td style=min-width:50px>{{ number_format($data['transport_heads_paid']) }}</td>
                {{-- Transport Head Section --}}
                <td style=min-width:50px>{{ number_format($data['total_fine_due']) }}</td>
                <td style=min-width:50px>{{ number_format($data['total_fine_waived']) }}</td>
                <td style=min-width:50px>{{ number_format($data['total_fine_paid']) }}</td>
            </tr>
        @endforeach
        
        <tr>
            <td style=min-width:50px colspan="5"></td>
            <td style=min-width:50px><b>TOTAL</b></td>
            <td style=min-width:50px>{{ number_format($fee_package_total) }}</td>
            <td style=min-width:50px colspan=""></td>
            @foreach($month_cols as $key => $due_date)
                <td style=min-width:50px>{{ number_format($monthly_installment_total[$key]['monthly_due']) }}</td>
                <td style=min-width:50px>{{ number_format($monthly_installment_total[$key]['monthly_paid']) }}</td>
            @endforeach
            
            {{-- Total Section Vertical --}}
            <td style=min-width:50px>{{ number_format($monthly_due_total) }}</td>
            <td style=min-width:50px>{{ number_format($monthly_paid_total) }}</td>
             {{-- Difference Vertical --}}
            <th style=min-width:50px;vertical-align:middle;>{{ number_format($installment_difference_total) }}</th>
                {{-- Head Section --}}

            <td style=min-width:50px> {{ number_format($heads_due_total) }} </td>
            <td style=min-width:50px> {{ number_format($heads_paid_total) }} </td>
                {{-- Transport Head Section --}}

            <td style=min-width:50px> {{ number_format($transport_head_due_total) }} </td>
            <td style=min-width:50px> {{ number_format($transport_head_paid_total) }} </td>
                {{--  Overall Fine Section --}}

            <td style=min-width:50px> {{ number_format($fine_due_total) }} </td>
            <td style=min-width:50px> {{ number_format($fine_waived_total) }} </td>
            <td style=min-width:50px> {{ number_format($fine_paid_total) }} </td>
        </tr>
        <tr>
            <td style=min-width:50px colspan="5"></td>
            <td style=min-width:50px colspan="3"><b>Pending Amount</b></td>
            @foreach($month_cols as $key => $due_date)
                <td colspan="2" style=min-width:50px>{{ number_format($monthly_installment_total[$key]['monthly_remaining']) }}</td>
            @endforeach
            {{-- Total Section Vertical --}}
            <td colspan="2" style=min-width:50px>{{ number_format($monthly_remaining_total) }}</td>
             {{-- Difference Vertical --}}
            <th style=min-width:50px;vertical-align:middle;></th>
                {{-- Head Section --}}
            <td style=min-width:50px colspan="2">{{ number_format($heads_due_total-$heads_paid_total) }}</td>
                {{-- Transport Head Section --}}
            <td style=min-width:50px colspan="2">{{ number_format($transport_head_due_total-$transport_head_paid_total) }}</td>
                {{-- Overall Fine Section --}}
            <td style=min-width:50px colspan="3">{{ number_format($fine_due_total-($fine_waived_total + $fine_paid_total)) }}</td>
        </tr>
    </tbody>
</table>
