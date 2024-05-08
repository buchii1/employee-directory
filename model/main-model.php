<?php
// MODEL functions containing all database interactions


// Function to add a new employee to the db
function addEmployee($first_name, $last_name, $hire_date, $position, $department_id = NULL)
{
    // Connect to the database
    $db = employeeDirectoryConnect();
    // Write the sql statement
    $sql = 'INSERT INTO employees (first_name, last_name, hire_date, position, department_id)
            VALUES (:first_name, :last_name, :hire_date, :position, :department_id)';
    // Sql prepared statement
    $stmt = $db->prepare($sql);
    // Bind the parameters for existing values
    $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindParam(':hire_date', $hire_date, PDO::PARAM_STR);
    $stmt->bindParam(':position', $position, PDO::PARAM_STR);
    // Bind the optional department_id, with a check for NULL
    $stmt->bindParam('department_id', $department_id, $department_id !== NULL ? PDO::PARAM_INT : PDO::PARAM_NULL);
    // Execute SQL query
    $stmt->execute();
    // Return no of rows changed
    $rowsChanged = $stmt->rowCount();
    // Close the cursor
    $stmt->closeCursor();
    return $rowsChanged;
}


// // Function to retrieve associative array of
// a selected employee from the db
function getDepartments() {
    $db = employeeDirectoryConnect();
    $sql = 'SELECT department_id, department_name FROM departments';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $departments;
}


// Function to add a new deparment to the db, and also
// promote an employee to a manager
function addDepartment($department_name, $manager_id = null) {
    $db = employeeDirectoryConnect(); // Connect to the database
    // Insert a new department with or without a manager_id
    $sql = 'INSERT INTO departments (department_name, manager_id) 
            VALUES (:department_name, :manager_id)';
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->bindParam(':department_name', $department_name, PDO::PARAM_STR);
    $stmt->bindParam('manager_id', $manager_id, $manager_id !== NULL ? PDO::PARAM_INT : PDO::PARAM_NULL);
    $stmt->execute(); // Execute the insertion
    $rowsChanged = $stmt->rowCount(); // Get the number of affected rows

    // If a manager_id is specified, update the employee's position to "Manager"
    if ($manager_id !== null) {
        $sql = 'UPDATE employees SET position = "Manager" WHERE employee_id = :manager_id';
        $stmt = $db->prepare($sql); // Prepare the update statement
        $stmt->bindParam(':manager_id', $manager_id, PDO::PARAM_INT); // Bind the manager_id
        $stmt->execute(); // Execute the update
    }
    $stmt->closeCursor(); // Close the cursor
    return $rowsChanged; // Return the result
}


// Function to retrieve an array of associative arrays of
// all the the employees from the db
function getEmployees() {
    $db = employeeDirectoryConnect(); // Connect to the database
    $sql = 'SELECT employee_id, first_name, last_name FROM employees'; // Get all employees
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->execute(); // Execute the query  
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
    $stmt->closeCursor(); // Close the cursor  
    return $employees; // Return the list of all employees
}


// Function to retrieve an associative array of
// a selected employee from the db
function getEmployeeInfo($employee_id) {
    $db = employeeDirectoryConnect();
    $sql = 'SELECT employees.*, departments.department_name FROM employees
            LEFT JOIN departments on employees.department_id = departments.department_id
            WHERE employees.employee_id = :employee_id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $stmt->execute();
    $employeeInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $employeeInfo;
}


// Function to update some select details of a selected
// employee from the db
function updateEmployee($last_name, $position, $employee_id, $department_id = Null) {
    // Create a connection object from the employeeDirectory's connection obj
    $db = employeeDirectoryConnect();
    // SQL update statement
    $sql = 'UPDATE employees SET last_name = :last_name, position = :position,
            department_id = :department_id WHERE employee_id = :employee_id';
    $stmt = $db->prepare($sql); // Create the prepared statement
    // Replace the placeholders in the SQL statement with the actual
    // values and tells the database the type of data it is
    $stmt->bindParam('last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindParam(':position', $position, PDO::PARAM_STR);
    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $stmt->bindParam(':department_id', $department_id, $department_id !== NULL ? PDO::PARAM_INT : PDO::PARAM_NULL);
    $stmt->execute(); // Insert the data
    // Ask how many rows changed as a result of our update
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}


// Function to delete an indvidual employee from the db
function deleteEmployee($employee_id) {
    $db = employeeDirectoryConnect();
    $sql = 'DELETE FROM employees WHERE employee_id = :employee_id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

// Function to retrieve an array of associative arrays of
// all the the employees and their department info in the db
function displayEmployeesDetails() {
    $db = EmployeeDirectoryConnect();
    $sql = 'SELECT employees.*, departments.department_name from employees
            LEFT JOIN departments on employees.department_id = departments.department_id';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $employeeDirectory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $employeeDirectory;
}