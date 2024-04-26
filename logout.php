<?php
session_start();

session_destroy();

header("login_page.php");

exit;
