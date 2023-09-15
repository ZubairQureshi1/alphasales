@include('includes/header_start')
<link href="{{ asset('assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet"
    type="text/css" media="screen">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">Enquiries</h3>
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

                        @include('enquiries/enquiry_form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes/footer_start')

<!-- Parsley js -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js') }}" type="text/javascript">
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#project_id').change(function() {
            $('#student_cnic_no').on('input', function() {
              $(this).val($(this).val().replace(/[^a-z0-9]/gi, ''));
            });
            // Department id
            var id = $(this).val();
            // alert(id);
            // Empty the dropdown
            // $('#product_id').find('option').not(':first').remove();
            $('#product_id').find('option').remove();
            // AJAX request
            $.ajax({
                url: 'getProduct/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response['data']);
                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }
                    
                    if (len > 0) {
                        
                        let option = "<option value='' selected disabled>--- Select Product ---</option>";
                        $("#product_id").append(option); 
                        // Read data and create <option >
                        for (var i = 0; i < len; i++) {
                            
                            var id = response['data'][i].id;
                            var name = response['data'][i].name;

                              var option1 = "<option value='" + id + "'>" + name + "</option>";
                
                            $("#product_id").append(option1);                            
                        }
                                                       
                        
                    }

                }
            });
        });





        $('#product_id').change(function() {

            // Department id
            var id = $(this).val();
            // alert(id);
            // Empty the dropdown
            // $('#developer_id').find('option').not(':first').remove();
            $('#developer_id').find('option').remove();
            // AJAX request
            $.ajax({
                url: 'getDeveloper/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response['data']);
                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }

                    if (len > 0) {
                        let option = "<option value='' selected disabled>--- Select Developer ---</option>";
                        $("#developer_id").append(option);
                        for (var i = 0; i < len; i++) {

                            var id = response['data'][i].id;
                            var name = response['data'][i].name;

                            var option1 = "<option value='" + id + "'>" + name + "</option>";


                            $("#developer_id").append(option1);
                        }
                    }

                }
            });
        });



        $('form').parsley();

        $("#enquiry_type").click(function() {
            alert("The paragraph was clicked.");
        });


    });
    var constants_json = '{{ json_encode(config('constants')) }}';
    var constants = JSON.parse(constants_json.replace(/&quot;/g, '"'));

    var countries_json = '{{ json_encode($countries) }}';
    var countries = JSON.parse(countries_json.replace(/&quot;/g, '"'));

    var references_json = '{{ json_encode($references) }}';
    var references = JSON.parse(references_json.replace(/&quot;/g, '"'));

    var cities_json = '{{ json_encode($cities) }}';
    var cities = JSON.parse(cities_json.replace(/&quot;/g, '"'));

    var session_json = '{{ json_encode($sessions) }}';
    var sessions = JSON.parse(session_json.replace(/&quot;/g, '"'));

    var statuses_json = '{{ json_encode($statuses) }}';
    var statuses = JSON.parse(statuses_json.replace(/&quot;/g, '"'));
</script>

<script type="text/javascript" src="{{ asset('js/enquiry/enquiry_validator.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/enquiry/enquiry.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
    $(":input").inputmask();
</script> --}}
<script>
    const phoneInputField = document.querySelector("#phone1");
    const phoneInput = window.intlTelInput(phoneInputField, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
</script>
<script>
    const phoneInputFields = document.querySelector("#phone2");
    const phoneInputs = window.intlTelInput(phoneInputFields, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
</script>
@include('includes/footer_end')
