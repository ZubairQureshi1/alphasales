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
        <button class="button-menu-mobile open-left waves-effect" type="button">
            <i class="ion-navicon">
            </i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">
            Add Admission Attachments
        </h3>
    </li>
</ul>
<div class="clearfix">
</div>
<!-- Top Bar End -->
<!-- ==================
     PAGE CONTENT START
     ================== -->
<div class="page-content-wrapper" id="sessions">
    <div class="container-fluid">
        <div class="m-b-10">
            <strong>
                Attachments:
            </strong>
            <div class="m-t-10 div-border-rad">
                <div class="margin-10">
                    <form action="{{ route('StoreAdmissionAttachment') }}" enctype="multipart/form-data" method="post" name="admission_attachment_form">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2">
                                    <input class="form-control-file" id="attachment" name="attachment" type="file"/>
                                </div>
                                <div class="col-lg-2">
                                    <input class="btn btn-primary" type="submit" value="Upload"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes/footer_start')
<!-- Required datatable js -->
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}">
</script>
<!-- Datatable init js -->
<script src="{{ asset('assets/plugins/parsleyjs/parsley.min.js')  }}" type="text/javascript">
</script>
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}">
</script>
<script src="{{ asset('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js')  }}">
</script>
<script type="text/javascript">
    $(document).ready(function() {
                $('form').parsley();
            });
            var template = '{{json_encode(config('constants'))}}';
            var constants = JSON.parse(template.replace(/&quot;/g,'"'));
</script>
<script src="{{ asset('js/admission/admission.js')  }}">
</script>
@include('includes/footer_end')
