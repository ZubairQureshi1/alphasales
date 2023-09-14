<div class="tabcontent active" id="feePackage" role="tabpanel">
    <div class="table-rep-plugin">
        <div class="table-responsive b-0">
            <table cellspacing="" class="verifyPackage tablet table table-striped table-responsive table-bordered" id="datatable-buttons" isdefault="true" width="100%">
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
                            Package Plan
                        </th>          
                        <th>
                            Due Date
                        </th>
                        <th>
                            Package Status
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
                            @foreach($student->feePackages as $index => $package)
                                @if (!$package->is_verified)
                                    <tr>
                                        <td>{{ $student->roll_no }}</td>
                                        <td>{{ $student->student_name }}</td>
                                        <td>{{ $student->session_name }}</td>
                                        <td>{{ $student->course_name }}</td>
                                        <td>{{ $student->section_name }}</td>
                                        <td>{{ $student->reference_name }}</td>
                                        <td>{{$package->net_total}}</td>
                                        <td>{{$package->due_date}}</td>
                                        <td>{{$package->fee_structure_type_id==1?$package->fee_structure_type: $package->status_name}}</td>
                                        <td>Un-Verified</td>
                                        <td>
                                            @can('verify_account_package_verification')
                                                <button class="verifyPlan" page_name="packages" package_id="{{ $package->id }}" >Verify</button></td>
                                            @endcan
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
 