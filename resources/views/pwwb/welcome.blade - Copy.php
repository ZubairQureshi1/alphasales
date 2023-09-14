<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker3.css')}}">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:wght@700&display=swap" rel="stylesheet">
    <title>CFE FORM</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="index_id" content="{{ $data['index_id'] ?? ''}}">
    {{--    <meta name="index_id" content="13">--}}
    <style type="text/css">
        .font{
            font-size: 14px;
            font-weight: bold;
            color: #D0D3D4;
            font-family: 'Balsamiq Sans', cursive;
            border-bottom: 1px solid white;
            margin-top: 10px;
            padding-left: 3px;
            padding-right: 0px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <!-- Content here -->
    <div class="row">
        <div class="col-md-2" style="background: #17202A;">
            <a href="{{url('/')}}"><img src="{{url('logoo.png')}}" style="height: 185px;"></a>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link font active" id="v-pills-page_1-tab" data-toggle="pill" href="#v-pills-page_1" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#D0D3D4'" role="tab" aria-controls="v-pills-page_1" aria-selected="true"><i class="fa fa-receipt" style="color: white;"></i> Receipt & Submission</a>
                <a class="nav-link font" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#D0D3D4'" id="v-pills-page_2-tab" data-toggle="pill" href="#v-pills-page_2" role="tab" onclick="setDisplayForButtons()" aria-controls="v-pills-page_2" aria-selected="true"><i class="fa fa-user" style="color: white;"></i> Worker's Personal Detail</a>
                <a class="nav-link font" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#D0D3D4'" id="v-pills-page_3-tab" data-toggle="pill" href="#v-pills-page_3" role="tab" onclick="setDisplayForButtons()" aria-controls="v-pills-page_3" aria-selected="true"><i class="fa fa-thumbs-up" style="color: white;"></i> Worker's Social Security Details</a>
                <a class="nav-link font" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#D0D3D4'" id="v-pills-page_4-tab" data-toggle="pill" href="#v-pills-page_4" role="tab" onclick="setDisplayForButtons()" aria-controls="v-pills-page_4" aria-selected="true"><i class="fa fa-house-user" style="color: white;"></i> Factory Details</a>
                <a class="nav-link font" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#D0D3D4'" id="v-pills-page_5-tab" data-toggle="pill" href="#v-pills-page_5" role="tab" onclick="setDisplayForButtons()" aria-controls="v-pills-page_5" aria-selected="true"><i class="fa fa-industry" style="color: white;"></i> Factory Manager's Details</a>
                <a class="nav-link font" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#D0D3D4'" id="v-pills-page_6-tab" data-toggle="pill" href="#v-pills-page_6" role="tab" onclick="setDisplayForButtons()" aria-controls="v-pills-page_6" aria-selected="true"><i class="fa fa-award" style="color: white;"></i> Personal Data of Student</a>
                <a class="nav-link font" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#D0D3D4'" id="v-pills-page_7-tab" data-toggle="pill" href="#v-pills-page_7" role="tab" onclick="setDisplayForButtons()" aria-controls="v-pills-page_7" aria-selected="true"><i class="fa fa-school" style="color: white;"></i> Educational Wing</a>
                <a class="nav-link font" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#D0D3D4'" id="v-pills-page_12-tab" data-toggle="pill" href="#v-pills-page_12" role="tab" onclick="setDisplayForButtons()" aria-controls="v-pills-page_12" aria-selected="true"><i class="fa fa-bus-alt" style="color: white;"></i> Transport Details</a>
                <a class="nav-link font" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#D0D3D4'" id="v-pills-page_13-tab" data-toggle="pill" href="#v-pills-page_13" role="tab" onclick="setDisplayForButtons()" aria-controls="v-pills-page_13" aria-selected="true"><i class="fa fa-file-alt" style="color: white;"></i> Documents Attached</a>
                <a class="nav-link font" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#D0D3D4'" id="v-pills-page_14-tab" data-toggle="pill" href="#v-pills-page_14" role="tab" onclick="setDisplayForButtons()" aria-controls="v-pills-page_14" aria-selected="true"><i class="fa fa-tasks" style="color: white;"></i> Provisional Letter From PWWB</a>
            </div>
        </div>
        <div class="col-md-10 mt-4 mb-4 pb-5 clearfix">
            <div id="container_holder">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-page_1" role="tabpanel" aria-labelledby="v-pills-page_1-tab">
                        @include('pages.page_01')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_2" role="tabpanel" aria-labelledby="v-pills-page_2-tab">
                        @include('pages.page_02')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_3" role="tabpanel" aria-labelledby="v-pills-page_3-tab">
                        @include('pages.page_03')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_4" role="tabpanel" aria-labelledby="v-pills-page_4-tab">
                        @include('pages.page_04')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_5" role="tabpanel" aria-labelledby="v-pills-page_5-tab">
                        @include('pages.page_05')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_6" role="tabpanel" aria-labelledby="v-pills-page_6-tab">
                        @include('pages.page_06')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_7" role="tabpanel" aria-labelledby="v-pills-page_7-tab">
                        @include('pages.page_07')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_12" role="tabpanel" aria-labelledby="v-pills-page_12-tab">
                        @include('pages.page_12')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_13" role="tabpanel" aria-labelledby="v-pills-page_13-tab">
                        @include('pages.page_13')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_14" role="tabpanel" aria-labelledby="v-pills-page_14-tab">
                        @include('pages.page_14')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_15" role="tabpanel" aria-labelledby="v-pills-page_15-tab">
                        @include('pages.page_15')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_16" role="tabpanel" aria-labelledby="v-pills-page_16-tab">
                        @include('pages.page_16')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_17" role="tabpanel" aria-labelledby="v-pills-page_17-tab">
                        @include('pages.page_17')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_18" role="tabpanel" aria-labelledby="v-pills-page_18-tab">
                        @include('pages.page_18')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_19" role="tabpanel" aria-labelledby="v-pills-page_19-tab">
                        @include('pages.page_19')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_20" role="tabpanel" aria-labelledby="v-pills-page_20-tab">
                        @include('pages.page_20')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_21" role="tabpanel" aria-labelledby="v-pills-page_21-tab">
                        @include('pages.page_21')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_22" role="tabpanel" aria-labelledby="v-pills-page_22-tab">
                        @include('pages.page_22')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_23" role="tabpanel" aria-labelledby="v-pills-page_23-tab">
                        @include('pages.page_23')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_24" role="tabpanel" aria-labelledby="v-pills-page_24-tab">
                        @include('pages.page_24')
                    </div>
                    <div class="tab-pane fade show" id="v-pills-page_25" role="tabpanel" aria-labelledby="v-pills-page_25-tab">
                        @include('pages.page_25')
                    </div>
                </div>
            </div>
            <div class="mt-4 mb-4 pb-5 clearfix">
                <button id="prevButton" type="button" class="btn btn-primary float-left" onclick="prevForm()">Previous</button>
                <button id="nextButton" type="button" class="btn btn-primary float-right" onclick="nextForm()">Next</button>
                <button id="saveButton" type="button" class="btn btn-primary float-right" onclick="saveForm()">Save</button>
            </div>
        </div>
    </div>
    {{--    <div class="mt-4">--}}
    {{--        <input type="number" id="goToPage">--}}
    {{--        <button type="button" onclick="goToPage()" class="btn btn-outline-success">GO</button>--}}
    {{--    </div>--}}
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    let container_no = 0;
    let container_array = ['#page_01', '#page_02', '#page_03', '#page_04', '#page_05', '#page_06', '#page_07', '#page_12', '#page_13', '#page_14'];
    let api_url_array = ['/index-table','/worker-personal-details','/worker-bank-security-details','/factory-service-details','/factory-death-manager-details','/student-personal-details','/educational-wing-details','/transport-hostel-details','/document-attachment-details','/provisional-claim-details'];
    let index_id = $('meta[name="index_id"]').attr('content');
    setDisplayForButtons();
    $('.datepicker').each(function (index, pick) {
        let picker = $(pick).datepicker({
            format: 'dd/mm/yyyy',
            endDate:'0d',
            autoclose : true
        });
    });
    $('.datepickerAll').each(function (index, pick) {
        let picker = $(pick).datepicker({
            format: 'dd/mm/yyyy',
            autoclose : true
        });
    });

    $('.datepickerFuture').each(function (index, pick) {
        let picker = $(pick).datepicker({
            format: 'dd/mm/yyyy',
            startDate:'0d',
            autoclose : true
        });
    });

    setDisplayNone();

    function setDisplayNone() {

        // container_array.forEach(function (value) {
        //     $(value).attr('style', 'display:none');
        // });
        $(container_array[container_no]).attr('style', 'display:block');
    }

    function saveForm(){
        apiRequest();
        window.location.href = "/home";
        // if(container_no < container_array.length){
        //     apiRequest();
        //     window.location.href = "/home";
        // }
    }

    function nextForm() {
        var current_pill = $('.nav-pills a.active').attr('href');
        // alert(current_pill);
        // alert(sessionStorage.getItem("semester_check"));
        if(sessionStorage.getItem("semester_check") == '/first-semester' &&  current_pill == '#v-pills-page_14'){
            console.log('/first-semester');
            var sem_reach = '#v-pills-page_17';
            var current_pill = $('.nav-pills a.active').attr('href');
            $('.nav-pills a').removeClass("active"); // remove class active from all tabs
            $('.tab-pane').removeClass("active"); // remove class active from all panes
            $(sem_reach.toString()).addClass("show");
            $(sem_reach.toString()).addClass("active");

            $('.nav-pills a[href="'+sem_reach+'"]').addClass("active"); // add class active to the next pill

            if (container_no < container_array.length) {
                console.log('a');
                apiRequest();

                container_no++;
                setDisplayNone();
                console.log('b');
                setDisplayForButtons();
                console.log('c');
                scrollToTop();
                console.log('d');
            }
        }else{
            var current_pill = $('.nav-pills a.active').attr('href');
            $('.nav-pills a').removeClass("active"); // remove class active from all tabs
            $('.tab-pane').removeClass("active"); // remove class active from all panes
            $(current_pill.toString()).next().addClass("show");
            $(current_pill.toString()).next().addClass("active");

            $('.nav-pills a[href="'+current_pill+'"]').next().addClass("active"); // add class active to the next pill

            if (container_no < container_array.length) {
                apiRequest();
                container_no++;
                setDisplayNone();
                setDisplayForButtons();
                scrollToTop();
            }
        }

        //going to next nav pill and pane code

        // var splited_string = current_pill.split('-');
        // var current_tab_number = parseInt(splited_string[2].split('_')[1]);
        // var next_tab_number = parseInt(current_tab_number)+1;
        // var next_tab_id = splited_string[0] +'-'+ splited_string[1] +'-'+ splited_string[2].split('_')[0]+'_'+next_tab_number;
        // $(next_tab_id.toString()).addClass("show");
        // $(next_tab_id.toString()).next().addClass("active"); // add class active to the next pane




    }

    function prevForm() {

        //going to previous nav pill and pane
        var current_pill = $('.nav-pills a.active').attr('href');
        $('.nav-pills a').removeClass("active"); // remove class active from all tabs
        $('.tab-pane').removeClass("active"); // remove class active from all panes
        $(current_pill.toString()).prev().addClass("show");
        $(current_pill.toString()).prev().addClass("active");
        // console.log(current_pill-1);
        // var splited_string = current_pill.split('-');
        // var current_tab_number = parseInt(splited_string[2].split('_')[1]);
        // var previous_tab_number = parseInt(current_tab_number)-1;
        // var previous_tab_id = splited_string[0] +'-'+ splited_string[1] +'-'+ splited_string[2].split('_')[0]+'_'+previous_tab_number;
        // $(previous_tab_id.toString()).addClass("active"); // add class active to the previous pane
        $('.nav-pills a[href="'+current_pill+'"]').prev().addClass("active"); // add class active to the previous pill

        if (container_no > 0) {
            container_no--;
            setDisplayNone();
            setDisplayForButtons();
            scrollToTop();
        }
    }

    function setDisplayForButtons() {
        // if (container_no == 0) {
        //     $('#prevButton').attr('style', 'display:none');
        // } else {
        //     $('#prevButton').attr('style', 'display:block');
        // }

        // if (container_no == container_array.length - 1) {
        //     $('#nextButton').attr('style', 'display:none');
        //     $('#saveButton').attr('style', 'display:block');
        // } else {
        //     $('#nextButton').attr('style', 'display:block');
        //     $('#saveButton').attr('style', 'display:none');
        // }
        console.log($('.nav-pills a.active').attr('href'));
        if($('.nav-pills a.active').attr('href').toString() == '#v-pills-page_25')
        {
            $('#saveButton').show();
            $('#nextButton').hide();
        }
        else
        {
            $('#nextButton').show();
            $('#saveButton').hide();
        }
    }

    function scrollToTop() {
        $('body,html').animate({
            scrollTop: 0
        }, 800);
    }

    function apiRequest() {
        if (api_url_array.length > container_no) {
            let form = $(container_array[container_no] + '_form').serializeArray();
            form.push({name: "index_id", value: index_id});
            let csrf_token = $('meta[name="csrf-token"]').attr('content');
            let index_number = container_no;
            let request = $.ajax({
                url: api_url_array[container_no],
                method: "POST",
                data: form,
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                }
            });

            request.done(function (response) {
                if (api_url_array[index_number] == '/index-table') {
                    if(response.indexObject)
                        index_id = response.indexObject.id;
                }
            });

            request.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        }
    }

    function goToPage() {
        let page = $('#goToPage').val();
        container_no = page-1;
        setDisplayNone();
        setDisplayForButtons();
    }

    function containerArraySearch(value) {
        let result = container_array.indexOf(value);
        if(result != -1)
            return true;
        else
            return false;
    }
    sessionStorage.clear();

    function lettersOnly(evt)
    {
        var charCode = (evt.which) ? evt.which : window.event.keyCode;
        if (charCode <= 13) {
            return true;
        }
        else {
            var keyChar = String.fromCharCode(charCode);
            var re = /^[a-zA-Z ]+$/
            return re.test(keyChar);
        }
    }

</script>
@yield('script_page_1')
@yield('script_page_2')
@yield('script_page_4')
@yield('script_page_6')
@yield('script_page_7')
@yield('script_page_12')
@yield('script_page_14')
@yield('script_page_15')
@yield('script_page_16')
@yield('script_page_17')
@yield('script_page_18')
@yield('script_page_19')
@yield('script_page_20')
@yield('script_page_21')
@yield('script_page_22')
@yield('script_page_23')
@yield('script_page_24')
</body>
</html>

