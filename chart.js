import {getDataFromMySQL} from 'mysql-data.js';

var ctx = document.getElementById("chart").getContext("2d");
var chart = new chart(ctx, {
    type: "bar",
    data: {
        labels: ["Ratings", "Comments", "Users"],
        datasets: [{
            label: "Count",
            data: [],
            backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)"
            ],
            borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)"
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        },
        legend: {
            display: false
        },
        title: {
            display: true,
            text: "Metrics Count"
        }
    }
});

getDataFromMySQL().then(data => {
    chart.data.datasets[0].data = data;
    chart.update();
});