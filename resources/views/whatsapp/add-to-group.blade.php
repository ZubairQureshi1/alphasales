<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="addGroup" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Add
                    <strong>
                        To Group
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('addtogroup') }}" method="POST">
                    @csrf
                    <input type="hidden" name="selectContacts" id="selectContacts">
                    <div class="form-group">
                        <div>
                            <label>
                                group
                            </label>
                            <select class="form-control" name="group_id">
                                <option value="">Select Group</option>
                                @foreach($groups as $gr)
                                <option value="{{$gr['id']}}">{{$gr['name']}}</option>
                                @endforeach
                            </select>
                            <br> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                            Close
                        </button>
                        <button class="btn btn-success" type="submit">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
