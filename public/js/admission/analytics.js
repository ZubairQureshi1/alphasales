$( document ).ready(function() {
    
    loadMonthlyData();
     $('#choose_years').val('1').trigger("change");
});

function initAdmissionMonthlyChart(monthly_details, monthly_course_details) {
   var canvas=document.getElementById("lineChart");
    var ctx = canvas.getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthly_details.labels,
            datasets: [{
                 fill: true,
                    lineTension: 0.5,
                  backgroundColor: "rgba(203, 86, 241, 0.2)",
                    borderColor: "#CB56F1",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#CB56F1",
                    pointBackgroundColor: "#CB56F1",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#CB56F1",
                    pointHoverBorderColor: "#CB56F1",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                data: monthly_details.datasets,
               label: 'Monthly Admissions Chart',
                
                borderWidth: 1
            }


            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
  // window.myChart = new Chart(ctx, {type:'line',data:monthly_course_details});
         
}

function initAdmissionYearlyChart(yearly_details) {

    var ctx = document.getElementById("line1Chart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: yearly_details.labels,
            datasets: [{
               label: 'Yearly Admissions Chart',
                fill: true,
                    lineTension: 0.5,
                  backgroundColor: "rgba(89, 69, 85, 0.2)",
                    borderColor: "#594555",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#594555",
                    pointBackgroundColor: "#594555",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#594555",
                    pointHoverBorderColor: "#594555",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                data: yearly_details.datasets,
                
                borderWidth: 1
            }]
        },

        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
}
function initCourseAdmissionMonthlyChart(monthly_course_details) {

    var ctx = document.getElementById("lineChart2").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
             labels: monthly_course_details.labels,
            datasets: [{
               label: 'Monthly Course_wise Admissions Chart',
                fill: true,
                    lineTension: 0.5,
                  backgroundColor: "rgba(65, 244, 79, 0.2)",
                    borderColor: "#41f44f",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#41f44f",
                    pointBackgroundColor: "#41f44f",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#41f44f",
                    pointHoverBorderColor: "#41f44f",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                data: monthly_course_details.datasets,
                
                borderWidth: 1
            }
          ]
        },

        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
}
function initCourseAdmissionYearlyChart(yearly_course_details) {

    var ctx = document.getElementById("lineChart3").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
             labels: yearly_course_details.labels,
            datasets: [{
               label: 'Yearly Course_wise Admissions Chart',
                fill: true,
                    lineTension: 0.5,
                  backgroundColor: "rgba(65, 244, 235,0.2)",
                    borderColor: "#41b8f4",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#41b8f4",
                    pointBackgroundColor: "#41b8f4",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#41b8f4",
                    pointHoverBorderColor: "#41b8f4",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                data: yearly_course_details.datasets,
                
                borderWidth: 1
            }
          ]
        },

        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
}



var chart_array;
$('#select_year').change(function(){
    loadMonthlyData();    
});



function loadMonthlyData() {
    $.ajax({
        type:'post',
        url: 'loadAdmissionMonthlyDataChart',
        data:{
            '_token':$('input[name=_token]').val(),
            'admission_growth':$('#select_year').val(),
        },
        success:function(data){
          monthly_details = data.chart_array;   
           initAdmissionMonthlyChart(monthly_details);
          
           // Chart.monthly_course_details.datasets1;
           //  Chart.update();
         
        },
    });
}
var chart1_array;
$('#choose_years').change(function(){
    $.ajax({
        type:'post',
        url: 'loadAdmissionYearlyDataChart',
        data:{
            '_token':$('input[name=_token]').val(),
            'value_to_subtract':$('#choose_years').val()
        },
        success:function(data){
          yearly_details = data.chart1_array;
          initAdmissionYearlyChart(yearly_details);
            // window.location.href = '/show';
        },
    });
});
var chart_array_course;

    function getState(val){
        document.getElementById('monthly_growth_course_wise_label').hidden = true;
    var course = $("#select_course").val();
    var year = $("#select_yearly_course").val();
    if(course && year) {
    $.ajax({
        type:'post',
        url: 'loadCourseAdmissionMonthlyDataChart',
        data:{
            '_token':$('input[name=_token]').val(),
            'course':course,
            'monthly_course':year,
        },
        success:function(data){
          monthly_course_details = data.chart_array_course;
          initCourseAdmissionMonthlyChart(monthly_course_details);
            // window.location.href = '/show';
        },
    });
}
};

var chart_yearwise_array_course;

    function getFilter(val){
         document.getElementById('yearly_growth_course_wise_label').hidden = true;
    var getcourse = $("#select_yearly_admission_course").val();
    var yearwise_course = $("#choose_yearly_course").val();
    if(getcourse && yearwise_course) {
    $.ajax({
        type:'post',
        url: 'loadCourseAdmissionYearlyDataChart',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        
        data:{
            '_token':$('input[name=_token]').val(),
            'getcourse':getcourse,
            'yearwise_course':yearwise_course,
        },
        success:function(data){
          yearly_course_details = data.chart_yearwise_array_course;
          initCourseAdmissionYearlyChart(yearly_course_details);
            // window.location.href = '/show';
        },
    });
}
};

