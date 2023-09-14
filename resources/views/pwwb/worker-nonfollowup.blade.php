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
                <label class="col-md-12 h1">Worker's Non-Followup:</label>
            </div>
        </div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    @php $i = 1; @endphp
                    <th scope="col">Serial #.</th>
                    <th scope="col">Worker's Name</th>
                    <th scope="col">Worker's CNIC</th>
                    <th scope="col">Student's Name</th>
                    <th scope="col">Passed Degree</th>
                    <th scope="col">Potential Degree</th>
                    <th scope="col">File Received Status</th>
                 </tr>
                </thead>
                <tbody>
                @if(!$workerFollowup->isEmpty())
                        @foreach($workerFollowup as $worker_details)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$worker_details->worker_name}}</td>
                            <td>{{$worker_details->worker_cnic}}</td>
                            <td>{{$worker_details->student_name}}</td>
                            <td>{{$worker_details->passed_degree}}</td>
                            <td>{{$worker_details->potential_degree}}</td>
                            <td>{{$worker_details->file_received_status}}</td>
                          </tr>
                      @endforeach
                @else
                <tr>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;">{{'No Data Found.'}}</td>
                </tr>

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
