<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/employee-directory/css/style.css">
    <title>Add Employee | Employee Direcotry</title>
</head>
<body>
    <main>
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/employee-directory/snippets/header.php'; ?>
        </header>
        <nav>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/employee-directory/snippets/navigation.php'; ?>
        </nav>

        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>

        <form method="post" action="/employee-directory/directory/">
            <fieldset>
                <legend>Add Employee</legend>
                <label for="first_name">First name<input type="text" name="first_name" id="first_name"
                    <?php if (isset($first_name)) {echo "value='$first_name'";} ?> required>
                </label>
                <label for="last_name">Last name<input type="text" name="last_name" id="last_name"
                    <?php if (isset($last_name)) {echo "value='$last_name'";} ?> required>
                </label>
                <label for="hire_date">Hire date<input type="date" name="hire_date" id="hire_date"
                    <?php if (isset($hire_date)) {echo "value=\"$hire_date\"";} ?> required>
                </label>
                <label for="position">Position<input type="text" name="position" id="position"
                    <?php if (isset($position)) {echo "value='$position'";} ?> required>
                </label>
                <label for="manager_id"></label>
                <?php echo $managerDropdown ?>
            </fieldset>

            <input type="submit" name="submit" id="addEmployee" class="submit" value="Add Employee">
            <input type="hidden" name="action" value="employeeAdd">
        </form>
    </main>
</body>
</html>