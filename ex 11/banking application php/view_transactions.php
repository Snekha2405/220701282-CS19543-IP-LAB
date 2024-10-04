<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ano = $_POST['ano'];

    $stmt = $conn->prepare("SELECT * FROM TRANSACTION WHERE ANO = ? ORDER BY TDATE DESC");
    $stmt->bind_param("i", $ano);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='container'>";
        echo "<h3>Transaction History for Account Number: $ano</h3>";
        echo "<table><tr><th>TID</th><th>Type</th><th>Date</th><th>Amount</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['TID'] . "</td><td>" . ($row['TTYPE'] == 'D' ? 'Deposit' : 'Withdrawal') . "</td><td>" . $row['TDATE'] . "</td><td>$" . $row['TAMOUNT'] . "</td></tr>";
        }
        echo "</table></div>";
    } else {
        echo "<p class='error'>No transactions found for account number $ano.</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Transaction History</title>
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
            align-items: center;
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

        h2, h3 {
            color: #2c6e49;
            text-align: center;
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
            color: #2c6e49;
        }

        input[type="number"], input[type="submit"] {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
            max-width: 400px;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #2c6e49;
            color: white;
            border: none;
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

        .error {
            color: red;
            text-align: center;
            margin-top: 20px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>View Transaction History</h2>
        <form action="view_transactions.php" method="POST">
            <label for="ano">Account Number:</label>
            <input type="number" id="ano" name="ano" required>
            <input type="submit" value="View Transactions">
        </form>
    </div>
</body>
</html>
