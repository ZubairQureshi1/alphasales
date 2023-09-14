@extends('enquiries.openEnquiries.master')
@section('title', 'Edit')
@push('css')
    <link href="{{ asset('assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet" type="text/css" media="screen">
@endpush
@section('content')


    <div class="card">
        <div class="card-header px-4 bg-primary text-white mb-2 clearfix">
            <h5 class="card-title float-left">Edit Enquiry: {{$enquiry->form_code}}</h5>
            <a href="{{ route('openEnquiries.index') }}" class="btn btn-primary btn-sm mt-2 rounded-0 float-right active">
                <i class="fa fa-chevron-left fa-fw fa-sm mr-1"></i> Go Back
            </a>
        </div>
        <div class="card-body px-4">
            @include('enquiries/openEnquiries/edit_enquiry')
        </div>
    </div>

@endsection

@push('js')   
    <script type="text/javascript">
        var contactCount = '{{ $enquiry->enquiryContactInfos->count() }}';
        var factoryCount = '{{ $enquiry->enquiryWorkers->count() }}';
    </script>
    
    <!-- Required datatable js -->
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('js/enquiry/enquiry-edit.js') }}"></script>
    
    <script type="text/javascript" src="{{ asset('js/enquiry/enquiry_validator.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/parsley.min.js')  }}"></script>
    <script src="{{ asset('assets/plugins/alertify/js/alertify.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')  }}"></script>
    <script src="{{ asset('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js')  }}"></script>
    <script type="text/javascript">
            $(document).ready(function() {
                $('#student_cnic_no_eidt').on('input', function() {
                  $(this).val($(this).val().replace(/[^a-z0-9]/gi, ''));
                });
                $('form').parsley();

            });
            var constants_json = '{{json_encode(config('constants'))}}';
            var constants = JSON.parse(constants_json.replace(/&quot;/g,'"'));
        </script>

    <script type="text/javascript">
            var enquiry_json = '{{json_encode($enquiry)}}';
            var enquiry = JSON.parse(enquiry_json.replace(/&quot;/g,'"'));
    </script>

@endpush