@include('includes/header_start')

<link href="{{ asset('assets/plugins/alertify/css/alertify.css') }}" rel="stylesheet" type="text/css" />

@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">Edit Product(s)</h3>
    </li>
</ul>

<div class="clearfix"></div>
</nav>

</div>
<!-- Top Bar End -->

<!-- ==================
    PAGE CONTENT START
    ================== -->

<div class="page-content-wrapper" id="sessions">
    @include('flash::message')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form class="" method="POST"
                            action="{{ route('courses.update', $course['id']) }}" novalidate>

                            @csrf
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>Product Name</label>
                                    <div>
                                        <input data-parsley-type="name" type="text" class="form-control" required
                                            name="name" id="name" value="{{ $course['name'] }}"
                                            placeholder="Enter Product Name" readonly />
                                    </div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>Unit</label>
                                    <div>
                                        {!! Form::select('plot_size', config('constants.plot_size_dropdown'), $course['plot_size'], ['id' => 'plot_size', 'class' => 'form-control select2', 'placeholder' => '--- Select Unit ---', 'onchange' => 'onPlotSizeSelect() , generateProductName()']) !!}
                                    </div>
                                </div>

                                <div class="form-group col-md-3" hidden="true" id="plot_size_number_div">
                                    {!! Form::label('Size', 'Size:') !!}
                                    <input class="form-control letter_capitalize" id="plot_size_number"
                                        name="plot_size_number" value="{{ $course['plot_size_number'] }}"
                                        placeholder="Enter Size" type="text" onchange="generateProductName()" />
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>Nature</label>
                                    <div>
                                        {!! Form::select('nature_plot', config('constants.nature_plot_dropdown'), $course['nature_plot'], ['id' => 'nature_plot', 'class' => 'form-control select2', 'placeholder' => '--- Select Plot Nature ---', 'onchange' => 'onPlotNatureSelect() , generateProductName()']) !!}
                                    </div>
                                </div>
                                {{-- {{ dd($course->plot_type) }} --}}
                                <div class="form-group col-md-3" hidden="true" id="plot_type_resid_div">
                                    {!! Form::label('Type', 'Type:') !!}

                                    {!! Form::select('plot_type_resid', array_slice(config('constants.plot_type_dropdown'), 0, 5, true), $course['plot_type'], ['id' => 'plot_type', 'class' => 'form-control select2', 'placeholder' => '--- Select Type ---', 'onchange' => 'onPlotTypeSelect() , generateProductName()']) !!}
                                </div>

                                <div class="form-group col-md-3" hidden="true" id="plot_type_comm_div">
                                    {!! Form::label('Type', 'Type:') !!}
                                    {!! Form::select('plot_type_com', array_slice(config('constants.plot_type_dropdown'), 5, 10, true), $course['plot_type'], ['id' => 'plot_type1', 'class' => 'form-control select2', 'placeholder' => '--- Select Type ---', 'onchange' => 'onPlotTypeSelect() , generateProductName()']) !!}
                                </div>
                                <div class="form-group col-md-3" id="other_plot_type_div" hidden="true">
                                    <label>
                                        Other Plot Type:
                                    </label>
                                    <input class="form-control letter_capitalize other_plot_type"
                                        onkeypress="return alphabaticOnly(event)" data-parsley-type="other_plot_type"
                                        id="other_plot_type" name="other_plot_type" placeholder="Enter Other Plot Type"
                                        required="" value="{{ $course['other_plot_type'] }}" type="text"
                                        onchange="generateProductName()" />
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>Project</label>
                                    <div>
                                        <select class="form-control select2" name="project" id="project"
                                            onchange=generateProductName()>
                                            <option value="">--- Select Project---</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}"
                                                    {{ $project->id == $course['project'] ? 'selected' : '' }}>
                                                    {{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                            </div>

                            <div class="div-border padding-5">
                                <div class="row padding-5">
                                    <!-- <div class="col-md-10">
                                        <strong>Developers</strong>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary btn-sm pull-right"
                                            onclick="addAffiliatedBodyRow()"><i class="mdi mdi-plus"></i> Add</button>
                                    </div>
                                    <hr> -->
                                    <!-- <div id="affiliated_body_rows" class="col-md-12">
                                        @if (isset($course->courseAffiliatedBodies))
                                            @foreach ($course->courseAffiliatedBodies as $key => $course_affiliated_body)
                                                <div class="row margin-top-10 affiliated_body_row_childs"
                                                    id="{{ $key }}">
                                                    <div class="col-md-5">
                                                        {{ Form::select('affiliated_body_ids[]',App\Models\AffiliatedBody::pluck('name', 'id'),$course_affiliated_body->affiliated_body_id,['id' => 'affiliated_body_id' . $key, 'class' => 'form-control select2']) }}
                                                    </div>
                                                    <div class="col-md-5" hidden>
                                                        {{ Form::select('academic_term_ids[]',config('constants.academic_terms'),$course_affiliated_body->academic_term_id,['id' => 'academic_term_id' . $key, 'class' => 'form-control select2']) }}
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="removeAffiliatedBodyRow({{ $key }})"
                                                            type="button">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div> -->

                                </div>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" id="save" onclick="updateForm('{{ $course['id'] }}')"
                                    class="btn btn-primary">Save</button> --}}
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            {{-- <div class="m-b-10">
                                    <h5>Courses/Degrees</h5>(Minimum 1 must be selected)
                                </div>

                                <div class="form-group">
                                    @if (count($subjects) != 0)
                                    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Prerequisite Subject</th>
                                                <th>Semester/Year</th>
                                                <th>Credit Hours</th>
                                                <th>Mid Term Attendance %</th>
                                                <th>Final Term Attendance %</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($subjects as $index => $subject)
                                            <tr>
                                                <td>{{ $subject['name'] }}</td>
                                                <td>
                                                    {!! Form::select('prerequisite_subject_id[]', $all_subjects, $subject['prerequisite_subject'], ['id' => 'prerequisite_subject_id'.$subject['id'], 'class' => 'form-control select2-multiple', 'placeholder' => '------ Select prerequisite Subject ------']) !!}
                                                </td>
                                                <td>{!! Form::select('semester_id[]', config('constants.semesters_years'), $subject['semester_id'], ['id' => 'semester_id'.$subject['id'], 'class' => 'form-control select2-multiple', 'placeholder' => '--- Semester/Year No ---']) !!}</td>
                                                <td><input type="text" name="credit_hours[]" value="{{$subject->credit_hours}}" id="credit_hours_id{{$subject['id']}}" class="form-control" placeholder="Enter Credit Hours" /></td>
                                                <td><input type="text" name="mid_term_attendance_percentage[]" id="mid_term_attendance_percentage{{$subject['id']}}" value="{{$subject->mid_term_attendance_percentage}}" class="form-control" placeholder="Entre Midterm Percentage"></td>
                                                <td><input type="text" name="final_term_attendance_percentage[]" id="final_term_attendance_percentage{{$subject['id']}}" value="{{$subject->final_term_attendance_percentage}}" class="form-control" placeholder="Entre Finaltrem Percentage"></td>
                                                <td>
                                                    <div class="text-center">
                                                        @if ($subject['isChecked'])
                                                        <input name="subjects[]" checked type="checkbox" onclick="onSubjectSelect('{{ $index }}','{{ $subject['id'] }}')" id="{{ $subject['id'] }}" switch="bool" value="{{ $subject['id'] }}"/>

                                                        @else
                                                        <input name="subjects[]" onclick="onSubjectSelect('{{ $index }}', '{{ $subject['id'] }}')" type="checkbox" id="{{ $subject['id'] }}" switch="bool" value="{{ $subject['id'] }}"/>
                                                        @endif
                                                        <label for="{{ $subject['id'] }}" data-on-label="Yes" data-off-label="No"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    @include('includes/not_found')
                                    @endif
                                </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes/footer_start')

<script type="text/javascript" src="{{ asset('js/course/course-edit.js') }}"></script>
<script type="text/javascript">
    var template = '{{ json_encode(config('constants')) }}';
    var constants = JSON.parse(template.replace(/&quot;/g, '"'));
    var template = '{{ json_encode($subjects) }}';
    var subjects = JSON.parse(template.replace(/&quot;/g, '"'));
    var bodies = '{{ json_encode(App\Models\AffiliatedBody::get()->toArray()) }}';
    var affiliated_bodies = JSON.parse(bodies.replace(/&quot;/g, '"'));
</script>


@include('includes/footer_end')
