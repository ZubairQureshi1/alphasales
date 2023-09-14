@include('includes/header_start')
@include('includes/header_end')
        <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Edit Role Details</h3>
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
                    <div class="card-header card-custom-header">
                        <h5 class="card-title font-weight-bold">{{ $role->display_name }}</h5>
                    </div>
                    <div class="card-body">
                        {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch']) !!}
                            @include('roles.edit_fields')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes/footer_start')
    @include('alertify::alertify')
    <script type="text/javascript">
        function selectAllCheckbox(id) {
            $('.'+id).prop("checked", !($('.'+id).prop("checked")));
        }
    </script>
@include('includes/footer_end')


