$(document).ready(function() {

  loadStudentExpelData();
  $('#choose_year').val('1').trigger("change");
});



function initExpelConversionChart(conversion_details) {

  var ctx = document.getElementById("line").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: conversion_details.labels,
      datasets: [{
        label: 'Expel Rate',
        fill: true,
        lineTension: 0.5,
        backgroundColor: "rgba(245, 46, 3, 0.2)",
        borderColor: "#F93106",
        borderCapStyle: 'butt',
        borderDash: [],
        borderDashOffset: 0.0,
        borderJoinStyle: 'miter',
        pointBorderColor: "#F93106",
        pointBackgroundColor: "#F93106",
        pointBorderWidth: 1,
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "#F93106",
        pointHoverBorderColor: "#F93106",
        pointHoverBorderWidth: 2,
        pointRadius: 1,
        pointHitRadius: 10,
        data: conversion_details.datasets,

        borderWidth: 1
      }, {
        label: 'Registered Rate',
        fill: true,
        lineTension: 0.5,
        backgroundColor: "rgba(51, 141, 221, 0.2)",
        borderColor: "#3498DB  ",
        borderCapStyle: 'butt',
        borderDash: [],
        borderDashOffset: 0.0,
        borderJoinStyle: 'miter',
        pointBorderColor: "#3498DB  ",
        pointBackgroundColor: "#3498DB  ",
        pointBorderWidth: 1,
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "#3498DB  ",
        pointHoverBorderColor: "#3498DB  ",
        pointHoverBorderWidth: 2,
        pointRadius: 1,
        pointHitRadius: 10,
        data: conversion_details.datasets1,

        borderWidth: 1
      }]
    },

    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
}


var conversion_array;
$('#LoadExpelData').change(function() {
  loadStudentExpelData();
});

function loadStudentExpelData() {
  $.ajax({
    type: 'post',
    url: 'students/loadExpelChart',
    data: {
      '_token': $('input[name=_token]').val(),
      'choose_year': $('#LoadExpelData').val(),
    },
    success: function(data) {
      conversion_details = data.conversion_array;
      initExpelConversionChart(conversion_details);
      // window.location.href = '/show';
    },
  });
}