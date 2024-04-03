<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $tds = $_POST['tds'];
    $ph = $_POST['ph'];
    $ambient_temp = $_POST['ambient_temp'];
    $water_temp = $_POST['water_temp'];
    $water_level = $_POST['water_level'];
    $water_flow = $_POST['water_flow'];

    try {
        $dbh = new PDO('pgsql:host = c7gljno857ucsl.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com; dbname = d8c0voh40hjuh5; user = u9qeclegl0p99t; password = p3aa566ad83c0cfa1a30735a70361d29d3febfe85f8cd35a24f6253ebeb15cd7f;');
        $stmt = $dbh->prepare("INSERT INTO nursery1 (date, time, tds, ph, ambient_temp, water_temp) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$date, $time, $tds, $ph, $ambient_temp, $water_temp]);
        // Optionally, you can perform further actions or send a response back to the ESP32 device
        echo "Data received and stored successfully.";
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // Handle invalid requests
    echo "Invalid request method.";
}
?>
