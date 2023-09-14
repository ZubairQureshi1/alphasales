<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/datepicker.css')}}">

    <title>CFE FORM</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--    <meta name="index_id" content="{{ $data['index_id'] ?? ''}}">--}}
    <meta name="index_id" content="11">
    <style type="text/css">
        .h1{
            font-weight: bold;
            font-family: 'PT Serif', serif;
            background: #17202A;
            color: white;
            padding: 15px;
            position: relative;
            top: -20px;
        }
    </style>
</head>
<body>

<div class="col-md-12">
    <h1>Followup Details</h1>
</div><br>
<div class="col-md-12 mt-4">
    <label class="styling font-weight-bold">Factory Details:</label>
</div>
<div class="card shadow ml-4 mr-4">
    <div class="card-body ">
        <div class="form-row">
            <div class="form-group  col-md-4">
                <label><strong>File Received No:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->file_received_number : ''}}
                </label>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Data Entry Date:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->receiving_date : ''}}
                </label>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Submission Date:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->submission_date : ''}}
                </label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group  col-md-4">
                <label><strong>Diary No:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->pwwb_diary_number : ''}}
                </label>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Name of Worker:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->worker_name : ''}}
                </label>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Worker CNIC No:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->worker_cnic : ''}}
                </label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group  col-md-4">
                <label><strong>Factory Card:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->factory_card : ''}}
                </label>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Social Security No:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->social_security : ''}}
                </label>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Worker IBAN:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->bank_iban : ''}}
                </label>
            </div>
            <div class="form-group col-md-4">
                <label><strong>EOBI Details:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->eobi_number : ''}}
                </label>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Name Of Factory:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->factory_name : ''}}
                </label>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Factory Registration No:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->factory_registration_number : ''}}
                </label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group  col-md-4">
                <label><strong>Factory Registeration Date:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->factory_registration_date : ''}}
                </label>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Factory Manager Name:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->factory_manager_name : ''}}
                </label>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Factory Manager Email:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->factory_manager_email	 : ''}}
                </label>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Student Name:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->student_name	 : ''}}
                </label>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Father Name:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->father_name	 : ''}}
                </label>
            </div>
            <div class="form-group col-md-4">
                <label><strong>Potential Degree:</strong></label>
                <label>
                    {{$fileInfo ? $fileInfo->potential_degree  : ''}}
                </label>
            </div>
        </div>        
    </div>
</div>

@if(!$familyCallsCheckAdmitted)
<br/>
<div class="card shadow ml-4 mr-4">
    <div class="card-body ">
        
        <form action="/pwwbfollowupstore" method="post">
            @CSRF
            <input type="hidden" name="family_id" id="family_id" value="{{$fileInfo->family_id}}">
            <input type="hidden" name="index_table_id" id="index_table_id" value="{{$fileInfo->Family_index_table_id}}">

            <input type="hidden" name="worker_name" id="worker_name" value="{{$fileInfo->worker_name}}">
            <input type="hidden" name="serial_no" id="serial_no" value="{{$fileInfo->serial_no}}">
            <input type="hidden" name="worker_cnic" id="worker_cnic" value="{{$fileInfo->worker_cnic}}">
            <input type="hidden" name="student_name" id="student_name" value="{{$fileInfo->student_name}}">
            <input type="hidden" name="potential_degree" id="potential_degree" value="{{$fileInfo->potential_degree}}">
            <input type="hidden" name="file_received_status" id="file_received_status" value="{{$fileInfo->file_received_status}}">
            <input type="hidden" name="follow_up" id="follow_up" value="{{$fileInfo->follow_up}}">
            <input type="hidden" name="follow_up_status" id="follow_up_status" value="{{$fileInfo->follow_up_status}}">
        <div class="form-row">
            <div class="form-group  col-md-3">
                <label>Called By:</label>
                   <input class="form-control" name="called_by" placeholder="Enter Called By" required="" type="input"/>
            </div>
            <div class="form-group  col-md-3">
                    {!! Form::label('status', 'Call Status:') !!}
                    {!! Form::select('call_status', config('constants.call_statuses'), null, ['id' => 'call_status_id', 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Status', 'onchange' => 'onCallStatusSelect()', 'required']) !!}
            </div>
            <div class="form-group col-md-3" id="photograph_attested_page_02">
                    {!! Form::label('status', 'Status:') !!}
                    {!! Form::select('status', [], null, ['id' => 'followup_statuses', 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Status', 'onchange' => 'onFollowupStatusSelect()', 'required']) !!}
               
            </div>
            <div class="form-group col-md-3" id="answered_by_div">
                <label>Answered By: </label>
                <div>
                    <input class="form-control" name="answered_by" id="answered_by" placeholder="Enter Answered By" required="" type="input"/>
                </div>
            </div>
            <div class="form-group col-md-3" id="attendant_relationship_div">
                <label>Attendant Relationship (With Student): </label>
                <div>
                    <input class="form-control" name="student_relationship_with_attendant" id="attendant_relationship" placeholder="Enter Attendant Relationship" required="" type="input"/>
                </div>
            </div>
            <div class="form-group col-md-3" id="followup_interested_level_div" hidden="true">
                {!! Form::label('ranking', 'Followup Ranking:') !!}
                {!! Form::select('interest_level_id', config('constants.follow_up_interested_levels'), null, ['id' => 'interest_level_id', 'class' => 'form-control select2-multiple', 'placeholder' => 'Select Followup Ranking', 'required']) !!}
            </div>
            <div class="form-group col-md-3" id="followup_date_div" hidden="true">
                <label>
                    Next Follow-Up Date:
                </label>
                <div>
                    <input class="form-control" data-date-format="YYYY-MM-DD" name="next_date" id="next_date" min="{{$fileInfo->follow_up}}" placeholder="Enter Next Follow-Up Date" required="" type="date"/>
                </div>
            </div>
            <div class="col-md-12">
                <label>
                    Remarks:
                </label>
                <div>
                    <textarea class="form-control letter_capitalize" name="remarks" id="remarks" required="" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">
                    Add To Follow-ups
                </button>
                <a class="btn btn-secondary" href="/records" data-dismiss="modal" type="button">
                    Close
                </a>
            </div>            
        </div>
        </form>
    </div>
</div>
@endif
<br/>
<div class="card shadow mt-2 ml-4 mr-4">
    <div class="card-body" id="service_detail_parent">
        <div class="card-header clearfix font-weight-bold">
            Followup Details (Eligible):
        </div>
        <span class="text-danger"><b>Note: </b><u>Last followup will be shown at top in below history</u></span>
            <table cellspacing="0" class="table table-striped table-bordered" isdefault="true" width="100%">
                <thead>
                    <tr>
                        <th>
                            No.
                        </th>
                        <th>
                            Called By
                        </th>
                        <th>
                            Call Status
                        </th>
                        <th>
                            Answered By
                        </th>
                        <th>
                            Revised Enquiry Status
                        </th>
                        <th>
                            Revised Enquiry Ranking
                        </th>
                        <th>
                            Followup Date
                        </th>
                        <th>
                            Remarks
                        </th>
                    </tr>
                </thead>
                <tbody>
                   @php $i = 1; @endphp
                   @if($familyCalls !=  null)
                        @foreach($familyCalls as $calls)
                            <tr>
                                <td>
                                    {{$i++}}
                                </td>
                                <td>
                                    {{ $calls->callby!=null?$calls->callby:'---' }}
                                </td>
                                <td>
                                    
                                      @php
                                        $call_status = config('constants.call_statuses');
                                        if($calls->callstatus != null){
                                            foreach($call_status as $checkCallStatus =>$key){
                                                if($checkCallStatus == $calls->callstatus  && $calls->callstatus != null){
                                                    echo $key;
                                                }
                                            }
                                        }else{
                                            echo '---';
                                    }
                                    @endphp
                                    
                                </td>
                                <td>
                                    {{ $calls->answeredby!=null?$calls->answeredby:'---' }}
                                </td>
                                <td>
                                    @php
                                        $followUpStatus = config('constants.followup_statuses');
                                        if($calls->status != null){
                                            foreach($followUpStatus as $checkFollowUpStatus =>$key){
                                                if($checkFollowUpStatus == $calls->status && $calls->status != null){
                                                    echo $key;
                                                }
                                            }
                                       }else{
                                            echo '---';
                                    }
                                    @endphp
                                    
                                </td>
                                <td>
                                    @php
                                        $follow_up_interested_levels = config('constants.follow_up_interested_levels');
                                        if($calls->followupranking != null){
                                            foreach($follow_up_interested_levels as $checkInterest =>$key){
                                                if($checkInterest == $calls->followupranking && $calls->followupranking != null ){
                                                    echo $key;
 
                                                }
                                            }
                                      }else{
                                        echo '---';
                                      }
                                
                                    @endphp
                                    <!-- {{ $calls->followupranking!=null?$calls->followupranking:'---' }} -->
                                </td>
                                <td>
                                    {{ $calls->nextfollowupdate!=null ? $calls->nextfollowupdate : '---'}}
                                </td>
                                <td>
                                    {{ $calls->remarks!=null?$calls->remarks:'---' }}
                                </td>
                            </tr>
                        @endforeach
                   @endif
                </tbody>
            </table>
     
    </div>
</div>
</body>
<script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
<script>
    $('.datepicker').each(function (index, pick) {
        let picker = $(pick).datepicker({
            format: 'yyyy-mm-dd'
        }).on('changeDate', function (ev) {
            picker.hide();
        }).data('datepicker');
    });
    function parseDate(str) {
        var mdy = str.split('/');
        return new Date(mdy[2], mdy[0]-1, mdy[1]);
    }

    function datediff(first, second) {
        // Take the difference between the dates and divide by milliseconds per day.
        // Round to nearest whole number to deal with DST.
        return Math.round((second-first)/(1000*60*60*24));
    }

    alert(datediff(parseDate(first.value), parseDate(second.value)));
</script>
  <!-- Datatable init js -->
    <script src="{{ asset('js/jstree.js') }}"></script>
    <script type="text/javascript">

      var template = '{{json_encode(config('constants'))}}';
      var constants = JSON.parse(template.replace(/&quot;/g,'"'));

      // $('#enquiry_hierarchy').jstree();
    </script>
    <script src="{{ asset('js/followup/followup.js') }}"></script>