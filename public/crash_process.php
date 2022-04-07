<?php
include('connect.php');
$date = validate($_POST["date"]);
$time = $_POST["time"];

function validate($data) {
    $data = trim($data);
    return $data;    
}

$SQL = ''
?>