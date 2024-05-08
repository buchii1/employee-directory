<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/employee-directory/css/style.css">
    <title>Add Department | Employee Direcotry</title>
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
                <legend>Add Department</legend>
                <label for="department_name">Department name:<input type="text" name="department_name" id="department_name"
                    <?php if (isset($department_name)) {echo "value='$department_name'";} ?> required>
                </label>
                <label for="department_id">Select department head:</label>
                <?php echo $_SESSION['employeesDropdown'] ?>
            </fieldset>

            <input type="submit" name="submit" id="addDepartment" class="submit" value="Add Employee">
            <input type="hidden" name="action" value="departmentAdd">
        </form>
    </main>
</body>
</html>