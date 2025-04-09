<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooman Restaurant Order Confirmation</title>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Pacifico&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff8f0, #ffe6e6);
            color: #333;
            line-height: 1.6;
            overflow-x: hidden;
        }

        .main-header {
            background: linear-gradient(120deg, #ff3e3e, #ff8c00);
            color: #fff5e1;
            padding: 2rem;
            text-align: center;
            font-family: 'Pacifico', cursive;
            font-size: 2.5rem;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.4);
            animation: slideIn 1s ease-out;
            border-bottom: 4px solid #ff8c00;
        }

        .topnav {
            background: #222;
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .topnav a {
            color: white;
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            transition: all 0.3s ease;
            border-radius: 5px;
        }

        .topnav a:hover, .topnav a.active {
            background: #ff8c00;
            transform: translateY(-3px);
        }

        .topnav a i {
            margin-right: 0.5rem;
        }

        .confirmation-content {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .confirmation-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: #d43f3a;
            text-align: center;
            margin: 2rem 0;
            border-bottom: 2px solid #ff8c00;
            padding-bottom: 0.5rem;
        }

        .confirmation-message {
            text-align: center;
            font-size: 1.2rem;
            margin: 1.5rem 0;
            color: #666;
        }

        .order-section {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .order-header {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #ff8c00;
        }

        .order-header span {
            color: #ff3e3e;
            font-weight: 700;
        }

        .confirmation-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0.5rem;
        }

        .confirmation-table th, .confirmation-table td {
            padding: 0.8rem;
            text-align: right;
            border: 1px solid #ddd;
        }

        .confirmation-table th {
            background: #ff8c00;
            color: #fff5e1;
            font-weight: 600;
            text-align: center;
        }

        .confirmation-table td:first-child {
            text-align: left;
        }

        .confirmation-table tr:nth-child(even) {
            background: #f9f9f9;
        }

        .error-message {
            text-align: center;
            font-size: 1.2rem;
            color: #ff3e3e;
            margin: 2rem 0;
        }

        .footer {
            background: #333;
            color: white;
            padding: 1.5rem;
            text-align: center;
            border-top: 4px solid #ff8c00;
            margin-top: 2rem;
        }

        @keyframes slideIn {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @media (max-width: 768px) {
            .main-header { font-size: 2rem; padding: 1.5rem; }
            .topnav { flex-direction: column; padding: 0.5rem; }
            .confirmation-title { font-size: 1.5rem; }
            .order-header { font-size: 1rem; }
            .confirmation-table th, .confirmation-table td { font-size: 0.9rem; padding: 0.5rem; }
            .confirmation-message { font-size: 1rem; }
        }

        @media (max-width: 480px) {
            .main-header { font-size: 1.5rem; }
            .confirmation-content { padding: 0 0.5rem; }
            .confirmation-table th, .confirmation-table td { font-size: 0.8rem; padding: 0.4rem; }
            .order-header { font-size: 0.9rem; }
        }

        @media print {
            .topnav, .footer { display: none; }
            body { background: none; }
            .confirmation-content { margin: 0; padding: 0; }
            .order-section { box-shadow: none; page-break-inside: avoid; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="main-header">Rooman Restaurant</header>

    <!-- Navigation -->
    <nav class="topnav">
        <a href="index.php"><i class="fas fa-home"></i> Home</a>
        <a href="menu.php"><i class="fas fa-utensils"></i> Menu</a>
        <a href="orderHistory.php"><i class="fas fa-history"></i> Order History</a>
    </nav>

    <!-- Confirmation Content -->
    <div class="confirmation-content">
        <div class="confirmation-title">Order Confirmation</div>

        <?php
        // Enable error reporting for debugging
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // Check if form data is received
        if (!isset($_POST["productId"]) || !isset($_POST["productName"]) || !isset($_POST["price"]) || !isset($_POST["quantity"])) {
            echo '<p class="error-message">Error: No order data received. Please submit an order from the menu.</p>';
        } else {
            // Get order information from submitted form
            $productIds = $_POST["productId"];
            $productNames = $_POST["productName"];
            $prices = $_POST["price"];
            $quantities = $_POST["quantity"];

            // Calculate order item amounts and total order amount
            $amounts = new SplFixedArray(sizeof($productIds));
            $totalAmount = 0.00;

            for ($i = 0; $i < sizeof($amounts); $i++) {
                $amounts[$i] = floatval($prices[$i]) * floatval($quantities[$i]);
                $totalAmount += $amounts[$i];
            }

            // Set timezone and timestamp
            date_default_timezone_set("UTC"); // Default; adjust as needed
            $currentTimeStamp = date('Y-m-d H:i:s');
            $currency = "$"; // Hardcoded for consistency
            $orderNumber = rand(1000, 9999); // Mock order number if database fails
            $dbSuccess = false;

            // Attempt database connection (optional)
            if (isset($db_url, $db_user, $db_password, $db_name)) {
                $conn = @new mysqli($db_url, $db_user, $db_password, $db_name);

                if (!$conn->connect_error) {
                    // Insert ORDER row
                    $sql = "INSERT INTO `order` (order_date_time, amount) VALUES ('$currentTimeStamp', $totalAmount)";
                    if ($conn->query($sql) === TRUE) {
                        $orderNumber = $conn->insert_id;
                        $dbSuccess = true;
                    }

                    // Insert ORDER_ITEM rows
                    if ($dbSuccess) {
                        $itemNo = 1;
                        for ($i = 0; $i < sizeof($amounts); $i++) {
                            if ($amounts[$i] != 0.00) {
                                $sql = "INSERT INTO order_item (order_number, order_item_number, product_id, quantity, amount)
                                        VALUES ($orderNumber, $itemNo, $productIds[$i], $quantities[$i], $amounts[$i])";
                                if ($conn->query($sql) === TRUE) {
                                    $itemNo += 1;
                                } else {
                                    $dbSuccess = false;
                                    break;
                                }
                            }
                        }
                    }
                    $conn->close();
                }
            }

            // Display confirmation regardless of database success
            echo '<p class="confirmation-message">Thank you for your order! It will be available for pickup within 15 minutes. Your order details are shown below.</p>';
            echo '<div class="order-section">';
            echo '<div class="order-header">';
            echo 'Order Number: <span>' . $orderNumber . '</span> | ';
            echo 'Date: <span>' . substr($currentTimeStamp, 0, 10) . '</span> | ';
            echo 'Time: <span>' . substr($currentTimeStamp, 11, 8) . '</span> | ';
            echo 'Total Amount: <span>' . $currency . number_format($totalAmount, 2) . '</span>';
            echo '</div>';

            echo '<table class="confirmation-table">';
            echo '<tr>';
            echo '<th>Item</th>';
            echo '<th>Price</th>';
            echo '<th>Quantity</th>';
            echo '<th>Amount</th>';
            echo '</tr>';

            for ($i = 0; $i < sizeof($amounts); $i++) {
                if ($amounts[$i] != 0.00) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($productNames[$i]) . '</td>';
                    echo '<td>' . $currency . number_format($prices[$i], 2) . '</td>';
                    echo '<td>' . htmlspecialchars($quantities[$i]) . '</td>';
                    echo '<td>' . $currency . number_format($amounts[$i], 2) . '</td>';
                    echo '</tr>';
                }
            }

            echo '</table>';
            echo '</div>';

            if (!$dbSuccess && isset($db_url)) {
                echo '<p class="confirmation-message" style="color: #ff3e3e;">Error: Could not save order to database. Please contact support.</p>';
            } elseif (!$dbSuccess) {
                echo '<p class="confirmation-message" style="color: #ff8c00;">Note: This is a temporary confirmation. Database integration pending.</p>';
            }
        }
        ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <h5>© 2025, Rooman Restaurant. All rights reserved.</h5>
    </footer>
</body>
</html>
