<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch employee, department, and position details
    $result = $conn->query("SELECT * FROM employee WHERE id = $id");
    $employee = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $department_id = $_POST['department_id'];
        $position_id = $_POST['position_id'];

        $updateSql = "UPDATE employee SET name='$name', department_id='$department_id', position_id='$position_id' WHERE id=$id";
        
        if ($conn->query($updateSql) === TRUE) {
            echo "Record updated successfully";
            header("Location: index.php"); // Redirect to list page
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Fetch departments and positions for the dropdowns
    $departments = $conn->query("SELECT * FROM department");
    $positions = $conn->query("SELECT * FROM position");
} else {
    echo "Invalid employee ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Employee</h1>
        <form method="POST">
            <label for="name">Employee Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $employee['name']; ?>" required><br><br>

            <label for="department_id">Department:</label>
            <select id="department_id" name="department_id" required>
                <?php
                while ($row = $departments->fetch_assoc()) {
                    $selected = $row['id'] == $employee['department_id'] ? 'selected' : '';
                    echo "<option value='" . $row['id'] . "' $selected>" . $row['department_name'] . "</option>";
                }
                ?>
            </select><br><br>

            <label for="position_id">Position:</label>
            <select id="position_id" name="position_id" required>
                <?php
                while ($row = $positions->fetch_assoc()) {
                    $selected = $row['id'] == $employee['position_id'] ? 'selected' : '';
                    echo "<option value='" . $row['id'] . "' $selected>" . $row['position_name'] . "</option>";
                }
                ?>
            </select><br><br>

            <input type="submit" value="Update Employee">
        </form>
    </div>
</body>
</html>
