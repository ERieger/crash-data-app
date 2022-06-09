<?php
$sql;
include("connect.php");
$query = $_POST['query'];
$decoded = json_decode($query, true);
// var_dump($decoded);

$output = [];
if (isset($decoded["query"])) {
    $search = $decoded["query"];
    $filterKey = $decoded["filter"];

    switch ($search) {
        case 'total':
            $sql = 'SELECT COUNT(crashid) AS count FROM c_crash_data';
            break;
        case 'otd';
            $sql = "SELECT COUNT(crashid) AS count FROM c_crash_data WHERE day LIKE '$filterKey'";
            break;
        case 'crashid':
            $sql = 'SELECT crashid FROM c_crash_data';
            break;
        case 'day':
            $sql = 'SELECT DISTINCT day, COUNT(day) AS count
            FROM c_crash_data GROUP BY day
            ORDER BY CASE
                WHEN day = "Monday" THEN 1
                WHEN day = "Tuesday" THEN 2
                WHEN day = "Wednesday" THEN 3
                WHEN day = "Thursday" THEN 4
                WHEN day = "Friday" THEN 5
                WHEN day = "Saturday" THEN 6
                WHEN day = "Sunday" THEN 7
            END';
            break;
        case 'month':
            $sql = "SELECT DISTINCT month, COUNT(month) AS count
            FROM c_crash_data GROUP BY month
            ORDER BY
             (CASE month
                WHEN 'January' THEN 1
                WHEN 'February' THEN 2
                WHEN 'March' THEN 3
                WHEN 'April' THEN 4
                WHEN 'May' THEN 5
                WHEN 'June' THEN 6
                WHEN 'July' THEN 7
                WHEN 'August' THEN 8
                WHEN 'September' THEN 9
                WHEN 'October' THEN 10
                WHEN 'November' THEN 11
                WHEN 'December' THEN 12
              END)";
            break;
        case 'year':
            $sql = 'SELECT DISTINCT year, COUNT(year) AS count
            FROM c_crash_data GROUP BY year
            ORDER BY year ASC';
            break;
        case 'time':
            $sql = 'SELECT DISTINCT time, COUNT(time) AS count
            FROM c_crash_data GROUP BY time
            ORDER BY time ASC';
            break;
        case 'locid':
            $sql = 'SELECT DISTINCT locid, COUNT(locid) AS count
            FROM c_crash_data GROUP BY locid
            ORDER BY locid ASC';
            break;
        case 'area_speed':
            $sql = 'SELECT DISTINCT area_speed, COUNT(area_speed) AS count
            FROM c_crash_data GROUP BY area_speed
            ORDER BY area_speed ASC';
            break;
        case 'pos_type':
            $sql = 'SELECT DISTINCT pos_type, COUNT(pos_type) AS count
            FROM c_crash_data GROUP BY pos_type
            ORDER BY pos_type ASC';
            break;
        case 'crash_type';
            $sql = "SELECT crash_type, COUNT(crash_type) AS count
            FROM c_crash_data GROUP BY crash_type";
            break;
        case 'dui':
            $sql = 'SELECT DISTINCT dui, COUNT(dui) AS count
            FROM c_crash_data GROUP BY dui
            ORDER BY dui ASC';
            break;
        case 'drugs':
            $sql = 'SELECT DISTINCT drugs, COUNT(drugs) AS count
            FROM c_crash_data GROUP BY drugs
            ORDER BY drugs ASC';
            break;
        case 'accloc':
            $sql = 'SELECT acclocx, acclocy FROM c_crash_data';
            break;
    }
}

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }

    echo json_encode($output);
} else {
    echo 'Data Not Found';
}
