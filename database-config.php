<?php
//Define your constant variables. Constant variables are mostly written in uppercase.
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'exeat_app');

// Create mysqli connection object
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection for error
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

?>