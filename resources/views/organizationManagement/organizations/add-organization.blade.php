<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="createOrganization" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Add
                    <strong>
                        Location(s)
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('organizations.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div>
                            <label>
                                Name
                            </label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="--Enter Organization Name--" required="" />
                            <br>

                            <label>
                                Short Name
                            </label>
                            <input type="text" class="form-control" id="short_name" name="short_name" placeholder="--Enter Company Short Name--" required="" />
                            <br>

                            <label>
                                Description
                            </label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="--Enter Description--"  />
                        </div>
                        <div class="modal-footer">

                            <button class="btn btn-secondary" data-dismiss="modal" type="button">
                                Close
                            </button>
                            <button class="btn btn-success" type="submit">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
