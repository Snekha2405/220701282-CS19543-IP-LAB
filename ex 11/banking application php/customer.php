<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cname = $_POST['cname'];
    
    $stmt = $conn->prepare("INSERT INTO CUSTOMER (CNAME) VALUES (?)");
    $stmt->bind_param("s", $cname);
    
    if ($stmt->execute()) {
        echo "<p class='success'>New customer added successfully!</p>";
    } else {
        echo "<p class='error'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f7f4;
            color: #333;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }

        h2 {
            color: #2c6e49;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            margin-bottom: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
            max-width: 400px;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2c6e49;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #1b5535;
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
            background-color: #2c6e49;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #eaf2e0;
        }

        .success {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add a New Customer</h2>
        <form action="customer.php" method="POST">
            <label for="cname">Customer Name:</label>
            <input type="text" id="cname" name="cname" required><br><br>
            <input type="submit" value="Add Customer">
        </form>

        <h2>Existing Customers</h2>
        <?php
        $result = $conn->query("SELECT * FROM CUSTOMER");
        if ($result->num_rows > 0) {
            echo "<table><tr><th>CID</th><th>Name</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["CID"] . "</td><td>" . $row["CNAME"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No customers found.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
