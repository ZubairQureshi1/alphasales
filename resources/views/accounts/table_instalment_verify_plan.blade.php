<div class="tabcontent active" id="installments" role="tabpanel">
    <div class="table-rep-plugin">
        <div class="table-responsive b-0">
            <table cellspacing="0" class="verifyPackage tablet table table-striped table-bordered" id="datatable-buttons" isdefault="true" width="100%">
                <thead>
                    <tr>
                        <th>
                            Roll No
                        </th>   
                        <th>
                            Student Name
                        </th>
                        <th>
                            Session Name
                        </th>
                        <th>
                            Course Name
                        </th>
                        <th>
                            Section Name
                        </th>
                        <th>
                            Reference Name
                        </th>
                        <th>
                            Instalment Amount
                        </th>
                        <th>
                            Amount Due Date
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
                                        @if (!$installment->is_verified)
                                            <tr>
                                                <td>{{ $student->roll_no }}</td>
                                                <td>{{ $student->student_name }}</td>
                                                <td>{{ $student->session_name }}</td>
                                                <td>{{ $student->course_name }}</td>
                                                <td>{{ $student->section_name }}</td>
                                                <td>{{ $student->reference_name }}</td>
                                                <td>{{$installment->amount_per_installment}}</td>
                                                <td>{{$installment->due_date}}</td>
                                                <td>Un-Verified</td>
                                                <td>
                                                    @can('verify_account_instalment_verification')
                                                        <button class="verifyPlan" page_name="instalments" instalment_id="{{ $installment->id }}" >Verify</button></td>
                                                    @endcan
                                                
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
 