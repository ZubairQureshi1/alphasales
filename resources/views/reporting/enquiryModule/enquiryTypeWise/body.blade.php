<table cellspacing="0" class="table table-striped table-bordered" id="enquiry_wise_report_table" isdefault="true" width="100%">
    <thead class="text-center">
        <tr>
            <th rowspan="2">
                Month
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
		@foreach ($data->sortBy('enquiry_date')->groupBy('enquiry_date_month') as $key => $value)
			<tr>
				<td rowspan="{{$value->groupBy('student_category_name')->count() + 1}}">{{ $key }}</td>
				@foreach ($value->groupBy('student_category_name') as $nested_key => $nested_value)
					<tr>
						<td>{{ $nested_key }}</td>
						<td>{{ $nested_value->count() }}</td>
						<td>{{ $nested_value->where('enquiry_type', 'physical')->count() }}</td>
						<td>{{ $nested_value->where('enquiry_type', 'sm_lead')->count() }}</td>
						<td>{{ $nested_value->where('enquiry_type', 'cold_lead')->count() }}</td>
						<td>{{ $nested_value->where('enquiry_type', 'inbound')->count() }}</td>
						<td>{{ $nested_value->where('enquiry_type', 'outbound')->count() }}</td>
					</tr>
				@endforeach
			</tr>
		@endforeach
		<tr class="background-color-white-fade text-center">
			<th colspan="2">
				Total
			</th>
			<th>
				{{ $data->count() }}
			</th>
            @foreach(array_slice(config('constants.enquiry_types'), 1, 5, true) as $key => $type)
                <th>{{ $data->where('enquiry_type', $key)->count() }}</th>
            @endforeach
		</tr>
	</tbody>
	<thead class="text-center">
        <tr>
            <th rowspan="2">
                Month
            </th>
            <th rowspan="2">
                Type
            </th>
            <th rowspan="2">
                Total
            </th>
            @foreach(array_slice(config('constants.enquiry_types'), 1, 5, true) as $type)
                <th>{{ $type }}</th>
            @endforeach
        </tr>
        <tr>
            <th colspan="{{ count(array_slice(config('constants.enquiry_types'), 1, 5, true)) }}">Enquiry Type</th>
        </tr>
    </thead>
</table>
