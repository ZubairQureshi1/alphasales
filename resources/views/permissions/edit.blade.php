@include('includes/header_start')
@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
  <li class="list-inline-item">
    <button type="button" class="button-menu-mobile open-left waves-effect">
      <i class="ion-navicon"></i>
    </button>
  </li>
  <li class="hide-phone list-inline-item app-search">
    <h3 class="page-title">Edit Permission</h3>
  </li>
</ul>
</nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->

     <div class="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card shadow">
              <div class="card-header">
                <h4 class="card-title font-weight-bold">Permission</h4>
              </div>
              <div class="card-body">
                <form action="{{ route('permissions.update', $permission->pluck('system_menu_id')->first()) }}" method="POST" id="permissionForm">
                  @csrf
                  @method('PATCH')
                  <div class="form-row">
                    <div class="form-group col-12">
                      <label>System Menu</label>
                      {!! Form::select('systemMenu', Globals::menuItems($menu->id)->pluck('label', 'id'), $permission->pluck('system_menu_id'), ['class' => 'custom-control select2', 'placeholder' => '------', 'disabled']) !!}
                    </div>
                    {{-- add new button --}}
                    <div class="form-group col-12 text-right">
                      <button type="button" class="btn btn-sm btn-primary" onclick="addPermissionColumn(event)"><i class="fa fa-plus fa-fw"></i> | Add Permission</button>
                    </div>
                    {{-- permissions --}}
                    <div class="form-group col-12">
                      <label>Permissions</label>
                      
                      <div class="list-group checkbox-list-group" id="permissionListGroup">
                        @foreach($permission as $index => $child) 
                        <div class="list-group-item" id="permissionItem_{{ $index }}">
                          <div class="input-group">
                            <input type="hidden" name="permission_ids[]" value="{{ $child->id }}">
                            <input type="text" name="permissions[]" class="form-control rounded-0 item-required" value="{{ $child->action_name }}" errorLabel="Permission name {{ $index }}">
                            <div class="input-group-append">
                              <button class="btn btn-sm btn-danger" type="button" onclick="removePermissionColumn({{ $index }})" data-id="{{ $child->id }}">
                                <i class="fa fa-times fa-fw"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <a href="{{ route('permissions.index') }}" class="btn btn-secondary"><i class="fa fa-chevron-left fa-fw"></i> Go Back</a>
                <button type="button" class="btn btn-primary" onclick="validateForm(event)"><i class="fa fa-cloud-upload fa-fw"></i> Save Changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('includes/footer_start')
<script type="text/javascript">
  var count = {!! count($permission) !!}-1;
</script>
<script src="{{ asset('js/permission/permissions.js') }}"></script>
@include('includes/footer_end')
