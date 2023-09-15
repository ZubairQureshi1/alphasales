@include('includes/header_start')

<!-- DataTables -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/plugins/alertify/css/alertify.css') }}" rel="stylesheet" type="text/css" />

@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">Edit Enquiry</h3>
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
            {{-- ENQUIRY EDIT --}}
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header card-custom-header">
                        <div class="float-left">
                            <h5 class="card-title mb-1"><b>Form Code:</b> {{ $enquiry->form_code }}</h5>
                            <span class="text-muted"><i class="fa fa-clock-o"></i> Last Updated:
                                {{ $enquiry->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class="float-right">
                            <a href="{{ route('enquiries.index') }}" class="btn btn-link text-danger mt-3"
                                title="Go Back" data-toggle="tooltip">
                                <i class="dripicons-cross fa-lg fa-fw"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('enquiries/edit_enquiry')
                    </div>
                </div>
            </div>
            {{-- ENQUIRY FOLLOW UP --}}
           <!--  @can(['view_followups', 'update_followups'])
                <div class="col-12">
                    @include('enquiries/edit_enquiry_followup')
                </div>
            @endcan -->
        </div>
    </div>
</div>
@include('includes/footer_start')

<script type="text/javascript">
    var contactCount = '{{ $enquiry->enquiryContactInfos->count() }}';
    var factoryCount = '{{ $enquiry->enquiryWorkers->count() }}';
</script>
<script type="text/javascript">
        function onFollowupStatusSelectedit() {
            selected_status_id = document.getElementById('followup_status_idedit').value;
            if (selected_status_id == 'Follow Up Required') {
                document.getElementById('followup_date_divedit').hidden = false;
                document.getElementById('followup_auto_msg_divedit').hidden = false;
                document.getElementById('followup_interested_level_divedit').hidden = false;
                document.getElementById('next_followup_date_idedit').hidden = false;
                document.getElementById('follow_up_interested_level_idedit').hidden = true;
                document.getElementsByClassName('pwwbFileInformationDivedit').hidden = true;
                move_to_followup = true;
            } else if (selected_status_id == 'Dropped') {
                document.getElementById('followup_date_divedit').hidden = true;
                document.getElementById('followup_auto_msg_divedit').hidden = true;
                document.getElementById('followup_interested_level_divedit').hidden = true;
                document.getElementById('next_followup_date_idedit').hidden = true;
                document.getElementById('follow_up_interested_level_idedit').hidden = true;
                document.getElementsByClassName('pwwbFileInformationDivedit').hidden = true;
                move_to_followup = true;
            } else if (selected_status_id == 'Sales Matured') { // admitted
                move_to_confirmed_admission = true;
                document.getElementById('followup_date_divedit').hidden = true;
                document.getElementById('followup_auto_msg_divedit').hidden = true;
                document.getElementById('followup_interested_level_divedit').hidden = true;
                document.getElementById('next_followup_date_idedit').hidden = true;
                document.getElementsByClassName('follow_up_interested_level_idedit').hidden = true;
                // if(document.getElementById('student_category_idedit').value == 0 && document.getElementById('student_category_idedit').value !== '') {
                //     document.getElementById('pwwbFileInformationDivedit').hidden = false;
                // }

            } else if (selected_status_id == "") {
                document.getElementById('followup_date_divedit').hidden = true;
                document.getElementById('followup_auto_msg_divedit').hidden = true;
                document.getElementById('followup_interested_level_divedit').hidden = true;
                document.getElementById('next_followup_date_idedit').hidden = true;
                document.getElementById('follow_up_interested_level_idedit').hidden = true;
                document.getElementById('pwwbFileInformationDivedit').hidden = true;
                move_to_followup = false;
            } else {
                document.getElementById('followup_date_divedit').hidden = true;
                document.getElementById('followup_auto_msg_divedit').hidden = true;
                document.getElementById('followup_interested_level_divedit').hidden = true;
                document.getElementById('next_followup_date_idedit').hidden = true;
                document.getElementById('follow_up_interested_level_idedit').hidden = true;
                document.getElementById('pwwbFileInformationDivedit').hidden = true;
                move_to_followup = false;
            }
        }
    $(document).ready(function() {

        console.log($('.appUrl').val());
        console.log('refer');
        var refer = document.getElementById('source_info_id').value;
        console.log(refer);
        if (refer == 'Referred By') {
            document.getElementById('refer_name_div').hidden = false;
            document.getElementById('other_source_of_info_div').hidden = true;
           // document.getElementById('faculty_member_name').required = true;
        }
            var refer = document.getElementById('followup_status_idedit').value;
            console.log(refer);
        if (refer == 'Follow Up Required') {
             document.getElementById('followup_date_divedit').hidden = false;
            document.getElementById('followup_auto_msg_divedit').hidden = false;
            document.getElementById('followup_interested_level_divedit').hidden = false;
            document.getElementById('next_followup_date_idedit').hidden = false;
            document.getElementById('follow_up_interested_level_idedit').hidden = true;
            document.getElementsByClassName('pwwbFileInformationDivedit').hidden = true;
            move_to_followup = true;
        }

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
            const host = window.location.host
            console.log(host)
            $.ajax({
                url: `http://${host}/alphasales/enquiries/getProduct/` + id,
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

                },
                error: function(responce){
                    console.log(responce);
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
                const host = window.location.host
                $.ajax({
                    url: `http://${host}/alphasales/enquiries/getDeveloper/` + id,
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
        

        $('#project_id1').change(function() {

            // Department id
            var id = $(this).val();
            //alert(id);
            // Empty the dropdown
            $('#product_id1').find('option').not(':first').remove();

            // AJAX request
            $.ajax({
                url: $('.appUrl').val() + '/enquiries/getProduct/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {

                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }

                    if (len > 0) {
                        // Read data and create <option >
                        for (var i = 0; i < len; i++) {

                            var id = response['data'][i].id;
                            var name = response['data'][i].name;

                            var option = "<option value='" + id + "'>" + name + "</option>";

                            $("#product_id1").append(option);
                        }
                    }

                }
            });
        });





        $('#product_id1').change(function() {

            // Department id
            var id = $(this).val();
            //alert(id);
            // Empty the dropdown
            $('#developer_id1').find('option').not(':first').remove();
            // $.ajax({
            //     url: $('.appUrl').val() + '/enquiries/getProduct/' + id,
            //     type: 'get',
            //     dataType: 'json',
            //     success: function(response) {

            //         var len = 0;
            //         if (response['data'] != null) {
            //             len = response['data'].length;
            //         }

            //         if (len > 0) {
            //             // Read data and create <option >
            //             for (var i = 0; i < len; i++) {

            //                 var id = response['data'][i].id;
            //                 var name = response['data'][i].name;

            //                 var option = "<option value='" + id + "'>" + name + "</option>";

            //                 $("#product_id").append(option);
            //             }
            //         }

            //     }
            // });
            // AJAX request
            $.ajax({
                url: $('.appUrl').val() + '/enquiries/getDeveloper/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response['data']);
                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }

                    if (len > 0) {
                        // Read data and create <option >
                        for (var i = 0; i < len; i++) {

                            var id = response['data'][i].id;
                            var name = response['data'][i].name;

                            var option = "<option value='" + id + "'>" + name + "</option>";


                            $("#developer_id1").append(option);
                        }
                    }

                }
            });
        });

        $('form').parsley();
    });
    var constants_json = '{{ json_encode(config('constants')) }}';
    var constants = JSON.parse(constants_json.replace(/&quot;/g, '"'));
</script>
<!-- Required datatable js -->
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/enquiry/enquiry-edit.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/enquiry/enquiry_validator.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('assets/plugins/alertify/js/alertify.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}"></script>
<script src="{{ asset('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js') }}"></script>


<script type="text/javascript">
    var enquiry_json = '{{ json_encode($enquiry) }}';
    var enquiry = @json($enquiry);
</script>
<script src="{{ asset('js/followup/followup.js') }}"></script>
@include('includes/footer_end')
