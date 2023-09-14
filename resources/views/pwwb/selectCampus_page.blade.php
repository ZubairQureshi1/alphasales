<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PWWB</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('pwwb/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('pwwb/css/datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('select2/css/select2.min.css')}}">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
    <style>
        .homestyle{
            background: none;
            border: none;
        }
        label{
            font-weight: bold;
            color: #566573;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <!-- Content here -->
    <div id="container_holder">
        <div class="card mt-5">
            <div class="card-header" style="font-weight: bold; font-size: 30px; font-family: 'Balsamiq Sans', cursive;
        background: #17202A; color: #ffffff;">
                PWWB Select Organization Campus For the File  : <b>{{$data->file_received_number}}</b>
            </div><br>
            <div class="card shadow p-3 w-100">
                <div class="card-body">
                    <form action="/setCampus" method="post">
                        @CSRF
                    <div class="form-row">                        
                        <div class="form-group col-md-2">
                            <label>File Received Number:</label><br/>
                            <input type="hidden" name="index_table_id" id="index_table_id" value="{{$data->id}}">
                            <label>{{$data->file_received_number}}</label>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Submission Number:</label><br/>
                            <label>{{$data->fresh_file_submission_in_pwwb_number}}</label>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Priority of Submission:</label><br/>
                           <label>{{$data->priority_of_submission}}</label>
                        </div>
                        
                        <div class="form-group col-md-2">
                            <label>Diary Number:</label><br/>
                            <label>{{$data->pwwb_diary_number}}</label>
                        </div>

                        <div class="form-group col-md-2">
                            <label>Select Organization Campus: </label> 
                            <select id="organization_campus_id" name="organization_campus_id" style="width: 300px!important;" class="select2">  
                                <option selected="" disabled="">-- Select Organization Campus --</option>
                                @foreach($organization_campus_data as $val)
                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="forn-group col-md-2">
                            <label>Action</label><br/>
                            <button type="submit" name="btnSave" id="btnSave" onclick="setCampus();" class="btn btn-primary">Assign Organization Camous</button>
                        </div>

                    </div>
                </form>
                </div>
            </div><br>
        </div>
    </div>
</div>

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
<script src="{{asset('pwwb/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('select2/js/select2.min.js')}}"></script>
<script src="{{asset('pwwb/js/custom.js')}}"></script>
</body>
</html>
