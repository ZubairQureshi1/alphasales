@include('includes/header_start')

<!-- DataTables -->
<link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@include('alertify::alertify')

@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">Enquiries</h3>
    </li>
</ul>

<div class="clearfix"></div>
</nav>

</div>
<!-- Top Bar End -->

<!-- PAGE CONTENT START -->
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                @include('layouts/live_search_filters')
            </div>
        </div>

        <div class="row">
            @can('create_enquiries_management')
                <div class="col-12 pull-right">
                    <a class="btn btn-outline-dark btn-sm waves-effect waves-light pull-right mb-3"
                        href="{{ route('enquiries.create') }}">
                        <i class="fa fa-plus"></i>
                        <b>|</b>
                        Add New Enquiry
                    </a>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                    <h4 class="m-3">All Enquiries List</h4>
                        <div class="card-body buttons-group-mobile">
                            @include('layouts/generic_data_table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('enquiries/import')
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
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="assets/pages/datatables.init.js"></script>
<script type="text/javascript">
    
      function assignEnqId(id = 0){
        if(id != 0){

            $("#enquiry_ids").val(id);
        
        }else{

            var values = $("input[name='enqIds[]']").map(function(){
                if(this.checked){
                    return $(this).val();
                }
            }).get().join(',');
            
            if(values){
                $("#enquiry_ids").val(values);
                $('#assignToUser').modal('show');
            }else{
                alert("select records");
            }
        }
      }
     function checkall(that){
        console.log(that.checked);
        if(that.checked){
            $(".checkboxsingle").prop("checked" , true);
        }else{
            $(".checkboxsingle").prop("checked" , false);
        }
     }
</script>
    @include('includes/footer_end')
