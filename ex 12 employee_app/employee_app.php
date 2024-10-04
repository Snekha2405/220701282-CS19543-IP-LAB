<?php
include 'db_connect.php'; // Include the database connection

// Add Employee
if (isset($_POST['add_employee'])) {
    $ename = $_POST['ename'];
    $desig = $_POST['desig'];
    $dept = $_POST['dept'];
    $doj = $_POST['doj'];
    $salary = $_POST['salary'];

    $sql = "INSERT INTO EMPDETAILS (ENAME, DESIG, DEPT, DOJ, SALARY) VALUES ('$ename', '$desig', '$dept', '$doj', '$salary')";
    if ($conn->query($sql) === TRUE) {
        echo "<h3>New Employee Added Successfully</h3>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Update Employee
if (isset($_POST['update_employee'])) {
    $empid = $_POST['empid'];
    $ename = $_POST['ename'];
    $desig = $_POST['desig'];
    $dept = $_POST['dept'];
    $doj = $_POST['doj'];
    $salary = $_POST['salary'];

    $sql = "UPDATE EMPDETAILS SET ENAME='$ename', DESIG='$desig', DEPT='$dept', DOJ='$doj', SALARY='$salary' WHERE EMPID='$empid'";
    if ($conn->query($sql) === TRUE) {
        echo "<h3>Employee Updated Successfully</h3>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Delete Employee
if (isset($_POST['delete_employee'])) {
    $empid = $_POST['empid'];
    $sql = "DELETE FROM EMPDETAILS WHERE EMPID='$empid'";
    if ($conn->query($sql) === TRUE) {
        echo "<h3>Employee Deleted Successfully</h3>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch Employee Details
$result = $conn->query("SELECT * FROM EMPDETAILS");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        input[type="submit"], input[type="text"], input[type="date"], input[type="number"] {
            padding: 10px;
            width: 100%;
            max-width: 400px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        h2 {
            color: #4CAF50;
        }
    </style>
</head>
<body>

<h2>Add a New Employee</h2>
<form action="employee_app.php" method="POST">
    <label for="ename">Employee Name:</label><br>
    <input type="text" id="ename" name="ename" required><br>

    <label for="desig">Designation:</label><br>
    <input type="text" id="desig" name="desig" required><br>

    <label for="dept">Department:</label><br>
    <input type="text" id="dept" name="dept" required><br>

    <label for="doj">Date of Joining:</label><br>
    <input type="date" id="doj" name="doj" required><br>

    <label for="salary">Salary:</label><br>
    <input type="number" step="0.01" id="salary" name="salary" required><br>

    <input type="submit" name="add_employee" value="Add Employee">
</form>

<h2>Update Employee Details</h2>
<form action="employee_app.php" method="POST">
    <label for="empid">Employee ID:</label><br>
    <input type="number" id="empid" name="empid" required><br>

    <label for="ename">Employee Name:</label><br>
    <input type="text" id="ename" name="ename" required><br>

    <label for="desig">Designation:</label><br>
    <input type="text" id="desig" name="desig" required><br>

    <label for="dept">Department:</label><br>
    <input type="text" id="dept" name="dept" required><br>

    <label for="doj">Date of Joining:</label><br>
    <input type="date" id="doj" name="doj" required><br>

    <label for="salary">Salary:</label><br>
    <input type="number" step="0.01" id="salary" name="salary" required><br>

    <input type="submit" name="update_employee" value="Update Employee">
</form>

<h2>Delete an Employee</h2>
<form action="employee_app.php" method="POST">
    <label for="empid">Employee ID:</label><br>
    <input type="number" id="empid" name="empid" required><br>

    <input type="submit" name="delete_employee" value="Delete Employee">
</form>

<h2>Employee Details</h2>
<table>
    <tr>
        <th>EMPID</th>
        <th>ENAME</th>
        <th>DESIG</th>
        <th>DEPT</th>
        <th>DOJ</th>
        <th>SALARY</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["EMPID"] . "</td><td>" . $row["ENAME"] . "</td><td>" . $row["DESIG"] . "</td><td>" . $row["DEPT"] . "</td><td>" . $row["DOJ"] . "</td><td>" . $row["SALARY"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No employees found</td></tr>";
    }
    ?>
</table>

</body>
</html>
