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
    <meta name="index_id" content="{{ $data['index_id'] ?? ''}}">
{{--    <meta name="index_id" content="13">--}}
</head>
<body>
    <div class="container-fluid">
        <!-- Content here -->
        <div id="container_holder">
            @include('pwwb/view_pages.page_01_view')
            @include('pwwb/view_pages.page_02_view')
            @include('pwwb/view_pages.page_03_view')
            @include('pwwb/view_pages.page_04_view')
            @include('pwwb/view_pages.page_05_view')
            @include('pwwb/view_pages.page_06_view')
            @include('pwwb/view_pages.page_07_view')
            @include('pwwb/view_pages.page_11_view')
            @include('pwwb/view_pages.page_12_view')
            @include('pwwb/view_pages.page_13_view')
            @include('pwwb/view_pages.page_14_view')
            @include('pwwb/view_pages.page_15_view')
            @include('pwwb/view_pages.page_16_view')
            @include('pwwb/view_pages.page_17_view')
            @include('pwwb/view_pages.page_18_view')
            @include('pwwb/view_pages.page_19_view')
            @include('pwwb/view_pages.page_20_view')
            @include('pwwb/view_pages.page_21_view')
            @include('pwwb/view_pages.page_22_view')
            @include('pwwb/view_pages.page_23_view')
            @include('pwwb/view_pages.page_24_view')
        </div>
    </div>
</body>
</html>
