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
        .h1{
            font-weight: bold;
            font-family: 'PT Serif', serif;
            background: #17202A;
            color: white;
            padding: 15px;
            position: relative;
            top: -20px;
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
            <div class="col-lg-12">
                <label class="col-md-12 h1">Worker's Followup:</label>
            </div>
        </div>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead class="thead-dark">
                <tr>
                    @php $i = 1; @endphp
                    <th scope="col" class="text-center" width="5%">Serial #.</th>
                    <th scope="col">Worker's Name</th>
                    <th scope="col">Worker's CNIC</th>
                    <th scope="col">Total Period</th>
                    @can('view_non_eligible_list')
                        <th scope="col" class="text-center" width="5%">Action</th>
                    @endcan
                 </tr>
                </thead>
                <tbody>
                @if(!$list->isEmpty())
                        @foreach($list as $value)
                            @if($value->sum < 3)
                            <tr>
                                <td class="text-center">{{$i++}}</td>
                                <td>{{$value->worker_name}}</td>
                                <td>{{$value->worker_cnic}}</td>
                                <td>{{$value->sum}} Years</td>
                                @can('view_non_eligible_list')
                                    <td class="text-center"><a href="/worker-eligible/{{$value->index_table_id}}" class="btn btn-success btn-sm"><i class="fa fa-eye fa-fw"></i></a></td>
                                @endcan
                              </tr>
                            @endif
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
<script src="{{asset('pwwb/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('select2/js/select2.min.js')}}"></script>
<script src="{{asset('pwwb/js/custom.js')}}"></script>
