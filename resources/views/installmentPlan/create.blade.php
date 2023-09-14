@include('includes/header_start')

        <!-- DataTables -->
        <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
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
                <h3 class="page-title">Add New Installment Plans</h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->

<div class="page-content-wrapper" id="installmentplans">

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30" >
                    <div class="card-body">

                      <form class="" method="POST" action="{{ route('installmentplans.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>Degree type</label>
                                <select class="form-control" name="academic_term_id" id="academic_term_id">
                                	<option value="" disabled="" selected="">-------  Select Degree type  -------</option>
                                	@foreach(Config::get('constants.academic_terms') as $key=> $academic_term)
                                	<option value="{{$key}}">{{$academic_term}}</option>
                                	@endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Max Installments</label>
                                <div>
                                    <input type="number"
                                           class="form-control text-right" required
                                           name="max_installments"
                                           placeholder="Enter No of Max Installments"/>
                                </div>
                            </div><div class="form-group">
                                <label>Min Installments</label>
                                <div>
                                    <input type="number"
                                           class="form-control text-right" required
                                           name="min_installments"
                                           placeholder="Enter No of Min Installments"/>
                                </div>
                                <label>Max Discount</label>
                                <div>
                                    <input type="number"
                                           class="form-control text-right" required
                                           name="max_discount"
                                           placeholder="Enter Max Discount"/>
                                </div>
                                <label>Min Discount</label>
                                <div>
                                    <input type="number"
                                           class="form-control text-right" required
                                           name="min_discount"
                                           placeholder="Enter Min Discount"/>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
						</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes/footer_start')

    <!-- Required datatable js -->
        <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
    <!-- Datatable init js -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/parsley.min.js')  }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
        <script src="{{ asset('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js')  }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('form').parsley();
            });
            var template = '{{json_encode(config('constants'))}}';
            var constants = JSON.parse(template.replace(/&quot;/g,'"'));

        </script>
     

@include('includes/footer_end')
