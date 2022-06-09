const chartArea = document.getElementById('chart').getContext('2d');
let chartDefined = false;
let myChart;
const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
const d = new Date();
let day = weekday[d.getDay()];

$(document).ready(function () {
    populateDropdown();
    $('#crashes').html(load_data('total', null)[0]['count']);
    $('#otd').html(load_data('otd', day)[0]['count']);
    updateChart('day');
});

function load_data(search, filterKey) {
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
    if (chartDefined) {
        myChart.destroy();
    }

    let data = (() => {
        let data = load_data(xquery, null);
        let labels = [];
        let dataArr = [];

        for (let i = 0; i < data.length; i++) {
            labels.push(data[i][xquery]);
            dataArr.push(data[i]['count']);
        }

        return {
            field: xquery,
            labels: labels,
            dataArr: dataArr
        };
    })();

    myChart = new Chart(chartArea, {
        type: 'bar',
        data: {
            labels: data.labels,
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

    chartDefined = true;
}
