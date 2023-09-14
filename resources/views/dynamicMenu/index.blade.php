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
                <h3 class="page-title">System Menu</h3>
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
                    <div class="col-lg-12">
                        {!! Menu::render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes/footer_start')
{!! Menu::scripts() !!}
@include('includes/footer_end') -->
