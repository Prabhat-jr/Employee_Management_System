<?php
include 'db.php';

// Fetch employee data with department and position details
$sql = "SELECT e.id, e.name, d.department_name, p.position_name
        FROM employee e
        JOIN department d ON e.department_id = d.id
        JOIN position p ON e.position_id = p.id";
$employeeResult = $conn->query($sql);

// Fetch department data
$departmentSql = "SELECT * FROM department";
$departmentResult = $conn->query($departmentSql);

// Fetch position data
$positionSql = "SELECT * FROM position";
$positionResult = $conn->query($positionSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="style.css">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
   
</head>
<body>
    <div class="container">
        <h1>Employee Management System</h1>

        <!-- Links to add new items -->
        <div class="add-links"> 
            <a href="add.php">Add Employee</a>
        </div>

        <!-- Employee List Section -->
        <div class="section">
            <h2>Employee Data Table</h2>
            <table id="employeeTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($employeeResult->num_rows > 0) {
                        while ($row = $employeeResult->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['name'] . "</td>
                                    <td>" . $row['department_name'] . "</td>
                                    <td>" . $row['position_name'] . "</td>
                                    <td>
                                        <a href='edit.php?id=" . $row['id'] . "'>Edit</a> | 
                                        <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No employees found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

      
    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTables for all tables
            $('#employeeTable').DataTable();
            $('#departmentTable').DataTable();
            $('#positionTable').DataTable();
        });
    </script>
</body>
</html>
