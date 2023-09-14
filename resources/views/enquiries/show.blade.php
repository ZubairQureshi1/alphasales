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
        <h3 class="page-title">Enquiry Details</h3>
    </li>
</ul>

<div class="clearfix"></div>
</nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->

     <div class="page-content-wrapper" id="enquiries">
        @include('flash::message')

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <div class="float-left">
                                <h5 class="card-title mb-1"><b>Form Code:</b> {{ $enquiry->form_code }}</h5>
                                <span class="text-muted"><i class="fa fa-clock-o"></i> Entry Date: {{ $enquiry->created_at->format('H:i:s | l F Y') }}</span>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('enquiries.index') }}" class="btn btn-link text-danger mt-3" title="Go Back" data-toggle="tooltip">
                                    <i class="dripicons-cross fa-lg fa-fw"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('enquiries/view_enquiry')
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('/enquiries') }}" class="btn btn-light rounded-0 waves-effect active">
                                <i class="fa fa-chevron-left fa-fw text-secondary"></i> Go Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('includes/footer_start')
    @include('includes/footer_end')