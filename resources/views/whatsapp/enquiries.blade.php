@include('includes/header_start')
<!-- DataTables -->
<link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
<!-- Responsive datatable examples -->
<link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/treeview.css" rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css" rel="stylesheet" type="text/css"/>
@include('includes/header_end')
<style type="text/css">
    .checkbox{
        text-align: center;
    }
</style>
    <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Contact Us Lead List</h3>
            </li>
        </ul>
        @include('alertify::alertify')
        <div class="clearfix"></div>
    </nav>
</div>

<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body table-responsive">
                        <table id="contacts" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="checkbox"><input  class="selectAll" type="checkbox"></th>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            @foreach($contacts as $key => $value)
                            <tr id="{{$value['id']}}">
                                <td ></td>
                                <td>{{$value['id']}}</td>
                                <td>{{$value['name']}}</td>
                                <td>{{$value['email']}}</td>
                                <td>{{$value['phone_number']}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- @include('organizationManagement.organizations.add-organization') -->
@include('includes/footer_start')
<script src="assets/plugins/datatables/jquery.dataTables.min.js">
</script>
<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js">
</script>
<!-- Buttons examples -->
<script src="assets/plugins/datatables/dataTables.buttons.min.js">
</script>
<script src="assets/plugins/datatables/buttons.bootstrap4.min.js">
</script>
<script src="assets/plugins/datatables/jszip.min.js">
</script>
<script src="assets/plugins/datatables/pdfmake.min.js">
</script>
<script src="assets/plugins/datatables/vfs_fonts.js">
</script>
<script src="assets/plugins/datatables/buttons.html5.min.js">
</script>
<script src="assets/plugins/datatables/buttons.print.min.js">
</script>
<script src="assets/plugins/datatables/buttons.colVis.min.js">
</script>
<!-- Responsive examples -->
<script src="assets/plugins/datatables/dataTables.responsive.min.js">
</script>
<script src="assets/plugins/datatables/responsive.bootstrap4.min.js">
</script>
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}">
</script>
<script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript">
</script>
<!-- Datatable init js -->
<script src="assets/pages/datatables.init.js">
</script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js">  
</script>
<script src="assets/plugins/datatables/dataTables.select.min.js">
</script>
<script type="text/javascript">
    var contactsTable = $('#contacts').DataTable( {
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]]
    } );
    function checkSelected(){
        var selectedrow = contactsTable.rows({ selected: true } ).ids().toArray();
        // console.log("contactsTable" , selectedrow);
        if(selectedrow.length > 0){
            $("#selectedIds").val(selectedrow.join(','));
            $("#sendMessage").modal("show");
        }else{
            alert("Please Select Contacts To Send Message");
        }
    }
    $(".selectAll").on( "click", function(e) {
        if ($(this).is( ":checked" )) {
            contactsTable.rows(  ).select();        
        } else {
            contactsTable.rows(  ).deselect(); 
        }
    });
</script>
@include('includes/footer_end')
@include('alertify::alertify')