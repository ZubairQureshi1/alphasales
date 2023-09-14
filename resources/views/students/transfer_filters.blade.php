
<div class="row filters-on-print">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="form-group">
                    <input name="isFilteredRequest" type="hidden" value="true">
                    <div class="row">
                        <div class="col-sm-4">

                            <div class="form-group">
                                <label>
                                    Sessions:
                                </label>
                                <div>
                                    {!! Form::select('session_id', App\Models\Session::get()->pluck('session_name', 'id'), null, ['id' => 'session_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Session ---']) !!}
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4">

                            <div class="form-group">
                                <label>
                                    Courses:
                                </label>
                                <div>
                                    {!! Form::select('course_id', App\Models\Course::get()->pluck('name', 'id'), null, ['id' => 'course_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Course ---']) !!}
                                </div>

                            </div>
                        </div>

                        <div class="col-sm-4">

                            <div class="form-group">
                                <label>
                                    Admission Types:
                                </label>
                                <div>
                                {!! Form::select('student_category_id', config('constants.student_categories'), null, ['id' => 'student_category_id', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Admission Type ---']) !!}
                                </div>

                            </div>
                        </div>

                    </div>
                </input>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a class="btn btn-success" onclick="getFilterData('studentTransfers/getStudent')">
                            <i class="mdi mdi-filter">
                            </i>
                            Filter
                        </a>
                        <a class="btn btn-secondary" href="migrations">
                            <i class="mdi mdi-recycle">
                            </i>
                            Clear Filter
                        </a>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>

                <div class="col-md-4" >

                </div>
                <div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('js/filters/filters_migrate.js')  }}"></script>