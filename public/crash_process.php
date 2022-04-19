<?php
include('connect.php');
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

if(isset($_POST['DUIInvolved']) && 
   $_POST['DUIInvolved'] == 'true') {
    $DUIInvolved = 1;
} else {
    $DUIInvolved = 0;
}

if(isset($_POST['drugsInvolved']) && 
   $_POST['drugsInvolved'] == 'true') {
    $drugsInvolved = 1;
} else {
    $drugsInvolved = 0;
}

function validate($data) {
    $data = trim($data);
    return $data;    
}

$SQL = "INSERT INTO `c_crash_data`(`day`, `month`, `year`, `time`, `locid`, `acclocx`, `acclocy`, `total_cas`, `total_fats`, `total_si`, `total_mi`, `area_speed`, `pos_type`, `crash_type`, `dui`, `drugs`) 
VALUES('$day', '$month', $year, '$time', $location, $accloc_x, $accloc_y, $totalCas, $totalFat, $totalSI, $totalMI, $areaSpeed, $posType, $crashType, $DUIInvolved, $drugsInvolved)";

if(mysqli_query($conn, $SQL)){

    echo "Records added successfully.";

} else{

    echo "ERROR: Could not able to execute $SQL. " . mysqli_error($conn);

}

 

// Close connection
mysqli_close($conn);

header("Location: index.php");
exit;
?>