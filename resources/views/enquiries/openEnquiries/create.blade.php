@extends('enquiries.openEnquiries.master')
@section('title', 'Create')
@push('css')
    <link href="{{ asset('assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet" type="text/css" media="screen">
@endpush
@section('content')


<div class="card">
    <div class="card-header px-4 bg-primary text-white mb-2 clearfix">
        <h5 class="card-title float-left">Create Open Enquiry</h5>
        <a href="{{ route('openEnquiries.index') }}" class="btn btn-primary btn-sm mt-2 rounded-0 float-right active">
            <i class="fa fa-chevron-left fa-fw fa-sm mr-1"></i> Go Back
        </a>
    </div>
    <div class="card-body px-4">
        @include('enquiries.openEnquiries.create_form')
    </div>
</div>



@endsection


@push('js')
    
    <script src="{{asset('assets/js/app.js')}}"></script>
    <!-- Parsley js -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
            
        });
        var constants_json = '{{json_encode(config('constants'))}}';
        var constants = JSON.parse(constants_json.replace(/&quot;/g,'"'));

        var countries_json = '{{json_encode($countries)}}';
        var countries = JSON.parse(countries_json.replace(/&quot;/g,'"'));

        var references_json = '{{json_encode($references)}}';
        var references = JSON.parse(references_json.replace(/&quot;/g,'"'));

        var cities_json = '{{json_encode($cities)}}';
        var cities = JSON.parse(cities_json.replace(/&quot;/g,'"'));

        var session_json = '{{json_encode($sessions)}}';
        var sessions = JSON.parse(session_json.replace(/&quot;/g,'"'));
        
        var statuses_json = '{{json_encode($statuses)}}';
        var statuses = JSON.parse(statuses_json.replace(/&quot;/g,'"'));
    </script>

    <script type="text/javascript" src="{{ asset('js/enquiry/enquiry_validator.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/enquiry/enquiry.js') }}"></script>
@endpush