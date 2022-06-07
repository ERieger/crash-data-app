let crashes = document.getElementById('crashes');
let x = document.querySelector('#x');
let y = document.querySelector('#y');
let selects = document.querySelector('.selects');

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
        }
    });

    return JSON.parse(values);
}

function populateDropdown() {
    let fields = ['crashid', 'day', 'month', 'year', 'time', 'locid', 'total_cas', 'total_fats', 'total_si', 'total_mi', 'area_speed', 'pos_type', 'crash_type', 'dui', 'drugs'];
    fields.forEach((value) => {
        $(x).append(`<option value="${value}">${value}</option>`);
        $(y).append(`<option value="${value}">${value}</option>`);
    });
}

$(document).ready(function () {
    populateDropdown();
    crashes.innerHTML = load_data('total')[0]['count'];
    bindListener();
});

function bindListener() {
    $(selects).change(updateChart($("#x").val(), $("#y").val()));
}

function updateChart(xquery, yquery) {
    console.log(xquery);
    let chart = document.getElementById('areaSpeed').getContext('2d');
    let myChart = new Chart(chart, {
        type: 'bar',
        data: {
            labels: (() => {
                let data = load_data(xquery);
                let labels = [];
    
                for (let i = 0; i < data.length; i++) {
                    labels.push(data[i][xquery]);
                }
    
                return labels;
            })(),
            datasets: [{
                label: '# of Votes',
                data: (() => {
                    let data = load_data(yquery);
                    let dataArr = [];
    
                    for (let i = 0; i < data.length; i++) {
                        dataArr.push(data[i][yquery]);
                    }
    
                    return dataArr;
                })(),
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
                        text: '# of Crashes',
                        display: true,
                        align: 'center'
                    }
                },
                x: {
                    title: {
                        text: 'Speed of Crash Area',
                        display: true,
                        align: 'center'
                    }
                }
            },
            maintainAspectRatio: false
        }
    });
    bindListener();
}
