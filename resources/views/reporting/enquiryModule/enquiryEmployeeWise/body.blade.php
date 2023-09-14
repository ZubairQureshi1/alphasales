<table cellspacing="0" class="table table-hover table-bordered" id="enquiry_employee_wise_report_table" isdefault="true" width="100%">
    <thead class="text-center thead-dark">
        <tr>
            <th rowspan="2">
                Employee
            </th>
            <th rowspan="2">
                Type
            </th>
            <th rowspan="2">
                Total
            </th>
            <th colspan="{{ count(array_slice(config('constants.enquiry_types'), 1, 5, true)) }}">Enquiry Type</th>
        </tr>
        <tr>
            @foreach(array_slice(config('constants.enquiry_types'), 1, 5, true) as $type)
                <th>{{ $type }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody class="text-center">
		@foreach($data->sortBy('display_name') as $key => $user)
        @php
            $enquiries = App\Models\Enquiry::where('user_id', $user->id)
                          ->where('organization_campus_id', Illuminate\Support\Facades\Session::get('organization_campus_id'))
                          ->where('enquiry_date', '>=', $start_date_obj)
                          ->where('enquiry_date', '<=', $end_date_obj)
                          ->get()
                          ->groupBy('student_category_name');
        @endphp
        @if($enquiries->isNotEmpty())
            <tr>
                <td rowspan="{{ count($enquiries) + 1 }}">{{ $user->display_name }}</td>
                @foreach($enquiries as $nested_key => $enquiry)
                    <tr>
                        <td>{{ $nested_key ?? 'NAN' }}</td>
                        <td>{{ count($enquiry) ?? 0 }}</td>
                        <td>{{ $enquiry->where('enquiry_type', 'physical')->count() }}</td>
                        <td>{{ $enquiry->where('enquiry_type', 'sm_lead')->count() }}</td>
                        <td>{{ $enquiry->where('enquiry_type', 'cold_lead')->count() }}</td>
                        <td>{{ $enquiry->where('enquiry_type', 'inbound')->count() }}</td>
                        <td>{{ $enquiry->where('enquiry_type', 'outbound')->count() }}</td>
                    </tr>
                @endforeach
            </tr>
        @endif
        @endforeach
	</tbody>
</table>