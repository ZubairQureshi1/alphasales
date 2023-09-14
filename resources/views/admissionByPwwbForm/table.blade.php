@if(count($pwwbForms) > 0)
    <div class="table-rep-plugin">
        <div class="table-responsive b-0 buttons-group-mobile">
            <table id="datatable-buttons" isDefault="true" class="table table-bordered table-striped"  class="tablet" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width: 2%; text-align: center;">#</th>
                        <th>File Module Number</th>
                        <th>Student Name</th>
                        <th>Received Date</th>
                        <th>Course</th>
                        <th style="width: 8%; text-align: center;">District</th>
                        <th style="width: 15%; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pwwbForms as $index => $pwwbForm)
                    <tr>
                        <td class="text-center">{{ ++$index }}</td>
                        <td>{{ $pwwbForm->file_module_number ?? '---' }}</td>
                        <td class="text-capitalize">{{ optional($pwwbForm->studentPersonalDetail)->name ?? '---' }}</td>
                        <td>{{ $pwwbForm->receiving_date ?? '---' }}</td>
                        <td>{{ !empty(App\Models\Course::find($pwwbForm->course_id)) ? App\Models\Course::find($pwwbForm->course_id)->name : '---- ' }}</td>
                        <td class="text-center">{{ !empty($pwwbForm->district) ? $pwwbForm->district : '----' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admissionByPwwbForm.admissionByPwwbForm', $pwwbForm->id) }}" class="btn btn-dark btn-sm">
                                Move to Admission <i class="fa fa-chevron-right fa-fw"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    @include('includes/not_found')
@endif