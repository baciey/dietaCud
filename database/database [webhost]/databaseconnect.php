<?php

	$servername = "localhost";
$username = "id8835198_baciey";
$password = "lol123";
$dbname = "id8835198_dieta";

$conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
?>