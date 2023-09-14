$( document ).ready(function() {
    
    loadMonthlyData();

    $('#year_wise_selection').val('1').trigger("change");
    $('#convert_wise_selection').val('1').trigger("change");
});

function initMonthlyChart(monthly_details) {

    var ctx = document.getElementById("lineChart").getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthly_details.labels,
            datasets: [{
               fill: true,
                    lineTension: 0.5,
                  backgroundColor: "rgba(51, 141, 221, 0.2)",
                    borderColor: "#2f8ee0",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#2f8ee0",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#2f8ee0",
                    pointHoverBorderColor: "#eef0f2",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                data: monthly_details.datasets,
               label: 'Monthly Enquiries Chart',
                
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

function initYearlyChart(yearly_details) {

    var ctx = document.getElementById("line1Chart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: yearly_details.labels,
            datasets: [{
               label: 'Yearly Enquiries Chart',
                fill: true,
                    lineTension: 0.5,
                  backgroundColor: "rgba(235, 139, 17, 0.2)",
                    borderColor: "#EB8B11",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#EB8B11",
                    pointBackgroundColor: "#EB8B11",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#EB8B11",
                    pointHoverBorderColor: "#EB8B11",
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
                  
    function initConversionChart(conversion_details) {      
    var ctx = document.getElementById("bar").getContext('2d');
     var myChart = new Chart(ctx, {
           type: 'bar',
            data: {
            labels: conversion_details.labels,
            datasets: [{
               label: 'Yearly Conversion Rate',
                fill: true,
                    lineTension: 0.5,
                  backgroundColor: "rgba(103, 86, 241, 0.2)",
                    borderColor: "#6756F1",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#6756F1",
                    pointBackgroundColor: "#6756F1",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#6756F1",
                    pointHoverBorderColor: "#6756F1",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                data: conversion_details.datasets,
                
                borderWidth: 1
            }]
        },
            options: {}
        });
       }
       function initMultilineChart(multiline_rates) {

    var ctx = document.getElementById("MultilineChart").getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:multiline_rates.labels1,
            datasets: [{
                label: "Not Intersted",
                  fill: true,
                    lineTension: 0.5,
                  backgroundColor: "rgba(51, 141, 221, 0.2)",
                    borderColor: "#2f8ee0",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#2f8ee0",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#2f8ee0",
                    pointHoverBorderColor: "#eef0f2",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                   
                data:multiline_rates.datasets,
                  borderWidth: 1
            },
            {
      type: 'bar',
      label: 'Dropped out',
      fill: true,
    lineTension: 0.5,
     backgroundColor: "rgba(17, 30, 235, 0.2)",
        borderColor: "#0000ff",
        borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#0000ff",
                    pointBackgroundColor: "#0000ff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#0000ff",
                    pointHoverBorderColor: "#0000ff",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
      data: multiline_rates.datasets3,
      borderWidth: 2
    },
     {
      type: 'bar',
      label: 'Intersted',
       fill: true,
      lineTension: 0.5,
       backgroundColor: "rgba(149, 17, 235, 0.2)",
        borderColor: "#8000ff",
        borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#8000ff",
                    pointBackgroundColor: "#bf00ff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#bf00ff",
                    pointHoverBorderColor: "#bf00ff",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
      data: multiline_rates.dataset1,
      borderWidth: 2
    },
     {
      type: 'bar',
      label: 'Moved to admissions',
      fill: true,
       backgroundColor: "rgba(235, 47, 17, 0.2)",
      lineTension: 0.5,
        borderColor: "#ff0040",
        borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#ff0000",
                    pointBackgroundColor: "#ff0000",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#ff0000",
                    pointHoverBorderColor: "#ff0000",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
      data: multiline_rates.datasets4,
      borderWidth: 2
    },
     {
      type: 'bar',
      label: 'Admitted',
      fill: true,
       backgroundColor: "rgba(80, 235, 17, 0.2)",
    lineTension: 0.5,
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
      data: multiline_rates.datasets2,
      borderWidth: 2
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
       


var chart_array;
$('#year_wise_selection').change(function(){
    $.ajax({
        type:'post',
        url: 'loadYearlyDataChart',
        data:{
            '_token':$('input[name=_token]').val(),
            'value_to_minus':$('#year_wise_selection').val()
        },
        success:function(data){
          yearly_details = data.chart_array;
          initYearlyChart(yearly_details);
            // window.location.href = '/show';
        },
    });
      $('#years').val('');
});

var chart1_array;
$('#DataType').change(function(){
    loadMonthlyData();    
});

function loadMonthlyData() {
    $.ajax({
        type:'post',
        url: 'loadMonthlyDataChart',
        data:{
            '_token':$('input[name=_token]').val(),
            'select_year':$('#DataType').val(),
        },
        success:function(data){
          monthly_details = data.chart1_array;
          initMonthlyChart(monthly_details);
            // window.location.href = '/show';
        },
    });
}
 
 var conversion_array;
 $('#LoadConversionData').change(function(){
     loadConversionData();    
 });

function loadConversionData() {
    $.ajax({
        type:'post',
        url: 'loadConversionDataChart',
          data:{        
            '_token':$('input[name=_token]').val(),
           'choose_year':$('#LoadConversionData').val(),
        },
        success:function(data){       
           conversion_details = data.conversion_array;
        initConversionChart(conversion_details);
          // window.location.href = '/show';
         },
     });
 }
   var multi_chart;
  $('#convert_wise_selection').change(function(){
      loadMultiConversionData();    
  });

 function loadMultiConversionData() {
     $.ajax({
         type:'post',
         url: 'loadMultiChart',
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
















