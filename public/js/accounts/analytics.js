$( document ).ready(function() {
    
    loadAccountsMonthlyData();
    loadMultiMonthlyAccountConversionData();
    loadMultiMonthlyRegWelData();
     $('#choose_years').val('1').trigger("change");
       $('#convert_wise_selection').val('1').trigger("change");
       $('#choose_year_for_welreg').val('1').trigger("change");
});

function initAccountsMonthlyChart(monthly_details) {

    var ctx = document.getElementById("lineChart").getContext('2d');

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
               label: 'Estimated Receivable',
                
                borderWidth: 1
            },

            {
               type: 'bar',
                 fill: true,
                    lineTension: 0.5,
                  backgroundColor: "rgba(80, 235, 17, 0.2)",
                    borderColor: "#00ff00",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#00ff00",
                    pointBackgroundColor: "#00ff00",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#00ff00",
                    pointHoverBorderColor: "#00ff00",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                data: monthly_details.datasets1,
               label: 'Actual Received',
                
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
function initAccountsYearlyChart(yearly_details) {

    var ctx = document.getElementById("line1Chart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: yearly_details.labels,
            datasets: [{
               label: 'Yearly Estimated Receivable',
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
            },

              {
                 type: 'bar',
                 fill: true,
                    lineTension: 0.5,
                  backgroundColor: "rgba(80, 235, 17, 0.2)",
                    borderColor: "#00ff00",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#00ff00",
                    pointBackgroundColor: "#00ff00",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#00ff00",
                    pointHoverBorderColor: "#00ff00",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                data: yearly_details.datasets1,
               label: 'Yearly Actual Received',
                
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

 function initMultilineChart(multiline_rates) {

    var ctx = document.getElementById("multilineChart").getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:multiline_rates.labels,
            datasets: [{
      type: 'bar',
      label: 'Total Installments',
      fill: true,
       backgroundColor: "rgba(51,159, 255, 0.2)",
      lineTension: 0.5,
        borderColor: "#339FFF",
        borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#339FFF",
                    pointBackgroundColor: "#339FFF",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#339FFF",
                    pointHoverBorderColor: "#339FFF",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
      data: multiline_rates.datasets3,
      borderWidth: 2
  },
            {
                label: "UnPaid",
                  fill: true,
                    lineTension: 0.5,
                  backgroundColor: "rgba(235, 47, 17, 0.2)",
                    borderColor: "#ff0040",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#ff0040",
                    pointBackgroundColor: "",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#ff0040",
                    pointHoverBorderColor: "#ff0040",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                   
                data:multiline_rates.datasets,
                  borderWidth: 1
            },
            {
      type: 'bar',
      label: 'Paid',
      fill: true,
    lineTension: 0.5,
     backgroundColor: "rgba(60, 255, 51, 0.2)",
        borderColor: "#3CFF33",
        borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#3CFF33",
                    pointBackgroundColor: "#3CFF33",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#3CFF33",
                    pointHoverBorderColor: "#3CFF33",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
      data: multiline_rates.datasets1,
      borderWidth: 2
    },
     {
      type: 'bar',
      label: 'Partial Paid',
       fill: true,
      lineTension: 0.5,
       backgroundColor: "rgba(255, 255, 51, 0.2)",
        borderColor: "#FFFC33",
        borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#FFFC33",
                    pointBackgroundColor: "#FFFC33",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#FFFC33",
                    pointHoverBorderColor: "#FFFC33",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
      data: multiline_rates.datasets2,
      borderWidth: 2
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
function initMultilineMonthChart(monthly_multiline_rates) {

    var ctx = document.getElementById("multiline1Chart").getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:monthly_multiline_rates.labels,
            datasets: [{
      type: 'bar',
      label: 'Total Installments',
      fill: true,
       backgroundColor: "rgba(51,159, 255, 0.2)",
      lineTension: 0.5,
        borderColor: "#339FFF",
        borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#339FFF",
                    pointBackgroundColor: "#339FFF",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#339FFF",
                    pointHoverBorderColor: "#339FFF",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
      data: monthly_multiline_rates.datasets,
      borderWidth: 2
  },
            {    
             type: 'bar',
                label: "UnPaid",
                  fill: true,
                    lineTension: 0.5,
                  backgroundColor: "rgba(235, 47, 17, 0.2)",
                    borderColor: "#ff0040",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#ff0040",
                    pointBackgroundColor: "",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#ff0040",
                    pointHoverBorderColor: "#ff0040",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                   
                data:monthly_multiline_rates.datasets1,
                  borderWidth: 1
            },
            {
      type: 'bar',
      label: 'Paid',
      fill: true,
    lineTension: 0.5,
     backgroundColor: "rgba(60, 255, 51, 0.2)",
        borderColor: "#3CFF33",
        borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#3CFF33",
                    pointBackgroundColor: "#3CFF33",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#3CFF33",
                    pointHoverBorderColor: "#3CFF33",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
      data:monthly_multiline_rates.datasets2,
      borderWidth: 2
    },
     {
      type: 'bar',
      label: 'Partial Paid',
       fill: true,
      lineTension: 0.5,
       backgroundColor: "rgba(255, 255, 51, 0.2)",
        borderColor: "#FFFC33",
        borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#FFFC33",
                    pointBackgroundColor: "#FFFC33",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#FFFC33",
                    pointHoverBorderColor: "#FFFC33",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
      data: monthly_multiline_rates.datasets3,
      borderWidth: 2
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
function  initMultilineMonthRegWelChart(monthly_multiline_reg_wel) {

    var ctx = document.getElementById("multiChartregwel").getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:monthly_multiline_reg_wel.labels,
            datasets: [{
      type: 'bar',
      label: 'Regular monthly total amount',
      fill: true,
       backgroundColor: "rgba(14,221,55, 0.2)",
      lineTension: 0.5,
        borderColor: "#0EDD37",
        borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#0EDD37",
                    pointBackgroundColor: "#0EDD37",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#0EDD37",
                    pointHoverBorderColor: "#0EDD37",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
      data:monthly_multiline_reg_wel.datasets,
      borderWidth: 2
  },
            {
                label: "PWWB monthly total amount",
                  fill: true,
                    lineTension: 0.5,
                  backgroundColor: "rgba(203, 66, 244, 0.2)",
                    borderColor: "#cb42f4",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#cb42f4",
                    pointBackgroundColor: "",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#cb42f4",
                    pointHoverBorderColor: "#cb42f4",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                   
                data:monthly_multiline_reg_wel.datasets1,
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
           
     function initMultilineYearlyRegWelChart(yearly_multiline_reg_wel){
       var ctx = document.getElementById("multiYearlyChartregwel").getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:yearly_multiline_reg_wel.labels,
            datasets: [{
      type: 'bar',
      label: 'Regular yearwise total amount',
      fill: true,
       backgroundColor: "rgba(161,167,167, 0.2)",
      lineTension: 0.5,
        borderColor: "#A1A7C1",
        borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#A1A7C1",
                    pointBackgroundColor: "#A1A7C1",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#A1A7C1",
                    pointHoverBorderColor: "#A1A7C1",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
      data:yearly_multiline_reg_wel.datasets,
      borderWidth: 2
  },
            {
                label: "PWWB YearWise total amount",
                  fill: true,
                    lineTension: 0.5,
                  backgroundColor: "rgba(13,240,243, 0.2)",
                    borderColor: "#0DF3F3",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#0DF3F3",
                    pointBackgroundColor: "",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#0DF3F3",
                    pointHoverBorderColor: "#0DF3F3",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                   
                data:yearly_multiline_reg_wel.datasets1,
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
    loadAccountsMonthlyData();    
});

function loadAccountsMonthlyData() {
    $.ajax({
        type:'post',
        url: 'loadAccountsMonthlyDataChart',
        data:{
            '_token':$('input[name=_token]').val(),
            'accounts_growth':$('#select_year').val(),
        },
        success:function(data){
          monthly_details = data.chart_array;
          initAccountsMonthlyChart(monthly_details);
            // window.location.href = '/show';
        },
    });
}
var chart1_array;
$('#choose_years').change(function(){
    $.ajax({
        type:'post',
        url: 'loadAccountsYearlyDataChart',
        data:{
            '_token':$('input[name=_token]').val(),
            'value_to_subtract':$('#choose_years').val()
        },
        success:function(data){
          yearly_details = data.chart1_array;
          initAccountsYearlyChart(yearly_details);
            // window.location.href = '/show';
        },
    });
});
var multi_chart;
  $('#convert_wise_selection').change(function(){
      loadMultiAccountConversionData();    
  });

function loadMultiAccountConversionData() {
     $.ajax({
         type:'post',
         url: 'loadAccountsMultiYearlyDataChart',
           data:{        
             '_token':$('input[name=_token]').val(),
            'multi_choose_year':$('#convert_wise_selection').val(),
         },
         success:function(data){ 
         multiline_rates=data.multi_chart;      
         initMultilineChart(multiline_rates);
         // window.location.href = '/show';          },
      },
 });
}
var multi_monthly_chart;
  $('#select_year_month').change(function(){
      loadMultiMonthlyAccountConversionData();    
  });

function loadMultiMonthlyAccountConversionData() {
     $.ajax({
         type:'post',
         url: 'loadAccountsMultiMonthlyYearlyDataChart',
           data:{        
             '_token':$('input[name=_token]').val(),
            'select_year_month':$('#select_year_month').val(),
         },
         success:function(data){ 
         monthly_multiline_rates=data.multi_monthly_chart;      
         initMultilineMonthChart(monthly_multiline_rates);
         // window.location.href = '/show';          },
      },
 });
}
var multi_monthly_reg_wel_chart;
  $('#select_year_for_wel_reg').change(function(){
     loadMultiMonthlyRegWelData();    
  });

function loadMultiMonthlyRegWelData() {
     $.ajax({
         type:'post',
         url: 'loadWelRegMonthlyDataChart',
           data:{        
             '_token':$('input[name=_token]').val(),
            'select_year_for_wel_reg':$('#select_year_for_wel_reg').val(),
         },
         success:function(data){ 
         monthly_multiline_reg_wel=data.multi_monthly_reg_wel_chart;      
         initMultilineMonthRegWelChart(monthly_multiline_reg_wel);
         // window.location.href = '/show';          },
      },
 });
}
var multi_yearly_reg_wel_chart;
  $('#choose_year_for_welreg').change(function(){  
     $.ajax({
         type:'post',
         url: 'loadWelRegYearlyDataChart',
           data:{        
             '_token':$('input[name=_token]').val(),
            'choose_year_for_welreg':$('#choose_year_for_welreg').val(),
         },
         success:function(data){ 
         yearly_multiline_reg_wel=data.multi_yearly_reg_wel_chart;      
         initMultilineYearlyRegWelChart(yearly_multiline_reg_wel);
         // window.location.href = '/show';          },
      },
 });
});





