<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'task_management';

$conn = new mysqli($db_host, $db_user, $db_pass);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS " . $db_name;
if ($conn->query($sql) === TRUE) {
    $conn->select_db($db_name);
} else {
    die("Error creating database: " . $conn->error);
}

$sql = "CREATE TABLE IF NOT EXISTS tasks (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('pending', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (!$conn->query($sql)) {
    die("Error creating table: " . $conn->error);
}
?> 