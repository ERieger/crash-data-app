<?php
include('connect.php');

//check to see if form sent
if (isset($_POST["submit"])) {
    echo "pressed submit: ";
    if ($_FILES['file']['name']) {
        echo ($_FILES['file']['name']);
        echo "</br>TMP File Name: " . ($_FILES['file']['tmp_name']);
        $filename = explode(".", $_FILES['file']['name']);

        //check to see if file name has a csv extension_loaded
        if ($filename[1] == 'csv') {
            //create a handler to read through file
            $handle = fopen($_FILES['file']['tmp_name'], "r");
            //read through the document and grab each cell and store in a local variable
            while ($data = fgetcsv($handle)) {
                $day = mysqli_real_escape_string($conn, $data[12]);
                $month = mysqli_real_escape_string($conn, $data[11]);
                $year = mysqli_real_escape_string($conn, $data[10]);
                $time = date("H:i:s", strtotime(mysqli_real_escape_string($conn, $data[13])));
                $location = getLocID($data);
                $accloc_x = mysqli_real_escape_string($conn, $data[30]);
                $accloc_y = mysqli_real_escape_string($conn, $data[31]);
                $totalCas = mysqli_real_escape_string($conn, $data[6]);
                $totalFat = mysqli_real_escape_string($conn, $data[7]);
                $totalSI = mysqli_real_escape_string($conn, $data[8]);
                $totalMI = mysqli_real_escape_string($conn, $data[9]);
                $areaSpeed = mysqli_real_escape_string($conn, $data[14]);
                $posType = getPosType($data);
                $crashType = getCrashType($data);

                if (
                    null !== mysqli_real_escape_string($conn, $data[28]) &&
                    mysqli_real_escape_string($conn, $data[28]) == "yes"
                ) {
                    $DUIInvolved = 1;
                } else {
                    $DUIInvolved = 0;
                }

                if (
                    null !== mysqli_real_escape_string($conn, $data[29]) &&
                    mysqli_real_escape_string($conn, $data[29]) == "yes"
                ) {
                    $drugsInvolved = 1;
                } else {
                    $drugsInvolved = 0;
                }

                //create a sql statement with variables for insert
                $sql = "INSERT INTO `c_crash_data`(`day`, `month`, `year`, `time`, `locid`, `acclocx`, `acclocy`, `total_cas`, `total_fats`, `total_si`, `total_mi`, `area_speed`, `pos_type`, `crash_type`, `dui`, `drugs`)
                VALUES('$day', '$month', $year, '$time', $location, $accloc_x, $accloc_y, $totalCas, $totalFat, $totalSI, $totalMI, $areaSpeed, '$posType', '$crashType', $DUIInvolved, $drugsInvolved)";

                echo "</br>" . $sql . "</br></br>";

                if ($conn->query($sql) === true) {
                    echo ("New record added");
                } else {
                    echo $sql . " " . $conn->error;
                }
            }
            //close the handler
            fclose($handle);
            //let the user know they are done
            echo ("<script>alert('import done')</script>");
        }
    }
}

function getLocID($data) {
    global $conn;

    $loc = mysqli_real_escape_string($conn, $data[2]);
    $sql = "SELECT `location-id` FROM `c_suburb` WHERE `suburb` LIKE '$loc' ORDER BY `location-id` LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            return $row["location-id"];
        }
    } else {
        echo "Location $loc not found... Adding";
        insertLoc($data);
    }
}

function insertLoc($data) {
    global $conn;
    $suburb = mysqli_real_escape_string($conn, $data[2]);
    $postcode = mysqli_real_escape_string($conn, $data[3]);
    $sql = "INSERT INTO `c_suburb`(`suburb`, `postcode`)
    VALUES('$suburb', $postcode";

    if(mysqli_query($conn, $sql)){
        echo "Records added successfully.";
        getLocID($data);
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}

function getPosType($data) {
    global $conn;

    $pos = mysqli_real_escape_string($conn, $data[15]);
    $sql = "SELECT `position-type-id` FROM `c_position_type` WHERE `position-type` LIKE '$pos' ORDER BY `position-type-id` LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            return $row["position-type-id"];
        }
    } else {
        echo "Location $pos not found...";
    }
}

function getCrashType($data) {
    global $conn;

    $type = mysqli_real_escape_string($conn, $data[23]);
    $sql = "SELECT `crash-type-id` FROM `c_crash_type` WHERE `crash-type` LIKE '$type' ORDER BY `crash-type-id` LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            return $row["crash-type-id"];
        }
    } else {
        echo "Location $type not found...";
    }
}
