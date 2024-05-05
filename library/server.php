<?php

function employeeDirectoryConnect()
{
    $server = 'localhost';
    $dbname = 'employee-directory';
    $username = 'root';
    $password = '';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $conn = new PDO($dsn, $username, $password, $options);
        return $conn;
    } catch (PDOException $e) {
        echo $e;
        exit;
        // header('Location: /phpmotors/view/500.php');
        // exit;
    }
}
employeeDirectoryConnect();