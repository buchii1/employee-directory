<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/employee-directory/css/style.css">
    <title>Delete Employee | Employee Direcotry</title>
</head>
<body>
    <main>
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/employee-directory/snippets/header.php'; ?>
        </header>
        
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>

        <form method="post" action="/employee-directory/directory/">
            <fieldset>
                <legend>Delete Employee</legend>
                <label for="first_name">First name:<input type="text" name="first_name" id="first_name" value="
                    <?php if (isset($employeeInfo['first_name'])) {echo $employeeInfo['first_name'];} ?>" readonly>
                </label>
                <label for="last_name">Last name:<input type="text" name="last_name" id="last_name" value="
                <?php if (isset($employeeInfo['last_name'])) {echo $employeeInfo['last_name'];} ?>" readonly>
                </label>
            </fieldset>

            <input type="submit" name="submit" id="deleteEmployee" class="submit" value="Delete Employee">
            <input type="hidden" name="action" value="employeeDelete">
            <input type="hidden" name="employee_id" value="
            <?php if (isset($employeeInfo['employee_id'])) {echo $employeeInfo['employee_id'];} ?>">
        </form>
    </main>
</body>
</html>