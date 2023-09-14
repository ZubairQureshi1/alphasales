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

<div class="card shadow mt-5 p-3 w-100">
    <div class="card-body" id="worker_detail_parent">
        <div class="form-row">
            <div class="col-lg-12">
                <label class="col-md-12 h1">Worker's Eligiblity Follow-up:</label>
            </div>
        </div>
    {{-- <form action="/worker-family" method="GET">
                    <div class="form-row">
                        <div class="col-md-4">
                            <input value="{{$date ? $date : ''}}" name="date" class="form-control datepicker" type="text" placeholder="yyyy-mm-dd">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-outline-success">Search</button>
                        </div>
                    </div>
                </form> --}}
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Serial No</th>
                <th scope="col">File Received No</th>
                <th scope="col">Factory Name</th>
                <th scope="col">Appointment Date</th>
                <th scope="col">Job Leaving Date</th>
                <th scope="col">Total Period</th>
                <th scope="col">Completion Date</th>
                <th scope="col">Service Completion Status</th>
                <th scope="col">Attested by Factory Manager</th>
                <th scope="col">Attestation by DOL</th>
                <th scope="col">Attestation by Dir. Labor</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @if($workerEligible)
                @php $total = 0; @endphp
                @foreach($workerEligible as $worker_details)
                    @php $total_period = (float)$worker_details['total_period']? (float)$worker_details['total_period'] : '--' @endphp
                    <tr>
                        <td>{{$worker_details['serial_no'] ? $worker_details['serial_no'] : '--'}}</td>
                        <td>{{$worker_details->IndexTable->file_received_number}}</td>
                        <td>{{$worker_details['name']? $worker_details['name'] : '--'}}</td>
                        <td>{{$worker_details['appointment_date']? $worker_details['appointment_date'] : '--'}}</td>
                        <td>{{$worker_details['job_leaving_date']? $worker_details['job_leaving_date'] : '--'}}</td>

                        <td>
                            @if($worker_details['total_period'] == 'NaN.NaN')
                                {{'0'}}
                            @else
                                {{$worker_details['total_period']? $worker_details['total_period'] : '--'}}
                            @endif

                        </td>

                        <td>{{$worker_details['completion_date'] ? $worker_details['completion_date'] : '--'}}</td>
                        <td>{{$worker_details['service_completion_status']? $worker_details['service_completion_status'] : '--'}}</td>
                        <td>{{$worker_details['attested_by_factory_manager'] ? $worker_details['attested_by_factory_manager'] : '--'}}</td>
                        <td>{{$worker_details['attested_by_dol'] ? $worker_details['attested_by_dol'] : '--'}}</td>
                        <td>{{$worker_details['attested_by_director'] ? $worker_details['attested_by_director'] : '--'}}</td>
                        <td>
                            <a href="/view/{{$worker_details->IndexTable->id}}" class="btn btn-info w-100"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    @php $total_period = (float)$worker_details['total_period']? (float)$worker_details['total_period'] : '--' @endphp
                    @php

                        $total += (float)$total_period;

                    @endphp
                @endforeach
                <td style="border: none; position: absolute;right: 40px;"><label style="color: red; font-weight: bold; float: right;">Accumulated Service Period :
                        {{$total}} Years</label></td>
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
