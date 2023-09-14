<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="view_{{$value['id']}}"
    role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    View
                    <strong>
                        Group
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                  
                <div class="wrapper">
                    <input type="hidden" name="group_id" value="{{ $value['id'] }}">
                    <ul>
                        <li class="parent-li-style">
                            <ul class="ul-style font-style">
                                <li class="li-style border-right-style">#</li>
                                <li class="li-style border-right-style with-style">Contact Name</li>
                                <li class="li-style border-right-style with-style">Contact Number</li>
                                <li class="li-style">Action</li>
                            </ul>
                        </li>
                        <li class="parent-li-style">
                            <?php 
                                $group_id = $value['id'];
                            ?>
                            @if(count($value['contacts']) > 0)
                                @foreach($value['contacts'] as $key =>$contact)
                                <?php 
                                    $contact_id = $contact['id'];
                                ?>
                                    <ul id="c_row_{{ $key }}" class="ul-style">
                                        <li class="li-style border-right-style">{{$key + 1 }}</li>
                                        <li class="li-style with-style border-right-style">{{$contact['name']}}</li>
                                        <li class="li-style with-style border-right-style">{{$contact['phone_number']}}</li>
                                        <li class="li-style">
                                            <i class="fa fa-remove cursor" onclick="removeRow(
                                                'c_row_{{ $key }}' , '{{ $group_id }}' ,'{{ $contact_id }}')"></i>
                                        </li>
                                    </ul> 
                                @endforeach
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">
                        Close
                    </button> 
                </div>
                
            </div>
        </div>
    </div>
</div>
