<?php
$host = 'localhost';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Drop and Recreate database for clean state
$conn->query("DROP DATABASE IF EXISTS edutrack");
$sql = "CREATE DATABASE edutrack";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select database
$conn->select_db("edutrack");

// Import Schema
$schema = file_get_contents(__DIR__ . '/schema.sql');
if ($conn->multi_query($schema)) {
    echo "Schema imported successfully<br>";
    while ($conn->next_result()) {;} // flush multi_queries
} else {
    echo "Error importing schema: " . $conn->error . "<br>";
}

// Import Data
$data = file_get_contents(__DIR__ . '/data_login.sql');
if ($conn->multi_query($data)) {
    echo "Data imported successfully<br>";
    while ($conn->next_result()) {;} // flush multi_queries
} else {
    echo "Error importing data: " . $conn->error . "<br>";
}

$conn->close();

echo "Setup completed! You can now try to login.";
?>
