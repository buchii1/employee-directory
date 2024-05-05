<?php
// functions.php

function createManagerDropdown($managers, $selectedManagerId = null) {
    $dropdown = '<select name="manager_id">';
    $dropdown .= '<option value="">No Manager</option>'; // Default option for no manager
    
    foreach ($managers as $manager) {
        $manager_name = htmlspecialchars($manager['first_name'] . ' ' . $manager['last_name']);
        $manager_id = intval($manager['id']);
        $isSelected = ($manager_id === $selectedManagerId) ? ' selected' : ''; // Check if it's selected
        $dropdown .= '<option value="' . $manager_id . '"' . $isSelected . '>' . $manager_name . '</option>';
    }
    $dropdown .= '</select>';
    
    return $dropdown; // Return the complete dropdown HTML
}
