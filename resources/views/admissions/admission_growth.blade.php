@include('includes/header_start')

@include('includes/header_end')
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
            <h4 class="mt-0 header-title">Monthly Admission Growth</h4>
            <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
            </ul>
            <select id="select_year">
              @foreach($years as $year)
              <option value="{{$year}}">{{$year}}</option>
              @endforeach
            </select>
            <div id="chart"></div>
            <canvas id="lineChart" height="300"></canvas>

          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card m-b-20">
          <div class="card-body">

            <h4 class="mt-0 header-title">Yearly Admission Growth</h4>

            <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
            </ul>
            <select id="choose_years">
              <option value="1">Last 1 Year</option>
              <option value="2">Last 2 Years</option>
              <option value="3">Last 3 Years</option>
              <option value="4">Last 4 Years</option>
              <option value="5">Last 5 Years</option>
            </select>
            <div id="chart"></div>
            <canvas id="line1Chart" height="300"></canvas>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="card m-b-20">
          <div class="card-body">
            <h4 class="mt-0 header-title">Monthly Course_wise Admission Growth</h4>
            <span id="monthly_growth_course_wise_label" style="color: red;">Please Select Filters To Proceed...</span>
            <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">

            </ul>
            <select id="select_yearly_course">
              @foreach($years as $year)
              <option value="{{$year}}">{{$year}}</option>
              @endforeach
            </select>

            <select id="select_course">
              <option value="select_subject">--Select Course--</option>
              @foreach($course as $courses)
              <option value="{{$courses->id}}">{{$courses->name}}</option>

              @endforeach

            </select>
            <input type="button" id="btn" value="Filter" onclick='getState()'>
            <div id="chart"></div>
            <canvas id="lineChart2" height="300"></canvas>

          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card m-b-20">
          <div class="card-body">

            <h4 class="mt-0 header-title">Yearly Course_wise Admission Growth</h4>
            <span id="yearly_growth_course_wise_label" style="color: red;">Please Select Filters To Proceed...</span>
            <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">

            </ul>

            <select id="choose_yearly_course">
              <option value="1">Last 1 Year</option>
              <option value="2">Last 2 Years</option>
              <option value="3">Last 3 Years</option>
              <option value="4">Last 4 Years</option>
              <option value="5">Last 5 Years</option>

            </select>

            <select id="select_yearly_admission_course">
              <option value="select_subject">--Select Course--</option>
              @foreach($course as $courses)
              <option value="{{$courses->id}}">{{$courses->name}}</option>

              @endforeach

            </select>
            <input type="button" id="btn1" value="Filter" onclick='getFilter()'>
            <div id="chart"></div>
            <canvas id="lineChart3" height="300"></canvas>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>





<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>


@include('includes/footer_start')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>

<svg width="500" height="500" id="svg1"></svg>
<svg width="500" height="500" id="svg2"></svg>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
<script src="{{asset('js/admission/analytics.js')}}"></script>
@include('includes/footer_end')