<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/employee-directory/css/style.css">
    <title>Update Employee | Employee Direcotry</title>
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
        // Check if `hire_date` exists and is a valid date
        $hire_date = isset($_SESSION['employeeInfo']['hire_date']) ? $_SESSION['employeeInfo']['hire_date'] : '';
        $first_name = $_SESSION['employeeInfo']['first_name'];
        ?>

        <form method="post" action="/employee-directory/directory/">
            <fieldset>
                <legend>Update Employee</legend>
                <label for="first_name">First name:<input type="text" name="first_name" id="first_name"
                    <?php if (isset($_SESSION['employeeInfo']['first_name'])) 
                    {echo "value='$first_name'";}?> disabled>
                </label>
                <label for="last_name">Last name:<input type="text" name="last_name" id="last_name"
                    <?php if (isset($last_name)) {echo "value='$last_name'";} elseif 
                   (isset($employeeInfo['last_name'])) {echo "value='$employeeInfo[last_name]'";} ?> required>
                </label>
                <label for="hire_date">Hire date: <input type="date" name="hire_date" id="hire_date" 
                    value="<?php echo htmlspecialchars($hire_date); ?>" disabled> 
                </label>
                <label for="position">Position:<input type="text" name="position" id="position"
                    <?php if (isset($position)) {echo "value='$position'";} else if
                    (isset($employeeInfo['position'])) {echo "value='$employeeInfo[position]'";} ?> required>
                </label>
                <label for="department_id">Select department:</label>
                <?php echo $_SESSION['updateDept'] ?>
            </fieldset>

            <input type="submit" name="submit" id="updateEmployee" class="submit" value="Update Employee">
            <input type="hidden" name="action" value="employeeUpdate">
            <input type="hidden" name="employee_id" value="
            <?php if (isset($employeeInfo['employee_id'])) {echo $employeeInfo['employee_id'];} elseif
            (isset($employee_id)) {echo $employee_id;} ?>">
        </form>
    </main>
</body>
</html>