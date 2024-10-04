<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cid = $_POST['cid'];
    $atype = $_POST['atype'];
    $balance = $_POST['balance'];
    
    $stmt = $conn->prepare("INSERT INTO ACCOUNT (ATYPE, BALANCE, CID) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $atype, $balance, $cid);
    
    if ($stmt->execute()) {
        echo "<p class='success'>New account added successfully!</p>";
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
    <title>Manage Accounts</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f7f4;
            color: #333;
            padding: 20px;
            display: flex;
            justify-content: center;
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
            text-align: center;
            color: #2c6e49;
            margin-bottom: 20px;
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

        input[type="text"],
        input[type="number"] {
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
        <h2>Add a New Account</h2>
        <form action="account.php" method="POST">
            <label for="cid">Customer ID:</label>
            <input type="number" id="cid" name="cid" required><br><br>
            
            <label for="atype">Account Type (S for Savings, C for Current):</label>
            <input type="text" id="atype" name="atype" maxlength="1" required><br><br>

            <label for="balance">Initial Balance:</label>
            <input type="number" step="0.01" id="balance" name="balance" required><br><br>
            
            <input type="submit" value="Add Account">
        </form>

        <h2>Existing Accounts</h2>
        <?php
        $result = $conn->query("SELECT * FROM ACCOUNT");
        if ($result->num_rows > 0) {
            echo "<table><tr><th>ANO</th><th>Type</th><th>Balance</th><th>CID</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["ANO"] . "</td><td>" . $row["ATYPE"] . "</td><td>" . $row["BALANCE"] . "</td><td>" . $row["CID"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No accounts found.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
