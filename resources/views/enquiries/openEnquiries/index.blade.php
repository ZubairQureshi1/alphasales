@extends('enquiries.openEnquiries.master')
@section('title', 'List')
@push('css')
    <!-- DataTables -->
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')

    <div class="card">
        <div class="card-header px-4 bg-primary text-white mb-2 clearfix">
            <h5 class="card-title float-left">Open Enquiry List</h5>
            <a href="{{ route('openEnquiries.create') }}" class="float-right btn rounded-0 btn-primary btn-sm mt-2 active">
                <i class="fa fa-plus fa-fw fa-sm"></i> Create Open Enquiry
            </a>
        </div>
        <div class="card-body px-2">
            @include('includes/alert')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm table-enquiry">
                    <thead>
                        <tr>
                            <th>Form Code</th>
                            <th>Enquiry Date</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>Cell No.</th>
                            <th>Course Name</th>
                            <!-- <th>Affiliated Body</th> -->
                            <th>Session</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Enquiry By</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enquiries as $enquiry)
                            <tr>
                                <td>{{ $enquiry->form_code ?? '---' }}</td>
                                <td>{{ $enquiry->enquiry_date ?? '---' }}</td>
                                <td>{{ $enquiry->name ?? '---' }}</td>
                                <td>{{ $enquiry->father_name ?? '---' }}</td>
                                <td>{{ $enquiry->enquiryContactInfos()->get()->first()->phone_no ?? '---' }}</td>
                                <td>{{ $enquiry->course->name ?? '---' }}</td>
                                <!-- <td>{{ $enquiry->affiliated_body_name }}</td>-->
                                <td>{{ $enquiry->session_name }}</td>
                                <td>{{ ucfirst($enquiry->enquiry_type) ?? '---' }}</td>
                                <td>{{ $enquiry->student_category_name ?? '---' }}</td>
                                <td>{{ $enquiry->user_name ?? '---' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('openEnquiries.show', $enquiry->id) }}"
                                        class="btn-link text-primary mr-1" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('openEnquiries.edit', $enquiry->id) }}"
                                        class="btn-link text-warning mr-1" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('openEnquiries.destroy', $enquiry->id) }}"
                                        class="btn-link text-danger" title="Delete"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100" class="text-center mx-2">No Enquiry Avaiable</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection


@push('js')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/pages/datatables.init.js') }}"></script>


    <!--page level -->
    <script type="text/javascript">
        $(function() {
            'use strict';

            $('.table-enquiry').DataTable();
        });
    </script>
@endpush
