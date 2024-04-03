<!DOCTYPE html>
<html lang="en">

<head>
    <title> Charts | Oasis Nursery Database </title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
<div class = "leftnav">
    <button id = "nursery1" type = "button" onclick = "location.href='chart.php?action=nursery1'"> Nursery 1 </button>
    <button id = "nursery2" type = "button" onclick = "location.href='chart.php?action=nursery2'"> Nursery 2 </button>
    <button id = "nursery3" type = "button" onclick = "location.href='chart.php?action=nursery3'"> Nursery 3 </button>
</div>

<div class = "dataspan">
    <button id = "daily" type = "button" onclick = "location.href='chart.php?span=daily'"> Daily</button>
    <button id = "weekly" type = "button" onclick = "location.href='chart.php?span=weekly'"> Weekly</button>
    <button id = "monthly" type = "button" onclick = "location.href='chart.php?span=monthly'"> Monthly</button>
    <button id = "yearly" type = "button" onclick = "location.href='chart.php?span=yearly'"> Yearly</button>
</div>

<div class = "datasource">
    <button id = "TDS" type ="button" onclick = "location.href='chart.php?dataset=tds'"> TDS </button>
    <button id = "pH" type ="button" onclick = "location.href='chart.php?dataset=ph'"> pH </button>
    <button id = "Ambient Temperature" type ="button" onclick = "location.href='chart.php?dataset=amb_temp'"> Ambient Temperature </button>
    <button id = "Water Temperature" type ="button" onclick = "location.href='chart.php?dataset=water_temp'"> Water Temperature </button>
    <button id = "All" type="button" onclick = "location.href='chart.php?dataset=all'"> All </button>
</div>

<div>
    <canvas id="tds"></canvas>
    <canvas id="ph"></canvas>
</div>

<?php
$action = isset($_GET['action']) ? $_GET['action'] : '';
$span = isset($_GET['span']) ? $_GET['span'] : '';
$dataset = isset($_GET['dataset']) ? $_GET['dataset'] :'';

switch ($action) {
    case 'nursery1':
        $nursery = 'nursery1';
        break;
    case 'nursery2':
        $nursery = 'nursery2';
        break;
    case 'nursery3':
        $nursery = 'MOCK_DATA';
        break;
    default:
        $nursery = 'nursery1';
        break;
}

switch ($dataset) {
    case 'tds':
        $dataset = 'tds';
        break;
    case 'pH':
        $dataset = 'ph';
        break;
    case 'amb_temp':
        $dataset = 'ambient_temp';
        break;
    case 'water_temp':
        $dataset = 'water_temp';
        break;
    default:
        $dataset = 'all';
        break;
}

switch ($span) {
    case 'daily':
        if ( $nursery = 'nursery1') {
            if ($dataset == 'tds') {
                $term = "SELECT $dataset FROM nursery1 WHERE date = CURRENT_DATE";
            }
            if ($dataset == 'ph') {
                $term = "SELECT $dataset FROM nurser1 WHERE date = CURRENT_DATE";
            }
            if ($dataset == 'ambient_temp') {
                $term = "SELECT $dataset FROM nursery1 WHERE date = CURRENT_DATE";
            }
            if ($dataset == 'water_temp') {
                $term = "SELECT $dataset FROM nursery1 WHERE date = CURRENT_DATE";
            }
            if ($dataset == 'all') {
                $term = "SELECT * FROM nursery1 WHERE date = CURRENT_DATE";
            }
        } else if ( $nursery = 'nursery2' ) {
            if ($dataset == 'tds') {
                $term = "SELECT $dataset FROM nursery2 WHERE date = CURRENT_DATE";
            }
            if ($dataset == 'ph') {
                $term = "SELECT $dataset FROM nursery2 WHERE date = CURRENT_DATE";
            }
            if ($dataset == 'ambient_temp') {
                $term = "SELECT $dataset FROM nursery2 WHERE date = CURRENT_DATE";
            }
            if ($dataset == 'water_temp') {
                $term = "SELECT $dataset FROM nursery2 WHERE date = CURRENT_DATE";
            }
            if ($dataset == 'all') {
                $term = "SELECT * FROM nursery2 WHERE date = CURRENT_DATE";
            }
        } else if ( $nursery = 'mock_data' ) {
            if ($dataset == 'tds') {
                $term = "SELECT $dataset FROM mock_data WHERE date = CURRENT_DATE";
            }
            if ($dataset == 'ph') {
                $term = "SELECT $dataset FROM mock_data WHERE date = CURRENT_DATE";
            }
            if ($dataset == 'ambient_temp') {
                $term = "SELECT $dataset FROM mock_data WHERE date = CURRENT_DATE";
            }
            if ($dataset == 'water_temp') {
                $term = "SELECT $dataset FROM mock_data WHERE date = CURRENT_DATE";
            }
            if ($dataset == 'all') {
                $term = "SELECT * FROM mock_data WHERE date = CURRENT_DATE";
            }
        }

        break;
    case 'weekly':
        if ($dataset == 'tds') {
            $term = "SELECT $dataset FROM $nursery WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE";
        }
        if ($dataset == 'ph') {
            $term = "SELECT $dataset FROM $nursery WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE";
        }
        if ($dataset == 'ambient_temp') {
            $term = "SELECT $dataset FROM $nursery WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE";
        }
        if ($dataset == 'water_temp') {
            $term = "SELECT $dataset FROM $nursery WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE";
        }
        if ($dataset == 'all') {
            $term = "SELECT $dataset FROM $nursery WHERE date BETWEEN CURRENT_DATE - INTERVAL '7 days' AND CURRENT_DATE";
        }
        break;
    case 'monthly':
        $term = "SELECT date_trunc('month', date)::date AS month, AVG(tds) AS tds, AVG(ph) as pH, AVG(ambient_temp) as ambient_temp, AVG(water_temp) as water_temp FROM $nursery WHERE date >= CURRENT_DATE - INTERVAL '12 months' GROUP BY month ORDER BY month";
        break;
    case 'yearly':
        $term = "SELECT date_trunc('year', date)::date AS year, AVG(tds) AS tds, AVG(ph) as pH, AVG(ambient_temp) as ambient_temp, AVG(water_temp) as water_temp FROM $nursery WHERE date >= CURRENT_DATE - INTERVAL '5 years' GROUP BY year ORDER BY year";
        break;
    default:
        $term = "SELECT * FROM $nursery WHERE date = CURRENT_DATE";
        break;
}

try {

    $dbh = new PDO('pgsql:host=localhost;dbname=OND;');

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dbh->prepare("SELECT $term FROM $nursery GROUP BY $span");
    $stmt = $dbh->prepare($term);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<script>
    const ctx = document.getElementById('tds');
    // Use the PHP-generated chartData variable
    var data = <?php echo json_encode($data); ?>;

    // Extracting data for the chart
    const labels = data.map(item => item.date + ' : ' + item.time);
    const tdsValues = data.map(item => parseFloat(item.tds));
    const pHvalues = data.map(item => parseFloat(item.ph));
    const ambient_tempValues = data.map(item => parseFloat(item.ambient_temp));
    const water_tempValues = data.map(item => parseFloat(item.water_temp));
    const water_levelBool = data.map(item => item.water_level === 'true' ? 1 : 0);
    const water_flowBool = data.map(item => item.water_flow === 'true' ? 1 : 0);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'TDS Values',
                data: tdsValues,
                backgroundColor: 'rgba(255, 0, 0, 0.2)',
                borderColor: 'rgba(255, 0, 0, 1)',
                borderWidth: 1
            },
                {
                    label: 'pH Values',
                    data: pHvalues,
                    backgroundColor: 'rgba(0, 255, 0, 0.2)',
                    borderColor: 'rgba(0, 255, 0, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Ambient Temp Values',
                    data: ambient_tempValues,
                    backgroundColor: 'rgba(0, 0, 255, 0.2)',
                    borderColor: 'rgba(0, 0, 255, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Water Temp Values',
                    data: water_tempValues,
                    backgroundColor: 'rgba(100, 100, 100, 0.2)',
                    borderColor: 'rgba(100, 100, 100, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>

</body>

</html>

