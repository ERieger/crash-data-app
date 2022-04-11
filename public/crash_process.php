<?php
include('connect.php');
$date = $_POST["date"];
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
$DUIInvolved = $_POST["DUIInvolved"];
$drugsInvolved = $_POST["drugsInvolved"];

function validate($data) {
    $data = trim($data);
    return $data;    
}

$SQL = "INSERT INTO c_crash_data (date, time, locid, accloc-x, accloc-y, total-cas, total-fats, total-si, total-mi, area-speed, pos-type, crash-type, dui, drugs)
VALUES($date, $time, $location, $accloc_x, $accloc_y, $totalCas, $totalFat, $totalSI, $totalMI, $areaSpeed, $posType, $crashType, $DUIInvolved, $drugsInvolved)";
?>