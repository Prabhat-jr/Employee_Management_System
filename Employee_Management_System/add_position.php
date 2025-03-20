<?php
include 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $position_name = $_POST['position_name'];

    // Insert into the position table
    $sql = "INSERT INTO position (position_name) VALUES ('$position_name')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New position created successfully.";
        header("Location: index.php"); // Redirect to the main page or position list page
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
    <title>Add Position</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add New Position</h1>
        <form method="POST">
            <label for="position_name">Position Name:</label>
            <input type="text" id="position_name" name="position_name" required><br><br>

            <input type="submit" value="Add Position">
        </form>
    </div>
</body>
</html>
