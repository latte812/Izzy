<?php

$servername = "localhost";
$username = "latte";
$password = "doit!123";
$dbname = "Izzy";

$conn = new mysqli($servername, $username, $password, $dbname, 41063);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
