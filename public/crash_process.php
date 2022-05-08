<?php
include('connect.php'); // Connect to database
// Get the values form the form
$day = $_POST["day"];
$month = $_POST["month"];
$year = $_POST["year"];
$time = $_POST["time"];
$location = $_POST["location"];
$accloc_x = $_POST["accloc_x"];
$accloc_y = $_POST["accloc_y"];
$totalCas = $_POST["totalCas"];
$totalFat = $_POST["totalFat"];
$totalSI = $_POST["totalSI"];
$totalMI = $_POST["totalMI"];
$areaSpeed = $_POST["areaSpeed"];
$posType = $_POST["posType"];
$crashType = $_POST["crashType"];

// Handel Checkboxes
if(isset($_POST['DUIInvolved']) && 
   $_POST['DUIInvolved'] == 'true') { // If checbox checked
    $DUIInvolved = 1; // Set variable to true
} else { // Not checked
    $DUIInvolved = 0; // Set to false
}

// See above comments
if(isset($_POST['drugsInvolved']) && 
   $_POST['drugsInvolved'] == 'true') {
    $drugsInvolved = 1;
} else {
    $drugsInvolved = 0;
}

function validate($data) {
    $data = trim($data); // Trim whitespace
    $data = htmlspecialchars($data); // Prevent SQL data injection by removing special characters
    return $data;    
}

// SQL statement for data insert
$SQL = "INSERT INTO `c_crash_data`(`day`, `month`, `year`, `time`, `locid`, `acclocx`, `acclocy`, `total_cas`, `total_fats`, `total_si`, `total_mi`, `area_speed`, `pos_type`, `crash_type`, `dui`, `drugs`) 
VALUES('$day', '$month', $year, '$time', $location, $accloc_x, $accloc_y, $totalCas, $totalFat, $totalSI, $totalMI, $areaSpeed, $posType, $crashType, $DUIInvolved, $drugsInvolved)";

// Add records
if(mysqli_query($conn, $SQL)){
    echo "Records added successfully."; // Acknowledge successful entry
} else{
    echo "ERROR: Could not able to execute $SQL. " . mysqli_error($conn); // Log error
}

// Close connection to database
mysqli_close($conn);

// Retrun to index page
header("Location: index.php");
exit;
?>