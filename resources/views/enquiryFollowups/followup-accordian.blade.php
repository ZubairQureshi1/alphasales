@if(count($followups)!=0)
  @foreach ($followups as $key => $followupsFromGroupBy)
    <div id="accordion" role="tablist">
      <div class="card">
        <div class="custom-accordion" id="heading{!!$key!!}" role="tab">
            <h5 class="mb-0">
              <a aria-controls="collapse{!!$key!!}" aria-expanded="true" data-toggle="collapse" href="#collapse{!!$key!!}">
                  {!! ucfirst($key) !!}
              </a>
            </h5>
        </div>
        <div aria-labelledby="heading{!!$key!!}" class="collapse panel" data-parent="#accordion" id="collapse{!!$key!!}" role="tabpanel">
          <div class="card-body ">
            <table cellspacing="0" class="table table-striped table-bordered" id="{{$key}}" width="100%">
              <thead>
                <tr>
                  @foreach ($followup_keys as $key)
                    @if($key != "replaced_name" &&$key != "created_at" && $key != "updated_at" && $key != "deleted_at")
                      <th>
                        {{ $key }}
                      </th>
                    @endif
                  @endforeach
                  <th>
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($followupsFromGroupBy as $index => $followup)
                  <tr>
                    @foreach ($followup_keys as $key)
                      @if($key != "id" && $key != "replaced_name" && $key != "created_at" && $key != "updated_at" && $key != "deleted_at")
                        <td>
                          {{ $followup[$key] }}
                        </td>
                      @elseif ($key == "id")
                        <td>
                          {{ $index+1 }}
                        </td>
                      @endif
                    @endforeach
                    <td>
                      <div aria-label="Toolbar with button groups" class="btn-toolbar" role="toolbar">
                        <div aria-label="First group" class="btn-group mr-2" role="group">
                          @if($followup['status'] == 'Interested')
                            <button class="btn btn-primary btn-sm" data-target="#enquiry_{{$followup['id']}}" data-toggle="modal" type="button">
                              <i class="mdi mdi-pencil">
                              </i>
                            </button>
                            {!! Form::open(['route' => ['followups.destroy', $followup['id']], 'method' => 'delete']) !!}
                              <button class="btn btn-danger btn-sm" type="submit">
                                <i class="typcn typcn-delete-outline">
                                </i>
                              </button>
                            {!! Form::close() !!}
                          @endif
                          <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade add_to_followup" id="enquiry_{{$followup['id']}}" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title mt-0">
                                    Add to
                                    <strong>
                                        Follow-ups
                                    </strong>
                                  </h5>
                                  <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                    ×
                                  </button>
                                </div>
                                <div class="modal-body">
                                  {!! Form::open(['route' => ['followups.store'], 'method' => 'post']) !!}
                                    <input hidden="true" id="update_course_name" name="enquiry_id" placeholder="Enter Name" value="{{ $followup['enquiry_id'] }}"/>
                                    <div class="form-group">
                                      <label>
                                        Followup Form Code
                                      </label>
                                      <div>
                                        <input class="form-control" data-parsley-type="enq_form_code" editable="false" id="update_course_name" name="enq_form_code" placeholder="Enter Name" required="" type="text" value="{{ $followup['enq_form_code'] }}"/>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                          Next Follow-Up Date
                                        </label>
                                        <div>
                                          <input class="form-control" data-date-format="YYYY-MM-DD" name="next_date" placeholder="Enter Next Follow-Up Date" required="" type="date"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      {!! Form::label('status', 'Status:') !!}
                                      {!! Form::select('status', config('constants.followup_statuses'), $followup['status_id'], ['id' => 'followup_statuses', 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Status']) !!}
                                    </div>
                                    <div class="form-group">
                                      <label>
                                        Remarks
                                      </label>
                                      <div>
                                          <input class="form-control" data-parsley-type="remarks" name="remarks" placeholder="Enter remarks" required="" type="textArea"/>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn btn-primary" type="submit">
                                        Add To Follow-ups
                                      </button>
                                      <button class="btn btn-secondary" data-dismiss="modal" type="button">
                                        Close
                                      </button>
                                    </div>
                                  {!! Form::close() !!}
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.modal -->
                        </div>
                      </div>
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
@else
  @include('includes/not_found')
@endif
