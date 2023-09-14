@include('includes/header_start')
<!-- DataTables -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- Responsive datatable examples -->
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/custom/admission.css') }}" rel="stylesheet" type="text/css"/>
@include('includes/header_end')

             <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">New Admission Form</h3>
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
                    {{--
                    <div class="card-header">
                        <div class="form-group text-center">
                            <h6 id="form_no" value="Admission Form Code: {{ $form_code }}">
                                Admission Form Code: {{ $form_code }}
                            </h6>
                        </div>
                    </div>
                    --}}
                    <div class="card-body">
                        <ul class="nav nav-tabs navbar-inverse" data-spy="affix" data-offset-top="197" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a aria-controls="admission_form_main" aria-selected="true" class="nav-link active show" data-toggle="tab" href="#admission_form_main" id="admission-form-tab" role="tab">
                                    Admission Form (New)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a aria-controls="accounts_form" aria-selected="false" class="nav-link" data-toggle="tab" href="#accounts_form" id="accounts-tab" role="tab">
                                    Accounts (Package and Installments)
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div aria-labelledby="admission-form-tab" class="tab-pane show active fade div-border-bottom-theme div-border-right-theme div-border-left-theme padding-10" id="admission_form_main" role="tabpanel">
                                <form action="{{ route('admissions.store') }}" aria-label="{{ ('Admission Create') }}" class="" enctype="multipart/form-data" method="POST" name="admission_form">
                                    @include('admissions/ca_admission_form')
                                </form>
                            </div>
                            <div aria-labelledby="accounts-tab" class="tab-pane fade div-border-bottom-theme div-border-right-theme div-border-left-theme padding-10" id="accounts_form" role="tabpanel">
                                @include('accounts/feePackage/create')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes/footer_start')
<!-- Required datatable js -->
<script type="text/javascript">var other_count = 0;</script>
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}">
</script>
<!-- Datatable init js -->
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}">
</script>
<script src="{{ asset('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js')  }}">
</script>
<script type="text/javascript">
    var template = '{{json_encode(config('constants'))}}';
    var constants = JSON.parse(template.replace(/&quot;/g,'"'));
</script>
@isset ($enquiry)
    <script type="text/javascript">
        var enquiry_template = '{{ json_encode($enquiry) }}';
        var enquiry          = JSON.parse(enquiry_template.replace(/&quot;/g,'"'));
    </script>
@endisset

@isset ($pwwb)
    <script type="text/javascript">
        var pwwb_template = '{{ json_encode($pwwb) }}';
        var pwwb          = JSON.parse(pwwb_template.replace(/&quot;/g,'"'));
    </script>
@endisset
<script src="{{ asset('js/admission/admission-validator.js')  }}">
</script>
<script src="{{ asset('js/admission/admission.js')  }}">
</script>
<script src="{{ asset('js/accounts/fee-package/fee_package.js')  }}">
</script>
@include('includes/footer_end')
