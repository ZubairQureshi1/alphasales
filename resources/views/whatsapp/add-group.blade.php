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
                <form action="{{ route('add-group') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div>
                            <label>
                                Name
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="--Enter name--" required="" value="" />
                            <br>
                             <label>
                                Description
                            </label>
                            <textarea class="form-control" name="description" id="description" 
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

