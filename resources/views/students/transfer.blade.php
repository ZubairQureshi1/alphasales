@include('includes/header_start')

<!-- DataTables -->
<link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

@include('includes/header_end')


<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">Students</h3>
    </li>
</ul>
@include('alertify::alertify')

<div class="clearfix"></div>
</nav>

</div>

<div class="page-content-wrapper">
    <div class="header_bg">
        <div class="container-fluid">
            <div class="jumbotron">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="card-body">
                                <div class="col-sm-12">
                                    @include('students/transfer_filters')

                                </div>
                            </div>
                        </div>


                        <div class="row text-right">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        @include('students/table_reporting')

                                    </div>

                                </div>
                            </div>
                        </div> 
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card text-left">
                                        <form>
                                            <div class="card-body">
                                                <span id="error" hidden="hidden" style="color: red;">Please Select  Subjects...</span>
                                                <div class="form-group text-left">
                                                    <span id="hide" hidden="hidden">
                                                        <label text-left for="subject">Subjects:</label>
                                                        <div id="Subjects">
                                                            
                                                            <select class="form-group select2 select2-multiple" multiple="multiple" name="subject" id="subject" required>
                                                                <option value="">--Select subjects--</option>
                                                                @foreach($subject as $row)
                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                @endforeach

                                                            </select>
                                                            
                                                        </div>
                                                    </span>
                                                </div>
                                                <br>
                                                <span id="inc" hidden="hidden">
                                                    <label>Student fee increment amount:</label>
                                                    <input class="form-control" required 
                                                    type="number" name="increment" id="increment" placeholder="Enter Increment Amount"/>
                                                    <span id="error1" hidden="hidden" style="color: red;">Please fill this field...</span>
                                                    <br>
                                                </span>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <input type="button" name="OK" id="ok" class="btn btn-primary" value="OK" hidden="hidden" onclick="Validate()" />
                                                </div>
                                            </div>

                                        </form>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        @include('includes/footer_start')
        <script type="text/javascript">
            $('.select2').select2({
                placeholder:"Select Subjects"
            });

        </script>
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>

        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
        <script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>

        <script src="assets/pages/datatables.init.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

        @include('includes/footer_end')





