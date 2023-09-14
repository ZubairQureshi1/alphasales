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
                            <h3 class="page-title">Student Academic Histories</h3>
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
                <div class="row">
                    <div class="col-md-4">
                            @foreach($student_academic_histories as $key => $value) 

                            <a href="{!! route('accounts.showAccountByYear', [$student_id, $value->id]) !!}" class="btn btn-primary">Part {{$key + 1}}</a>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                    @include('includes/footer_start')
@include('alertify::alertify')

<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>


@include('includes/footer_end') -->
