<hr>
@if($campuses->count() > 0)
@foreach($campuses as $key => $campus)
<div class="row">
	<div class="col-md-2 form-group">
		<label>Campus</label>
		<select class="form-control select2" name="campus_{{$row_count}}_ids[{{$campus->name}}]" readonly tabindex="-1" id="organizationCampusId{{$row_count}}{{$key}}">
			<option value="{{$campus->id}}">{{$campus->name}}</option>
		</select>
	</div>
	<div class="col-md-2 form-group">
		<label>Number of seats</label>
		<input type="number" class="form-control text-right" min="0" required max="99999" name="quotas_{{$row_count}}[{{$campus->name}}]" value="0" placeholder=""/>
	</div>
	<div class="col-md-2 form-group">
		<label>Max Installments</label>
		<input type="number" class="form-control text-right" min="0" required max="12" value="0" name="max_{{$row_count}}_installments[{{$campus->name}}]" placeholder=""/>
	</div>
	<div class="col-md-2 form-group">
		<label>Min Discount</label>
		<input type="number" class="form-control text-right" min="0" required max="99" name="min_{{$row_count}}_discounts[{{$campus->name}}]" value="0" placeholder=""/>
	</div>
	<div class="col-md-2 form-group">
		<label>Max Discount</label>
		<input type="number" class="form-control text-right" min="1" required max="100" name="max_{{$row_count}}_discounts[{{$campus->name}}]" value="100" placeholder=""/>
	</div>
	<div class="col-md-2 form-group text-center">
		<label>Active</label><br>
        <div class="custom-control custom-checkbox">
           <input type="checkbox" class="custom-control-input"  name="is_{{$row_count}}_actives[{{$campus->name}}]" id="isActive{{$row_count}}{{$key}}" value="1" checked>
           <label class="custom-control-label" for="isActive{{$row_count}}{{$key}}"></label>
        </div>
	</div>
</div>
@endforeach
@else
<h2 class="text-center text-danger">No Campus is alloted to the selected wing</h2>
@endif