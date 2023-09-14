@if(count($followups)!=0)
  <a href="{{ route('followups.exportExcel') }}">
      Download Excell
  </a>

  @foreach ($followups as $key => $followupsFromGroupBy)
                <table id="{{$key}}" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    @foreach ($followup_keys as $key)
                      @if($key != "replaced_name" &&$key != "created_at" && $key != "updated_at" && $key != "deleted_at")
                      <th> {{ $key }}</th>
                      @endif
                    @endforeach
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($followupsFromGroupBy as $index => $followup)
                    <tr>
                      @foreach ($followup_keys as $key)
                        @if($key != "id" && $key != "replaced_name" && $key != "created_at" && $key != "updated_at" && $key != "deleted_at")
                        <td>{{ $followup[$key] }}</td>
                        @elseif ($key == "id")
                        <td>{{ $index+1 }}</td>
                        @endif
                      @endforeach
                      <td>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                          <div class="btn-group mr-2" role="group" aria-label="First group">

                            {{-- For Editing a specific object/row --}}

                            <button type="button" data-toggle="modal" data-target="#{{$index+1}}" class="btn btn-primary btn-sm"><i class="mdi mdi-pencil"></i></button>
                            
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
  @endforeach
@else
  @include('includes/not_found')
@endif