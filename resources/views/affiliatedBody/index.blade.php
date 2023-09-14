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
        <h3 class="page-title">Developer(s)</h3>
    </li>
</ul>

<div class="clearfix"></div>
</nav>

</div>
<style type="text/css">
.dt-buttons
{
    display: none;
    }</style>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->

<div class="page-content-wrapper" id="subjects">

    <div class="container-fluid">

        <div class="modal fade create_subect_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Add<strong> Developer(s)</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="POST" action="{{ route('affiliatedBody.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <div>
                                    <input data-parsley-type="name" type="text" class="form-control" required
                                        name="name" id="name" placeholder="Enter Name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Code</label>
                                <div>
                                    <input data-parsley-type="code" type="text" class="form-control" required
                                        name="code" id="code" placeholder="Enter Code" />
                                </div>
                            </div>
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
                            <div class="form-group text-right">
                                {{-- <button class="btn btn-primary btn-sm" onclick="addNewCheckList()">
                                    <i class="fa fa-plus fa-fw fa-sm"></i> |&nbsp; Add Checklist
                                </button> --}}
                            </div>
                            <hr>
                            {{-- dynamic content --}}
                            <div id="checkList" class="form-row"></div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        {{-- thi model is generated for affiliatedBody edit. On click edit butoon this open through javascript --}}


        <div class="row">
            <div class="col-12 pull-right">

                <button type="button" id="add"
                    class="btn btn-primary btn-sm waves-effect waves-light pull-right m-b-10 m-t-15-negative"
                    data-toggle="modal" data-target=".create_subect_model"><i class="fa fa-plus"></i> Add
                    New</button>
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

                        @if (count($affiliatedBodies) > 0)
                            <div class="table-responsive">
                                <table id="datatable-buttons" isDefault="true"
                                    class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th class="text-center" style="width: 10%">Code</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($affiliatedBodies as $index => $affiliatedBody)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $affiliatedBody->name }}</td>
                                                <td class="text-primary">{{ $affiliatedBody->code }}</td>
                                                <td>
                                                    <div class="btn-toolbar" role="toolbar"
                                                        aria-label="Toolbar with button groups">
                                                        <div class="btn-group mr-2" role="group"
                                                            aria-label="First group">

                                                            {{-- For Editing a specific object/row --}}

                                                            <button type="button" data-toggle="modal"
                                                                data-target="#edit_{{ $index }}"
                                                                class="btn btn-primary btn-sm"
                                                                onclick="updateEditCount({{ count($affiliatedBody->checklists) }})"><i
                                                                    class="mdi mdi-pencil"></i></button>


                                                            <div class="modal fade update_subect_model"
                                                                id="edit_{{ $index }}" tabindex="-1"
                                                                role="dialog" aria-labelledby="mySmallModalLabel"
                                                                aria-hidden="true">
                                                                <div
                                                                    class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title mt-0">Update<strong>
                                                                                    Developer(s)</strong></h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            {!! Form::open(['route' => ['affiliatedBody.update', $affiliatedBody->id], 'method' => 'patch']) !!}
                                                                            <div class="form-group">
                                                                                <label>Name</label>
                                                                                <input type="text"
                                                                                    class="form-control" name="name"
                                                                                    id="update_body_name"
                                                                                    value="{{ $affiliatedBody->name }}"
                                                                                    placeholder="Enter Name" required />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Code</label>
                                                                                <input type="text"
                                                                                    class="form-control" name="code"
                                                                                    value="{{ $affiliatedBody->code }}"
                                                                                    placeholder="Enter Code" required />
                                                                            </div>
                                                                            <label>
                                                                                Organization
                                                                            </label>
                                                                            <select class="form-control select2" id="organization_id" name="organization_id">
                                                                                <option selected="" disabled="">--Select organization--</option>
                                                                                @foreach ($organizations as $key => $orgn)
                                                                                    <option value="{{ $orgn['id'] }}" @if($affiliatedBody->organization_id == $orgn['id']) selected @endif >{{ $orgn['name'] }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <label>
                                                                                Offices
                                                                            </label>
                                                                            <select class="form-control select2" id="office_id" name="office_id">
                                                                                <option selected="" disabled="">--Select office--</option>
                                                                                @foreach ($offices as $key => $off)
                                                                                    <option value="{{ $off['id'] }}" @if($affiliatedBody->organization_campus_id == $off['id']) selected @endif>{{ $off['name'] }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <br>
                                                                            <div class="form-group text-right">
                                                                                {{-- <button class="btn btn-primary btn-sm"
                                                                                    onclick="editAddNewCheckList({{ $index }})">
                                                                                    <i
                                                                                        class="fa fa-plus fa-fw fa-sm"></i>
                                                                                    |&nbsp; Add Checklist
                                                                                </button> --}}
                                                                            </div>
                                                                            <hr>
                                                                            <div id="editCheckListDiv_{{ $index }}"
                                                                                class="form-row">
                                                                                @foreach ($affiliatedBody->checklists as $key => $checklist)
                                                                                    <div class="col-12"
                                                                                        id="editCheckList_{{ $key }}">
                                                                                        <div class="input-group mb-3">
                                                                                            <textarea
                                                                                                class="form-control rounded-0"
                                                                                                rows="3"
                                                                                                name="checklists[]"
                                                                                                placeholder="Enter Checklist Description..."
                                                                                                style="resize: none;"
                                                                                                required>{{ $checklist->description }}</textarea>
                                                                                            <div
                                                                                                class="input-group-append">
                                                                                                <button
                                                                                                    onclick="remvoeEditCheckList({{ $key }})"
                                                                                                    data-row="{{ $key }}"
                                                                                                    class="btn btn-link text-danger btn-sm rounded-0"><i
                                                                                                        class="fa fa-times fa-fw"></i></button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Update</button>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close</button>
                                                                            </div>
                                                                            {{ Form::close() }}
                                                                        </div>
                                                                    </div><!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->
                                                            </div><!-- /.modal -->

                                                            {{-- For Editing a specific object/row ends here --}}
                                                            {!! Form::open(['route' => ['affiliatedBody.destroy', $affiliatedBody->id], 'method' => 'delete']) !!}
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
                            No Affiliated Body found
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
<script src="{{ asset('js/affiliatedBodies/afiliated_bodies.js') }}"></script>
<script type="text/javascript">
    var edit_count_checklist = 0;

    function updateEditCount(edit_count) {
        edit_count_checklist = edit_count;
    }
</script>


@include('includes/footer_end')
