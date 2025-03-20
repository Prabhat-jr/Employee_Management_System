<?php
include 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $department_id = $_POST['department_id'];
    $position_id = $_POST['position_id'];

    $sql = "INSERT INTO employee (name, department_id, position_id) 
            VALUES ('$name', '$department_id', '$position_id')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: index.php"); // Redirect to list page
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch departments and positions for the dropdowns
$departments = $conn->query("SELECT * FROM department");
$positions = $conn->query("SELECT * FROM position");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Add New Employee</h1>
        <form method="POST">
            <label class="form-label" for="name">Employee Name:</label>
            <input class="form-control" type="text" id="name" name="name" required><br><br>

            <label for="department_id">Department:</label>
            <select class="form-control"id="department_id" name="department_id" required>
                <?php
                while ($row = $departments->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['department_name'] . "</option>";
                }
                ?>
            </select><br><br>

            <label for="position_id">Position:</label>
            <select class="form-control" id="position_id" name="position_id" required>
                <?php
                while ($row = $positions->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['position_name'] . "</option>";
                }
                ?>
            </select><br><br>

            <input type="submit" value="Add Employee">
        </form>
    </div>
</body>
</html>
