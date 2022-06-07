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
            $sql = 'SELECT "day" FROM c_cras_data';
            break;
        case 'month':
            $sql = 'SELECT "month" FROM c_crash_data';
            break;
        case 'year':
            $sql = 'SELECT "year" FROM c_crash_data';
            break;
        case 'time':
            $sql = 'SELECT "time" FROM c_crash_data';
            break;
        case 'locid':
            $sql = 'SELECT locid FROM c_crash_data';
            break;
        case 'total_cas':
            $sql = 'SELECT total_cas FROM c_crash_data';
            break;
        case 'total_fats':
            $sql = 'SELECT total_fats FROM c_crash_data';
            break;
        case 'total_si':
            $sql = 'SELECT total_si FROM c_crash_data';
            break;
        case 'area_speed':
            $sql = 'SELECT area_speed FROM c_crash_data';
            break;
        case 'pos_type':
            $sql = 'SELECT pos_type FROM c_crash_data';
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
        // case 'area_speed':
        //     $sql = 'SELECT DISTINCT area_speed, COUNT(*) AS count FROM `c_crash_data` GROUP BY area_speed';
        //     break;
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
?>