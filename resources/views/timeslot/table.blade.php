        @foreach ($groupByTimeSlots as $key => $timeslots)
    <div class="tabcontent" id="{{$key}}" role="tabpanel" style="display:none">
        <table id="datatable-buttons" isDefault="true" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Buffer Start</th>
                <th>Buffer End</th>
                <th class="text-center">Slot Type</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($timeslots as $index => $timeslot)
                <tr>
                    <td>{{ $timeslot['name'] }}</td>
                    <td><input class="form-control input-date-time" type="time" disabled value="{{ $timeslot['start_time'] }}"></td>
                    <td><input class="form-control input-date-time" type="time" disabled value="{{ $timeslot['end_time'] }}"></td>
                    <td><input class="form-control input-date-time" type="time" disabled value="{{ $timeslot['buffer_start_time'] }}"></td>
                    <td><input class="form-control input-date-time" type="time" disabled value="{{ $timeslot['buffer_end_time'] }}"></td>
                    <td class="text-center">{{ $timeslot['slot_type_name'] }}</td>
                    <td>
                        <div class="btn-toolbar" role="toolbar">
                          <div class="btn-group text-center" role="group">
                            {{-- For Editing a specific object/row --}}
                            <button type="button" data-toggle="modal" data-target="#{{ str_slug($timeslot['name']).($index+1) }}" class="btn btn-primary rounded-0 btn-sm"><i class="mdi mdi-pencil"></i></button>
                            @include('timeslot.edit_slot')
                            {!! Form::open(['route' => ['timeslots.destroy', $timeslot['id']], 'method' => 'delete']) !!}
                                <button type="submit" class="btn btn-danger btn-sm rounded-0"><i class="mdi mdi-delete"></i></button>
                            {!! Form::close() !!}
                          </div>
                        </div>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
@endforeach
