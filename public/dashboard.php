<?php
include('connect.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crash Data Web Interface</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <link rel=stylesheet href="actionfw.css">
    <link rel=stylesheet href="index.css">
</head>

<body>
    <div class="page">
        <div class="nav">
            <h1>Road Crash Dashboard</h1>

        </div>
        <div class="body">
            <div class="totals">
                <h1>Totals</h1>
                <span>
                    <p>Total Crashes</p>
                    <p id="crashes"></p>
                </span>
            </div>
            <div class="chart">
                <span>
                    <select name="x-axis" id="x" class="selects"></select>
                    <button class="btn btn-primary-outline-rounded" onclick="submit()">Submit</button>
                </span>
                <canvas id="chart"></canvas>
            </div>
            <!-- <div class="filters">
            <h1>Select Filters</h1>
        </div> -->

        
        </div>
        <script src="index.js"></script>
    </div>
</body>

</html>