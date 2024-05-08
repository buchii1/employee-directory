<?php

// Create or access a Session
session_start();

// Get the required files (datasase config, model, and helper functions)
require_once 'library/server.php';
require_once 'model/main-model.php';
require_once 'library/functions.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    default:
        // An array of employee data returned from the db query
        $employees = displayEmployeesDetails();

        // Check if there are any employees to display
        if (empty($employees)) {
            $employeeTable = "<p>No employees found. Please add employees to the database.</p>";
        } else {
            // Build the HTML table from the employee details
            $employeeTable = buildEmployeeTable($employees);
        }
        // Pass the table to the view
        include 'view/home.php';
        break;
}