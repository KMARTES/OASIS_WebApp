<?php
session_start();
$authenticated = false;
$errorMessage = '';

if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 10)) {      // Check if the session timeout has not expired
        session_unset();                                    // Session timed out
        session_destroy();
        $errorMessage = 'Session expired. Please log in again.';
    } else {
        $_SESSION['last_activity'] = time();                // Update the last activity time
        header('location: main.php');                      // Redirect to main page if already authenticated
        exit;
    }
}

if (isset($_POST['login']) && $_POST['login'] == 'L O G I N') {

    $name = $_POST['user'];
    $pass = $_POST['pass'];

    $connect = pg_connect("host = localhost dbname = login_db");

    if ($connect) {
        $query = "SELECT * FROM verify($1::varchar, $2::varchar)";
        $res = pg_query_params($connect, $query, array($name,$pass));

        $result = pg_fetch_object($res);

        if (!$result) {
            echo "Result not ok.";
        } else {
            $authenticated = $result->verify == 1;

            if ($authenticated) {
                $_SESSION['user_id'] = $result->user_id;
                $_SESSION['last_activity'] = time();
            }
        }
    }
    if (!$authenticated) {
        $errorMessage = "Missing or incorrect username/password";
    } else {
        header('location:main.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Login | Oasis Nursery Databse </title>
    <link rel = "stylesheet" typev= "text/css" href="login_page.css" />
</head>

<body>
<header>
    <img src = "Sources/Oasis_Logo.png" height = 400 width = 65% alt="Company logo">
</header>
<h1> Nursery Database </h1>

<?php if (!empty($errorMessage)): ?>
    <p> <?php echo $errorMessage; ?></p>
<?php endif; ?>

<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST" >
    <label for = "user"> Username: </label>
    <input type = "text" name = "user">

    <label for = "pass"> Password: </label>
    <input type = "password" name = "pass">

    <input type = "submit" value = "L O G I N" name = "login" class = "login_btn">
</form>

<footer>
    <button class = "forgot"> Forgot your password? CLICK ME </button>
</footer>
</body>
</html>
