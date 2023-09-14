@include('includes/header_start')
<style type="text/css">
  input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
      /* display: none; <- Crashes Chrome on hover */
      -webkit-appearance: none;
      margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
      }
      input[type=number] {
      -moz-appearance:textfield; /* Firefox */
      }
</style>

<!-- DataTables -->
<link href="{{ asset ('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset ('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset ('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
  <li class="list-inline-item">
    <button type="button" class="button-menu-mobile open-left waves-effect">
      <i class="ion-navicon"></i>
    </button>
  </li>
  <li class="hide-phone list-inline-item app-search">
    <h3 class="page-title">Fine Payments</h3>
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
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body"><br>
                                          <div class="form-group row">
                                            <div class="col-md-4">
                                              <label class="h5">Student Name:</label>
                                              <span class="h6 font-weight-normal">Asad Aslam</span>
                                            </div>
                                            <div class="col-md-4">
                                              <label class="h5">Roll No:</label>
                                              <span class="h6 font-weight-normal">B-20325</span>
                                            </div>
                                            <div class="col-md-4">
                                              <label class="h5">Program:</label>
                                              <span class="h6 font-weight-normal">BSCS</span>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <table id="datatable" class="table table-bordered">
                                                <div class="card-header clearfix">
                                                  <h5 class="card-title float-left font-weight-bold">Attendance Fines:</h5>
                                                </div><br>
                                                <thead>
                                                <tr>
                                                      <th>No.</th>
                                                      <th>Section</th>
                                                      <th>Attendance Fine</th>
                                                      <th>Date</th>
                                                      <th>Type</th>
                                                      <th>Amount</th>
                                                      <th>Checkbox</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td><input type="Checkbox" name="" class="form-control"> </td>
                                                </tr>
                                                <tr>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td><input type="Checkbox" name="" class="form-control"> </td>
                                                </tr>
                                                <tr>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td><input type="Checkbox" name="" class="form-control"> </td>
                                                </tr>
                                                </tbody>
                                            </table>
            
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            {{-- Other Fee Fines --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <table id="datatable" class="table table-bordered">
                                                <div class="card-header clearfix">
                                                  <h5 class="card-title float-left font-weight-bold">Other Fee/Fines:</h5>
                                                </div><br>
                                                <thead>
                                                <tr>
                                                      <th>No.</th>
                                                      <th>Fee/Fine Details</th>
                                                      <th>Amount</th>
                                                      <th>Checkbox</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td><input type="Checkbox" name="" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td><input type="Checkbox" name="" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td><input type="Checkbox" name="" class="form-control"></td>
                                                </tr>
                                                </tbody>
                                            </table>
            
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            {{-- Other Fee & Fines --}}


                            {{-- Discounts --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                          <div class="card-header clearfix">
                                                  <h5 class="card-title float-left font-weight-bold">Discounts:</h5>
                                                </div><br>
                                          <div class="form-group row">
                                            <div class="col-md-4">
                                              <label class="h5">Total:</label>
                                              <input type="number" name="" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" placeholder="XXXX">
                                            </div>
                                            <div class="col-md-4">
                                              <label class="h5">Discount %:</label>
                                              <input type="number" name="" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" placeholder="XXXX">
                                            </div>
                                            <div class="col-md-4">
                                              <label class="h5">Payable:</label>
                                              <input type="number" name="" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" placeholder="XXXX">                                           
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            {{-- Discounts --}}
                            {{-- Payments --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                          <div class="card-header clearfix">
                                                  <h5 class="card-title float-left font-weight-bold">Payments:</h5>
                                                <div class="text-right float-right btn btn-dark text-white" onclick="setPaymentsHistory(event);">
                                                <i class="fa fa-eye"></i> | Payments History
                                                </div>
                                                </div><br>
                                          <div class="form-group row">
                                            <div class="col-md-2">
                                              <label class="h5">Payment Type:</label>
                                              <input type="text" name="" class="form-control" placeholder="Enter Payment Type">
                                            </div>
                                            <div class="col-md-2">
                                              <label class="h5">Current Active Installment:</label>
                                              <input type="number" name="" class="form-control" placeholder="XXXX">
                                            </div>
                                            <div class="col-md-2">
                                              <label class="h5">Total:</label>
                                              <input type="number" name="" class="form-control" placeholder="XXXX">                                           
                                            </div>
                                            <div class="col-md-2">
                                              <label class="h5">Chalan No:</label>
                                              <input type="number" name="" class="form-control" placeholder="XXXX">                                           
                                            </div>
                                            <div class="col-md-2">
                                              <label class="h5">Date:</label>
                                              <input type="date" name="" class="form-control" placeholder="XXXX">                                           
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            {{-- Payments --}}
                            {{-- Payments History --}}
                            <div class="row" id="payments_history_table" style="display: none;">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <table id="datatable" class="table table-bordered">
                                                <div class="card-header clearfix">
                                                  <h5 class="card-title float-left font-weight-bold">Payments History:</h5>
                                                </div><br>
                                                <thead>
                                                <tr>
                                                      <th>No.</th>
                                                      <th>Payment Type</th>
                                                      <th>Date</th>
                                                      <th>Payables</th>
                                                      <th>Paid</th>
                                                      <th>Discounts</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    <td>A</td>
                                                    
                                                </tr>
                                                </tbody>
                                            </table>
            
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            {{-- Payments History --}}
                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->


@include('includes/footer_start')

<!-- Required datatable js -->
<script src="{{ asset( 'assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{ asset( 'assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
<!-- Responsive examples -->
<script src="{{ asset( 'assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset( 'assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

<!-- Datatable init js -->
<script src="{{ asset( 'assets/pages/datatables.init.js')}}"></script>
<script src="{{ asset('js/affiliatedBodies/afiliated_bodies.js') }}"></script>
<script src="{{ asset('js/attendance/attendance_sheet_entry.js') }}"></script>
<script type="text/javascript" src="{{asset('js/finePolicy/finePolicy.js')}}"></script>
@include('includes/footer_end')