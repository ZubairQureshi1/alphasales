<style type="text/css">
    label{
        font-weight: bold;
        color: black;
        font-family: 'Balsamiq Sans', cursive;
    }
    h1{
        font-weight: bold; 
        text-align: center; 
        font-family: 'Balsamiq Sans', cursive; 
        background: #17202A; 
        color: white; 
        padding: 15px; 
        position: relative; 
        top: -20px;
    }
    input{
        text-transform: capitalize;
    }
</style>
<div id="page_25">
	<form id="page_25_form">
		<div class="col-md-12">
			<label for="" style="font-size: 20px;">Conversion in Next Degree:</label>
		</div>
		<div class="card shadow p-3 mt-1 w-100">
			<div class="card-body">
				<div class="form-row">
					<div class="form-group col-md-3">
						<label>Status:<span style="color: red;">*</span></label>
						<select  name="status" class="form-control">
							<option value="" selected disabled>--select--</option>
							@foreach(\Config::get('constants.general_yes_no') as $key => $value)
							<option value="{{$key}}" {{ $data ? $data['first_semester_details'] != null ? $data['first_semester_details']['status'] == $key ? 'selected' : '' : '' : ''}}>{{$value}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-3">
						<label>Date:<span style="color: red;">*</span></label>
						<input type="text" class="form-control text-center datepicker" name="degree_date" placeholder="Enter Date"
						value="{{$data && isset($data['first_semester_details']) ? date('d/m/Y',strtotime($data['first_semester_details']['degree_date'])) : ''}}">
					</div>
				</div>
			</div>
		</div>
	</form>
</div>