<?php
// functions.php

// A helper function to build a html select dropdown of all departments
function createDepartmentDropdown($departments, $selectedDepartmentId = null) {
    $dropdown = '<select name="department_id" id="department_id">'; // Add an ID for accessibility
    $dropdown .= '<option value="">No Department</option>'; // Default if there's no department

    foreach ($departments as $department) {
        $department_name = htmlspecialchars($department['department_name']); // Sanitize the department name
        $department_id = intval($department['department_id']); // Convert to integer
        // Determine if this department should be pre-selected
        $isSelected = ($department_id === $selectedDepartmentId) ? ' selected' : ''; // Check if it's the default        
        // Add the option to the dropdown with correct selection state
        $dropdown .= '<option value="' . $department_id . '"' . $isSelected . '>' . $department_name . '</option>';
    }
    $dropdown .= '</select>'; // Close the select tag
    return $dropdown; // Return the complete dropdown HTML
}


// A helper function to build a html select dropdown of all employees
function createEmployeeDropdown($employees, $selectedEmployeeId = null) {
    $dropdown = '<select name="manager_id" id="manager_id">';
    $dropdown .= '<option value="">Select a dept. head</option>'; // Default option for no manager
    
    foreach ($employees as $employee) {
        // Get the employee's full name for display
        $employee_name = htmlspecialchars($employee['first_name'] . ' ' . $employee['last_name']);
        // Get the employee_id for the dropdown value
        $employee_id = intval($employee['employee_id']);        
        // Check if this employee is the currently selected manager
        $isSelected = ($employee_id === $selectedEmployeeId) ? ' selected' : '';
        // Build the option tag with the appropriate value and selection state
        $dropdown .= '<option value="' . $employee_id . '"' . $isSelected . '>' . $employee_name . '</option>';
    }
    $dropdown .= '</select>'; // Close the select tag
    return $dropdown; // Return the dropdown HTML
}

// A helper function to build a table of all the employees
function buildEmployeeTable($employees) {
    if (empty($employees)) {
        return '<p>No employees found.</p>'; // Return a message if no data is available
    }
    // Start building the HTML table
    $table = '<table>';
    $table .= '<thead>';
    $table .= '<tr>'; // Table headers
    $table .= '<th>First Name</th>';
    $table .= '<th>Last Name</th>';
    $table .= '<th>Hire Date</th>';
    $table .= '<th>Position</th>';
    $table .= '<th>Department</th>';
    $table .= '<th>Actions</th>'; // For update and delete links
    $table .= '</tr>';
    $table .= '</thead>';
    $table .= '<tbody>'; // Table body

    foreach ($employees as $employee) {
        $table .= '<tr>'; // Start a new row
        // Display employee information
        $table .= '<td>' . htmlspecialchars($employee['first_name']) . '</td>';
        $table .= '<td>' . htmlspecialchars($employee['last_name']) . '</td>';
        $table .= '<td>' . htmlspecialchars($employee['hire_date']) . '</td>';
        $table .= '<td>' . htmlspecialchars($employee['position']) . '</td>';
        
        // Department name might be null (due to LEFT JOIN), handle it gracefully
        $department_name = isset($employee['department_name']) ? $employee['department_name'] : 'No Department';
        $table .= '<td>' . htmlspecialchars($department_name) . '</td>';
        
        // Build the action links
        $employee_id = intval($employee['employee_id']); // Ensure it's an integer
        
        // Update link
        $update_link = '/employee-directory/directory/?action=update-employee&employee_id=' . $employee_id;
        // Delete link
        $delete_link = '/employee-directory/directory/?action=delete-employee&employee_id=' . $employee_id;
        
        $table .= '<td>'; // Actions column
        $table .= '<a href="' . htmlspecialchars($update_link) . '">Update</a> | '; // Update link
        $table .= '<a href="' . htmlspecialchars($delete_link) . '" onclick="return confirm(\'Are you sure you want to delete this employee?\');">Delete</a>'; // Delete link with confirmation
        $table .= '</td>';
        $table .= '</tr>'; // End the row
    }
    $table .= '</tbody>'; // Close the table body
    $table .= '</table>'; // Close the table
    return $table; // Return the complete HTML table
}