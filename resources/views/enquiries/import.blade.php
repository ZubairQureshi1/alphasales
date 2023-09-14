<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="importEnqModel" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Import Enquiries
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('enquiries.ImportEnq') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div>
                            <label>
                                Choose CSV File in same format as you find in export
                            </label>
                            <input type="file" class="form-control" accept=".csv" name="csv-enquiries"
                                placeholder="--Choose CSV File--" required="" value="" />
                            <br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                            Close
                        </button>
                        <button class="btn btn-success" type="submit">
                            Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
