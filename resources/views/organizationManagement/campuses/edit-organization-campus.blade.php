<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="edit_{{ $index }}"
    role="dialog" tabindex="-1">
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

                {!! Form::model($organizationOfficeLocation, ['route' => ['organizationOfficeLocation.update', $row->id], 'method' => 'patch']) !!}
                @csrf
                <div class="form-group">
                    <div>

                        <label>
                            Organization
                        </label>
                        @if (App\Models\Organization::count() > 0)
                            {!! Form::select('organization_id', App\Models\Organization::pluck('name', 'id'), $row->organization_id, ['id' => 'organization_id', 'required', 'class' => 'form-control select2', 'placeholder' => '--- Select Campus City ---']) !!}
                        @else
                            <h4 class="text-danger">Create Organization First To Proceed</h4>
                        @endif
                        <br>
                        <label>
                            Name
                        </label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="--Enter Campus Name--" value="{{ $row->name }}" />
                        <br>
                        <label>
                            Code
                        </label>
                        <input type="text" class="form-control" id="code" name="code"
                            placeholder="--Enter Campus Code--" value="{{ $row->code }}" />
                        <br>
                        <label>
                            City
                        </label>
                        {!! Form::select('city_id', App\Models\City::pluck('name', 'id'), $row->city_id, ['id' => 'city_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Campus City ---']) !!}
                        <br>
                        <label>
                            Address
                        </label>
                        <input type="text" class="form-control" id="address" name="address"
                            placeholder="--Enter Address--" required="" value="{{ $row->address }}" />
                        <label>
                            Projects
                        </label><br>
                        @foreach ($wings as $wing)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="wing_ids[]"
                                    id="{{ $row->id . '_' . $wing->id }}"
                                    @foreach ($row->organizationCampusWings as $organization_campus_wing) {{ $organization_campus_wing->wing_id == $wing->id ? 'checked' : '' }} @endforeach
                                    value="{{ $wing->id }}">
                                <label class="custom-control-label"
                                    for="{{ $row->id . '_' . $wing->id }}">{{ $wing->short_name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @if (App\Models\Organization::count() > 0)
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal" type="button">
                                Close
                            </button>
                            <button class="btn btn-success" type="submit">
                                Update
                            </button>
                        </div>
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
