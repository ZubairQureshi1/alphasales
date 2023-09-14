@if(count($data)!=0)
    <div class="row">
        @foreach ($data as $index => $student)
            <div class="col-sm-12 col-md-6 col-lg-3 m-b-15">
                    
                <div class="card analogy-card analogy-data-card-shadow-top m-b-5">
                        <div class="bg_blue text-center">
                            <div class="p-1">
                                <p class="text-white m-0">{{$student->admission_type}}</p>
                            </div>
                        </div>
                    <div class="card-body p-t-10">
                        <div class="text-center">
                            <img class="m-t-10 rounded-circle thumb-lg" src="{{ $student->picture_pic_directory_url!=''?$student->picture_pic_directory_url: 'assets/images/users/dummy.png'}}" alt="Generic placeholder image">
                            <div class="media-body m-t-10  border_top_content analogy-card-content-left-border">
                                <h5 class="m-t-10 font-18 mb-1" style="text-transform: uppercase;letter-spacing: 1px;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" id="student_name">{{ $student->student_name }}</h5>
                                <p class="text-muted m-0 font-secondary"  id="roll_no"><i><b>Roll No: </b></i>{{ $student->roll_no }}</p>
                                <p class="text-muted m-0 font-secondary"  id="old_roll_no"><i><b>Old Roll No: </b></i> {{ $student->old_roll_no }}</p>
                                <p class="text-muted m-0 font-secondary"  id="course_name"><i><b>Course: </b>({{ $student->course_name }})</i></p>
                                <p class="text-muted m-0 font-secondary"  id="section_name"><i><b>Section: </b>({{ $student->section_name }})</i></p>
                                <p class="text-muted m-0 font-secondary" style="text-transform: lowercase;" >{{ $student->email==null?'---':$student->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card analogy-card analogy-data-card-shadow-bottom">
                    <div class="card-body m-0 padding-5">
                        <ul class="social-links m-0 text-center list-inline">
                            <li class="list-inline-item">
                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="{!! route('studentWorkers.show', [$student->id]) !!}" data-original-title="View"><i class="fa fa-eye"></i></a>
                            </li>
                           
                        </ul>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Semester Freeze</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="semester_freeze_form" method="post" action="{{ route('students.semesterFreeze', [$student->id]) }}">
                            @csrf
                            <div class="form-group">
                                {!! Form::label('semester status', 'Semester Status' )!!}
                                {!! Form::select('semester_status_id', config('constants.semester_statuses'), null, ['id' => 'semester_status_id','class' => 'form-control select2-multiple', 'placeholder' => '--- Select Status ---']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('reason','Reason')!!}
                                <textarea class="form-control" name="semester_freeze_reason" id="semester_freeze_reason_id"></textarea>
                            </div>
                    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="Submit" class="btn btn-primary" />
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach    
    </div>
@else
    @include('includes/not_found')
@endif

