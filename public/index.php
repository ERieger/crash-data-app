<?php
    include('connect.php');
?>

<html>

<head>
    <title>Crash Data Web Interface</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel=stylesheet href="index.css">
</head>

<body>
    <div class="page">
        <div class="nav">
            <h1>Road Crash Data Entry</h1>
            <form action="" method="POST">
                <input type="file" name="Upload CSV" id="csvUp">
            </form>
        </div>
        <div class="body">
            <div class="entry body-container">
                <h2>Data Entry</h2>
                <form action="crash_process.php" method="POST">
                    <input type="date" name="date" id="date">
                    <input type="time" name="time" id="time">
                    <select name="location" id="location">

                    </select>
                    <input type="number" name="accloc_x" id="accloc_x" min="0" placeholder="Accloc_X">
                    <input type="number" name="accloc_y" id="accloc_y" min="0" placeholder="Accloc_Y">
                    <input type="number" name="totalCas" id="totalCas" min="0" placeholder="Total Casualties">
                    <input type="number" name="totalFat" id="totalFat" min="0" placeholder="Total Fatalities">
                    <input type="number" name="totalSI" id="totalSI" min="0" placeholder="Total SI">
                    <input type="number" name="totalMI" id="totalMI" min="0" placeholder="Total MI">
                    <input type="number" name="areaSpeed" id="areaSpeed" min="0" max="150" placeholder="Area Speed">

                    <select name="posType" id="posType">
                    <?php 
                    $sql = "SELECT * FROM `c_position_type`  ORDER BY `position-type-id`"; 
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("<option value=\"".$row["position-type-id"]."\">".$row["position-type"]."</option>");
                        } 
                    } else {
                        echo("no records");
                    }
                    ?>
                    </select>

                    <select name="crashType" id="crashType">
                    <?php 
                    $sql = "SELECT * FROM `c_crash_type`  ORDER BY `crash-type-id`"; 
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("<option value=\"".$row["crash-type-id"]."\">".$row["crash-type"]."</option>");
                        } 
                    } else {
                        echo("no records");
                    }
                    ?>
                    </select>
                    <span class="check check-label"><p>DUI Involved</p><input type="checkbox" name="DUIInvolved" id="DUIInvolved"></span>
                    <span class="check check-label"><p>Drugs Involved</p><input type="checkbox" name="drugsInvolved" id="drugsInvolved"></span>
                
                    <button type="submit">Submit</button>
                </form>
            </div>
            <div class="output body-container">
                <h2>Output Table</h2>
            </div>
        </div>
    </div>
</body>

</html>