@include('includes/header_start')

        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

@include('includes/header_end')

             <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Departments</h3>
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

        <div class="modal fade create_subect_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Add<strong> Departments</strong></h5>
                        <button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="POST" action="{{ route('departments.store') }}">
                            @csrf
                            <div class="form-group">
                                  @if (App\Models\Organization::count() > 0)
                                  <label>Organization</label>
                                  {!! Form::select('organization_id', App\Models\Organization::pluck('name', 'id'), App\Models\Organization::first()->id, ['id' => 'organization_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Organization ---', 'required']) !!}
                                  @else
                                    <h6 class="text-danger">Create Organization First To Proceed</h6>
                                  @endif
                                  @if (App\Models\Organization::count() > 0)
                                  <label>
                                    Campus
                                  </label>
                                  {!! Form::select('organization_campus_ids[]', App\Models\OrganizationCampus::pluck('name', 'id'), App\Models\OrganizationCampus::first()->id, ['id' => 'organization_campus_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Campus ---', 'required' , 'multiple']) !!}
                                  @else
                                    <h6 class="text-danger">Create Campuses First To Proceed</h6>
                                  @endif
                                <label>Name</label>
                                <div>
                                    <input data-parsley-type="name" type="text"
                                           class="form-control" required
                                           name="name" id="name"
                                           placeholder="Enter Name"/>

                                           <label>Code</label>
                                           <input data-parsley-type="code" type="text"
                                           class="form-control" required
                                           name="code" id="code"
                                           placeholder="Enter code"/>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-dark btn-sm"><i class="fa fa-plus fa-sm"></i> | Create Department</button>
                            <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw text-danger"></i> Cancel</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        {{-- thi model is generated for departments edit. On click edit butoon this open through javascript --}}

        
        <div class="row">
            <div class="col-12 pull-right">
                <button type="button" id="add" class="btn btn-dark btn-sm waves-effect waves-light pull-right mb-3"  data-toggle="modal" data-target=".create_subect_model">
                  <i class="fa fa-plus fa-fw"></i>
                  <b>|</b>
                  Add new Department
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body buttons-group-mobile">

                      <!--   <h4 class="mt-0 header-title">Buttons example</h4>
                        <p class="text-muted m-b-30 font-14">The Buttons extension for DataTables
                            provides a common set of options, API methods and styling to display
                            buttons on a page that will interact with a DataTable. The core library
                            provides the based framework upon which plug-ins can built.
                        </p> -->

                        @if(count($departments)!=0)
                        <div class=" table-responsive">
                            <table id="datatable-buttons"  isDefault="true" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        @foreach ($department_keys as $index => $key)
                                        @if($key == "name" || $key == "organization_id" || $key == "organization_campus_id" || $key == "code")
                                        <th> {{ ucwords(str_replace(' id', '', str_replace('_', ' ', $key))) }}</th>
                                        @endif
                                        @endforeach
                                        <th style="width: 5%; text-align: center;">Actions</th>
                                    </tr>
                                </thead>

                            <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        @foreach ($department_keys as $key)
                                        @if($key == "name")
                                            <td>{{ $department[$key] }}</td>
                                        @elseif ($key == "organization_name")
                                            <td>{{ $department[$key] }}</td>
                                        @elseif ($key == "organization_campus_name")
                                            <td>{{ $department[$key] }}</td>
                                        @elseif ($key == "code")
                                            <td>{{ $department[$key] }}</td>
                                        @endif
                                        @endforeach
                                        <td>
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">

                                                    {{-- For Editing a specific object/row --}}

                                                    <button type="button" data-toggle="modal" data-target="#{{ $department['id'] }}" class="btn btn-primary btn-sm"><i class="mdi mdi-pencil"></i></button>

                                                    
                                                    <div class="modal fade update_subect_model" id="{{ $department['id'] }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0">Update<strong> {{ $department['name'] }}</strong> Department</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {!! Form::open(['route' => ['departments.update', $department['id']], 'method' => 'patch']) !!}
                                                                          <div class="form-row">
                                                                            @if (App\Models\Organization::count() > 0)
                                                                              <div class="form-group col-6">
                                                                                <label>Organization</label>
                                                                                {!! Form::select('organization_id', App\Models\Organization::pluck('name', 'id'), $department['organization_id'], ['id' => 'organization_id', 'class' => 'form-control select2', 'placeholder' => '------', 'disabled']) !!}
                                                                              </div>
                                                                              @else
                                                                                <h6 class="text-danger">Create Organization First To Proceed</h6>
                                                                              @endif
                                                                              @if (App\Models\Organization::count() > 0)
                                                                              <div class="form-group col-6">
                                                                                <label>Campus</label>
                                                                                {!! Form::select('organization_campus_id', App\Models\OrganizationCampus::pluck('name', 'id'), $department['organization_campus_id'], ['id' => 'organization_campus_id', 'class' => 'form-control select2', 'placeholder' => '------', 'disabled']) !!}
                                                                              </div>
                                                                              @else
                                                                                <h6 class="text-danger">Create Campuses First To Proceed</h6>
                                                                              @endif
                                                                          </div>
                                                                          <div class="form-group">
                                                                            <label>Name</label>
                                                                            <input data-parsley-type="name" type="text" class="form-control" required name="name" id="update_department_name" value="{{ $department['name'] }}" placeholder="Enter Name"/>
                                                                          </div>
                                                                          <div class="form-group">
                                                                            <label>Code</label>
                                                                            <input data-parsley-type="code" type="text" class="form-control" required name="code" id="update_department_code" value="{{ $department['code'] }}" placeholder="Enter code"/>
                                                                          </div>
                                                                        <div class="mt-3">
                                                                          <button type="submit" class="btn btn-primary"><i class="fa fa-cloud-upload fa-fw"></i> Update</button>
                                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->

                                                    @if ($department['is_active'] == 1)
                                                    <a href="{{ route('departments.deactivateDepartment', $department['id']) }}" class="btn btn-dark btn-sm">In-Active</a>
                                                    @elseif ($department['is_active'] == 0)
                                                    <a href="{{ route('departments.activateDepartment', $department['id']) }}" class="btn btn-dark btn-sm">Activate</a>
                                                    @endif

                                                    {{-- For Editing a specific object/row ends here --}}
                                                    {!! Form::open(['route' => ['departments.destroy', $department['id']], 'method' => 'delete']) !!}
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="typcn typcn-delete-outline"></i></button>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                            </div>
                        @else
                          No Departments found
                        @endif

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
@include('includes/footer_start')

    <!-- Required datatable js -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables/jszip.min.js"></script>
    <script src="assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="assets/pages/datatables.init.js"></script>
    <script src="js/department.js"></script>

@include('includes/footer_end')