document.addEventListener("DOMContentLoaded", function() {

    var minimum_button = document.getElementById("min");
    var maximum_button = document.getElementById("max");
    var average_button = document.getElementById("average");
    var date_button = document.getElementById("date");
    var time_button = document.getElementById("time");
    var nursery_button = document.getElementById("nursery_id");
    var tds_button = document.getElementById("tds");
    var pH_button = document.getElementById("pH");
    var ambient_temperature_button = document.getElementById("ambient_temp");
    var water_temperature_button = document.getElementById("water_temp");
    var water_level_button = document.getElementById("water_level");
    var water_flow_button = document.getElementById("water_flow");

    date_button.addEventListener("click", function() {
        fetchData("orderby", "date");
    });

    time_button.addEventListener("click", function() {
        fetchData("orderby", "time");
    });

    nursery_button.addEventListener("click", function() {
        fetchData("orderby", "nursery_id");
    });

    tds_button.addEventListener("click", function() {
        fetchData("orderby", "tds");
    });

    pH_button.addEventListener("click", function() {
        fetchData("orderby", "pH");
    });

    ambient_temperature_button.addEventListener("click", function() {
        fetchData("orderby", "ambient_temp");
    });

    water_temperature_button.addEventListener("click", function() {
        fetchData("orderby", "water_temp");
    });

    water_level_button.addEventListener("click", function() {
        fetchData("orderby", "water_level");
    });

    water_flow_button.addEventListener("click", function() {
        fetchData("orderby", "water_flow");
    });

    minimum_button.addEventListener("click", function() {
        toggleMinimum();
    });

    maximum_button.addEventListener("click", function () {
        toggleMaximum();
    });

    average_button.addEventListener("click", function() {
        toggleAverage();
    });

    function toggleMinimum() {
        var minDiv = document.getElementById("minimum");
        minDiv.style.display = minDiv.style.display === "none" ? "block" : "none";
    }

    function toggleMaximum() {
        var maxDiv = document.getElementById("maximum");
        maxDiv.style.display = maxDiv.style.display === "none" ? "block" : "none";
    }

    function toggleAverage() {
        var avgDiv = document.getElementById("avg");
        avgDiv.style.display = avgDiv.style.display === "none" ? "block" : "none";
    }

    function fetchData(action, parameter) {
        // var request = new XMLHttpRequest();
        // request.onreadystatechange = function() {
        //     if ( request.readyState == 4 && request.status == 200 ) {
        //         var table = document.querySelector(".table table tbody");
        //         table.innerHTML = request.responseText;
        //     }
        // };

        // request.open("GET", "main.php?action=" + action + "&parameter=" + parameter, true);
        // request.send();
        fetch("main.php?action = " + action + "&parameter = " + parameter).then (response=> {
            if (!response.ok) {
                throw new Error("Bad network response.");
            }
            return response.text();
        }).then (data=> {
            var table = document.querySelector(".table table tbody")
            table.innerHTML = data;
        })
            .catch(error=> console.error('Error:', error));
    }

    if (window.location.pathname.includes('chart.php')) {
        fetchChartData();
    }

    function fetchChartData() {
        fetch("main.php?action=chartData")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Bad network response.");
                }
                return response.json();
            })
            .then(data => {
                renderChart(data);
            })
            .catch(error => console.error('Error:', error));
    }

});