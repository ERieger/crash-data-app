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
                    <input type="number" name="accloc_x" id="accloc_x">
                    <input type="number" name="accloc_y" id="accloc_y">
                    <input type="number" name="totalCas" id="totalCas">
                    <input type="number" name="totalFat" id="totalFat">
                    <input type="number" name="totalSI" id="totalSI">
                    <input type="number" name="totalMI" id="totalMI">
                    <input type="number" name="areaSpeed" id="areaSpeed">
                    <select name="posType" id="posType">

                    </select>
                    <select name="crashType" id="crashType">

                    </select>
                    <span><p>DUI Involved</p><input type="checkbox" name="DUIInvolved" id="DUIInvolved"></span>
                    <span><p>Drugs Involved</p><input type="checkbox" name="drugsInvolved" id="drugsInvolved"></span>
                
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