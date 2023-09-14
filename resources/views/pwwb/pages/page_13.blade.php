<style type="text/css">
    label{
        font-weight: bold;
        color: black;
        font-family: 'Balsamiq Sans', cursive;
    }
    h1{
        font-weight: bold;
        text-align: center;
        font-family: 'Balsamiq Sans', cursive;
        background: #17202A;
        color: white;
        padding: 15px;
        position: relative;
        top: -20px;
    }
    input{
        text-transform: capitalize;
    }
</style>
<div id="page_13">
    <h1>Documents Attached<span class="float-right">Page # 09</span></h1><br>
    <form id="page_13_form">
        <div class="card shadow p-3 w-100">
            <div class="card-body ">
                <div class="col-md-12 mt-2">
                    <label for="" style="font-size: 20px;">Previous Passed Examination Result Card/ Degree:</label>
                </div>
                <div class="card shadow p-3 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                <label>Quantity Min(04):<span style="color: red;">*</span></label>
                               <input type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" onchange="previous_passed_exam_qty_check();" id="previous_passed_exam_qty" name="result_card_quantity" placeholder="Enter Min Quantity"
                                value="{{$data ? $data['document_attachment_details']['result_card_quantity'] : ''}}">
                            </div>
                            <div class="form-group  col-md-6">
                                <label>Attested by Gazetted Officer:<span style="color: red;">*</span></label>
                                <select  name="result_card_attested" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['result_card_attested'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row mt-4 ml-1">
                    <div class="form-group  col-md-6">
                        <label>NOC From Previous Affiliated Body(Original) Required:<span style="color: red;">*</span></label>
                        <select onchange="check_noc_yes_no();" name="noc_affiliated_body" id="noc_affiliated_body" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['noc_affiliated_body'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group  col-md-6">
                        <label>Equivalence Certificate(Original) Required:<span style="color: red;">*</span></label>
                        <select onchange="check_equivalence_yes_no();" name="equivalence_certificate" id="equivalence_certificate" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['equivalence_certificate'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Ali Naeem Edit . --}}
                <div  class="form-row mt-4 ml-1">
                    <div style="display:none;" id="nocyesno" class="form-group  col-md-6">
                        <label>NOC Received:<span style="color: red;">*</span></label>
                        <select style="display:none" name="noc_received_yes_no" id="noc_received_yes_no" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['noc_received_yes_no'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="display: none" id="equivalenceyesno" class="form-group  col-md-6">
                        <label>Equivalence Received:<span style="color: red;">*</span></label>
                        <select style="display:none" name="equivalence_yes_no" id="equivalence_yes_no" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['equivalence_yes_no'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- End --}}
                <div class="col-md-12 mt-2">
                    <label for="" style="font-size: 20px;">Student's Character Certificate:</label>
                </div>
                <div class="card shadow p-3 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                <label>Quantity Min(04):<span style="color: red;">*</span></label>
                                <input type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control text-center" id="students_certificate_qty" onchange="students_certificate_qty_check();" name="certificate_quantity" placeholder="Enter Min Quantity"
                                value="{{$data ? $data['document_attachment_details']['certificate_quantity'] : ''}}">
                            </div>
                            <div class="form-group  col-md-6">
                                <label>Attested by Gazetted Officer:<span style="color: red;">*</span></label>
                                <select  name="character_certificate_attested" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['character_certificate_attested'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row mt-4 ml-1">
                    <div class="form-group  col-md-6">
                        <label>Student College Card Quantity(01):<span style="color: red;">*</span></label>
                        <select  name="collage_card_quantity" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['collage_card_quantity'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group  col-md-6">
                        <label>Transport Card Quantity(01):<span style="color: red;">*</span></label>
                        <select  name="transport_card_quantity" class="form-control">
                            <option value="" selected>--select--</option>
                            @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['transport_card_quantity'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="" style="font-size: 20px;">Admission Offer Letter:</label>
                </div>
                <div class="card shadow p-3 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                <label>Original:</label>
                                <select  name="admission_letter_original" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['admission_letter_original'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-6">
                                <label>Signed by Principal:</label>
                                <select  name="admission_letter_principal_sign" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['admission_letter_principal_sign'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="col-md-12 mt-2">
                    <label for="" style="font-size: 20px;">Bonafide Letter (Required):</label>
                </div>
                <div class="card shadow p-3 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                <label>Original:</label>
                                <select onchange="bonafiderecievedvesno_check();" id="bonafide_letter_original" name="bonafide_letter_original" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['bonafide_letter_original'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-6">
                                <label>Signed by Principal:</label>
                                <select  name="bonafide_letter_principal_sign" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['bonafide_letter_principal_sign'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{--Ali Naeem Edit.--}}
                        <div class="form-row">
                            <div style="display: none" id="bonafiderecievedvesno_check" class="form-group  col-md-12">
                                <label>Received:</label>
                                <select style="display: none" id="bonafide_recieved_ves_no" name="bonafide_recieved_ves_no" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['bonafide_recieved_ves_no'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{--End Edit.--}}
                    </div>
                </div><br>
                <div class="col-md-12 mt-2">
                    <label for="" style="font-size: 20px;">Claim Letter:</label>
                </div>
                <div class="card shadow p-3 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                <label>Original:</label>
                                <select  name="claim_letter_original" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['claim_letter_original'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-6">
                                <label>Signed by Principal:</label>
                                <select  name="claim_letter_principal_sign" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['claim_letter_principal_sign'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="col-md-12 mt-2">
                    <label for="" style="font-size: 20px;">Rs.50/ Affidavit:</label>
                </div>
                <div class="card shadow p-3 w-100">
                    <div class="card-body ">
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                <label>Original:</label>
                                <select  name="affidavit_original" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['affidavit_original'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-6">
                                <label>Signed by Worker:</label>
                                <select  name="affidavit_worker_sign" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['affidavit_worker_sign'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-6">
                                <label>Thumb Impression of Worker:</label>
                                <select  name="worker_thumb" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['worker_thumb'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-6">
                                <label>Attestation by Oath Commissioner:</label>
                                <select  name="oath_commission_attested" class="form-control">
                                    <option value="" selected>--select--</option>
                                    @foreach(\Config::get('constants.general_yes_no') as $key => $value)
                                        <option value="{{$key}}" {{ $data ? $data['document_attachment_details']['oath_commission_attested'] == $key ? 'selected' : '' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- Ali Naeem Edit. --}}
<div class="modal fade" id="previous_passed_exam_qty_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Quantity Min. (04)*</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do You Want To Store Less Then Given Quantity ?
      </div>
      <div class="modal-footer">
{{--        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>--}}
        <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="students_certificate_qty_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Quantity Min. (04)*</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do You Want To Store Less Then Given Quantity ?
      </div>
      <div class="modal-footer">
{{--        <button type="button" class="btn btn-secondary" id="checkno" onclick="checkno_check();" data-dismiss="modal">No</button>--}}
        <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
      </div>
    </div>
  </div>
</div>
{{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>--}}

<script>
        noc_yes_no();
        function noc_yes_no(){
            var noc_affiliated_body = $('#noc_affiliated_body').val();
            if(noc_affiliated_body == 'yes'){
                $('#nocyesno').show();
                $('#noc_received_yes_no').show();
            }
            else{
                $('#nocyesno').hide();
                $('#noc_received_yes_no').hide();
            }
        }

        equivalence_yes_no();
        function equivalence_yes_no(){
            var equivalence_certificate = $('#equivalence_certificate').val();
            if(equivalence_certificate == 'yes'){
                $('#equivalenceyesno').show();
                $('#equivalence_yes_no').show();
            }
            else{
                $('#equivalenceyesno').hide();
                $('#equivalence_yes_no').hide();
            }
        }

        bonafide_yes_no();
        function bonafide_yes_no(){
            var bonafide_letter_original = $('#bonafide_letter_original').val();
            if(bonafide_letter_original == 'yes'){
                $('#bonafiderecievedvesno_check').show();
                $('#bonafide_recieved_ves_no').show();
            }
            else{
                $('#bonafiderecievedvesno_check').hide();
                $('#bonafide_recieved_ves_no').hide();
            }
        }

    // $('select[name="noc_affiliated_body"').each(function (index,value) {
    //         if($(value).val() == 'yes')
    //             $(value).parent().next().show();
    //         else
    //             $(value).parent().next().hide();
    //     });
     // Ali Naeem Edit.
        function previous_passed_exam_qty_check(){
            var minimum  = $('#previous_passed_exam_qty').val();

            if (minimum != '') {
                if(minimum < 4){
                    $("#previous_passed_exam_qty_modal").modal();
                }
            }
        }



        function students_certificate_qty_check(){
             var minimum  = $('#students_certificate_qty').val();

            if (minimum != '') {
                if(minimum < 4){
                    $("#students_certificate_qty_modal").modal();
                }
            }
        }
        function checkno_check(){
            $('#photograph_quantity').focus();
        }
        // Ali Naeem Edi.
        function check_noc_yes_no(){
            var check_noc_yes_no = $('#noc_affiliated_body').val();
            if(check_noc_yes_no == 'yes'){
                $("#noc_received_yes_no").css("display", "block");
                $("#nocyesno").css("display", "block");
            }else{
                $("#noc_received_yes_no").css("display", "none");
                $("#nocyesno").css("display", "none");
            }

            console.log(check_noc_yes_no);
        }

        function check_equivalence_yes_no(){
            var check_noc_yes_no = $('#equivalence_certificate').val();
            if(check_noc_yes_no == 'yes'){
                $("#equivalence_yes_no").css("display", "block");
                $("#equivalenceyesno").css("display", "block");
            }else{
                $("#equivalence_yes_no").css("display", "none");
                $("#equivalenceyesno").css("display", "none");
            }

            console.log(check_noc_yes_no);
        }

        function bonafiderecievedvesno_check(){
            var check_noc_yes_no = $('#bonafide_letter_original').val();
            if(check_noc_yes_no == 'yes'){
                $("#bonafiderecievedvesno_check").css("display", "block");
                $("#bonafide_recieved_ves_no").css("display", "block");
            }else{
                $("#bonafiderecievedvesno_check").css("display", "none");
                $("#bonafide_recieved_ves_no").css("display", "none");
            }

            console.log(check_noc_yes_no);
        }



        // End.
</script>
