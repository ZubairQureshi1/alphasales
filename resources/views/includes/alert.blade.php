@foreach (['danger', 'warning', 'success', 'info'] as $msg)
	@if(Session::has($msg))
		<div class="alert alert-{{ $msg }} alert-dismissible fade show my-3">
			{{ Session::get($msg) }}
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
	@endif
@endforeach