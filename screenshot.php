<?php
$sql;
include("connect.php"); // Connect to database
$query = $_POST['query']; // Get post request from js
$decoded = json_decode($query, true); // Decode the parsed JSON obect
// var_dump($decoded); // Display a dump of the parsed JSON

$output = []; // Define the output array
if (isset($decoded["query"])) { // Check query is defined
    // These are redundant however useful if the object is updated
    $search = $decoded["query"]; // Decode search query
    $filterKey = $decoded["filter"]; // Decode filter key

    switch ($search) { // Get filter ref
        case 'crashid': // Count all crashes
            $sql = 'SELECT crashid FROM c_crash_data';
            break;
        case 'day': // Count and order crashes on days
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
        ...
    }
}

$result = mysqli_query($conn, $sql); // Get the desired value
if (mysqli_num_rows($result) > 0) { // If successfully returned result
    while ($row = mysqli_fetch_array($result)) { // Loop through returned value
        $output[] = $row; // Push row to output array
    }

    echo json_encode($output); // Encode output
} else {
    echo 'Data Not Found'; // If no data
}
