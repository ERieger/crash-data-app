<?php
$sql;
//fetch.php
include("connect.php");

$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($conn, $_POST["query"]);

    switch ($search) {
        case 'total':
            $sql = 'SELECT COUNT(crashid) FROM c_crash_data';
            break;
    }
}

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output .= $row['COUNT(crashid)'];
    }
    echo $output;
} else {
    echo 'Data Not Found';
}
