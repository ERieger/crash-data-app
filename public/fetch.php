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
        case 'speed':
            $sql = 'SELECT DISTINCT area_speed, COUNT(*) AS count FROM `c_crash_data` GROUP BY area_speed';
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
