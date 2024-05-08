<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/employee-directory/css/style.css">
    <title>Home | Employee Direcotry</title>
</head>
<body>
    <main>
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/employee-directory/snippets/header.php'; ?>
        </header>
        <div>
        <?php
        // Display the session message if it exists
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']); // Unset message after display
        }
        // Display the employee table
        echo $employeeTable;
        ?>
        </div>
    </main>
</body>
</html>