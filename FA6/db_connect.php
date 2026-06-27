<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'dog_database';

$mysqli = new mysqli($host, $user, $password);
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

$mysqli->query("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$mysqli->select_db($dbname);

$createTable = "CREATE TABLE IF NOT EXISTS dogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dogname VARCHAR(100) NOT NULL,
    breed VARCHAR(100) NOT NULL,
    age VARCHAR(50) NOT NULL,
    address VARCHAR(255) NOT NULL,
    color VARCHAR(50) NOT NULL,
    height VARCHAR(50) NOT NULL,
    weight VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (!$mysqli->query($createTable)) {
    die('Table creation failed: ' . $mysqli->error);
}

return $mysqli;
