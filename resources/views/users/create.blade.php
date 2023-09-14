@include('includes/header_start')

<!-- DataTables -->
<!-- Responsive datatable examples -->
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">Users</h3>
    </li>
</ul>

<div class="clearfix"></div>
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
                    <div class="card-body">
                        {!! Form::open(['route' => 'users.store']) !!}

                        @include('users.create_fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes/footer_start')
@include('alertify::alertify')

<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>

<!-- Responsive examples -->
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>

<!-- Datatable init js -->
<script type="text/javascript">
    var template = '{{json_encode(config('constants'))}}';
    var constants = JSON.parse(template.replace(/&quot;/g,'"'));
</script>
<script type="text/javascript">$('.select2').select2()</script>
<script src="{{ asset('js/user/user.js') }}"></script>

<script type="text/javascript">

    $(document).on('change', '.chk', function() {
        $('input.chk').not(this).prop('checked', false);  
    });
</script>
@include('includes/footer_end')


