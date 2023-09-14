@foreach($filtered_attendances->groupBy('student.course_name') as $key => $attendances)
    <div class="div-border padding-10 margin-bottom-10">
        <div class="row margin-bottom-5">
            <div class="col-6">
                <strong class="card-title" id="summary_title">
                    {{ $key }}
                </strong>
            </div>
            <div class="col-6">
                <button class="before-print btn btn-primary waves-effect waves-light pull-right" id="add" onclick="window.print();return false;" type="button">
                    Print
                </button>
            </div>
        </div>
        <div class="card-content">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    Month
                                </th>
                                <th>
                                    Absent Student & Dates
                                </th>
                                <th>
                                    Count
                                </th>
                                <th>
                                    Fine Amount
                                </th>
                            </tr>
                        </thead>
                        <tbody id="attendance_summary_body">
                            @foreach ($attendances->groupBy('month_year') as $key => $values)
                                <tr>
                                    <td>
                                        {{$key}}
                                    </td>
                                    <td>
                                        @foreach ($values->groupBy('student.student_name') as $student_key => $student_values)
                                                <b>{{ $student_key }}</b> ( @foreach ($student_values as $element)
                                                    {{date('d', strtotime($element->date)) }},
                                                @endforeach)
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $values->count() }}
                                    </td>
                                    <td>
                                        {{ $values->count() * config('constants.constant_fines.attendance_fine') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach
