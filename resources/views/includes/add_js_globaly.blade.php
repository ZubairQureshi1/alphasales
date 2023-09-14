@if (request()->route()->getName() == 'enquiries.create')
   
@else
  
@endif
<script src="{{ asset('assets/js/jquery.min.js') }}">
</script>
<script src="{{ asset('assets/js/popper.min.js') }}">
</script>
<!-- Popper for Bootstrap -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}">
</script>
<script src="{{ asset('assets/js/modernizr.min.js') }}">
</script>
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}">
</script>
<script src="{{ asset('assets/js/waves.js') }}">
</script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}">
</script>
<script src="{{ asset('assets/plugins/alertify/js/alertify.js') }}">
</script>
<script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}">
</script>
<script src="{{ asset('js/steps-modal.js') }}">
</script>
<script src="{{ asset('js/global.js') }}">
</script>
<script src="{{ asset('js/notify.js') }}">
</script>
<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js">
</script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}">
</script>
<script src="{{ asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}">
</script>
<script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}">
</script>
<script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}">
</script>
<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js">
</script>
<script src="{{ asset('js/FileSaver.js') }}">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.0/xlsx.core.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.0.0/js/tableexport.js">
</script>
<script src="{{ asset('plugins/smartwizard/dist/js/jquery.smartWizard.js') }}" type="text/javascript">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js">
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#smartwizard').smartWizard();

    });
</script>
<script type="text/javascript">
    var base_url = '{{ json_encode(url('/')) }}';
    base_url = JSON.parse(base_url.replace(/&quot;/g, '"'));
</script>
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript">
</script>
{{-- INTROJS --}}
<script src="{{ asset('plugins/introJs/intro.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/internet_connectivity_detect.js') }}" type="text/javascript" async></script>
@stack('javascript')
