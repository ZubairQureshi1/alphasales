<div aria-hidden="true" aria-labelledby="mySmallModalLabel"  class="modal fade create_head_fine_model" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 1230px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                   Add
                    <strong>
                        Heads
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('accounts.update_headFine')}}" class="" method="POST">
                    @csrf
                    <div class="form-group">
                        @if(count($heads)!=0)
                            <table class="table table-responsive table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Discount (In Amount)</th>
                                        <th>Discount (In Percentage)</th>
                                        <th>Amount After Discount</th>
                                        <th>Due Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                            <tbody>
                                @foreach ($heads as $index => $head)
                                    <tr>
                                        <td>{{ $head['name'] }}</td>
                                        <td><input class="form-control p-1 mb-2 fee" disabled="" id="heads_amount_{{$index}}" min="0" name="head_amount[]" type="number"></td>
                                        <td>
                                            <input class="form-control p-1 mb-2 fee" disabled="" id="heads_discount_{{$index}}" min="0" onkeyup="headsDiscount('{{$index}}')" name="discount_in_amount[]" type="number">
                                            <span id="heads_discount_message_{{$index}}"></span>
                                       </td>
                                       <td> 
                                            <input class="form-control p-1 mb-2 fee" disabled="" editable="false" id="heads_discount_percentage_{{$index}}" name="discount_in_percentage[]"  type="text" placeholder="Discount Rate">
                                       </td>
                                       <td> 
                                            <input class="form-control p-1 mb-2 fee" disabled="" editable="false" id="heads_amount_after_discount_{{$index}}" name="amount_after_discount[]"  type="text" placeholder="Amount After Discount">
                                       </td>
                                       <td> 
                                            <input name="due_date[]" id="due_date_{{ $index }}" disabled="" required type="date" data-date-format="YYYY-MM-DD" class="form-control">
                                       </td>
                                        <td>
                                            <div class="text-center">
                                                <input name="heads[]" type="checkbox" id="head_{{ $index }}" onclick="enableHeadRow('{{ $index }}')" value="{{ $head['id'] }}"/>
                                                <input name="status_id" type="hidden" value="0">
                                                <input name="package_id" type="hidden" value="{{$fee_package['id']}}">
                                                <input name="academic_history_id" type="hidden" value="{{$academic_history_id}}">
                                                <input name="status_name" type="hidden" value="{{ config('constants.payment_statuses')[0] }}">
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        @else
                            @include('includes/not_found')
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="head_modal_submit" type="submit">
                            Save
                        </button>
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                            Close
                        </button>
                    </div>
                    <input type="text" hidden name="student_id" value="{{$student['id']}}">
                </form>
            </div>
        </div>
    </div>
</div>
