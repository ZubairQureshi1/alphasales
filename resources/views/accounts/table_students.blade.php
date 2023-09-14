@if(count($data)!=0)
    <div class="row">

        @foreach ($data as $index => $student)

        <div class="col-sm-12 col-md-6 col-lg-3 m-b-15">
                    
            <div class="card analogy-card analogy-data-card-shadow-top m-b-5">
                <div class="bg_blue padding-5 text-center">
                    <div class="p-1 float-left">
                        <p class="text-white m-0">{{ !is_null($student->student_category_id) ? config('constants.student_categories')[$student->student_category_id] : '---' }}</p>
                        
                    </div>

                    <div class="btn-group pull-right ml-2 acount_instalment show">
                        <button type="button" class="btn btn-sm custm_btn_color  waves-light waves-effect " data-toggle="dropdown" aria-expanded="true">
                           <i class="fa fa-bars"></i>
                        </button>
                        <div class="dropdown-menu account_dropdown "  aria-labelledby="btnGroupDrop1" x-placement="bottom-start"  >                                       
                            <a class="dropdown-item" href="{!! route('accounts.studentAcademicHistory', $student['id']) !!}"><i class="fa fa-eye"></i> View Accounts</a>
                            @foreach($student->studentAcademicHistories()->get() as $key => $history)
                                <a class="dropdown-item" href="{!! route('accounts.studentSummary', [$student->id, $history->id, ($key+1)]) !!}"><i class="fa fa-clipboard"> Summary Part - {{$key+1}}</i></a>
                            @endforeach
                        </div>

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
        </div>

            
        @endforeach    
    </div>
@else
    @include('includes/not_found')
@endif
