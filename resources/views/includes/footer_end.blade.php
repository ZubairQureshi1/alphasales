<!-- App js -->
<script src="{{asset('assets/js/app.js')}}">
</script>
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
    function mySnackBar(message) {
        // Get the snackbar DIV
        var x = document.createElement("p"); 
        x.setAttribute("id", "snackbar");
        x.setAttribute("class", "show");
        message.innerHTML = message;
        var t =  document.createTextNode(message); 
        x.appendChild(t); 
        // x.className = "show";
        document.body.appendChild(x); 
        // Add the "show" class to DIV
        // After 3 seconds, remove the show class from DIV
        setTimeout(function(){ 
            x.className = x.className.replace("show", ""); 
            x.parentNode.removeChild(x);
        }, 8000);
    }
</script>
<script type="text/javascript">
    $(function() {
        mySnackBar("Just in case of facing any issue please press CRTL + SHIFT + R");
    });
        $(".target :input").prop("disabled", true);
</script>