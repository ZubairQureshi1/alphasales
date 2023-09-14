@if(count($enquiriesForAdmission)!=0)
<div class="table-rep-plugin">
    <div class="table-responsive b-0 buttons-group-mobile">
        <table id="datatable-buttons" isDefault="true" class="table table-bordered table-striped"  class="tablet" cellspacing="0" width="100%">
            <thead>
                <tr>

                    <th>Enquiry Code</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Category</th>
                    <th>Enquiry By</th>
                    <th class="text-center" style="width: 15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enquiriesForAdmission as $index => $enquiry)
                <tr>
                 <td>{{ $enquiry->enquiry_data->form_code }}</td>
                 <td class="letter_capitalize">{{ ($enquiry->enquiry_data->name) }}</td>
                 <td class="letter_capitalize">{{ ($enquiry->enquiry_data->father_name) }}</td>
                 <td>{{ !is_null($enquiry->enquiry_data->student_category_id) ? (isset(config('constants.student_categories')[$enquiry->enquiry_data->student_category_id]) ? config('constants.student_categories')[$enquiry->enquiry_data->student_category_id] : '---') : '---' }}</td>
                 <td class="letter_capitalize">{{ $enquiry->enquiry_data->user_name }}</td>
                 <td class="text-center">
                    @if($enquiry['is_admitted'] == false)
                        <a href="{{ route('admissionByEnquiryForm.admissionByEnquiryForm',$enquiry->enquiry_id) }}" class="btn btn-dark btn-sm wave-effect">
                            Move to Admission
                            <i class="fa fa-chevron-right fa-fw"></i>
                        </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@else
@include('includes/not_found')
@endif
