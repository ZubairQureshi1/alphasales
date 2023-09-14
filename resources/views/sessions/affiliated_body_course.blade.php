
<select placeholder="--- Select Body ---" class="form-control select2" name="course_affiliated_body_id[]" id="affiliated_body_id">
	@foreach ($affiliated_bodies as $body)
		<optgroup label="{{config('constants.academic_terms')[$body->academic_term_id]}}">
			<option value="{{$body->id}}">
				{{ $body->name }}
			</option>
		</optgroup>
	@endforeach
</select>


<script type="text/javascript">
	
	$('.select2').select2();

</script>