<?php

require_once 'library/server.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    default:
        include 'view/home.php';
        break;
}