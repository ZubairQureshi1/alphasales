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
                    <h3 class="page-title">Locations</h3>
                    </li>
                    </ul>
                        @include('alertify::alertify')

                    <div class="clearfix"></div>
                    </nav>
                    </div>
                    <div class="page-content-wrapper">
                    <div class="container-fluid">
                    <div class="row">
                    <div class="col-4 pull-right">
                    <div class="row">
                    <div class="col-12">
                    @csrf()
                    <div class="form-group">
                    <button type="button" class="btn btn-primary" class="btn btn-primary waves-effect waves-light m-b-10 m-t-15-negative"  data-toggle="modal" data-target=  "#createlocation">Create<i class="fa fa-plus-circle" style="padding: 10px;"></i></button>
                                                   
                    </div>
                </div>
            </div>
            <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="createlocation" role="dialog" tabindex="-1">
           <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
           <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Add
                    <strong>
                        Locations
                    </strong>
                </h5>
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
            </button>
            </div>
            <div class="modal-body">
            <form action="{{route('location.store')}}" method="POST">
            @csrf
            <div class="form-group">
            <div>
            <label>
            Address
            </label>
            <input type="text" class="form-control" id="address" name="address"/> <br>
            <label>
            Company
            </label>
            <select class="form-control select2" name="selected_company">
            <option value="">--Select Company--</option>
            @foreach($companies as $row){
            <option value="{{$row->id}}">{{$row->company_name}}</option>
                            }
            @endforeach

            </select>
            <br>
            <label>
            Branch
            </label>  
            <select class="form-control select2" name="select_branch">
            <option value="">--Select Branch_code--</option>
            @foreach($branches as $row){
            <option value="{{$row->id}}">{{$row->branch_code}}</option>
                            }
                         @endforeach

            </select>
            </div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="submit">
                            Save
            </button>
            <button class="btn btn-secondary" data-dismiss="modal" type="button">
                            Close
            </button>
            </div>
            </form>
            </div>
            </div>
            </div>
        </div>
     </div>
    </div>

  <table class="table">
  <thead>
  <tr>
  <th>Branch Code</th>
  <th>Address</th>
  <th>Action</th>
  </tr>
  </thead>
  @foreach($locations  as $index => $row)
  <tr>
  <td>{{$row->branch_code}}</td>
  <td>{{$row->address}}</td>
  <td>
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <div class="btn-group mr-2" role="group" aria-label="First group">
    <a href="{{route('location.delete',  $row['id'])}}" class="btn btn-danger btn-sm"><i class='mdi mdi-delete'></i></a>
    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editlocation_{{ $index }}" ><i class="mdi mdi-pencil"></i></button>
     <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="editlocation_{{ $index }}" role="dialog" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
     <div class="modal-header">
     <h5 class="modal-title mt-0">
                Edit
                    <strong>
                        Location
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
     </div>
     <div class="modal-body">
     <form action="{{route('location.update', $row->id)}}" method="POST">
             @csrf
    <div class="form-group">
    <div>
    <label>
        Address
    </label>
    <input type="text" class="form-control" value="{{ $row->address }}" id="address" name="address"/> 
                           
     </div>
     <div class="modal-footer">
     <button class="btn btn-secondary" type="submit">
                            Save Changes
     </button>
     <button class="btn btn-secondary" data-dismiss="modal" type="button">
                            Close
     </button>
     </div>
     </form>
     </div>
     </div>
     </div>
</div>
</div>
</div>
</td>
</tr>
@endforeach

</table> 
</div>
</div>
@include('includes/footer_start')
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
        <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
        <script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

@include('includes/footer_end')

