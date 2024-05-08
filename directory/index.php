<?php 
// Employee Directory Controller

session_start(); // Create or access a session

// Get all required functions
require_once '../library/server.php';
require_once '../model/main-model.php';
require_once '../library/functions.php';

// Fetch list of departments and managers from the model
$departments = getDepartments();
$employees = getEmployees();

// Create dropdowns of employees and departments and
// persist them to session
$_SESSION['departmentDropdown'] = 
    !empty($departments) ? createDepartmentDropdown($departments) : '<em>No department</em>';
$_SESSION['employeesDropdown'] = 
    !empty($employees) ? createEmployeeDropdown($employees) : '<em>No department head</em>';



$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    // Displays the add-employee form
    case 'add-employee':
        include '../view/add-employee.php';
        break;

    // Handles the logic of filtering, processing and 
    // adding a new employee
    case 'employeeAdd':
        $first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $hire_date = trim(filter_input(INPUT_POST, 'hire_date', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $position = trim(filter_input(INPUT_POST, 'position', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $department_id = trim(filter_input(INPUT_POST, 'department_id', FILTER_VALIDATE_INT));
        
        if (empty($department_id) || $department_id === false) {
            $department_id = null;
        } else {
            $department_id = (int) $department_id; // Convert to integer if valid
        }

        // Check for inaccurate data
        if (empty($first_name) || empty($last_name) || empty($hire_date) || empty($position)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-employee.php';
            exit;
        }
        // Send the data to the model
        $rowsChanged = addEmployee($first_name, $last_name, $hire_date, $position, $department_id);

        // Check and return the result
        if ($rowsChanged) {
            $message = "<p><b>$first_name $last_name</b> was successfully added.</p>";
            $_SESSION['message'] = $message;
            header('Location: /employee-directory/');
            exit;
        } else {
            $message = "<p><b>$first_name $last_name</b> was not added.</p>";
            include '../view/add-employee.php';
            exit;
        }
        
    // Displays the add department form page
    case 'add-department':
        include '../view/add-department.php';
        break;
        
    // Handles the logic of filtering, processing and 
    // adding a new department
    case 'departmentAdd':
        $department_name = trim(filter_input(INPUT_POST, 'department_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $manager_id = trim(filter_input(INPUT_POST, 'manager_id', FILTER_VALIDATE_INT));

        // Default `manager_id` to `null` if not provided or invalid
        if ($manager_id === false) {
            $manager_id = null;
        }
        if (empty($department_name)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-department.php';
            exit;
        }
        // Send the data to the model
        $rowsChanged = addDepartment($department_name, $manager_id);

        // Check and return the result
        if ($rowsChanged) {
            $message = "<p>Department was successfully added.</p>";
            $_SESSION['message'] = $message;
            header('Location: /employee-directory/');
            exit;
        } else {
            $message = "<p>$Error adding department.</p>";
            include '../view/add-department.php';
            exit;
        }

    // Handles the logic of displaying the update
    // employee form
    case 'update-employee':
        // Get the employee id
        $employee_id = filter_input(INPUT_GET, 'employee_id', FILTER_VALIDATE_INT);
        $employeeInfo = getEmployeeInfo($employee_id);

        if (empty($employeeInfo)) {
            $message = 'Employee information not found';
        }
        // Add employee information to session
        $_SESSION['employeeInfo'] = $employeeInfo;

        // Determine the default department for the dropdown
        $selectedDepartmentId = isset($employeeInfo['department_id']) ? $employeeInfo['department_id'] : null;
        // Create the department dropdown with the correct default and add to session
        $_SESSION['updateDept'] = createDepartmentDropdown($departments, $selectedDepartmentId);
        include '../view/update-employee.php';
        break;

    // Handles the logic of filtering, processing and 
    // updating an employee details
    case 'employeeUpdate':
        $last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $position = trim(filter_input(INPUT_POST, 'position', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $employee_id = trim(filter_input(INPUT_POST, 'employee_id', FILTER_SANITIZE_NUMBER_INT));
        $department_id = trim(filter_input(INPUT_POST, 'department_id', FILTER_VALIDATE_INT));
        
        if (empty($department_id) || $department_id === false) {
            $department_id = null;
        } else {
            $department_id = (int) $department_id; // Convert to integer if valid
        }

        // Check for inaccurate data
        if (empty($last_name) || empty($position)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/update-employee.php';
            exit;
        }

        // Send the data to the model
        $updateResult = updateEmployee($last_name, $position, $employee_id, $department_id);

        // Check and return the result
        if ($updateResult) {
            $message = "<p><b>$last_name</b>, was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('Location: /employee-directory/');
            exit;
        } else {
            $message = "<p><b>$last_name</b>, was not updated.</p>";
            include '../view/update-employee.php';
            exit;
        }
    
    // Handles the logic of displaying the delete 
    // employee form
    case 'delete-employee':
        // Get the employee id
        $employee_id = filter_input(INPUT_GET, 'employee_id', FILTER_VALIDATE_INT);
        $employeeInfo = getEmployeeInfo($employee_id);

        if (empty($employeeInfo)) {
            $message = 'Employee information not found.';
        }
        include '../view/delete-employee.php';
        break;

    // Handles the logic of filtering, processing and 
    // deleting an employee
    case 'employeeDelete':
        $first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $position = trim(filter_input(INPUT_POST, 'position', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $employee_id = trim(filter_input(INPUT_POST, 'employee_id', FILTER_SANITIZE_NUMBER_INT));        

        // Send the data to the model
        $deleteResult = deleteEmployee($employee_id);

        // Check and return the result
        if ($deleteResult) {
            $message = "<p><b>$last_name</b>, was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('Location: /employee-directory/');
            exit;
        } else {
            $message = "<p><b>$last_name</b>, was not deleted.</p>";
            include '../view/delete-employee.php';
            exit;
        }
}    