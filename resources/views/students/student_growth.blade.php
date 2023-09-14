@include('includes/header_start')

@include('includes/header_end')

                            <!-- Page title -->
                            <ul class="list-inline menu-left mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="button-menu-mobile open-left waves-effect">
                                        <i class="ion-navicon"></i>
                                    </button>
                                </li>
                                <li class="hide-phone list-inline-item app-search">
                                  
                                </li>
                            </ul>

                            <div class="clearfix"></div>
                        </nav>

                    </div>

                     <div class="page-content-wrapper">

                        <div class="container-fluid">

                            <div class="row">
                    <div class="col-lg-6">
                                    <div class="card m-b-20">
                                        <div class="card-body">
            
                                            <h4 class="mt-0 header-title">End of Registration Growth</h4>
            
                                            <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                                            </ul>
                                             <select id="LoadExpelData">
                                               <option value="1">Last 1 Year</option>
                                     <option value="2">Last 2 Years</option>
                                     <option value="3">Last 3 Years</option>
                                     <option value="4">Last 4 Years</option>
                                     <option value="5">Last 5 Years</option>
                                    
                                             </select>
                                               
                                          
                                              <div id="chart"></div>
                                            <canvas id="line" height="300"></canvas>
            
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    




<script src="https://code.jquery.com/jquery-3.3.1.js"
                 integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
                  crossorigin="anonymous"></script>
                      <div class="page-content-wrapper">

                        <div class="container-fluid">

                            <div class="row">
                                
        


<!--  -->  @include('includes/footer_start')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
        
        <svg width="500" height="500" id="svg1"></svg>
          <svg width="500" height="500" id="svg2"></svg>
      

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
<script src="{{asset('js/student/analytics.js')}}"></script>
@include('includes/footer_end') 
