<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('pwwb/css/datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('select2/css/select2.min.css')}}">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <title>CFE FORM</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <meta name="index_id" content="{{ $data['index_id'] ?? ''}}">--}}
    <meta name="index_id" content="11">
    <style type="text/css">
        label{
        font-weight: bold;
        color: black;
        font-family: 'PT Serif', serif;
        text-align: center;
        color: white;
    }
    h1{
        font-weight: bold; 
        text-align: center; 
        font-family: 'PT Serif', serif; 
        background: #17202A; 
        color: white; 
        padding: 15px; 
        position: relative; 
        top: -20px;
    }
    p{
        text-align: center;
    }
    .dataTables_filter label {
        color: #666666;
    }
    .dataTables_length label{
        color: #666666;
    }
    label {
        color: #666666;
    }
    </style>
</head>
<body>

<div class="card shadow mt-5 p-3 w-100">
            <div class="card-body" id="worker_detail_parent">
                <div class="form-row">
                    <div class="col-md-12">
                       <h1>Prospect Followups</h1>
                    </div>
                </div>
<br/>
<div class="card shadow p-3 w-100">
                <div class="card-body">
                    <div class="form-row">
                     
                        <div class="form-group col-md-2">
                            <label>Followup (Start):</label><br>
                            <input id="followupDateStartFilter" value="<?php echo date("Y-m-d"); ?>" data-date-format='yyyy-mm-dd' class="form-control" type="date" style="width: 80%;" placeholder="Enter Start Date" name="followupDateStart">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Followup (End):</label><br>
                            <input id="followupDateEndFilter" value="<?php echo date("Y-m-d"); ?>" data-date-format='yyyy-mm-dd' class="form-control" type="date" style="width: 80%;" placeholder="Enter End Date" name="followupDateEnd">
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="col-md-12">
                <a href="#" id="clickButtonFollowup" style="float: left; font-weight: bold; margin-left: 10px;" name="clickButtonFollowup" class="btn btn-info" ><i class="fa fa-eye"></i> Followups Export</a>
            </div><br>
       <table id="follow_up" class="table table-striped table-bordered" style="width:100%">
          
            <thead class="thead-dark">
            <tr>
                <th scope="col">Serial #.</th>
                <th scope="col">File Received No.</th>
                <th scope="col">Fresh File Submission</th>
                <th scope="col">Worker's Name</th>
                <th scope="col">Worker's CNIC</th>
                <th scope="col">File Received Status</th>
                <th scope="col">PWWB Diary No</th>
                <th scope="col">First Followup Date</th>
                <th scope="col">Next Followup Date</th>
                <th scope="col">Action</th>
             </tr>
            </thead>
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
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

<script>
$('.datepicker').each(function (index, pick) {
        let picker = $(pick).datepicker({
            format: 'yyyy-mm-dd'
        }).on('changeDate', function (ev) {
            picker.hide();
        }).data('datepicker');
    });
</script>

<script type="text/javascript">
    var updatePermissionForProspectFollowup = {{ auth()->user()->can('update_prospect_followups') ? 'true' : 'false' }};
</script>


<script src="{{asset('pwwb/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('select2/js/select2.min.js')}}"></script>
<script src="{{asset('pwwb/js/custom.js')}}"></script>
