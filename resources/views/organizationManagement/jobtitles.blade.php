@include('includes/header_start')

<!-- DataTables -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@include('includes/header_end')
<!-- Page title -->
<ul class="list-inline menu-left mb-0">
	<li class="list-inline-item">
		<button type="button" class="button-menu-mobile open-left waves-effect">
			<i class="ion-navicon"></i>
		</button>
	</li>
	<li class="hide-phone list-inline-item app-search">
		<h3 class="page-title">Job TItle</h3>
	</li>
</ul>
<div class="clearfix"></div>
</nav>

</div>
<!-- Top Bar End -->

<!-- ==================
	  PAGE CONTENT START
	  ================== -->

	  <div class="page-content-wrapper" id="departments">

	  	<div class="container-fluid">

	  		<div class="modal fade create_subect_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	  			<div class="modal-dialog modal-dialog-centered modal-lg">
	  				<div class="modal-content">
	  					<div class="modal-header">
	  						<h5 class="modal-title mt-0">Add<strong> Job Title</strong></h5>
	  						<button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">×</button>
	  					</div>
	  					<div class="modal-body">
	  						<form method="POST" action="{{ route('jobtitle.store') }}">
	  							@csrf                        
	  							<div class="form-row">
		  							<div class="form-group col-12">
		  								@if (App\Models\Organization::count() > 0)
		  								<label>Organization</label>
		  								{!! Form::select('organization_id', App\Models\Organization::pluck('name', 'id'), App\Models\Organization::first()->id, ['id' => 'organization_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Organization ---', 'required']) !!}
		  								@else
		  								<h6 class="text-danger">Create Organization First To Proceed</h6>
		  								@endif
		  							</div>
		  							<div class="form-group col-md-6">
		  								<label>Name</label>
		  								<input data-parsley-type="name" type="text" class="form-control" name="name" id="name"placeholder="Enter Job Title" required />
		  							</div>
		  							<div class="form-group col-md-6">
		  								<label>Serial Code</label>
		  								<input data-parsley-type="code" type="text" class="form-control" name="serial_no" id="code" placeholder="Enter Serial Code" required/>
		  							</div>
		  							<div class="form-group col-12">
		  								<label>Description</label>
		  								<textarea class="form-control" name="description" placeholder="Enter Job Description"></textarea>
		  							</div>
		  						</div>
	  							{{-- foooter --}}
	  							<div class="text-right my-2">
	  								<button type="submit" class="btn btn-dark btn-sm mr-1">
	  									<i class="fa fa-plus fa-fw"></i>
	  									<b>|</b>
	  									Create Job Title
	  								</button>
	  								<button type="button" class="btn btn-light btn-sm" data-dismiss="modal"><i class="fa fa-times text-danger"></i> Cancel</button>
	  							</div>
	  						</form>
	  					</div>
	  				</div><!-- /.modal-content -->
	  			</div><!-- /.modal-dialog -->
	  		</div><!-- /.modal -->

	  		{{-- thi model is generated for departments edit. On click edit butoon this open through javascript --}}


	  		<div class="row">
	  			<div class="col-12 pull-right">
	  				<button type="button" id="add" class="btn btn-dark btn-sm waves-effect waves-light pull-right mb-3"  data-toggle="modal" data-target=".create_subect_model">
	  					<i class="fa fa-plus fa-fw"></i>
	  					<b>|</b>
	  					Add new Job Title
	  				</button>
	  			</div>
	  		</div>
	  		<div class="row">
	  			<div class="col-12">
	  				<div class="card m-b-30">
	  					<div class="card-body buttons-group-mobile">

	  						@if(count($jobtitles) != 0)
	  						<div class=" table-responsive">
	  							<table id="datatable-buttons"  isDefault="true" class="table table-striped table-bordered" cellspacing="0" width="100%">
	  								<thead>
	  									<tr>
	  										<th>#</th>
	  										<th>Title</th>
	  										<th>Serial No.</th>
	  										<th>Description</th>
	  										<th>Organization</th>
	  										<th class="text-center">Actions</th>
	  									</tr>
	  								</thead>

	  								<tbody>
	  									@foreach ($jobtitles as $index => $jobtitle)
										<tr>
											<td>{{ ++$index }}</td>
											<td>{{ $jobtitle->name }}</td>
											<td>{{ $jobtitle->serial_no }}</td>
											<td>{{ $jobtitle->description }}</td>
											<td>{{ $jobtitle->organization_name }}</td>
											<td class="text-center">
												<div class="btn-group">
													<button class="btn btn-primary btn-sm mr-1" title="Edit" data-toggle="modal" data-target="#edit_modal_{{$index}}">
														<i class="mdi mdi-pencil"></i>
													</button>
													{!! Form::open(['route' => ['jobtitle.delete', $jobtitle->id], 'method' => 'delete']) !!}
														@method('delete')
														<button type="submit" class="btn btn-danger btn-sm">
															<i class="typcn typcn-delete-outline"></i>
														</button>
													{!! Form::close() !!}
												</div>
											</td>
										</tr>
										{{-- MODAL --}}
										<div class="modal fade update_subect_model" id="edit_modal_{{$index}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title mt-0">Update<strong> Job Title</strong></h5>
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													</div>
													<div class="modal-body">
														{!! Form::open(['route' => ['jobtitle.update', $jobtitle->id], 'method' => 'patch']) !!}
														<div class="form-group">
															<label>Department</label>
															{!! Form::select('organization_id', App\Models\Organization::where('id', $jobtitle->organization_id)->pluck('name', 'id'), $jobtitle->organization_id, ['id' => 'organization_id', 'class' => 'form-control select2', 'data-placeholder' => '--- Select Department ---']) !!}
														</div>
														<div class="form-group">
															<label>Name</label>
															<input type="text" class="form-control" name="name" id="name" value="{{ $jobtitle->name }}" placeholder="Enter Name" required/>
														</div>
														<div class="form-group">
															<label>Code</label>
															<input type="text" class="form-control" name="serial_no" value="{{ $jobtitle->serial_no }}" placeholder="Enter code" required/>
														</div>
														<div class="form-group">
															<label>Description</label>
															<textarea class="form-control" placeholder="Enter Description" name="description">{{ $jobtitle->description }}</textarea>
														</div>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary">Update</button>
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													</div>
													{!! Form::close() !!}
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
										{{-- /.MODAL --}}
	  									@endforeach
	  								</tbody>
	  							</table>
	  						</div>
	  						@else
	  							No Job Title found
	  						@endif
	  					</div>
	  				</div>
	  			</div> <!-- end col -->
	  		</div>
	  	</div>
	  </div>
	  @include('includes/footer_start')

	  <!-- Required datatable js -->
	  <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	  <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
	  <!-- Buttons examples -->
	  <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
	  <script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
	  <script src="{{ asset('assets/plugins/datatables/jszip.min.js')}}"></script>
	  <script src="{{ asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>
	  <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>
	  <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
	  <script src="{{ asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>
	  <script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
	  <!-- Responsive examples -->
	  <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
	  <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

	  <!-- Datatable init js -->
	  <script src="{{ asset('assets/pages/datatables.init.js')}}"></script>
	  @include('includes/footer_end')