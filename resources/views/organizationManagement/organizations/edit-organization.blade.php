<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="edit_{{$index}}" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                  Edit
                  <strong>
                      Location(s)
                  </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                  ×
                </button>
             </div>
            <div class="modal-body">

                {!! Form::model($organizations, ['route' => ['organizations.update', $row->id], 'method' => 'patch']) !!}
                    @csrf
                    <div class="form-group">
                      <div>
                        <label>
                          Name
                        </label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="--Enter Organization Name--" required="" value="{{$row->name}}" />
                        <br>
                        <label>
                          Short Name
                        </label>
                        <input type="text" class="form-control" id="short_name" name="short_name" placeholder="--Enter Company Short Name--" required="" value="{{ $row->short_name }}" />
                        <br>
                        <label>
                          Description
                        </label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="--Enter Description--" value="{{ $row->description }}" />
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                                  Close
                        </button>
                        <button class="btn btn-success" type="submit">
                                  Update
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
