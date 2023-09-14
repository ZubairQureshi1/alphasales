<div class="row">
    <!-- Name Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter Role Name']) !!}
    </div>

    <div class="form-group col-sm-12">

        @foreach(Globals::menuItems($menu->id) as $key => $item)
            <div id="accordion" role="tablist">
                <div class="card">
                    {{-- check if item has child (show only parent) --}}
                    @if($item->parent == 0 && $item->depth == 0)
                        <div class="custom-accordion" role="tab" id="heading{!!$key!!}">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#collapse{!!$key!!}" aria-expanded="true" aria-controls="collapse{!!$key!!}">
                                    {!! ucfirst($item->label) !!}
                                </a>
                                <label class="float-right">
                                     <input type="checkbox" onclick="selectAllCheckbox('{{Illuminate\Support\Str::snake($item->label)}}')"> Select all
                                </label>
                            </h5>
                        </div>

                        <div id="collapse{!!$key!!}" class="collapse panel" role="tabpanel" aria-labelledby="heading{!!$key!!}" data-parent="#accordion">
                            <div class="card-body">
                                {{-- loop through permissions --}}
                                <div class="parentCheckBox {{ count($item->child) > 0 ? 'mb-3' : ''}}">
                                    @foreach(Globals::menuPermissions($item->id) as $permission)
                                        {!! Form::checkbox('permission[]', $permission->name, $permission->isChecked, ['class' => 'btn.active '.Illuminate\Support\Str::snake($item->label)]) !!}
                                        {!! $permission->action_name !!}
                                    @endforeach
                                </div>
                                {{-- if child exists loop through all items --}}
                               @foreach($item->child as $index => $child) 
                                   <div class="custom-accordion" role="tab" id="headingChild{{Illuminate\Support\Str::snake($child->label).'_'.$index}}">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" href="#collapseChild{{Illuminate\Support\Str::snake($child->label).'_'.$index}}" aria-expanded="true" aria-controls="collapseChild{{Illuminate\Support\Str::snake($child->label).'_'.$index}}">
                                                {!! ucfirst($child->label) !!}
                                            </a>
                                            <label class="float-right">
                                                <input type="checkbox" onclick="selectAllCheckbox('{{Illuminate\Support\Str::snake($child->label)}}')"> Select all
                                            </label>
                                        </h5>
                                    </div>

                                    <div id="collapseChild{{Illuminate\Support\Str::snake($child->label).'_'.$index}}" class="collapse panel" role="tabpanel" aria-labelledby="headingChild{{Illuminate\Support\Str::snake($child->label).'_'.$index}}" data-parent="#accordion">
                                        <div class="card-body">
                                            {{-- loop through child  permissions --}}
                                            <div class="childCheckBox my-2">
                                                @foreach(Globals::menuPermissions($child->id) as $perm)
                                                    {!! Form::checkbox('permission[]', $perm->name, $perm->isChecked, ['class' => 'btn.active '.Illuminate\Support\Str::snake($child->label)]) !!}
                                                    {!! $perm->action_name !!}
                                                @endforeach
                                            </div>
                                            {{-- Second Level Child --}}
                                            @foreach($child->child as $secondindex => $secondChild) 
                                            <div class="custom-accordion" role="tab" id="headingChild{{Illuminate\Support\Str::snake($secondChild->label).'_'.$secondindex}}">
                                                <h5 class="mb-0">
                                                    <a data-toggle="collapse" href="#collapseChild{{Illuminate\Support\Str::snake($secondChild->label).'_'.$secondindex}}" aria-expanded="true" aria-controls="collapseChild{{Illuminate\Support\Str::snake($secondChild->label).'_'.$secondindex}}">
                                                        {!! ucfirst($secondChild->label) !!}
                                                    </a>
                                                    <label class="float-right">
                                                        <input type="checkbox" onclick="selectAllCheckbox('{{Illuminate\Support\Str::snake($secondChild->label)}}')"> Select all
                                                    </label>
                                                </h5>
                                            </div>

                                            <div id="collapseChild{{Illuminate\Support\Str::snake($secondChild->label).'_'.$secondindex}}" class="collapse panel" role="tabpanel" aria-labelledby="headingChild{{Illuminate\Support\Str::snake($secondChild->label).'_'.$secondindex}}" data-parent="#accordion">
                                                <div class="card-body">
                                                    {{-- loop through child  permissions --}}
                                                    <div class="childCheckBox my-2">
                                                        @foreach(Globals::menuPermissions($secondChild->id) as $perm)
                                                        {!! Form::checkbox('permission[]', $perm->name, $perm->isChecked, ['class' => 'btn.active '.Illuminate\Support\Str::snake($secondChild->label)]) !!}
                                                        {!! $perm->action_name !!}
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                               @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach


    </div>
    <div class="col-sm-12">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <button type="cancel" href="{{ route('roles.index') }}" class="btn btn-secondary m-l-5">Close</button>
    </div>
</div>