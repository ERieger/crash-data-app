let crashes = document.getElementById('crashes');
let x = document.querySelector('#x');
let myChart;
let chartArea = document.getElementById('chart').getContext('2d');
let chartDefined = false;

function load_data(search) {
    var values;
    // console.log(search);
    $.ajax({
        async: false,
        url: "fetch.php",
        method: "POST",
        data: {
            query: search
        },
        success: function (data) {
            // console.log(JSON.parse(data));
            values = data;
            console.log(values);
        }
    });
    return JSON.parse(values);
}

function populateDropdown() {
    let xfields = ['day', 'month', 'year', 'time','locid', 'area_speed', 'pos_type', 'crash_type'];

    xfields.forEach((value) => {
        $(x).append(`<option value="${value}">${value}</option>`);
    });
}

$(document).ready(function () {
    populateDropdown();
    crashes.innerHTML = load_data('total')[0]['count'];
});

function submit() {
    updateChart($("#x").val());
}

function updateChart(xquery) {
    console.log(xquery);
    console.log(myChart);

    if (chartDefined) {
        myChart.destroy();
    }

    let data = (() => {
        let data = load_data(xquery);
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
