<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="edit_{{ $index }}"
    role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Edit
                    <strong>
                        Project(s)
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">

                {!! Form::model($wings, ['route' => ['wings.update', $row->id], 'method' => 'patch']) !!}
                @csrf
                <div class="form-group">
                    <div>
                        <label>
                            Name
                        </label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="--Enter Project Name--" required="" value="{{ $row->name }}" />
                        <br>
                        <label>
                            Short Name
                        </label>
                        <input type="text" class="form-control" id="short_name" name="short_name"
                            placeholder="--Enter Project Short Name--" required="" value="{{ $row->short_name }}" />
                        <br>
                        <label>
                            Organization
                        </label>
                        <select class="form-control select2" id="organization_id" name="organization_id">
                            <option selected="" disabled="">--Select organization--</option>
                            @foreach ($organizations as $key => $orgn)
                                <option value="{{ $orgn['id'] }}" @if($row->organization_id == $orgn['id']) selected @endif >{{ $orgn['name'] }}</option>
                            @endforeach
                        </select>
                        <label>
                            Offices
                        </label>
                        <select class="form-control select2" id="office_id" name="office_id">
                            <option selected="" disabled="">--Select office--</option>
                            @foreach ($offices as $key => $off)
                                <option value="{{ $off['id'] }}" @if($row->organization_campus_id == $off['id']) selected @endif>{{ $off['name'] }}</option>
                            @endforeach
                        </select>
                        <br>
                        <label>
                            Developer
                        </label>
                        <select class="form-control select2" id="dev_id" name="dev_id">
                            <option selected="" disabled="">--Select office--</option>
                            @foreach ($affiliatedBodies as $key => $dev)
                                <option value="{{ $dev['id'] }}" @if($row->wing_type_id == $dev['id']) selected @endif>{{ $dev['name'] }}</option>
                            @endforeach
                        </select>
                        {{-- <label>
                            Select Project Type
                        </label>
                        <select class="form-control select2" id="wing_type_id" name="wing_type_id">
                            <option selected="" disabled="">--Select Project Type--</option>
                            @foreach (\config('constants.wing_type') as $key => $wing_type)
                                <option value="{{ $key }}"
                                    {{ $key ? ($key == $row->wing_type_id ? 'selected' : '') : '' }}>
                                    {{ $wing_type }}
                                </option>
                            @endforeach
                        </select>
                        <br> --}}
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
