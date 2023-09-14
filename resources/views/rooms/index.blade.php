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
                <h3 class="page-title">Rooms</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->

<div class="page-content-wrapper" id="subjects">

    <div class="container-fluid">

        <div class="modal fade create_room_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Add<strong> Rooms</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form class="" method="POST" action="{{ route('rooms.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>Room Name</label>
                                <div>
                                    <input data-parsley-type="name" type="text"
                                           class="form-control" required
                                           name="name" id="name"
                                           placeholder="Enter Name"/>
                                </div>
                                <label>Sitting Capasity</label>
                                <div>
                                    <input data-parsley-type="sitting_capacity" type="text"
                                           class="form-control" required
                                           name="sitting_capacity" id="sitting_capacity"
                                           placeholder="Enter Sitting Capasity"/>
                                </div>
                                <label>Facilities</label>
                                @php $i = 0; @endphp
                                @foreach(\Config::get('constants.facilities') as $key => $facility)
                                <div>
                                    @php $i++; @endphp
                                    <input type="checkbox"name="facilities[]" id="facilities" value="{{ $key }}"/>
                                    <label>{{ $facility }}</label>
                                    {{-- <option value="{{$key}}" {{ $data ? $data['district'] == $key ? 'selected' : '' : ''}}>{{$districtName}}</option> --}}
                                </div>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        {{-- thi model is generated for subjects edit. On click edit butoon this open through javascript --}}


        <div class="row">
            <div class="col-12 pull-right">

                <button type="button" id="add" class="btn btn-primary waves-effect waves-light pull-right m-b-10 m-t-15-negative"  data-toggle="modal" data-target=".create_room_model">Add New</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                      <!--   <h4 class="mt-0 header-title">Buttons example</h4>
                        <p class="text-muted m-b-30 font-14">The Buttons extension for DataTables
                            provides a common set of options, API methods and styling to display
                            buttons on a page that will interact with a DataTable. The core library
                            provides the based framework upon which plug-ins can built.
                        </p> -->

                        @if(count($rooms)!=0)
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        @foreach ($room_keys as $key)
                                        @if($key == "name" || $key == "id" || $key == "sitting_capacity")
                                        <th> {{ $key }}</th>
                                        @endif
                                        @endforeach
                                        <th> Actions</th>
                                    </tr>
                                </thead>

                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        @foreach ($room_keys as $key)
                                        @if($key == "name")
                                            <td>{{ $room[$key] }}</td>
                                        @elseif ($key == "id")
                                            <td>{{ $room[$key] }}</td>
                                             @elseif ($key == "sitting_capacity")
                                            <td>{{ $room[$key] }}</td>
                                        @endif
                                        @endforeach
                                        <td>
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">

                                                    {{-- For Editing a specific object/row --}}

                                                    <button type="button" data-toggle="modal" data-target="#{{ $room['replaced_name'] }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button>


                                                    <div class="modal fade update_subect_model" id="{{ $room['replaced_name'] }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0">Update<strong> Rooms</strong></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p></p>
                                                                    {!! Form::open(['route' => ['rooms.update', $room['id']], 'method' => 'patch']) !!}
                                                                        <div class="form-group">
                                                                            <label>Name</label>
                                                                            <div>
                                                                                <input data-parsley-type="name" type="text"
                                                                                       class="form-control" required
                                                                                       name="name" id="update_room_name"
                                                                                       value="{{ $room['name'] }}"
                                                                                       placeholder="Enter Name"/>
                                                                            </div>
                                                                            <label>sitting_capacity</label>
                                                                            <div>
                                                                                <input data-parsley-type="sitting_capacity" type="text"
                                                                                       class="form-control" required
                                                                                       name="sitting_capacity" id="update_room_sitting_capacity"
                                                                                       value="{{ $room['sitting_capacity'] }}"
                                                                                       placeholder="Enter sitting_capacity"/>
                                                                            </div>
                                                                            <label>Facilities</label>
                                                                            @php $i = 0; @endphp
                                                                            {{-- @php $getFacility =  \App\Models\RoomFacility::where('room_id', $room['id'])->first(); @endphp --}}
                                                                            @php $j = 1; $checkFacility = array(); @endphp
                                                                            @foreach(\Config::get('constants.facilities') as $key => $facility)
                                                                                @php $getFacilities = \App\Models\RoomFacility::where('room_id', $room['id'])->get(); @endphp
                                                                                @foreach($getFacilities as $val)
                                                                                    @if($j == 1)
                                                                                        @php $checkFacility[] = $val->facility_id @endphp
                                                                                    @endif
                                                                                @endforeach

                                                                            @php $j++; @endphp
                                                                            @endforeach
                                                                            @php $i = 0; @endphp
                                                                            @foreach(\Config::get('constants.facilities') as $key => $facility)
                                                                            <div>
                                                                                @php $i++; @endphp
                                                                                <input type="checkbox"name="facilities[]" id="facilities"
                                                                                @foreach($checkFacility as $val)
                                                                                    @if($val == $key)
                                                                                        checked
                                                                                    @endif
                                                                                @endforeach
                                                                                 value="{{ $key }}"/>
                                                                                <label>{{ $facility }}</label>
                                                                                {{-- <option value="{{$key}}" {{ $data ? $data['district'] == $key ? 'selected' : '' : ''}}>{{$districtName}}</option> --}}
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->

                                                    {{-- For Editing a specific object/row ends here --}}
                                                    {!! Form::open(['route' => ['rooms.destroy', $room['id']], 'method' => 'delete']) !!}
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        @else
                        No rooms found
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
    <script src="js/subject.js"></script>

@include('includes/footer_end')
