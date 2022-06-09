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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
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
        <div id="map"></div>

        <script src="./heatmap.js"></script>
        <script src="./leaflet-heatmap.js"></script>
        <script src="./proj4.js"></script>
        <script src="./index.js"></script>
        <script src="./map.js"></script>
    </div>
</body>

</html>