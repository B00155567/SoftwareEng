<?php
// DBconnect.php
require 'config.php'; // Adjust the path as necessary

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; // Uncomment for debugging connections
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
