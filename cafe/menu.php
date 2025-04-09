<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooman Restaurant Menu</title>

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

        /* Menu Content */
        .menu-content {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .cursive-text {
            font-family: 'Pacifico', cursive;
            font-size: 2rem;
            color: #d43f3a;
            text-align: center;
            margin: 2rem 0;
            animation: fadeInUp 1s ease-out;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .container {
            padding: 1.5rem;
            text-align: center;
        }

        .product-title {
            font-size: 1.5rem;
            color: #d43f3a;
            margin-bottom: 0.5rem;
        }

        .container p {
            font-size: 1rem;
            margin: 0.5rem 0;
        }

        .quantity-input {
            width: 60px;
            padding: 0.3rem;
            margin-top: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        .order-summary {
            text-align: center;
            margin: 2rem 0;
            font-size: 1.2rem;
        }

        .button {
            background: #ff8c00;
            color: white;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 0.5rem;
        }

        .button:hover {
            background: #ff3e3e;
            transform: scale(1.05);
        }

        /* Footer */
        .footer {
            background: #333;
            color: white;
            padding: 2rem 1rem;
            text-align: center;
        }

        /* Animations */
        @keyframes slideIn {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-header { font-size: 2rem; padding: 1.5rem; }
            .topnav { flex-direction: column; padding: 0.5rem; }
            .menu-grid { grid-template-columns: 1fr; }
            .cursive-text { font-size: 1.5rem; }
        }

        @media (max-width: 480px) {
            .main-header { font-size: 1.5rem; }
            .product-title { font-size: 1.2rem; }
            .container p { font-size: 0.9rem; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="main-header">Rooman Restaurant Menu</header>

    <!-- Navigation -->
    <nav class="topnav">
        <a href="index.php"><i class="fas fa-home"></i> Home</a>
        <a href="menu.php" class="active"><i class="fas fa-utensils"></i> Menu</a>
        <a href="orderHistory.php"><i class="fas fa-history"></i> Order History</a>
    </nav>

    <!-- Menu Content -->
    <div class="menu-content">
        <?php
        // Create a connection to the database.
        $conn = new mysqli($db_url, $db_user, $db_password, $db_name);

        // Check the connection.
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get all rows from the product table.
        $sql = "SELECT a.id, a.product_name, a.description, a.price, b.product_group_number, b.product_group_name, a.image_url
                FROM product a, product_group b
                WHERE b.product_group_number = a.product_group
                ORDER BY b.product_group_number, a.id";

        $result = $conn->query($sql);
        $numOfItems = $result->num_rows;

        if ($numOfItems > 0) {
            echo '<form id="orderForm" action="processOrder.php" method="post" onsubmit="return validateOrder()">';
            $previousProductGroupNumber = 0;

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                if ($row["product_group_number"] != $previousProductGroupNumber) {
                    echo '<div class="cursive-text">' . $row["product_group_name"] . '</div>';
                    $previousProductGroupNumber = $row["product_group_number"];
                }

                $price = number_format($row["price"], 2);
                $currency = "$"; // Assuming USD, adjust as needed

                echo '<div class="card">';
                echo '  <img src="' . $row["image_url"] . '" alt="' . $row["product_name"] . '">';
                echo '  <div class="container">';
                echo '      <h2 class="product-title">' . $row["product_name"] . '</h2>';
                echo '      <p>' . $currency . $price . '</p>';
                echo '      <p>' . $row["description"] . '</p>';
                echo '      <input type="hidden" name="productId[]" value="' . $row["id"] . '">';
                echo '      <input type="hidden" name="productName[]" value="' . $row["product_name"] . '">';
                echo '      <input type="hidden" name="price[]" value="' . $price . '">';
                echo '      <div>';
                echo '          Quantity: <input class="quantity-input" name="quantity[]" type="number" min="0" max="15" value="0" onchange="updateTotal(' . $row["id"] . ', this.value, ' . $price . ')">';
                echo '      </div>';
                echo '  </div>';
                echo '</div>';
            }

            echo '<div class="order-summary">';
            echo '  <p>Order Total: ' . $currency . '<span id="orderTotal">0.00</span></p>';
            echo '</div>';
            echo '<input type="submit" value="Submit Order" class="button">';
            echo '<input type="reset" value="Reset Order" class="button" onclick="resetForm()">';
            echo '</form>';
        } else {
            echo '<p style="text-align: center; margin: 2rem;">There are no items on the menu.</p>';
        }

        // Close the connection.
        $conn->close();
        ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <h5>© 2025, Rooman Restaurant. All rights reserved.</h5>
    </footer>

    <script>
        /* Initialize order total */
        document.getElementById("orderTotal").innerHTML = "0.00";
        <?php echo 'var itemTotals = new Array(' . $numOfItems . ');' ?>
        for (let i = 0; i < itemTotals.length; i++) {
            itemTotals[i] = 0.00;
        }

        /* Function to calculate order total */
        function calculateOrderTotal() {
            let orderTotal = 0.00;
            for (let i = 0; i < itemTotals.length; i++) {
                orderTotal += itemTotals[i];
            }
            return orderTotal;
        }

        /* Function to reset form */
        function resetForm() {
            document.getElementById("orderForm").reset();
            document.getElementById("orderTotal").innerHTML = "0.00";
            for (let i = 0; i < itemTotals.length; i++) {
                itemTotals[i] = 0.00;
            }
        }

        /* Function to update order total when quantities change */
        function updateTotal(itemNo, quantity, price) {
            let amount = quantity * price;
            itemTotals[itemNo] = amount;
            let totalAmount = calculateOrderTotal().toFixed(2);
            document.getElementById("orderTotal").innerHTML = totalAmount;
        }

        /* Function to validate the order amount */
        function validateOrder() {
            if (calculateOrderTotal() <= 0.0) {
                alert('Please select at least one item to buy.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
