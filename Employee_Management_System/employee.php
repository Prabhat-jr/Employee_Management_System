<?php
include 'db.php';

$sql = "SELECT e.id, e.name, d.department_name, p.position_name
        FROM employee e
        JOIN department d ON e.department_id = d.id
        JOIN position p ON e.position_id = p.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Position</th>
            </tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['department_name'] . "</td>
                <td>" . $row['position_name'] . "</td>
              </tr>";
    }
    
    echo "</table>";
} else {
    echo "No records found.";
}
?>
