<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ano = $_POST['ano'];
    $ttype = $_POST['ttype'];
    $tamount = $_POST['tamount'];

    $result = $conn->query("SELECT BALANCE FROM ACCOUNT WHERE ANO = $ano");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_balance = $row['BALANCE'];

        if ($ttype == 'D') {
            $new_balance = $current_balance + $tamount;
        } elseif ($ttype == 'W') {
            if ($tamount > $current_balance) {
                echo "<p class='error'>Error: Insufficient balance.</p>";
                exit();
            }
            $new_balance = $current_balance - $tamount;
        } else {
            echo "<p class='error'>Error: Invalid transaction type.</p>";
            exit();
        }

        $stmt = $conn->prepare("INSERT INTO TRANSACTION (ANO, TTYPE, TDATE, TAMOUNT) VALUES (?, ?, CURDATE(), ?)");
        $stmt->bind_param("isd", $ano, $ttype, $tamount);
        $stmt->execute();

        $stmt_update = $conn->prepare("UPDATE ACCOUNT SET BALANCE = ? WHERE ANO = ?");
        $stmt_update->bind_param("di", $new_balance, $ano);
        $stmt_update->execute();

        echo "<p class='success'>Transaction successful! New balance: $" . $new_balance . "</p>";
        $stmt->close();
        $stmt_update->close();
    } else {
        echo "<p class='error'>Error: Account not found.</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perform Transaction</title>
    <style>
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
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        h2 {
            color: #2c6e49;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: #2c6e49;
        }

        input[type="number"], input[type="text"] {
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
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #1b5535;
        }

        .success, .error {
            text-align: center;
            font-size: 1.2rem;
            margin-top: 20px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Perform a Transaction</h2>
        <form action="transaction.php" method="POST">
            <label for="ano">Account Number:</label>
            <input type="number" id="ano" name="ano" required>

            <label for="ttype">Transaction Type (D for Deposit, W for Withdrawal):</label>
            <input type="text" id="ttype" name="ttype" maxlength="1" required>

            <label for="tamount">Amount:</label>
            <input type="number" step="0.01" id="tamount" name="tamount" required>

            <input type="submit" value="Submit Transaction">
        </form>
    </div>
</body>
</html>
