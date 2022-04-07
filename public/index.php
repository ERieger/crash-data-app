<html>

<head>
    <title>Crash Data Web Interface</title>
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
                    <input type="date" name="date" id="cDate">
                    <input type="time" name="time" id="cTime">
                    <select name="Location" id="">

                    </select>
                    <input type="number" name="Accloc_X" id="">
                    <input type="number" name="Accloc_Y" id="">
                    <input type="number" name="TotalCasualties" id="">
                    <input type="number" name="TotalFatalities" id="">
                    <input type="number" name="TotalSI" id="">
                    <input type="number" name="TotalMI" id="">
                    <input type="number" name="AreaSpeed" id="">
                    <select name="PositionType" id="">

                    </select>
                    <select name="CrashType" id="">

                    </select>
                    <input type="checkbox" name="DUIInvolved" id="">
                    <input type="checkbox" name="DrugsInvolved" id="">
                    <button type="submit">Submit</button>
                </form>
            </div>
            <div class="output body-container">
                <h2>Output Table</h2>
            </div>
        </div>
    </div>
    <?php
    include('connect.php');
    ?>
</body>

</html>