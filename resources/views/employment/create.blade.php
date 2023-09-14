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
                            <h3 class="page-title">End of Employment</h3>
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
        <div class="card">
            <div class="card-body">
                <form name="end_employment_form" method="post" action="{{url('employments')}}">
                   @csrf
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('employee', 'Employee:') !!}
                            {!! Form::select('user_id', $employees, null, ['id' => 'user_id', 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select Employee ------']) !!}
                        </div>
                        <div class="col-md-4">
                            <label>Date( End Of Employment )</label>
                            <input type="date" name="end_employment_date" id="end_employment_date_id" class="form-control" />
                        </div>
                        <div class="col-md-4">
                        <label>Reason End Of Employment</label>
                            <textarea class="form-control" name="reason_end_employment" id="reason_end_employment_id" rows="3"></textarea>
                        </div>
                        <div class="col-lg-12 text-right mt-5">
                            <input type="submit" value="Save" class="btn btn-primary" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                    @include('includes/footer_start')
@include('alertify::alertify')

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

@include('includes/footer_end') -->
