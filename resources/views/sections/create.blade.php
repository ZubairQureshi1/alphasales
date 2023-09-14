@include('includes/header_start')
        <link href="{{ asset('assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet" type="text/css" media="screen">   
        <link rel="stylesheet" href="{{ asset('css/hover.min.css') }}">
@include('includes/header_end')

        <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Sections</h3>
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
            <div class="col-lg-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        @include('sections/sections_create_form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes/footer_start')

        <!-- Parsley js -->
        <script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
            var constants = @json(config('constants'));
        </script>
        <script type="text/javascript" src="{{ asset('js/section/section_validator.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/section/section.js') }}"></script>
        <script type="text/javascript">
            /*$(() => {
                javascript:introJs().start();
            })*/
        </script>
@include('includes/footer_end')