<?php
// Add a new employee
function addEmployee($first_name, $last_name, $hire_date, $position, $department_id = NULL)
{
    // Connect to the database
    $db = employeeDirectoryConnect();

    // Write the sql statement
    $sql = 'INSERT INTO employees (first_name, last_name, hire_date, position, manager_id)
            VALUES (:first_name, :last_name, :hire_date, :position, :manager_id)';

    // Sql prepared statement
    $stmt = $db->prepare($sql);

    // Bind the parameters for existing values
    $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindParam(':hire_date', $hire_date, PDO::PARAM_STR);
    $stmt->bindParam(':position', $position, PDO::PARAM_STR);

    // Bind the optional manager_id, with a check for NULL
    $stmt->bindParam(':manager_id', $manager_id, $manager_id !== NULL ? PDO::PARAM_INT : PDO::PARAM_NULL);

    // Execute SQL query
    $stmt->execute();

    // Return no of rows changed
    $rowsChanged = $stmt->rowCount();
    // Close the cursor
    $stmt->closeCursor();
    return $rowsChanged;
}

function getManagers() {
    $db = employeeDirectoryConnect();
    $sql = 'SELECT employee_id, first_name, last_name FROM employees WHERE position = "Manager"';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $managers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $managers;
}