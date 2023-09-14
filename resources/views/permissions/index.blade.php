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
    <h3 class="page-title">Permissions</h3>
  </li>
</ul>

<div class="clearfix"></div>
</nav>

</div>
<!-- Top Bar End -->


<!-- ==================
     PAGE CONTENT START
     ================== -->
     <div class="page-content-wrapper" id="departments">
      <div class="container-fluid">
        <!-- modal -->
        <div class="modal fade create_subect_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title mt-0">Add<strong> Permission</strong></h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                <form action="{{ route('permissions.store') }}" method="POST" id="permissionForm">
                	@csrf
                  <div class="form-row">
                    <div class="form-group col-12">
                      <label>System Menu</label>
                      {!! Form::select('systemMenu', Globals::menuItems($menu->id)->pluck('label', 'id'), null, ['class' => 'custom-control select2 item-required', 'errorLabel' => 'System Menu', 'id' => 'systemMenuId', 'placeholder' => '--- Select System Menu ---']) !!}
                    </div>
                    {{-- add new button --}}
                    <div class="form-group col-12 text-right">
                      <button type="button" class="btn btn-sm btn-outline-dark" onclick="addPermissionColumn(event)">
                        <i class="fa fa-plus fa-fw"></i> | Add Permission
                      </button>
                    </div>
                    {{-- permissions --}}
                    <div class="form-group col-12">
                      <label>Permissions</label>
                      <div class="list-group checkbox-list-group" id="permissionListGroup">
                        <div class="list-group-item">
                          <input type="text" name="permissions[]" class="form-control rounded-0" value="View" readonly>
                        </div>
                        {{--  --}}
                        <div class="list-group-item">
                          <input type="text" name="permissions[]" class="form-control rounded-0" value="Create" readonly>
                        </div>
                        {{--  --}}
                        <div class="list-group-item">
                          <input type="text" name="permissions[]" class="form-control rounded-0" value="Update" readonly>
                        </div>
                        {{--  --}}
                        <div class="list-group-item">
                          <input type="text" name="permissions[]" class="form-control rounded-0" value="Delete" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-12">
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times fa-fw text-danger"></i> Cancel
                      </button>
                      <button type="submit" class="btn btn-dark btn-sm" onclick="validateForm(event)">
                        <i class="fa fa-cloud-upload fa-fw"></i> | Create Permission
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="row">
          <div class="col-12">
            <div class="card m-b-30">
              <div class="card-header clearfix">
              	<h5 class="card-title font-weight-bold float-left">System Permissions</h5>
                <button type="button" id="add" class="btn btn-outline-dark waves-effect waves-light float-right btn-sm mt-2" data-toggle="modal" data-target=".create_subect_model">
                  <i class="fa fa-plus fa-fw"></i> | Add New Permission
                </button>
              </div>
              <div class="card-body buttons-group-mobile">
							<div class="row">
								@foreach($permissions as $index => $permission)
								<div class="col-md-3 col-sm-6 col-12 mb-3">
									<div class="card shadow">
										<div class="card-header clearfix py-1">
											<h6 class="card-title font-weight-bold float-left">{{ title_case(str_replace('_', ' ', spatie\Permission\Models\Permission::where('system_menu_id', $index)->get()->first()->module_name)) }}</h6>
											<a href="{{ route('permissions.delete', $index) }}" title="Delete" class="float-right text-danger mt-2">
												<i class="fa fa-times fa-lg fa-fw"></i>
											</a>
											<a href="{{ route('permissions.edit', $index) }}" title="Edit" class="float-right text-secondary mt-2 mr-2">
												<i class="fa fa-pencil fa-lg fa-fw"></i>
											</a>
										</div>
										<div class="card-body pt-2">
											<ul class="fa-ul pl-3">
											@foreach($permission as $child)
											  <li class="mb-1">
                          <i class="fa-li fa fa-check fa-sm text-success fa-fw"></i>
                          {{ $child->action_name }}
                        </li>
											@endforeach
											</ul>
										</div>
									</div>
								</div>
								@endforeach
							</div>
              </div>
            </div>
          </div> <!-- end col -->
        </div>
      </div>
    </div>
    @include('includes/footer_start')
    <script type="text/javascript">
    	var count = 0;
    </script>
    <script src="{{ asset('js/permission/permissions.js') }}"></script>
    @include('includes/footer_end')