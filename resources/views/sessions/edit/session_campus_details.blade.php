<div id="campusDetails{{ ($sessionCourseKey+1) }}">
    @foreach($session->getSessionCampusesByCourse($session_course->course_id) as $key => $session_course_campus)
        <div class="row">
            <div class="col-md-2 form-group">
                <label>Campus</label>
                <select class="form-control select2" name="campus_{{ ($sessionCourseKey+1) }}_ids[{{$session_course_campus->campus->name}}]" readonly tabindex="-1" id="organizationCampusId{{ ($sessionCourseKey+1) }}{{$key}}">
                    <option value="{{$session_course_campus->organization_campus_id}}">{{$session_course_campus->campus->name}}</option>
                </select>
            </div>
            <div class="col-md-2 form-group">
                <label>Number of seats</label>
                <input type="number" class="form-control text-right" min="0" max="999" name="quotas_{{ ($sessionCourseKey+1) }}[{{$session_course_campus->campus->name}}]" value="{{$session_course_campus->quota}}" />
            </div>
            <div class="col-md-2 form-group">
                <label>Max Installments</label>
                <input type="number" class="form-control text-right" min="0" max="12" name="max_{{ ($sessionCourseKey+1) }}_installments[{{$session_course_campus->campus->name}}]" value="{{$session_course_campus->max_installments != 0 ? $session_course_campus->max_installments : '0'}}"/>
            </div>
            <div class="col-md-2 form-group">
                <label>Min Discount</label>
                <input type="number" class="form-control text-right" min="0" max="99" name="min_{{ ($sessionCourseKey+1) }}_discounts[{{$session_course_campus->campus->name}}]" value="{{$session_course_campus->min_discount != 0 ? $session_course_campus->min_discount : '0'}}"/>
            </div>
            <div class="col-md-2 form-group">
                <label>Max Discount</label>
                <input type="number" class="form-control text-right" min="1" max="100" name="max_{{ ($sessionCourseKey+1) }}_discounts[{{$session_course_campus->campus->name}}]" value="{{$session_course_campus->max_discount != 0 ? $session_course_campus->max_discount : '0'}}"/>
            </div>
            <div class="col-md-2 form-group text-center">
                <label>Active</label><br>
                <div class="custom-control custom-checkbox">
                    {{ \Log::info($session_course_campus->isActive()) }}
                   <input type="checkbox" class="custom-control-input" {{ $session_course_campus->isActive()?'checked':'' }} name="is_{{ ($sessionCourseKey+1) }}_actives[{{$session_course_campus->campus->name}}]" id="isActive{{ ($sessionCourseKey+1) }}{{$key}}">
                   <label class="custom-control-label" for="isActive{{ ($sessionCourseKey+1) }}{{$key}}"></label>
                </div>
            </div>
        </div>
    @endforeach
</div>