@include('includes/header_start')

<!-- DataTables -->
<link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/jquery-jvectormap-2.0.5.css') }}" rel="stylesheet" type="text/css" />

@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">Office Location(s)</h3>
    </li>
</ul>
@include('alertify::alertify')

<div class="clearfix"></div>
</nav>
</div>
<!-- Top Bar End -->

<!-- ==================
                         PAGE CONTENT START

                        ================== -->

<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <button type="button"
                        class="btn btn-primary btn-sm waves-effect waves-light pull-right m-b-10 m-t-15-negative"
                        data-toggle="modal" data-target="#createOrganization"><i class="fa fa-plus"></i> |
                        Create</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>City</th>
                                    <th>Projects</th>
                                    <th>Organization</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($organizationOfficeLocation as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->code }}</td>
                                    <td>{{ $row->city_name }}</td>
                                    <td>
                                        @if ($row->organizationCampusWings->count() > 0)
                                            @foreach ($row->organizationCampusWings as $organization_campus_wing)
                                            @if(!empty($organization_campus_wing->wing->name))
                                                {{ $organization_campus_wing->wing->name }},
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $row->organization_name }}</td>
                                    <td>{{ $row->address }}</td>
                                    <td>
                                        <div class="btn-toolbar" role="toolbar"
                                            aria-label="Toolbar with button groups">
                                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                                {!! Form::open(['route' => ['organizationOfficeLocation.destroy', $row->id], 'method' => 'delete']) !!}
                                                <input type="hidden" name="org_id" value="{{ $row->id }}" />
                                                <button
                                                    href="{{ route('organizationOfficeLocation.destroy', $row['id']) }}"
                                                    class="btn btn-danger btn-sm"><i
                                                        class='mdi mdi-delete'></i></button>
                                                {!! Form::close() !!}
                                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#edit_{{ $index }}"><i
                                                        class="mdi mdi-pencil"></i></button>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @include(
                                    'organizationManagement.campuses.edit-organization-campus'
                                )
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include(
    'organizationManagement.campuses.add-organization-campus'
)

@include('includes/footer_start')

<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery-jvectormap-2.0.5.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/world_map.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $('.select2').select2()
</script>
<script>
    $(function() {

        var plants = [{
                name: 'Myanmar',
                coords: [21.9162, 95.9560],
                offsets: [10, 12]
            },
            {
                name: 'Philippines',
                coords: [12.8797, 121.7740],
                offsets: [0, 2]
            },
            {
                name: 'Cambodia',
                coords: [12.5657, 104.9910],
            },
            {
                name: 'Indonesia',
                coords: [0.7893, 113.9213],
            },
            {
                name: 'Pakistan',
                coords: [30.3753, 69.3451],
            },
            {
                name: 'Sri Lanka',
                coords: [7.8731, 80.7718],
            },
            {
                name: 'Maldives',
                coords: [3.2028, 73.2207],
            },
            {
                name: 'Zambia',
                coords: [13.1339, 27.8493],
            },
            {
                name: 'Nigeria',
                coords: [9.0820, 8.6753],
            },
            {
                name: 'Sierra Leone',
                coords: [8.4606, 11.7799],
            },
        ];
        $('#world-map').vectorMap({
            map: 'world_mill',
            backgroundColor: '#fff',
            regionStyle: {
                initial: {
                    fill: '#1979f5'
                },
                hover: {
                    fill: "#388bfd"
                }
            },
            markers: plants.map(function(h) {
                return {
                    name: h.name,
                    latLng: h.coords,
                    style: {
                        r: 8,
                        fill: '#fe0103'
                    }
                }
            }),
            labels: {
                markers: {
                    render: function(index) {
                        return plants[index].name;
                    },

                }
            },
        });
    });
</script>
@include('includes/footer_end')
