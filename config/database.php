<?php 

// Database connection
$host = 'localhost';
$dbname = 'e-books'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

$mysqli = new mysqli($host, $username, $password, $dbname);


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
// Check if the connection is successful 

return $mysqli;