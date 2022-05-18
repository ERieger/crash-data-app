<?php
include('connect.php');
?>

<html>

<head>
    <title>Crash Data Web Interface</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel=stylesheet href="actionfw.css">
    <link rel=stylesheet href="index.css">
</head>

<body>
    <div class="page">
        <div class="nav">
            <h1>Road Crash Data Entry</h1>
            <form action="upload_data.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file" />
                <input type="submit" name="submit" value="Import" class="btn btn-light-outline btn-rounded"/>
            </form>
        </div>
        <div class="body">
            <div class="entry body-container">
                <h2>Data Entry</h2>
                <form action="crash_process.php" method="POST">
                    <select name="day" id="day" required>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                    <select name="month" id="month" required>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                    <input type="number" name="year" id="year" placeholder="year - YYYY" required>

                    <input type="time" name="time" id="time" required>
                    <select name="location" id="location" required>
                        <?php
                        $sql = "SELECT * FROM `c_suburb`  ORDER BY `location_id`";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo ("<option value=\"" . $row["location_id"] . "\">" . $row["suburb"] . "</option>");
                            }
                        } else {
                            echo ("no records");
                        }
                        ?>
                    </select>
                    <input type="number" name="accloc_x" id="accloc_x" min="0" placeholder="Accloc_X" required>
                    <input type="number" name="accloc_y" id="accloc_y" min="0" placeholder="Accloc_Y" required>
                    <input type="number" name="totalCas" id="totalCas" min="0" placeholder="Total Casualties" required>
                    <input type="number" name="totalFat" id="totalFat" min="0" placeholder="Total Fatalities" required>
                    <input type="number" name="totalSI" id="totalSI" min="0" placeholder="Total SI" required>
                    <input type="number" name="totalMI" id="totalMI" min="0" placeholder="Total MI" required>
                    <input type="number" name="areaSpeed" id="areaSpeed" min="0" max="150" placeholder="Area Speed" required>

                    <select name="posType" id="posType" required>
                        <?php
                        $sql = "SELECT * FROM `c_position_type`  ORDER BY `position_type_id`";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo ("<option value=\"" . $row["position_type_id"] . "\">" . $row["position_type"] . "</option>");
                            }
                        } else {
                            echo ("no records");
                        }
                        ?>
                    </select>

                    <select name="crashType" id="crashType" required>
                        <?php
                        $sql = "SELECT * FROM `c_crash_type`  ORDER BY `crash_type_id`";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo ("<option value=\"" . $row["crash_type_id"] . "\">" . $row["crash_type"] . "</option>");
                            }
                        } else {
                            echo ("no records");
                        }
                        ?>
                    </select>
                    <span class="check check-label">
                        <p>DUI Involved</p><input type="checkbox" name="DUIInvolved" id="DUIInvolved" value="true">
                    </span>
                    <span class="check check-label">
                        <p>Drugs Involved</p><input type="checkbox" name="drugsInvolved" id="drugsInvolved" value="true">
                    </span>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="output body-container">
                <h2>Output Table</h2>
                <table class="table table-zebra table-hover table-responsive-lg table-sm" >
                    <thead>
                        <tr>
                            <th>Crash ID</th>
                            <th>Day</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Time</th>
                            <th>Suburb</th>
                            <th>Accloc_X</th>
                            <th>Accloc_y</th>
                            <th>Casualties</th>
                            <th>Fatalities</th>
                            <th>Serious Injury</th>
                            <th>Mild Injury</th>
                            <th>Area Speed</th>
                            <th>Position Type</th>
                            <th>Crash Type</th>
                            <th>DUI Involved</th>
                            <th>Drugs Involved</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $SQL = "SELECT c_crash_data.crashid, c_crash_data.day, c_crash_data.month, c_crash_data.year, c_crash_data.time, c_suburb.suburb, c_crash_data.acclocx, c_crash_data.acclocy, c_crash_data.total_cas, c_crash_data.total_fats, c_crash_data.total_si, c_crash_data.total_mi,c_crash_data.area_speed, c_position_type.position_type, c_crash_type.crash_type, c_crash_data.dui, c_crash_data.drugs
                        FROM c_crash_data
                        INNER JOIN c_suburb ON c_crash_data.locid = c_suburb.location_id
                        INNER JOIN c_position_type ON c_crash_data.pos_type = c_position_type.position_type_id
                        INNER JOIN c_crash_type ON c_crash_data.crash_type = c_crash_type.crash_type_id
                        ORDER BY c_crash_data.crashid ASC";
                        $result = mysqli_query($conn, $SQL);

                        $fields = ["crashid", "day", "month", "year", "time", "suburb", "acclocx", "acclocy", "total_cas", "total_fats", "total_si",    "total_mi",    "area_speed", "position_type", "crash_type", "dui", "drugs"];
                        //loop through the result variable and print out its contents if a result was returned
                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                foreach ($fields as $field) {
                                    if ($field == "dui" || $field == "drugs") {
                                        switch ($row[$field]) {
                                            case 0:
                                                echo "<td>no</td>";
                                                break;

                                            case 1:
                                                echo "<td>yes</td>";
                                                break;
                                        }
                                    } else if ($field == "time") {
                                        echo "<td>" . date('g:ia', strtotime($row[$field])) . "</td>";
                                    } else {
                                        echo "<td>" . $row[$field] . "</td>";
                                    }
                                }
                                echo "</tr>";
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<?php
mysqli_close($conn);
?>