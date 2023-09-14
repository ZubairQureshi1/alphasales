<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="assignToUser" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Assign
                    <strong>
                        to user
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('followups.assignEnquiry') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <div>
                            <select 
                                class="form-control" 
                                name="user_id" 
                            >
                                <option value="">Select user</option>
                                @foreach($users as $user)
                                <option value="{{$user['id']}}">{{$user['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="enquiry_ids" id="enquiry_ids">
                    <input type="hidden" name="followup_ids" id="followup_ids">
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                            Close
                        </button>
                        <button class="btn btn-success" type="submit">
                            Assign
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>