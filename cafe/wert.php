<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Rooman Restaurant | Menu</title>

  <!-- Font Awesome -->
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
      padding: 1rem;
      text-align: center;
      font-family: 'Pacifico', cursive;
      font-size: 2.5rem;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.4);
      animation: slideIn 1s ease-out;
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

    .topnav a:hover {
      background: #ff8c00;
      transform: translateY(-3px);
    }

    .topnav a.active {
      background: #ff8c00;
    }

    .main-content {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 0 1rem;
    }

    .menu-section {
      margin: 2rem 0;
    }

    .menu-section h2 {
      color: #d43f3a;
      font-size: 2rem;
      margin-bottom: 1.5rem;
      font-family: 'Pacifico', cursive;
      text-align: center;
    }

    .menu-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
    }

    .menu-item {
      background: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      padding: 1rem;
      text-align: center;
      height: 450px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: transform 0.3s ease;
    }

    .menu-item:hover {
      transform: translateY(-10px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .menu-item img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
    }

    .menu-item h3 {
      color: #333;
      font-size: 1.2em;
      margin: 10px 0;
    }

    .menu-item p {
      font-size: 0.9em;
      margin: 5px 0;
    }

    .menu-item .price {
      color: #d43f3a;
      font-weight: 600;
    }

    .menu-item input[type="number"] {
      width: 60px;
      padding: 5px;
      margin-top: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .order-total {
      text-align: center;
      margin: 2rem 0;
      font-size: 1.2em;
      color: #333;
    }

    .button {
      background: linear-gradient(120deg, #ff3e3e, #ff8c00);
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin: 0 10px;
    }

    .button:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .center {
      text-align: center;
    }

    .footer {
      background: #333;
      color: white;
      padding: 2rem 1rem;
      text-align: center;
    }

    .social-links a {
      color: white;
      margin: 0 1rem;
      font-size: 1.5rem;
      transition: all 0.3s ease;
    }

    .social-links a:hover {
      transform: scale(1.2);
    }

    @media (max-width: 768px) {
      .main-header { font-size: 2rem; }
      .topnav { flex-direction: column; }
      .menu-grid { grid-template-columns: 1fr; }
    }

    @keyframes slideIn {
      from { transform: translateY(-100%); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="main-header">
    Rooman Restaurant
  </header>

  <!-- Navigation -->
  <nav class="topnav">
    <a href="index.php"><i class="fas fa-home"></i> Home</a>
    <a href="#about"><i class="fas fa-info-circle"></i> About Us</a>
    <a href="#contact"><i class="fas fa-phone-alt"></i> Contact</a>
    <a href="menu.php" class="active"><i class="fas fa-utensils"></i> Menu</a>
    <a href="orderHistory.php"><i class="fas fa-history"></i> Order History</a>
  </nav>

  <!-- Main Content with Menu -->
  <main class="main-content">
    <?php
    // Get the application environment parameters from the Parameter Store.
    include ('getAppParameters.php');

    // Display the server metadata information if the showServerInfo parameter is true.
    include('serverInfo.php');

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
                if ($previousProductGroupNumber != 0) {
                    echo '</div></div>'; // Close previous menu-grid and menu-section
                }
                echo '<div class="menu-section">';
                echo '<h2>' . htmlspecialchars($row["product_group_name"]) . '</h2>';
                echo '<div class="menu-grid">';
                $previousProductGroupNumber = $row["product_group_number"];
            }

            $price = number_format($row["price"], 2);
            echo '<div class="menu-item">';
            echo '<img src="' . htmlspecialchars($row["image_url"]) . '" alt="' . htmlspecialchars($row["product_name"]) . '">';
            echo '<h3>' . htmlspecialchars($row["product_name"]) . '</h3>';
            echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
            echo '<p class="price">$' . $price . '</p>';
            echo '<input type="hidden" name="productId[]" value="' . $row["id"] . '">';
            echo '<input type="hidden" name="productName[]" value="' . htmlspecialchars($row["product_name"]) . '">';
            echo '<input type="hidden" name="price[]" value="' . $price . '">';
            echo '<div>Quantity: <input name="quantity[]" type="number" min="0" max="15" value="0" onchange="updateTotal(' . $row["id"] . ', this.value, ' . $price . ')"></div>';
            echo '</div>';
        }

        // Close the last menu-grid and menu-section
        echo '</div></div>';

        // Order total and buttons
        echo '<div class="order-total">';
        echo 'Order Total: $<span id="orderTotal">0.00</span>';
        echo '</div>';
        echo '<div class="center">';
        echo '<input type="submit" value="Submit Order" class="button">';
        echo '<input type="reset" value="Reset Order" class="button" onclick="resetForm()">';
        echo '</div>';
        echo '</form>';
    } else {
        echo '<p style="text-align: center; font-size: 1.2em; color: #666;">There are no items on the menu.</p>';
    }

    // Close the connection
    $conn->close();
    ?>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <h5>© 2025, Rooman Restaurant. All rights reserved.</h5>
    <div class="social-links" style="margin-top: 1rem;">
      <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
      <a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
    </div>
  </footer>

  <script>
    document.getElementById("orderTotal").innerHTML = "0.00";
    var itemTotals = new Array(<?php echo $numOfItems + 1; ?>);
    for (var i = 0; i < itemTotals.length; i++) itemTotals[i] = 0.00;

    function calculateOrderTotal() {
      return itemTotals.reduce((acc, val) => acc + val, 0.00);
    }

    function resetForm() {
      document.getElementById("orderForm").reset();
      document.getElementById("orderTotal").innerHTML = "0.00";
      for (var i = 0; i < itemTotals.length; i++) itemTotals[i] = 0.00;
    }

    function updateTotal(itemNo, quantity, price) {
      itemTotals[itemNo] = quantity * price;
      document.getElementById("orderTotal").innerHTML = calculateOrderTotal().toFixed(2);
    }

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