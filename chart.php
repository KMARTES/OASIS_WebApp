<?php
session_start();

if (isset($_GET['home']) && $_GET['home'] === 'true') {
    header('location:main.php');
    exit; // Make sure to exit after redirection
}
?>

<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    <link rel = "stylesheet" typev = "text/css" href = "chart.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="chart.js"></script>
    <title> Charts | Oasis Nursery Database </title>
</head>

<body>
<div class = "back">
    <button id = "previous_page" type = "button" onclick = "location.href = 'chart.php?home=true'"> Return Home</button>
</div>

<header>
    <img src = "Sources/Oasis_Logo.png" height = 200 width = 400 alt="company logo">
</header>

<div class = "leftnav">
    <button id = "nursery1" type = "button" onclick = "location.href='chart.php?action=nursery1&<?php echo isset($_GET['span']) ? 'span='.$_GET['span'] : '' ?>'"> Nursery 1 </button>
    <button id = "nursery2" type = "button" onclick = "location.href='chart.php?action=nursery2&<?php echo isset($_GET['span']) ? 'span='.$_GET['span'] : '' ?>'"> Nursery 2 </button>
    <button id = "nursery3" type = "button" onclick = "location.href='chart.php?action=nursery3&<?php echo isset($_GET['span']) ? 'span='.$_GET['span'] : '' ?>'"> Nursery 3 </button>
    <button id = "All" type = "button" onclick = "location.href='chart.php?action=all&<?php echo isset($_GET['span']) ? 'span='.$_GET['span'] : ''?>'"> All </button>
</div>

<div class = "dataspan">
    <button id = "daily" type = "button" onclick = "location.href='chart.php?action=<?php echo isset($_GET['action']) ? $_GET['action'].'&' : '' ?>span=daily'"> Daily</button>
    <button id = "weekly" type = "button" onclick = "location.href='chart.php?action=<?php echo isset($_GET['action']) ? $_GET['action'].'&' : '' ?>span=weekly'"> Weekly</button>
    <button id = "monthly" type = "button" onclick = "location.href='chart.php?action=<?php echo isset($_GET['action']) ? $_GET['action'].'&' : '' ?>span=monthly'"> Monthly</button>
    <button id = "yearly" type = "button" onclick = "location.href='chart.php?action=<?php echo isset($_GET['action']) ? $_GET['action'].'&' : '' ?>span=yearly'"> Yearly</button>
</div>

<div class = "datasource">
    <button id="TDS" type="button" onclick="location.href='chart.php?action=<?php echo isset($_GET['action']) ? $_GET['action'].'&' : ''; echo isset($_GET['span']) ? 'span='.$_GET['span'].'&' : ''; ?>dataset=tds'">TDS</button>
    <button id = "pH" type ="button" onclick = "location.href='chart.php?action=<?php echo isset($_GET['action']) ? $_GET['action'].'&' : ''; echo isset($_GET['span']) ? 'span='.$_GET['span'].'&' : ''; ?>dataset=ph'"> pH </button>
    <button id = "Ambient Temperature" type ="button" onclick = "location.href='chart.php?action=<?php echo isset($_GET['action']) ? $_GET['action'].'&' : ''; echo isset($_GET['span']) ? 'span='.$_GET['span'].'&' : ''; ?>dataset=amb_temp'"> Ambient Temperature </button>
    <button id = "Water Temperature" type ="button" onclick = "location.href='chart.php?action=<?php echo isset($_GET['action']) ? $_GET['action'].'&' : ''; echo isset($_GET['span']) ? 'span='.$_GET['span'].'&' : ''; ?>dataset=water_temp'"> Water Temperature </button>
    <button id = "All" type="button" onclick = "location.href='chart.php?action=<?php echo isset($_GET['action']) ? $_GET['action'].'&' : ''; echo isset($_GET['span']) ? 'span='.$_GET['span'].'&' : ''; ?>dataset=all'"> All </button>
</div>

<div class = "container">
    <div class = "containerBody">
        <canvas id = "tds"></canvas>
        <canvas id = "ph"></canvas>
        <canvas id = "ambtemp"></canvas>
        <canvas id = "wattemp"></canvas>
        <canvas id = "alltds"></canvas>
        <canvas id = "allph"></canvas>
        <canvas id = "allambtemp"></canvas>
        <canvas id = "allwattemp"></canvas>
        <canvas id = "alltable"></canvas>
    </div>
</div>

<?php

$_SESSION['action'] = isset($_GET['action']) ? $_GET['action'] : '';
$_SESSION['span'] = isset($_GET['span']) ? $_GET['span'] : '';
$_SESSION['dataset'] = isset($_GET['dataset']) ? $_GET['dataset'] :'';
$_SESSION['term'] = isset($_GET['term']) ? $_GET['term'] : '';
$_SESSION['term1'] = isset($_GET['term1']) ? $_GET['term1'] : '';
$_SESSION['term2'] = isset($_GET['term2']) ? $_GET['term2'] : '';
$_SESSION['term3'] = isset($_GET['term3']) ? $_GET['term3'] : '';

echo "Action: ".$_SESSION['action']."<br>";
echo "Span: ".$_SESSION['span']."<br>";
echo "Dataset: ".$_SESSION['dataset']."<br>";

switch ($_SESSION['action']) {
    case 'nursery1':
        $_SESSION['nursery'] = 'nursery1';
        break;
    case 'nursery2':
        $_SESSION['nursery'] = 'nursery2';
        break;
    case 'nursery3':
        $_SESSION['nursery'] = 'MOCK_DATA';
        break;
    default:
        $_SESSION['nursery'] = 'all';
        break;
}

switch ($_SESSION['dataset']) {
    case 'tds':
        $_SESSION['dataset'] = 'tds';
        break;
    case 'ph':
        $_SESSION['dataset'] = 'ph';
        break;
    case 'amb_temp':
        $_SESSION['dataset'] = 'ambient_temp';
        break;
    case 'water_temp':
        $_SESSION['dataset'] = 'water_temp';
        break;
    default:
        $_SESSION['dataset'] = 'all';
        break;
}

switch ($_SESSION['span']) {
    case 'daily':
        if ( $_SESSION['nursery'] == 'nursery1') {
            if ($_SESSION['dataset'] == 'tds') {
                $_SESSION['term'] = "SELECT date, time, tds FROM nursery1 WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'ph') {
                $_SESSION['term'] = "SELECT date, time, ph FROM nursery1 WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'ambient_temp') {
                $_SESSION['term'] = "SELECT date, time, ambient_temp FROM nursery1 WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'water_temp') {
                $_SESSION['term'] = "SELECT date, time, water_temp FROM nursery1 WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'all') {
                $_SESSION['term'] = "SELECT * FROM nursery1 WHERE date = CURRENT_DATE";
            }
        } else if ( $_SESSION['nursery'] == 'nursery2' ) {
            if ($_SESSION['dataset'] == 'tds') {
                $_SESSION['term'] = "SELECT tds FROM nursery2 WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'ph') {
                $_SESSION['term'] = "SELECT ph FROM nursery2 WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'ambient_temp') {
                $_SESSION['term'] = "SELECT ambient_temp FROM nursery2 WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'water_temp') {
                $_SESSION['term'] = "SELECT water_temp FROM nursery2 WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'all') {
                $_SESSION['term'] = "SELECT * FROM nursery2 WHERE date = CURRENT_DATE";
            }
        } else if ( $_SESSION['nursery'] == 'MOCK_DATA' ) {
            if ($_SESSION['dataset'] == 'tds') {
                $_SESSION['term'] = "SELECT date, time, tds FROM MOCK_DATA WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'ph') {
                $_SESSION['term'] = "SELECT date, time, ph FROM MOCK_DATA WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'ambient_temp') {
                $_SESSION['term'] = "SELECT date, time, ambient_temp FROM MOCK_DATA WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'water_temp') {
                $_SESSION['term'] = "SELECT date, time, water_temp FROM MOCK_DATA WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'all') {
                $_SESSION['term'] = "SELECT * FROM mock_data WHERE date = CURRENT_DATE";
            }
        } else if ( $_SESSION['nursery'] == 'all' ) {
            if ($_SESSION['dataset'] == 'tds') {
                $_SESSION['term1'] = "SELECT date, time, tds FROM nursery1 WHERE date = CURRENT_DATE";
                $_SESSION['term2'] = "SELECT date, time, tds FROM nursery2 WHERE date = CURRENT_DATE";
                $_SESSION['term3'] = "SELECT date, time, tds FROM mock_data WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'ph') {
                $_SESSION['term1'] = "SELECT date, time, ph FROM nursery1 WHERE date = CURRENT_DATE";
                $_SESSION['term2'] = "SELECT date, time, ph FROM nursery2 WHERE date = CURRENT_DATE";
                $_SESSION['term3'] = "SELECT date, time, ph FROM mock_data WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'ambient_temp') {
                $_SESSION['term1'] = "SELECT date, time, ambient_temp FROM nursery1 WHERE date = CURRENT_DATE";
                $_SESSION['term2'] = "SELECT date, time, ambient_temp FROM nursery2 WHERE date = CURRENT_DATE";
                $_SESSION['term3'] = "SELECT date, time, ambient_temp FROM mock_data WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'water_temp') {
                $_SESSION['term1'] = "SELECT date, time, water_temp FROM nursery1 WHERE date = CURRENT_DATE";
                $_SESSION['term2'] = "SELECT date, time, water_temp FROM nursery2 WHERE date = CURRENT_DATE";
                $_SESSION['term3'] = "SELECT date, time, water_temp FROM mock_data WHERE date = CURRENT_DATE";
            }
            if ($_SESSION['dataset'] == 'all') {
                $_SESSION['term1'] = "SELECT * FROM nursery1 WHERE date = CURRENT_DATE";
                $_SESSION['term2'] = "SELECT * FROM nursery2 WHERE date = CURRENT_DATE";
                $_SESSION['term3'] = "SELECT * FROM mock_data WHERE date = CURRENT_DATE";
            }
        }

        break;
    case 'weekly':
        if ($_SESSION['nursery'] != 'all') {
            if ($_SESSION['dataset'] == 'tds') {
                $_SESSION['term'] = "SELECT date, time, AVG(tds) as tds FROM {$_SESSION['nursery']} WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time ORDER BY date, time";
            }
            if ($_SESSION['dataset'] == 'ph') {
                $_SESSION['term'] = "SELECT date, time, ph FROM {$_SESSION['nursery']} WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, ph ORDER BY date, time";
            }
            if ($_SESSION['dataset'] == 'ambient_temp') {
                $_SESSION['term'] = "SELECT date, time, ambient_temp FROM {$_SESSION['nursery']} WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, ambient_temp ORDER BY date, time";
            }
            if ($_SESSION['dataset'] == 'water_temp') {
                $_SESSION['term'] = "SELECT date, time, water_temp FROM {$_SESSION['nursery']} WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, water_temp ORDER BY date, time";
            }
            if ($_SESSION['dataset'] == 'all') {
                $_SESSION['term'] = "SELECT date, time, tds, ph, ambient_temp, water_temp FROM {$_SESSION['nursery']} WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, tds, ph, ambient_temp, water_temp ORDER BY date, time";
            }
        } else {
            if ($_SESSION['dataset'] == 'tds') {
                $_SESSION['term1'] = "SELECT date, time, tds FROM nursery1 WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, tds ORDER BY date, time";
                $_SESSION['term2'] = "SELECT date, time, tds FROM nursery2 WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, tds ORDER BY date, time";
                $_SESSION['term3'] = "SELECT date, time, tds FROM mock_data WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, tds ORDER BY date, time";
            }
            if ($_SESSION['dataset'] == 'ph') {
                $_SESSION['term1'] = "SELECT date, time, ph FROM nursery1 WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, ph ORDER BY date, time";
                $_SESSION['term2'] = "SELECT date, time, ph FROM nursery2 WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, ph ORDER BY date, time";
                $_SESSION['term3'] = "SELECT date, time, ph FROM mock_data WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, ph ORDER BY date, time";
            }
            if ($_SESSION['dataset'] == 'ambient_temp') {
                $_SESSION['term1'] = "SELECT date, time, ambient_temp FROM nursery1 WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, ambient_temp ORDER BY date, time";
                $_SESSION['term2'] = "SELECT date, time, ambient_temp FROM nursery2 WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, ambient_temp ORDER BY date, time";
                $_SESSION['term3'] = "SELECT date, time, ambient_temp FROM mock_data WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, ambient_temp ORDER BY date, time";
            }
            if ($_SESSION['dataset'] == 'water_temp') {
                $_SESSION['term1'] = "SELECT date, time, water_temp FROM nursery1 WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, water_temp ORDER BY date, time";
                $_SESSION['term2'] = "SELECT date, time, water_temp FROM nursery2 WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, water_temp ORDER BY date, time";
                $_SESSION['term3'] = "SELECT date, time, water_temp FROM mock_data WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, water_temp ORDER BY date, time";
            }
            if ($_SESSION['dataset'] == 'all') {
                $_SESSION['term1'] = "SELECT date, time, tds, ph, ambient_temp, water_temp FROM nursery1 WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, tds, ph, ambient_temp, water_temp ORDER BY date, time";
                $_SESSION['term2'] = "SELECT date, time, tds, ph, ambient_temp, water_temp FROM nursery2 WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, tds, ph, ambient_temp, water_temp ORDER BY date, time";
                $_SESSION['term3'] = "SELECT date, time, tds, ph, ambient_temp, water_temp FROM mock_data WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE GROUP BY date, time, tds, ph, ambient_temp, water_temp ORDER BY date, time";
            }
        }
        break;
    case 'monthly':
        if ($_SESSION['nursery'] != 'all') {
            if ($_SESSION['dataset'] == 'tds') {
                $_SESSION['term'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(tds) as tds FROM {$_SESSION['nursery']} WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
            }
            if ($_SESSION['dataset'] == 'ph') {
                $_SESSION['term'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(ph) as ph FROM {$_SESSION['nursery']} WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
            }
            if ($_SESSION['dataset'] == 'ambient_temp') {
                $_SESSION['term'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(ambient_temp) as ambient_temp FROM {$_SESSION['nursery']} WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
            }
            if ($_SESSION['dataset'] == 'water_temp') {
                $_SESSION['term'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(water_temp) as water_temp FROM {$_SESSION['nursery']} WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
            }
            if ($_SESSION['dataset'] == 'all') {
                $_SESSION['term'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(tds) AS tds, AVG(ph) as pH, AVG(ambient_temp) as ambient_temp, AVG(water_temp) as water_temp FROM {$_SESSION['nursery']} WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
            }
        } else {
            if ($_SESSION['dataset'] == 'tds') {
                $_SESSION['term1'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(tds) AS tds FROM nursery1 WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
                $_SESSION['term2'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(tds) AS tds FROM nursery2 WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
                $_SESSION['term3'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(tds) AS tds FROM mock_data WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
            }
            if ($_SESSION['dataset'] == 'ph') {
                $_SESSION['term1'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(ph) AS ph FROM nursery1 WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
                $_SESSION['term2'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(ph) AS ph FROM nursery2 WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
                $_SESSION['term3'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(ph) AS ph FROM mock_data WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
            }
            if ($_SESSION['dataset'] == 'ambient_temp') {
                $_SESSION['term1'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(ambient_temp) AS ambient_temp FROM nursery1 WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
                $_SESSION['term2'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(ambient_temp) AS ambient_temp FROM nursery2 WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
                $_SESSION['term3'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(ambient_temp) AS ambient_temp FROM mock_data WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
            }
            if ($_SESSION['dataset'] == 'water_temp') {
                $_SESSION['term1'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(water_temp) AS water_temp FROM nursery1 WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
                $_SESSION['term2'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(water_temp) AS water_temp FROM nursery2 WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
                $_SESSION['term3'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(water_temp) AS water_temp FROM mock_data WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
            }
            if ($_SESSION['dataset'] == 'all') {
                $_SESSION['term1'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(tds) AS tds, AVG(ph) AS ph, AVG(ambient_temp) AS ambient_temp, AVG(water_temp) AS water_temp FROM nursery1 WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
                $_SESSION['term2'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(tds) AS tds, AVG(ph) AS ph, AVG(ambient_temp) AS ambient_temp, AVG(water_temp) AS water_temp FROM nursery2 WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
                $_SESSION['term3'] = "SELECT date, time, date_trunc('month', date)::date AS month, AVG(tds) AS tds, AVG(ph) AS ph, AVG(ambient_temp) AS ambient_temp, AVG(water_temp) AS water_temp FROM mock_data WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY date, time, month ORDER BY month";
            }
        }
        break;
    case 'yearly':
        if ($_SESSION['nursery'] != 'all') {
            if ($_SESSION['dataset'] == 'tds') {
                $_SESSION['term'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(tds) AS tds FROM {$_SESSION['nursery']} WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
            }
            if ($_SESSION['dataset'] == 'ph') {
                $_SESSION['term'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(ph) AS ph FROM {$_SESSION['nursery']} WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
            }
            if ($_SESSION['dataset'] == 'ambient_temp') {
                $_SESSION['term'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(ambient_temp) AS ambient_temp FROM {$_SESSION['nursery']} WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
            }
            if ($_SESSION['dataset'] == 'water_temp') {
                $_SESSION['term'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(water_temp) AS water_temp FROM {$_SESSION['nursery']} WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
            }
            if ($_SESSION['dataset'] == 'all') {
                $_SESSION['term'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(tds) AS tds, AVG(ph) as pH, AVG(ambient_temp) as ambient_temp, AVG(water_temp) as water_temp FROM {$_SESSION['nursery']} WHERE date >= CURRENT_DATE - INTERVAL '5 years' GROUP BY date, time, year ORDER BY year";
            }
        } else {
            if ($_SESSION['dataset'] == 'tds') {
                $_SESSION['term1'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(tds) AS tds FROM nursery1 WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
                $_SESSION['term2'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(tds) AS tds FROM nursery2 WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
                $_SESSION['term3'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(tds) AS tds FROM mock_data WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
            }
            if ($_SESSION['dataset'] == 'ph') {
                $_SESSION['term2'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(ph) AS ph FROM nursery1 WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
                $_SESSION['term3'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(ph) AS ph FROM nursery2 WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
                $_SESSION['term1'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(ph) AS ph FROM mock_data WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
            }
            if ($_SESSION['dataset'] == 'ambient_temp') {
                $_SESSION['term1'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(ambient_temp) AS ambient_temp FROM nursery1 WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
                $_SESSION['term2'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(ambient_temp) AS ambient_temp FROM nursery2 WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
                $_SESSION['term3'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(ambient_temp) AS ambient_temp FROM mock_data WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
            }
            if ($_SESSION['dataset'] == 'water_temp') {
                $_SESSION['term1'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(water_temp) AS water_temp FROM nursery1 WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
                $_SESSION['term2'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(water_temp) AS water_temp FROM nursery2 WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
                $_SESSION['term3'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(water_temp) AS water_temp FROM mock_data WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
            }
            if ($_SESSION['dataset'] == 'all') {
                $_SESSION['term1'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(tds) AS tds, AVG(ph) AS ph, AVG(ambient_temp) AS ambient_temp, AVG(water_temp) AS water_temp FROM nursery1 WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
                $_SESSION['term2'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(tds) AS tds, AVG(ph) AS ph, AVG(ambient_temp) AS ambient_temp, AVG(water_temp) AS water_temp FROM nursery2 WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
                $_SESSION['term3'] = "SELECT date, time, date_trunc('year', date)::date AS year, AVG(tds) AS tds, AVG(ph) AS ph, AVG(ambient_temp) AS ambient_temp, AVG(water_temp) AS water_temp FROM mock_data WHERE date >= CURRENT_DATE - INTERVAL '3 years' GROUP BY date, time, year ORDER BY year";
            }
        }
        break;
    default:
        $_SESSION['term'] = "SELECT * FROM nursery1 WHERE date = CURRENT_DATE";
        break;
}

try {

    $dbh = new PDO('pgsql:host = c7gljno857ucsl.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com; dbname = d8c0voh40hjuh5; user = u9qeclegl0p99t; password = p3aa566ad83c0cfa1a30735a70361d29d3febfe85f8cd35a24f6253ebeb15cd7f;');

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SESSION['action'] != 'all') {
        $stmt = $dbh->prepare($_SESSION['term']);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "Term: " . $_SESSION['term'];
    } else if ($_SESSION['action'] == 'all') {
        $stmt1 = $dbh->prepare($_SESSION['term1']);
        $stmt1->execute();
        $var1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        $stmt2 = $dbh->prepare($_SESSION['term2']);
        $stmt2->execute();
        $var2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $stmt3 = $dbh->prepare($_SESSION['term3']);
        $stmt3->execute();
        $var3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

        $data1 = json_encode($var1);
        $data2 = json_encode($var2);
        $data3 = json_encode($var3);

        echo "Term 1: " . $_SESSION['term1']."<br>";
        echo "Term 2: " . $_SESSION['term2']."<br>";
        echo "Term 3: " . $_SESSION['term3']."<br>";
    }


} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<script>
    <?php if ($_SESSION['action'] != 'all') {
        switch ($_SESSION['dataset']) {
            case 'tds': ?>
                renderTDSChart(<?php echo json_encode($data) ?>);
            <?php break;
            case 'ph': ?>
                renderpHChart(<?php echo json_encode($data) ?>);
            <?php break;
            case 'ambient_temp': ?>
                renderAmbTempChart(<?php echo json_encode($data) ?>);
                <?php break;
            case 'water_temp': ?>
                renderWatTempChart(<?php echo json_encode($data) ?>);
            <?php break;
            case 'all': ?>
                renderAllTable(<?php echo json_encode($data)?>);
            <?php break;
            default:
                break;
        }
    } else {
        switch ($_SESSION['dataset']) {
            case 'tds': ?>
                renderAllTDSChart(<?php echo $data1 ?>, <?php echo $data2?>, <?php echo $data3?>);
            <?php break;
            case 'ph': ?>
                renderAllpHChart(<?php echo $data1 ?>, <?php echo $data2?>, <?php echo $data3?>);
            <?php break;
            case 'ambient_temp': ?>
                renderAllAmbTempChart(<?php echo $data1 ?>, <?php echo $data2?>, <?php echo $data3?>);
            <?php break;
            case 'water_temp': ?>
                renderAllWatTempChart(<?php echo $data1 ?>, <?php echo $data2?>, <?php echo $data3?>);
            <?php break;
            case 'all': ?>
                renderAllTDSChart(<?php echo $data1 ?>, <?php echo $data2?>, <?php echo $data3?>);
                renderAllpHChart(<?php echo $data1 ?>, <?php echo $data2?>, <?php echo $data3?>);
                renderAllAmbTempChart(<?php echo $data1 ?>, <?php echo $data2?>, <?php echo $data3?>);
                renderAllWatTempChart(<?php echo $data1 ?>, <?php echo $data2?>, <?php echo $data3?>);
            <?php break;
            default:
                break;
        }
    } ?>

</script>

</body>

</html>
