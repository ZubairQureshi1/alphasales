        <table id="datatable-buttons" isDefault="true" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Course</th>
                <th>Subject</th>
                <th>Section</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Time Slot</th>
                <th>Room</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($timeperiods as $index => $timeperiod)
                <tr>
                    <td>{{$timeperiod->Course->name }}</td>
                    <td>{{$timeperiod->Subject->name}}</td>
                    <td>{{isset($timeperiod->Section->name) ? $timeperiod->Section->name : ''}}</td>
                    <td>
                        {{date_format(date_create($timeperiod->start_date), 'd-m-Y')}}
                    </td>
                    <td>
                        {{date_format(date_create($timeperiod->end_date), 'd-m-Y')}}
                    </td>
                    <td>
                        {{$timeperiod->timeSlot->name}} - ({{$timeperiod->timeSlot->start_time}} - 
                        {{$timeperiod->timeSlot->end_time}})
                    </td>
                    <td>{{$timeperiod->room->name}}</td>
                    <td>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                          <div class="btn-group mr-2" role="group" aria-label="First group">
                            {!! Form::open(['route' => ['timePeriods.destroy', $timeperiod->id], 'method' => 'delete']) !!}
                            <button type="submit" class="btn btn-danger btn-sm"><i class="typcn typcn-delete-outline"></i></button>
                            {!! Form::close() !!}
                          </div>
                        </div>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>

