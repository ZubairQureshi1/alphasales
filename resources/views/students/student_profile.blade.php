
<section class="intro-section">
    <div class="container">
    
        <div class="heading-wrapper">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="info">
                        <i class="icon fa fa-map"></i>
                        <div class="right-area">
                            <h5>{{$student['present_address']}}</h5>
                            <h5>{{$student['permanent_address']}}</h5>
                        </div><!-- right-area -->
                    </div><!-- info -->
                </div><!-- col-sm-4 -->
                
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="info">
                        <i class="icon fa fa-mobile"></i>
                        <div class="right-area">
                            <h5>{{$student['student_cell_no']}}</h5>
                            <h6>{{$student['ptcl_no']}}</h6>
                        </div><!-- right-area -->
                    </div><!-- info -->
                </div><!-- col-sm-4 -->
                
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="info">
                        <i class="icon fa fa-envelope"></i>
                        <div class="right-area">
                            <h5>{{$student['email']}}</h5>
                            
                        </div><!-- right-area -->
                    </div><!-- info -->
                </div><!-- col-sm-4 -->
            </div><!-- row -->
        </div><!-- heading-wrapper -->
        
    
    
        <div class="intro">
            <div class="row">
            
                <div class="col-sm-8 col-md-4 col-lg-3">
                    <div class="profile-img margin-b-30"><img src="{{asset('uploads/avatars/1532420540.jpg')}}" alt=""></div>
                </div><!-- col-sm-8 -->
                
                <div class="col-sm-10 col-md-5 col-lg-6">       
                        <h2><b>{{$student['student_name']}}   {{$student['father_name']}}</b></h2>
                        <h4 class="font-yellow">{{$student['roll_no']}}</h4>
                        <ul class="information margin-tb-30">
                            <li><b class="font-yellow">BORN</b> : {{$student['d_o_b']}}</li>
                            <li><b class="font-yellow">EMAIL</b> : {{$student['email']}}</li>
                            <li><b class="font-yellow">SESSION</b> : {{$student['session_name']}}</li>
                            <li><b class="font-yellow">COURSE</b> : {{$student['course_name']}}</li>
                        </ul>
                        
                </div><!-- col-sm-8 -->
                
                <div class="col-sm-10 col-md-3 col-lg-3">
                    <a class="downlad-btn" href="#">Download CV</a>
                </div><!-- col-lg-2 -->
        
            </div><!-- row -->
        
        </div><!-- intro -->
    </div><!-- container -->
</section><!-- intro-section -->

<section class="portfolio-section section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="heading">
                        <h3><b>Account</b></h3>
                        <h6 class="font-lite-black"><b>DETAILS</b></h6>
                    </div>
                </div><!-- col-sm-3 -->
                
                <div class="col-sm-12 col-md-9">
                    <div class="portfolioFilter clearfix margin-b-80">
                        <a href="#" data-filter="*" class="current"><b>FEE PACKAGE</b></a>
                        <a href="#" data-filter=".web-design"><b>INSTALLMENTS</b></a>
                        <a href="#" data-filter=".graphic-design"><b>SUMMARY</b></a>
                        <a href="#" data-filter=".branding"><b>FINES</b></a>
                    </div><!-- portfolioFilter -->
                </div><!-- col-sm-8 -->
            </div><!-- row -->
            </div>
        </section>







            
    <section class="portfolio-section section">
        <div class="container">
        

            <div class="row">
                <div class="col-sm-12 col-md-3">
                <div class="heading">
                <h3><b>Subjects</b></h3>
                <h6 class="font-lite-black"><b>Current Session Subjects</b></h6>
                </div>
                </div>
                <table class="table">
                <thead>
                <tr>
                <th>List</th>
                </tr>
                </thead>
                  @foreach($student_book as $row)
                 <tr>
                 <td> {{$row['subject_name']}}</td>
                 <td>
                 <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                 <div class="btn-group mr-2" role="group" aria-label="First group">
                 <a href="{{route('students.WrongEntry',$row->id)}} " class="btn btn-danger btn-sm"><i class='mdi mdi-delete'></i></a>
                 </div>
                 </div>
                 </td>
                 </tr>
                    @endforeach
                    <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-primary" class="btn btn-primary waves-effect waves-light m-b-10 m-t-15-negative"  data-toggle="modal" data-target="#addsubjects">Add</button>
                 </div>
                 </table>
                <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade" id="addsubjects" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                 <h5 class="modal-title mt-0">
                    Course
                    <strong>
                        Subjects
                    </strong>
                 </h5>
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
                </div>
                <div class="modal-body">
                <form action="{{route('students.addSubject',$student->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                              <div>
                             <label> Subjects: </label>
                             <select class="form-control select2" name="selected_book">
                             <option value="">--Select Subjects--</option>
                             @foreach($getsubjects as $row){
                              <option value="{{$row->id}}">{{$row->subject_name}}</option>
                            }
                         @endforeach
                            </select>
                            </div>
                            </div>
                            
                    <div class="modal-footer">
                    <button class="btn btn-secondary" type="submit">
                            Save
                    </button>
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">
                            Close
                    </button>
                    </div>
                </form>
               </div>
            </div>
        </div>
    </div>
</div>


    </section>
            <section>
            <div class="portfolioContainer  margin-b-50">
                <div class="container">
                <div class="p-item web-design">
                    <a href="images/portfolio-13-400x400.jpg" data-fluidbox>
                        <img src="images/portfolio-13-400x400.jpg" alt=""></a>
                </div><!-- p-item -->
                
                <div class="p-item branding graphic-design">
                    <a href="images/portfolio-14-400x400.jpg" data-fluidbox>
                        <img src="images/portfolio-14-400x400.jpg" alt=""></a>
                </div><!-- p-item -->
                
                <div class="p-item web-design">
                    <a href="images/portfolio-15-400x400.jpg" data-fluidbox>
                        <img src="images/portfolio-15-400x400.jpg" alt=""></a>
                </div><!-- p-item -->
                
                <div class="p-item graphic-design">
                    <a class="img" href="images/portfolio-16-400x400.jpg" data-fluidbox>
                        <img src="images/portfolio-16-400x400.jpg" alt=""></a>
                </div><!-- p-item -->
                
                <div class="p-item branding graphic-design">
                    <a href="images/portfolio-17-400x400.jpg" data-fluidbox>
                        <img src="images/portfolio-17-400x400.jpg" alt=""></a>
                </div><!-- p-item -->
                
                <div class="p-item graphic-design web-design">
                    <a href="images/portfolio-18-400x400.jpg" data-fluidbox>
                        <img src="images/portfolio-18-400x400.jpg" alt=""></a>
                </div><!-- p-item -->
                
                <div class="p-item  graphic-design branding">
                    <a href="images/portfolio-19-400x400.jpg" data-fluidbox>
                        <img src="images/portfolio-19-400x400.jpg" alt=""></a>
                </div><!-- p-item -->
                    
                <div class="p-item web-design branding">
                    <a href="images/portfolio-20-400x400.jpg" data-fluidbox>
                        <img src="images/portfolio-20-400x400.jpg" alt=""></a>
                </div><!-- p-item -->
            
            </div><!-- portfolioContainer -->
        </div><!-- container -->
    </section><!-- portfolio-section -->
    
    
    <section class="education-section section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="heading">
                        <h3><b>Education</b></h3>
                        <h6 class="font-lite-black"><b>ACADEMIC CAREER</b></h6>
                    </div>
                </div><!-- col-sm-3 -->
                
                <div class="col-sm-12 col-md-9">
                
                    <div class="education-wrapper">
                        <div class="education margin-b-50">
                            <h4><b>{{$student['course_name']}}</b></h4>
                            <h5 class="font-yellow"><b></b>{{$student['session_name']}}</h5>
                            
                        </div><!-- education -->
                      


                          @foreach($ac as $index => $key)
           
                        <div class="education margin-b-50">
                           <h4><b>{{$key['type_name']}}</b></h4>
                            <h5 class="font-yellow"><b>{{$key['session_name']}}</b></h5>
                            <h6 class="font-lite-black margin-t-10">GRADUATED IN {{$key['year']}}</h6>
                           
                        </div><!-- education -->
                        @endforeach
                        
                    </div><!-- education-wrapper -->
                </div><!-- col-sm-9 -->
            </div><!-- row -->
        </div><!-- container -->
        



    </section><!-- education-section -->
    
