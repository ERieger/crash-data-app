<?php
include('connect.php');
?>

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
        <div class="areaSpeed">
            <canvas id="areaSpeed"></canvas>
        </div>
        </div>
        <script src="index.js"></script>
    </div>
</body>

</html>