<?php

// Function to create a DB CONNECTION using PDO
function employeeDirectoryConnect()
{
    $server = 'localhost';
    $dbname = 'employee-directory';
    $username = 'root';
    $password = '';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // Create the actual connection and assign it to a variable
    try {
        $conn = new PDO($dsn, $username, $password, $options);
        return $conn;
    } catch (PDOException $e) {
        echo "Error: $e";
        exit;
    }
}
employeeDirectoryConnect();