<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM employee WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("Location: index.php"); // Redirect to list page
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid employee ID.";
}
?>
