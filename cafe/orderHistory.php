<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooman Restaurant Order History Report</title>

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

        /* Header */
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

        /* Navigation */
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

        /* Report Content */
        .report-content {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .report-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: #d43f3a;
            text-align: center;
            margin: 2rem 0;
            border-bottom: 2px solid #ff8c00;
            padding-bottom: 0.5rem;
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

        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0.5rem;
        }

        .report-table th, .report-table td {
            padding: 0.8rem;
            text-align: right;
            border: 1px solid #ddd;
        }

        .report-table th {
            background: #ff8c00;
            color: #fff5e1;
            font-weight: 600;
            text-align: center;
        }

        .report-table td:first-child {
            text-align: left;
        }

        .report-table tr:nth-child(even) {
            background: #f9f9f9;
        }

        .no-orders {
            text-align: center;
            font-size: 1.2rem;
            margin: 2rem 0;
            color: #666;
        }

        /* Footer */
        .footer {
            background: #333;
            color: white;
            padding: 1.5rem;
            text-align: center;
            border-top: 4px solid #ff8c00;
            margin-top: 2rem;
        }

        /* Animations */
        @keyframes slideIn {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-header { font-size: 2rem; padding: 1.5rem; }
            .topnav { flex-direction: column; padding: 0.5rem; }
            .report-title { font-size: 1.5rem; }
            .order-header { font-size: 1rem; }
            .report-table th, .report-table td { font-size: 0.9rem; padding: 0.5rem; }
        }

        @media (max-width: 480px) {
            .main-header { font-size: 1.5rem; }
            .report-content { padding: 0 0.5rem; }
            .report-table th, .report-table td { font-size: 0.8rem; padding: 0.4rem; }
            .order-header { font-size: 0.9rem; }
        }

        /* Print Styles */
        @media print {
            .topnav, .footer { display: none; }
            body { background: none; }
            .report-content { margin: 0; padding: 0; }
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
        <a href="orderHistory.php" class="active"><i class="fas fa-history"></i> Order History</a>
    </nav>

    <!-- Report Content -->
    <div class="report-content">
        <div class="report-title">Order History Report</div>

        <?php
        // Create a connection to the database.
        $conn = new mysqli($db_url, $db_user, $db_password, $db_name);

        // Check the connection.
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve all orders in the database.
        $sql = "SELECT a.order_number, a.order_date_time, a.amount as order_total,
                       b.order_item_number, b.product_id, b.quantity, b.amount as item_amount,
                       c.product_name, c.price
                FROM `order` a, order_item b, product c
                WHERE a.order_number = b.order_number
                  AND c.id = b.product_id
                ORDER BY a.order_number DESC, b.order_item_number ASC";

        $result = $conn->query($sql);
        $currency = "$"; // Assuming USD, adjust as needed

        if ($result->num_rows > 0) {
            $previousOrderNumber = 0;
            $firstTime = true;

            while ($row = $result->fetch_assoc()) {
                if ($row["order_number"] != $previousOrderNumber) {
                    if (!$firstTime) {
                        echo '</table>';
                        echo '</div>'; // Close previous order-section
                    }

                    echo '<div class="order-section">';
                    echo '<div class="order-header">';
                    echo 'Order Number: <span>' . $row["order_number"] . '</span> | ';
                    echo 'Date: <span>' . substr($row["order_date_time"], 0, 10) . '</span> | ';
                    echo 'Time: <span>' . substr($row["order_date_time"], 11, 8) . '</span> | ';
                    echo 'Total Amount: <span>' . $currency . number_format($row["order_total"], 2) . '</span>';
                    echo '</div>';

                    echo '<table class="report-table">';
                    echo '<tr>';
                    echo '<th>Item</th>';
                    echo '<th>Price</th>';
                    echo '<th>Quantity</th>';
                    echo '<th>Amount</th>';
                    echo '</tr>';

                    $previousOrderNumber = $row["order_number"];
                    $firstTime = false;
                }

                echo '<tr>';
                echo '<td>' . $row["product_name"] . '</td>';
                echo '<td>' . $currency . number_format($row["price"], 2) . '</td>';
                echo '<td>' . $row["quantity"] . '</td>';
                echo '<td>' . $currency . number_format($row["item_amount"], 2) . '</td>';
                echo '</tr>';
            }

            // Close the last table and section
            echo '</table>';
            echo '</div>';
        } else {
            echo '<p class="no-orders">No orders recorded at this time.</p>';
        }

        // Close the connection.
        $conn->close();
        ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <h5>© 2025, Rooman Restaurant. All rights reserved.</h5>
    </footer>
</body>
</html>
