<?php
$sql;
//fetch.php
include("connect.php");

$output = [];
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($conn, $_POST["query"]);

    switch ($search) {
        case 'total':
            $sql = 'SELECT COUNT(crashid) AS count FROM c_crash_data';
            break;
        case 'crashid':
            $sql = 'SELECT crashid FROM c_crash_data';
            break;
        case 'day':
            $sql = 'SELECT DISTINCT day, COUNT(day) AS count
            FROM c_crash_data GROUP BY day
            ORDER BY day ASC';
            break;
        case 'month':
            $sql = 'SELECT DISTINCT month, COUNT(month) AS count
            FROM c_crash_data GROUP BY month
            ORDER BY month ASC';
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
            FROM c_crash_data WHERE COUNT(locid) > 5 GROUP BY locid
            ORDER BY locid ASC';
            break;
        case 'crash_type':
            $sql = 'SELECT crash_type FROM c_crash_data';
            break;
        case 'dui':
            $sql = 'SELECT dui FROM c_crash_data';
            break;
        case 'drugs':
            $sql = 'SELECT drugs FROM c_crash_data';
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
