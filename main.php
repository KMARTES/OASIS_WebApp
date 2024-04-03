<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] === 'charts') {
    header('location:chart.php');
    exit; // Make sure to exit after redirection
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    <link rel = "stylesheet" typev= "text/css" href="main.css" />
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">  <!-- Eliminates GET favicon.ico NOT FOUND error-->
    <script src = "main.js"> </script> <!--Links JavaScript to file. -->
    <title> Oasis Nursery Database </title>
</head>

<body>
<div class = "logout_btn">
    <button id = "logout" type = "button"> L O G O U T </button>
</div>

<header>
    <img src = "Sources/Oasis_Logo.png" height = 200 width = 400 alt="Company logo">
</header>

<div class = "search_bar">
    <input type = "text" placeholder = "Search...">
</div>

<div class = "leftnav">
    <button id = "nursery1" type = "button" onclick = "location.href='main.php?action=nursery1'"> Nursery 1 </button>
    <button id = "nursery2" type = "button" onclick = "location.href='main.php?action=nursery2'"> Nursery 2 </button>
    <button id = "nursery3" type = "button" onclick = "location.href='main.php?action=nursery3'"> Nursery 3 </button>
</div>

<div class = "charts">
    <button id = "charts" type = "button" onclick = "location.href = 'main.php?action=charts'"> Charts </button>
</div>

<div class = "centernav">
    <button id = "min" type = "button" onclick = "toggleMinimum()"> Min </button>
    <button id = "max" type = "button" onclick = "toggleMaximum()"> Max </button>
    <button id = "average" type = "button" onclick = "toggleAverage()"> Average </button>


    <p id="minimum" style="display: none">Minimum TDS:<br>
        Minimum pH:<br>
        Minimum Ambient Temperature:<br>
        Minimum Water Temperature:</p>

    <p id="maximum" style="display: none">Maximum TDS:<br>
        Maximum pH:<br>
        Maximum Ambient Temperature:<br>
        Maximum Water Temperature:</p>

    <p id="avg" style="display: none">Average TDS:<br>
        Average pH:<br>
        Average Ambient Temperature:<br>
        Average Water Temperature:</p>
</div>

<div class = "rightnav">
    <button id = "day" type = "button"> Day </button>
    <button id = "week" type = "button"> Week </button>
    <button id = "month" type = "button"> Month</button>
    <button id = "year" type = "button"> Year </button>
    <button id = "all" type = "button"> All </button>
</div>

<div class = "table">
    <table>
        <tr>
            <th class = "columns" colspan = "9"><h2>Data Collected </h2></th>
        </tr>

        <tr>
            <th><button id = "date" type = "button" onclick = "location.href='main.php?orderBy=date'"><h3>Date</h3></button></th>
            <th><button id = "time" type = "button" onclick = "location.href='main.php?orderBy=time'"><h3>Time</h3></button></th>
            <th><button id = "tds" type = "button" onclick = "location.href='main.php?orderBy=tds'"><h3>TDS</h3></button></th>
            <th><button id = "pH" type = "button" onclick = "location.href='main.php?orderBy=pH'"><h3>pH</h3></button></th>
            <th><button id = "ambient_temp" type = "button" onclick = "location.href='main.php?orderBy=ambient_temp'"><h3>Ambient Temperature</h3></button></th>
            <th><button id = "water_temp" type = "button" onclick = "location.href='main.php?orderBy=water_temp'"><h3>Water Temperature</h3></button></th>
            <th><button id = "water_level" type = "button"><h3>Water Level</h3></button></th>
            <th><button id = "water_flow" type = "button"><h3>Water Flow</h3></button></th>
        </tr>

        <tbody>
        <?php


        $states = [" ", "ASC", "DESC"];

        if (!isset($_SESSION['dateTog'])) {
            $_SESSION['dateTog'] = $states[0];
        }

        if (!isset($_SESSION['timeTog'])) {
            $_SESSION['timeTog'] = $states[0];
        }

        if (!isset($_SESSION['tdsTog'])) {
            $_SESSION['tdsTog'] = $states[0];
        }

        if (!isset($_SESSION['phTog'])) {
            $_SESSION['phTog'] = $states[0];
        }

        if (!isset($_SESSION['ambientTempTog'])) {
            $_SESSION['ambientTempTog'] = $states[0];
        }

        if (!isset($_SESSION['waterTempTog'])) {
            $_SESSION['waterTempTog'] = $states[0];
        }

        $dbh = new PDO('pgsql:host = c7gljno857ucsl.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com; dbname = d8c0voh40hjuh5; user = u9qeclegl0p99t; password = p3aa566ad83c0cfa1a30735a70361d29d3febfe85f8cd35a24f6253ebeb15cd7f;');

        $_SESSION['action'] = isset($_GET['action']) ? $_GET['action'] : '';

        switch ($_SESSION['action']) {
            case 'nursery1':
                $_SESSION['table'] = 'nursery1';
                break;
            case 'nursery2':
                $_SESSION['table'] = 'nursery2';
                break;
            case 'nursery3':
                $_SESSION['table'] = 'MOCK_DATA';
                break;

            // case 'charts':
            //     header('location:chart.php');
            //     break;

            default:
                //$_SESSION['table'] = 'nursery1'; // Default table
                break;
        }

        $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : '';

        switch($orderBy) {
            case 'date':
                if ($_SESSION['dateTog'] == true ) {
                    $_SESSION['dateTog'] = false;
                } else $_SESSION['dateTog'] = true;

                $dateTogSetter = ($_SESSION['dateTog'] == true) ? "ASC" : "DESC";

                $var = "SELECT * FROM {$_SESSION['table']} ORDER BY date $dateTogSetter";
                break;

            case 'time':
                if ($_SESSION['timeTog'] == true ) {
                    $_SESSION['timeTog'] = false;
                } else $_SESSION['timeTog'] = true;

                $timeTogSetter = ($_SESSION['timeTog'] == true) ? "ASC" : "DESC";

                $var = "SELECT * FROM {$_SESSION['table']} ORDER BY time $timeTogSetter";
                break;

            case 'tds':
                if ($_SESSION['tdsTog'] == true ) {
                    $_SESSION['tdsTog'] = false;
                } else $_SESSION['tdsTog'] = true;

                $tdsTogSetter = ($_SESSION['tdsTog'] == true) ? "ASC" : "DESC";

                $var = "SELECT * FROM {$_SESSION['table']} ORDER BY tds $tdsTogSetter";
                break;

            case 'pH':
                if ($_SESSION['phTog'] == true ) {
                    $_SESSION['phTog'] = false;
                } else $_SESSION['phTog'] = true;

                $phTogSetter = ($_SESSION['phTog'] == true) ? "ASC" : "DESC";

                $var = "SELECT * FROM {$_SESSION['table']} ORDER BY ph $phTogSetter";
                break;

            case 'ambient_temp':
                if ($_SESSION['ambientTempTog'] == true ) {
                    $_SESSION['ambientTempTog'] = false;
                } else $_SESSION['ambientTempTog'] = true;

                $ambientTempTogSetter = ($_SESSION['ambientTempTog'] == true) ? "ASC" : "DESC";

                $var = "SELECT * FROM {$_SESSION['table']} ORDER BY ambient_temp $ambientTempTogSetter";
                break;

            case 'water_temp':
                if ($_SESSION['waterTempTog'] == true ) {
                    $_SESSION['waterTempTog'] = false;
                } else $_SESSION['waterTempTog'] = true;

                $waterTempTogSetter = ($_SESSION['waterTempTog'] == true) ? "ASC" : "DESC";

                $var = "SELECT * FROM {$_SESSION['table']} ORDER BY water_temp $waterTempTogSetter";
                break;

            default:
                $var = "SELECT * FROM {$_SESSION['table']}";
                break;
        }

        $result = $dbh->prepare($var);
        $result->execute();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td class = 'datecol'>{$row['date']}</td>";
            echo "<td class = 'timecol'>{$row['time']}</td>";
            echo "<td class = 'tdscol'>{$row['tds']}</td>";
            echo "<td class = 'phcol'>{$row['ph']}</td>";
            echo "<td class = 'ambtempcol'>{$row['ambient_temp']}</td>";
            echo "<td class = 'watempcol'>{$row['water_temp']}</td>";
            echo "<td class = 'watlevcol'>" . ($row['water_level'] == 1 ? 'OK':'NOT OK') . "</td>";
            echo "<td class = 'watflowcol'>" . ($row['water_flow'] == 1 ? 'OK' : 'NOT OK') . "</td>";
            echo "</tr>";
        }

        $dbh = null;

        ?>
        </tbody>
    </table>
</div>

</body>
</html>
