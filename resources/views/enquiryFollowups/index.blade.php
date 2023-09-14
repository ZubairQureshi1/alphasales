@include('includes/header_start')
        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css" rel="stylesheet" type="text/css"/>
@include('includes/header_end')

             <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Follow Up</h3>
            </li>
        </ul>
        <div class="clearfix"></div>
    </nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->

<div class="page-content-wrapper" id="followups">
  <div class="container-fluid">
    @include('layouts/live_search_filters')
    <div class="row m-b-10 m-t-20-negative p-20">
      <div class="col-5"></div>
      <div class="col-5"></div>
      <div class="col-2">
        {{-- <a href="{{ route('followups.exportExcel') }}" class="btn btn-info btn-xs waves-effect pull-right">
             <i class="mdi mdi-file-excel"></i> Export To Excel
        </a> --}}
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card m-b-30">
            <h4 class="m-3">All Follow-ups List</h4>
          <div class="card-body">
            @include('layouts/generic_data_table')
          </div>
        </div> <!-- end col -->
      </div>
    </div>
  </div>
</div>

@include('enquiryFollowups.asign')
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
        <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>

    <!-- Datatable init js -->
    <script src="assets/pages/datatables.init.js"></script>
    <script src="assets/plugins/datatables/dataTables.select.min.js">
    </script>
    <script type="text/javascript">
  
      var template = '{{json_encode(config('constants'))}}';
      var constants = JSON.parse(template.replace(/&quot;/g,'"'));
      
      function assignEnqId(id  =0, followupid=0){
        if(id != 0){

            $("#enquiry_ids").val(id);
            $("#followup_ids").val(followupid);
        
        }else{

            var values = $("input[name='enqIds[]']").map(function(){
                if(this.checked){
                    return $(this).val();
                }
            }).get();
            // .join(',')
            var enqids = [];
            var followupids = [];
            if(values.length >0){
                for (var i = values.length - 1; i >= 0; i--) {
                      var a= values[i].split("|");
                      enqids.push(a[0]);
                      followupids.push(a[1]);
                }  
                // console.log(enqids , followupids);
                $("#enquiry_ids").val(enqids.join(","));
                $("#followup_ids").val(followupids.join(","));
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