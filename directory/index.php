<?php 
// Employee Directory Controller

session_start(); // Create or access a session

require_once '../library/server.php';
require_once '../model/main-model.php';
require_once '../library/functions.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'add-employee':
        $managers = getManagers(); // Fetch list of managers from the model
        // $managerDropdown = '';

        if (isset($managers) && !empty($managers)) {
            $managerDropdown = createManagerDropdown($managers); // Set the dropdown value
        }
        
        $managerDropdown = createManagerDropdown($managers);

        include '../view/add-employee.php';
        exit;
        break;
    case 'employeeAdd':
        $first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $hire_date = trim(filter_input(INPUT_POST, 'hire_date', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $position = trim(filter_input(INPUT_POST, 'position', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $manager_id = trim(filter_input(INPUT_POST, 'manager_id', FILTER_VALIDATE_INT, ["options" => ["default" => null]]));

        // if ($manager_id === false) {
        //     $manager_id = NULL;
        // }

        // Check for inaccurate data
        if (empty($first_name) || empty($last_name) || empty($hire_date) || empty($position)) {
            $message = '<p>Please provide information for all empty form fields.</p>';

            // Re-fetch the manager list and dropdown in case of re-rendering
            $managers = getManagers();
            $managerDropdown = createManagerDropdown($managers);

            include '../view/add-employee.php';
            exit;
        }

        // Send the data to the model
        $rowsChanged = addEmployee($first_name, $last_name, $hire_date, $position, $manager_id);

        // Check and return the result
        if ($rowsChanged) {
            $message = "<p>$first_name $last_name was successfully added.</p>";
            $SESSION['message'] = $message;
            header('Location: /employee-directory/');
            exit;
        } else {
            $message = "<p>$first_name $last_name was not added.</p>";
            include '../view/add-employee.php';
        }
}