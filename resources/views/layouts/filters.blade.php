<div class="row filters-on-print">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="form-group">
                    <input name="isFilteredRequest" type="hidden" value="true">
                        <div class="row">
                            @if ($filters_configuration['filters']['users'])
                            <div class="col-md-3">
                                <label>
                                    Users:
                                </label>
                                <div>
                                    {!! Form::select('user_id', App\User::get()->pluck('name', 'id'), null, ['id' => 'user_id', 'class' => 'form-control select2', 'placeholder' => '--- Select User ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['visitor_users'])
                            <div class="col-md-3">
                                <label>
                                    Users:
                                </label>
                                <div>
                                    {!! Form::select('user_id', App\User::where('faculty_type', 1)->get()->pluck('name', 'id'), null, ['id' => 'visitor_user_id', 'class' => 'form-control select2', 'placeholder' => '--- Select User ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['students'])
                            <div class="col-md-3">
                                <label>
                                    Students:
                                </label>
                                <div>
                                    {!! Form::select('student_id', App\Models\Student::get()->pluck('student_name', 'id'), null, ['id' => 'student_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Student ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['sessions'])
                            <div class="col-md-3">
                                <label>
                                    Sessions:
                                </label>
                                <div>
                                    {!! Form::select('session_id', App\Models\Session::get()->pluck('session_name', 'id'), null, ['id' => 'session_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Session ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['courses'])
                            <div class="col-md-3">
                                <label>Courses:</label>
                                <div>
                                    {!! Form::select('course_id', $filters_configuration['data']['courses'], null, ['id' => 'course_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Course ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['parts'])
                            <div class="col-md-3">
                                <label>
                                    Part:
                                </label>
                                <div>
                                    {!! Form::select('part_id', ['1' => 1, '2' => 2], null, ['id' => 'part_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Part ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['subjects'])
                            <div class="col-md-3">
                                <label>
                                    Subjects:
                                </label>
                                <div>
                                    {!! Form::select('subject_id', App\Models\Subject::get()->pluck('name', 'id'), null, ['id' => 'subject_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Subject ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['roles'])
                            <div class="col-md-3">
                                <label>
                                    Roles:
                                </label>
                                <div>
                                    {!! Form::select('role_id', Spatie\Permission\Models\Role::get()->pluck('display_name', 'id'), null, ['id' => 'role_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Role ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['admission_forms'])
                            <div class="col-md-3">
                                <label>
                                    Admission Form:
                                </label>
                                <div>
                                    {!! Form::select('admission_id', App\Models\Admission::get()->pluck('form_code', 'id'), null, ['id' => 'admission_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Admission Form ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['departments'])
                            <div class="col-md-3">
                                <label>
                                    Department:
                                </label>
                                <div>
                                    {!! Form::select('department_id', App\Models\Department::get()->pluck('name', 'id'), null, ['id' => 'department_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Department ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['designations'])
                            <div class="col-md-3">
                                <label>
                                    Designation:
                                </label>
                                <div>
                                    {!! Form::select('designation_id', App\Models\Designation::get()->pluck('name', 'id'), null, ['id' => 'designation_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Designation ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['sections'])
                            <div class="col-md-3">
                                <label>
                                    Section:
                                </label>
                                <div>
                                    {!! Form::select('section_id', App\Models\Section::get()->pluck('name', 
                                    'id'), null, ['id' => 'section_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Section ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['admission_types'])
                            <div class="col-md-3">
                                <label>
                                    Student Category:
                                </label>
                                <div>
                                    {!! Form::select('student_category_id', config('constants.student_categories'), null, ['id' => 'student_category_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Category ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['end_of_registrations'])
                            <div class="col-md-3">
                                <label>
                                    Registration Status:
                                </label>
                                <div>
                                    {!! Form::select('is_end_of_reg', ['False', 'True'], null, ['id' => 'is_end_of_reg', 'class' => 'form-control select2', 'placeholder' => '--- Select Registration Status ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['fee_structure_types'])
                            <div class="col-md-3">
                                <label>
                                    Fee Structure Types:
                                </label>
                                <div>
                                    {!! Form::select('fee_structure_type_id', config('constants.fee_structure_types'), null, ['id' => 'fee_structure_type_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Fee Type ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['heads'])
                            <div class="col-md-3">
                                <label>
                                    Heads:
                                </label>
                                <div>
                                    {!! Form::select('head_id', App\Models\HeadFine::get()->pluck('name', 'id'), null, ['id' => 'head_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Head ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['payment_statuses'])
                            <div class="col-md-3">
                                <label>
                                    Payment Status:
                                </label>
                                <div>
                                    {!! Form::select('payment_status_id', config('constants.payment_statuses'), null, ['id' => 'payment_status_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Payment Status ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['voucher_statuses'])
                            <div class="col-md-3">
                                <label>
                                    Voucher Status:
                                </label>
                                <div>
                                    {!! Form::select('voucher_status_id', config('constants.voucher_statuses'), null, ['id' => 'voucher_status_id', 'class' => 'form-control select2', 'placeholder' => '--- Select Voucher Status ---']) !!}
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['start_date'])
                            <div class="col-md-3">
                                <label>
                                    Start Date:
                                </label>
                                <div>
                                    <input type="date" name="start_date" id="start_date" data-date-format="YYYY-MM-DD" class="form-control">
                                </div>
                            </div>
                            @endif
                            @if ($filters_configuration['filters']['end_date'])
                            <div class="col-md-3">
                                <label>
                                    End Date:
                                </label>
                                <div>
                                    <input type="date" name="end_date" id="end_date" data-date-format="YYYY-MM-DD" class="form-control" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            @endif
                        </div>
                    </input>
                </div>
                <div class="form-group">
                    <div class="row">
                        @if ($filters_configuration['can_filters'] == true || $filters_configuration['clear_filters'] == true)
                        <div class="col-md-12 text-right">
                            @if ($filters_configuration['can_filters'])
                                <button class="btn btn-success btn-sm" onclick="getFilterData('{{$filters_configuration['route']}}')">
                                    <i class="mdi mdi-filter"></i> Filter
                                </button>
                            @endif
                            @if ($filters_configuration['clear_filters'])
                                <a class="btn btn-secondary btn-sm" href="{!! $filters_configuration['route'] !!}">
                                    <i class="mdi mdi-recycle"></i> Clear Filter
                                </a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ $filters_configuration['js_path']  }}">></script>
