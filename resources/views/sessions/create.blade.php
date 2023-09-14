@include('includes/header_start')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

@include('includes/header_end')

             <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title">Add New Session</h3>
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
                        @include('sessions/create_new_session')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes/footer_start')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
        <script src="{{ asset('js/session/session.js')  }}"></script>

        <script type="text/javascript">
           
            var template = '{{json_encode(config('constants'))}}';
            var constants = JSON.parse(template.replace(/&quot;/g,'"'));

        </script>
<script>
    $("#session_submit").on("click", function(e){
        var formValid = document.forms["session_form"].checkValidity();
        if(!formValid)
        {
            swal.clickCancel();
        }
        else
        {
            e.preventDefault();
        }
        swal({
            title: 'Are your sure to proceed?',
            text: '',
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            confirmButtonClass: 'btn btn-success',
            showLoaderOnConfirm: true,
            reverseButtons: false
        }).then((result) => {
            if (result.value) {
                if (Global_count > 0 && formValid) {
                    $('#session_form').submit();
                } else {
                    alertify.error('something went wrong.');
                }
            }
        });
    });
</script>

@include('includes/footer_end')