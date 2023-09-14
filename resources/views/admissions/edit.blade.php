@include('includes/header_start')

<!-- DataTables -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">Edit Admission Form</h3>
    </li>
</ul>

<div class="clearfix"></div>
</nav>

</div>

<div class="page-content-wrapper" id="sessions">

    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="form-group text-center">
                            <h6 id="form_no" value="Admission Form Code: {{ $admission['form_no'] }}">Admission Form Code: {{ $admission['form_no'] }}</h6>
                        </div>

                    </div>
                    <div class="card-body">
                        <form name="admission_form" class="" method="POST" action="{{ route('admissions.store') }}" aria-label="{{ ('Admission Create') }}">
                            @include('admissions/edit_admission_form')
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

    var template = '{{json_encode($acadmicRecords)}}';
    var acadmicRecords = JSON.parse(template.replace(/&quot;/g,'"'));
    
</script>
<script src="{{ asset('js/admission/edit-admission.js')  }}"></script>

@include('includes/footer_end')