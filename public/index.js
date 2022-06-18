// Define global variables
const chartArea = document.getElementById('chart').getContext('2d'); // Reference to chart
let chartDefined = false;
let myChart;
const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
const d = new Date();
let day = weekday[d.getDay()]; // Get current day as string

// Run when the page loads
$(document).ready(function () {
    populateDropdown(); // Call function to populate dropdowns
    $('#crashes').html(load_data('total', null)[0]['count']); // Display total
    $('#otd').html(load_data('otd', day)[0]['count']); // Count total on this day
    updateChart('day'); // Call chart update function with 'day' option
});

// Define function to load data - accept search query and filter key
function load_data(search, filterKey) {
    // Create search query object to parse to php
    let obj = JSON.stringify({
        query: search,
        filter: filterKey
    });

    var values;
    // console.log(search);
    $.ajax({
        async: false,
        url: "fetch.php",
        method: "POST",
        data: {
            query: obj
        },
        success: function (data) {
            // console.log(JSON.parse(data));
            // console.log(data);
            values = data;
            // console.log(values);
        }
    });
    return JSON.parse(values);
}

function populateDropdown() {
    let xfields = ['day', 'month', 'year', 'time', 'locid', 'area_speed', 'pos_type', 'crash_type'];

    xfields.forEach((value) => {
        $('#x').append(`<option value="${value}">${value}</option>`);
    });
}

function submit() {
    updateChart($("#x").val());
}

function updateChart(xquery) {
    // Destory chart if already defined
    // Fixes a chart.js error when updating graph
    if (chartDefined) {
        myChart.destroy();
    }

    // Define chart data
    // Uses arrow function to avoid scope issue
    // Also minimises extra functions
    let data = (() => {
        let data = load_data(xquery, null); // Get data
        // Define data and labels array
        let labels = [];
        let dataArr = [];

        // Loop through returned data
        for (let i = 0; i < data.length; i++) {
            labels.push(data[i][xquery]); // Label name
            dataArr.push(data[i]['count']); // Push data value
        }

        // Return object with all values
        return {
            field: xquery, // Chart name
            labels: labels, // Chart labels
            dataArr: dataArr // Chart data
        };
    })();

    // Define chart config
    // Also creates new chart instance
    myChart = new Chart(chartArea, {
        type: 'bar',
        data: {
            labels: data.labels, // Reference to data object
            datasets: [{
                label: 'Count of crashes',
                data: data.dataArr,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                // Title axes
                y: {
                    beginAtZero: true,
                    title: {
                        text: `Count of ${data.field}`,
                        display: true,
                        align: 'center'
                    }
                },
                x: {
                    title: {
                        text: data.field,
                        display: true,
                        align: 'center'
                    }
                }
            },
            maintainAspectRatio: false
        }
    });

    /*
    chartDefined is a global variable
    on page load it is false
    after the chart has been made for the first time
    it becomes true
    if chart is defined then it is destroyed
    before the data is updated
    */
    chartDefined = true;
}
