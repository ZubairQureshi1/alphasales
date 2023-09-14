<div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="sendMessage" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    Send
                    <strong>
                        Whatsapp Message
                    </strong>
                </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('message') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <div>
                            
                            <select 
                                class="form-control" 
                                name="template" 
                                id="template"
                                onchange="selectMessage(this)" 
                            >
                                <option value="">Select template</option>
                                @foreach($templates as $temp)
                                <option value="{{$temp['message']}}">{{$temp['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="display:none" id="singleMessage_mob">
                            <label>
                                Mobile Number
                                <small>(Number should start with 92 and length should be correct)</small>
                            </label>
                            <input type="text" class="form-control" id="mobileNumber"  name="mobileNumber" />
                            <br> 
                        </div>
                        <div>
                            <label>
                                Messaage
                            </label>
                            <textarea class="form-control" name="message_text" id="message" 
                            required>Write Message Here..</textarea> 
                            <input type="hidden" class="form-control" id="selectedIds" name="selectedIds" />
                            <input type="hidden" class="form-control" id="singleMessage" name="singleMessage" value="0"/>
                            <br> 
                        </div>
                        <div>
                            <label>
                                Attachment
                            </label>
                            <input type="file" class="form-control"  name="attachment" />
                            <br> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                            Close
                        </button>
                        <button class="btn btn-success" type="submit">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function selectMessage(element) {
    $('#message').val(element.value);
}
</script>