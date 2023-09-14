<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/datepicker.css')}}">

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
    </style>
</head>
<body>

<div class="card shadow mt-5 p-3 w-100">
            <div class="card-body" id="worker_detail_parent">
                <div class="form-row">
                    <div class="col-md-12">
                       <h1>Worker's Eligible Family Members</h1>
                    </div>
                </div>
                <form action="/worker-family" method="GET">
                    <div class="form-row">
                        <div class="col-md-4">
                            <input value="{{$date ? $date : ''}}" name="date" class="form-control datepicker" type="text" placeholder="yyyy-mm-dd">
                        </div>
                        <div class="col-md-4">
                            <input value="" name="cnic" id="cnic" class="form-control" type="text" placeholder="By CNIC">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Search</button>
                        </div>
                    </div>
                </form><br>
                <div class="form-row" style="background: #17202A;">
                    <div class="border col-md-1 text-center">
                        <label><strong>File Received No.</strong></label>
                    </div>
                    <div class="border col-md-2 text-center">
                        <label><strong>Worker Name</strong></label>
                    </div>
                    <div class="border col-md-2 text-center">
                        <label><strong>Worker's CNIC</strong></label>
                    </div>
                    <div class="border col-md-1 text-center">
                        <label><strong>Student Name</strong></label>
                    </div>
                    <div class="border col-md-1 text-center">
                        <label><strong>Passed Degree</strong></label>
                    </div> 
                    <div class="border col-md-1 text-center">
                        <label><strong>Potential Degree</strong></label>
                    </div>
                    <div class="border col-md-1 text-center">
                        <label><strong>File Received Status</strong></label>
                    </div>
                    <div class="border col-md-1 text-center">
                        <label><strong>Follow-up</strong></label>
                    </div>
                    <div class="border col-md-1 text-center">
                        <label><strong>Needs Follow-up</strong></label>
                    </div>
                    <div class="border col-md-1 text-center">
                        <label><strong>View</strong></label>
                    </div>
                </div>
                @if($workerFamily)
                    @foreach($workerFamily as $worker_details)
                        <div class="form-row" id="worker_detail" style="background: #F8F9F9;">
                            <div class="border col-md-1 p-0">
                                <p>
                                {{$worker_details->IndexTable->file_received_number}}
                                </p>
                            </div>
                            <div class="border col-md-2 p-0">
                                <p>
                                    <a href="{{url('/worker-eligible/'.$worker_details['index_table_id'])}}"
                                    class="btn btn-success w-100">{{$worker_details['worker_name']? $worker_details['worker_name'] : '--'}}</a>
                                </p>
                            </div>
                            <div class="border col-md-2 p-0">
                                <p>
                                    {{$worker_details['worker_cnic']? $worker_details['worker_cnic'] : '--'}}
                                </p>
                            </div>
                            <div class="border col-md-1 p-0">
                                <p>
                                    {{$worker_details['student_name']? $worker_details['student_name'] : '--'}}
                                </p>
                            </div>
                            <div class="border col-md-1 p-0">
                                <p>
                                    {{$worker_details['passed_degree']? $worker_details['passed_degree'] : '--'}}
                                </p>
                            </div>
                            <div class="border col-md-1 p-0">
                                <p>
                                    {{$worker_details['potential_degree']? $worker_details['potential_degree'] : '--'}}
                                </p>
                            </div>
                            <div class="border col-md-1 p-0">
                                <p>
                                    {{$worker_details['file_received_status']? $worker_details['file_received_status'] : '--'}}
                                </p>
                            </div>
                            <div class="border col-md-1 p-0">
                                <p>
                                    {{$worker_details['follow_up']? $worker_details['follow_up'] : '--'}}
                                </p>
                            </div>
                            <div class="border col-md-1 p-0">
                                <p>
                                    @if($worker_details['follow_up_status'] == 'worker_follow_up')
                                        {{'Needs Follow Up'}}
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-1">
                            <a href="/view/{{$worker_details->IndexTable->id}}" class="btn btn-info w-100">VIEW</a>
                        </div>
                        </div>
                    @endforeach
                @endif
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
</script>
