<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="createWing" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Add
                    <strong>
                        Project(s)
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('wings.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div>
                            <label>
                                Name
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="--Enter Project Name--" required="" value="{{ old('name') }}" />
                            <br>

                            <label>
                                Short Name
                            </label>
                            <input type="text" class="form-control" id="short_name" name="short_name"
                                placeholder="--Enter Project Short Name--" required="" />
                            <br>
                            <label>
                                Organization
                            </label>
                            <select class="form-control select2" id="organization_id" name="organization_id">
                                <option selected="" disabled="">--Select organization--</option>
                                @foreach ($organizations as $key => $orgn)
                                    <option value="{{ $orgn['id'] }}">{{ $orgn['name'] }}</option>
                                @endforeach
                            </select>
                            <label>
                                Offices
                            </label>
                            <select class="form-control select2" id="office_id" name="office_id">
                                <option selected="" disabled="">--Select office--</option>
                                @foreach ($offices as $key => $off)
                                    <option value="{{ $off['id'] }}">{{ $off['name'] }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label>
                                Developer
                            </label>
                            <select class="form-control select2" id="dev_id" name="dev_id">
                                <option selected="" disabled="">--Select office--</option>
                                @foreach ($affiliatedBodies as $key => $dev)
                                    <option value="{{ $dev['id'] }}">{{ $dev['name'] }}</option>
                                @endforeach
                            </select>
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
