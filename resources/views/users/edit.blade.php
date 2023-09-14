@include('includes/header_start')
	<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@include('includes/header_end')
		<!-- Page title -->
		<ul class="list-inline menu-left mb-0">
			<li class="list-inline-item">
				<button type="button" class="button-menu-mobile open-left waves-effect">
					<i class="ion-navicon"></i>
				</button>
			</li>
			<li class="hide-phone list-inline-item app-search">
				<h3 class="page-title">{!! $user->display_name !!}</h3>

			</li>
		</ul>

		<div class="clearfix"></div>
	</nav>

</div>

{!! Form::model($user, ['route' => ['users.changePassword', $user->id], 'method' => 'patch']) !!}

<div class="modal fade change_password" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title mt-0">Change<strong> Password</strong></h5>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				New Password:
				{!! Form::password('password', ['id' => 'password', 'class' => 'form-control']) !!}<br>
				Confirm New Password:
				{!! Form::password('confirm_password', ['id' => 'confirm_password', 'class' => 'form-control']) !!}
				<span id="message"></span>

			</div>
			<div class="modal-footer">
				{!! Form::submit('Save', ['class' => 'btn btn-primary submit_password', 'disabled' => '']) !!}
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}


<div class="page-content-wrapper">

	<div class="container-fluid">
		<div class="row">
			<div class="col-12 pull-right">   
				<button type="button" id="add" class="btn btn-secondary btn-sm waves-effect waves-light pull-right m-b-10 m-t-15-negative"  data-toggle="modal" data-target=".change_password"><i class="fa fa-unlock-alt fa-fw"></i> Change Password</button>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card m-b-30">
					<div class="card-body">
						{!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}

						@include('users.edit_user_detail_fields')

						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('includes/footer_start')


<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}"></script>
<script src="{{ asset('js/user/change-password.js')  }}"></script>

<script type="text/javascript">
	var constants = @json(config('constants'));
</script>

<script type="text/javascript" src="{{ asset('js/user/user.js') }}"></script>
<script type="text/javascript">$('.select2').select2()</script>
<script type="text/javascript">
	$(document).on('change', '.chk', function() {
		$('input.chk').not(this).prop('checked', false);  
	});
</script>

@include('includes/footer_end')

