@extends('enquiries.openEnquiries.master')
@section('title', 'View')
@section('content')
    <div class="card">
        <div class="card-header px-4 bg-primary text-white mb-2 clearfix">
            <h5 class="card-title float-left">View Enquiry: {{$enquiry->form_code}}</h5>
            <a href="{{ route('openEnquiries.index') }}" class="btn btn-primary btn-sm mt-2 rounded-0 float-right active">
                <i class="fa fa-chevron-left fa-fw fa-sm mr-1"></i> Go Back
            </a>
        </div>
        <div class="card-body px-4">
            @include('enquiries/openEnquiries/view_enquiry')
        </div>
    </div>
@endsection