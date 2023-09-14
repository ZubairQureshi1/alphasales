<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="edit_{{$value['id']}}"
    role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Edit
                    <strong>
                        Contact
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                 {!! Form::model($value['id'], ['route' => ['edit-templates'], 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" value="{{ $value['id'] }}">
                    <div>
                        <label>
                            Name
                        </label>
                        <input type="text" class="form-control" id="name" name="title"
                            placeholder="--Enter Title--" required="" value="{{$value['title']}}" />
                        <br>
                         <label>
                            Messaage
                        </label>
                        <textarea class="form-control" name="message" id="message" 
                        required>{{$value['message']}}</textarea> 
                        <br>
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
