
                                                    <button type="button" data-toggle="modal" data-target="#{{ $section['id']}}" class="btn btn-primary btn-sm"><i class="mdi mdi-pencil"></i></button>


                                                    <div class="modal fade update_subect_model" id="{{ $section['id'] }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0">Update<strong> Subject</strong></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p></p>
                                                                    {!! Form::open(['route' => ['sections.update', $section['id']], 'method' => 'patch']) !!}
                                                                        <div class="form-group">
                                                                            <label>Name</label>
                                                                            <div>
                                                                                <input data-parsley-type="name" type="text"
                                                                                       class="form-control" required
                                                                                       name="name" id="update_section_name"
                                                                                       value="{{ $section['name'] }}"
                                                                                       placeholder="Enter Name"/>
                                                                            </div>
                                                                            <label>Code</label>
                                                                            <div>
                                                                                <input data-parsley-type="code" type="text"
                                                                                       class="form-control" required
                                                                                       name="code" id="update_section_code"
                                                                                       value="{{ $section['code'] }}"
                                                                                       placeholder="Enter Code"/>
                                                                            </div>
                                                                            {!! Form::label('course', 'Course:') !!}
                                {!! Form::select('course_id', $courses, $section['course_id'], ['id' => 'course_id', 'disabled' => 'disabled', 'class' => 'form-control select2-multiple', 'placeholder' => '--- Select Course ---']) !!}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->