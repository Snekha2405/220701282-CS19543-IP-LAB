<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking Application</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container for the Application */
        .container {
            text-align: center;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        /* Title Styling */
        h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        /* List Styling */
        ul {
            list-style: none;
        }

        ul li {
            margin: 20px 0;
        }

        /* Link Styling */
        a {
            text-decoration: none;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 25px;
            transition: background-color 0.3s;
        }

        /* Hover Effect for Links */
        a:hover {
            background-color: #2980b9;
        }

        /* Mobile Responsiveness */
        @media (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }
            a {
                font-size: 1rem;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Banking Application</h1>

        <ul>
            <li><a href="customer.php">Manage Customers</a></li>
            <li><a href="account.php">Manage Accounts</a></li>
            <li><a href="transaction.php">Manage Transactions</a></li>
            <li><a href="view_transactions.php">View Transaction History</a></li>
        </ul>
    </div>
</body>
</html>
