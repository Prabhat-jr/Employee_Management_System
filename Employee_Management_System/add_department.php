<?php
include 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_name = $_POST['department_name'];

    // Insert into the department table
    $sql = "INSERT INTO department (department_name) VALUES ('$department_name')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New department created successfully.";
        header("Location: index.php"); // Redirect to the main page or department list page
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add New Department</h1>
        <form method="POST">
            <label for="department_name">Department Name:</label>
            <input type="text" id="department_name" name="department_name" required><br><br>

            <input type="submit" value="Add Department">
        </form>
    </div>
</body>
</html>
