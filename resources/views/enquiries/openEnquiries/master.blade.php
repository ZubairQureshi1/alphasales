<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="UTF-8">
		<title>@yield('title') – Open Enquiries</title>
		<meta charset="utf-8">
	    <meta name="_token" content="{{ csrf_token() }}">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    {{-- global css header --}}
	    @include('includes.add_css_globaly')
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/custom/loader.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/custom/buttons.css') }}" rel="stylesheet" type="text/css">
	    {{-- page level style --}}
		@stack('css')
	</head>
	<body class="bg-light">
		<div class="row no-gutters">
			<div class="col-md-12">
				{{-- content --}}
				@yield('content')
				{{-- /.content --}}
			</div>
		</div>

		{{-- scripts --}}
		@include('includes.add_js_globaly')
		<script type="text/javascript">
		    $('.select2').select2();

		    function alphabaticOnly(event) {
		        return ((event.charCode > 64 && 
		        event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32)?true: false ;
		    }

		    // validation and terms for number input

		    function numericOnly(event) {
		    	console.log(event);
		    	if (((event.charCode > 47 && event.charCode < 58) || event.charCode == 45)) {
					return true;	
		    	} else {
			        return false;
		    	}
		    }
		    function validateNumberByMin(event) {
		    	if (event.target.min != "" && (parseInt(event.target.value) < parseInt(event.target.min))) {
					alertify.error('Value must be greater than ' + event.target.min + '.');
					event.target.value = 0;
				} else {
					validateNumberByMax(event);
				}
		    }
		    function validateNumberByMax(event) {
		    	if ((event.target.max) != "" && (parseInt(event.target.value) > parseInt(event.target.max))) {
					alertify.error('Value should not be greater than ' + event.target.max + '.');
					event.target.value = 0;
				}
		    }
		    // ---------------------------------------------------
		</script>
		{{-- page level scripts --}}
		@stack('js')
	</body>
</html>