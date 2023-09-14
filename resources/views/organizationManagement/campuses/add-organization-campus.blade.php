<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="createOrganization" role="dialog">
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
                <form action="{{ route('organizationOfficeLocation.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div>
                            @if (App\Models\Organization::count() > 0)
                                <label>
                                    Organization
                                </label>
                                {!! Form::select('organization_id', App\Models\Organization::pluck('name', 'id'), App\Models\Organization::first()->id, ['id' => 'organization_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Organization ---']) !!}
                            @else
                                <h6 class="text-danger">Create Organization First To Proceed</h6>
                            @endif
                            <br>
                            <label>
                                Name
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="--Enter Office Name--" required="" />
                            <br>
                            <label>
                                Code
                            </label>
                            <input type="text" class="form-control" id="code" name="code"
                                placeholder="--Enter Office Code--" required="" />
                            <br>
                            <label>
                                City
                            </label>
                            {!! Form::select('city_id', App\Models\City::pluck('name', 'id'), null, ['id' => 'city_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Office City ---']) !!}
                            <br>
                            <label>
                                Address
                            </label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="--Enter Address--" required="" />
                            <br>
                            <label>
                                Projects
                            </label>
                            <br>
                            @foreach ($wings as $wing)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="wing_ids[]"
                                        id="{{ $wing->id }}" value="{{ $wing->id }}">
                                    <label class="custom-control-label"
                                        for="{{ $wing->id }}">{{ $wing->short_name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if (App\Models\Organization::count() > 0)
                        <div class="modal-footer">

                            <button class="btn btn-secondary" data-dismiss="modal" type="button">
                                Close
                            </button>
                            <button class="btn btn-success" type="submit">
                                Save
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
