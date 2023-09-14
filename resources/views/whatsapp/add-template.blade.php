<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="addConcat" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Add
                    <strong>
                        Template
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add-templates') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div>
                            <label>
                                Title
                            </label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="--Enter title--" required="" value="" />
                            <br>
                             <label>
                                Messaage
                            </label>
                            <textarea class="form-control" name="message" id="message" 
                            required>Write Message Here..</textarea> 
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
