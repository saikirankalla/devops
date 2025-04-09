<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooman Restaurant Order History</title>

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
        <div class="report-title">Order History</div>

        <?php
        // Static sample order data based on the 10-item menu
        $currency = "$";
        $sampleOrders = [
            [
                "order_number" => 1001,
                "order_date_time" => "2025-04-08 18:30:00",
                "order_total" => 42.23,
                "items" => [
                    ["product_id" => 1, "product_name" => "Tandoori Chicken", "price" => 12.99, "quantity" => 2, "item_amount" => 25.98],
                    ["product_id" => 6, "product_name" => "Garlic Naan", "price" => 3.50, "quantity" => 3, "item_amount" => 10.50],
                    ["product_id" => 9, "product_name" => "Raita", "price" => 2.99, "quantity" => 2, "item_amount" => 5.98]
                ]
            ],
            [
                "order_number" => 1002,
                "order_date_time" => "2025-04-07 12:15:00",
                "order_total" => 34.99,
                "items" => [
                    ["product_id" => 3, "product_name" => "Chicken Biryani", "price" => 13.75, "quantity" => 1, "item_amount" => 13.75],
                    ["product_id" => 5, "product_name" => "Chicken Tikka Masala", "price" => 15.25, "quantity" => 1, "item_amount" => 15.25],
                    ["product_id" => 7, "product_name" => "Chicken Soup", "price" => 5.99, "quantity" => 1, "item_amount" => 5.99]
                ]
            ],
            [
                "order_number" => 1003,
                "order_date_time" => "2025-04-06 19:45:00",
                "order_total" => 32.99,
                "items" => [
                    ["product_id" => 4, "product_name" => "Lamb Rogan Josh", "price" => 16.99, "quantity" => 1, "item_amount" => 16.99],
                    ["product_id" => 8, "product_name" => "Keema Samosa", "price" => 4.75, "quantity" => 2, "item_amount" => 9.50],
                    ["product_id" => 10, "product_name" => "Mutton Soup", "price" => 6.50, "quantity" => 1, "item_amount" => 6.50]
                ]
            ]
        ];

        if (!empty($sampleOrders)) {
            foreach ($sampleOrders as $order) {
                echo '<div class="order-section">';
                echo '<div class="order-header">';
                echo 'Order Number: <span>' . $order["order_number"] . '</span> | ';
                echo 'Date: <span>' . substr($order["order_date_time"], 0, 10) . '</span> | ';
                echo 'Time: <span>' . substr($order["order_date_time"], 11, 8) . '</span> | ';
                echo 'Total Amount: <span>' . $currency . number_format($order["order_total"], 2) . '</span>';
                echo '</div>';

                echo '<table class="report-table">';
                echo '<tr>';
                echo '<th>Item</th>';
                echo '<th>Price</th>';
                echo '<th>Quantity</th>';
                echo '<th>Amount</th>';
                echo '</tr>';

                foreach ($order["items"] as $item) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($item["product_name"]) . '</td>';
                    echo '<td>' . $currency . number_format($item["price"], 2) . '</td>';
                    echo '<td>' . htmlspecialchars($item["quantity"]) . '</td>';
                    echo '<td>' . $currency . number_format($item["item_amount"], 2) . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
                echo '</div>';
            }
        } else {
            echo '<p class="no-orders">You have no orders at this time.</p>';
        }
        ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <h5>© 2025, Rooman Restaurant. All rights reserved.</h5>
    </footer>
</body>
</html>
