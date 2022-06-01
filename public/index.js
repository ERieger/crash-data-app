let crashes = document.getElementById('crashes');

function load_data(search) {
    var values;

    $.ajax({
        async: false,
        url: "fetch.php",
        method: "POST",
        data: {
            query: search
        },
        success: function (data) {
            values = data;
        }
    });

    return JSON.parse(values);
}

$(document).ready(function () {
    crashes.innerHTML = load_data('total')[0]['count'];
});

const ctx = document.getElementById('areaSpeed').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: (() => {
            let data = load_data('speed');
            let labels = [];

            for (let i = 0; i < data.length; i++) {
                labels.push(data[i]['area_speed']);
            }

            return labels;
        })(),
        datasets: [{
            label: '# of Votes',
            data: (() => {
                let data = load_data('speed');
                let dataArr = [];

                for (let i = 0; i < data.length; i++) {
                    dataArr.push(data[i]['count']);
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