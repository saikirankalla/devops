<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Café Order History</title>

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

    .cursive-text {
      font-family: 'Pacifico', cursive;
      font-size: 2rem;
      color: #d43f3a;
      text-align: center;
      margin: 1.5rem 0;
    }

    .order-container {
      background: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      transition: transform 0.3s ease;
    }

    .order-container:hover {
      transform: translateY(-10px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .order-header {
      font-size: 1.2em;
      font-weight: 600;
      color: #333;
      margin-bottom: 1rem;
    }

    .order-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    .order-table th,
    .order-table td {
      padding: 0.8rem;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    .order-table th {
      background: linear-gradient(120deg, #ff3e3e, #ff8c00);
      color: #fff5e1;
      font-weight: 600;
    }

    .order-table tr:hover {
      background: #f5f5f5;
    }

    .no-orders {
      text-align: center;
      font-size: 1.2em;
      color: #666;
      margin: 2rem 0;
    }

    .footer {
      background: #333;
      color: white;
      padding: 2rem 1rem;
      text-align: center;
    }

    @media (max-width: 768px) {
      .main-header { font-size: 2rem; }
      .topnav { flex-direction: column; }
      .order-table { font-size: 0.9em; }
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
    Café
  </header>

  <!-- Navigation -->
  <nav class="topnav">
    <a href="index.php"><i class="fas fa-home"></i> Home</a>
    <a href="menu.php"><i class="fas fa-utensils"></i> Menu</a>
    <a href="orderHistory.php" class="active"><i class="fas fa-history"></i> Order History</a>
  </nav>

  <!-- Main Content -->
  <main class="main-content">
    <div class="cursive-text">
      <p>Order History</p>
    </div>

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

    // Retrieve all orders in the database.
    $sql = "SELECT a.order_number, a.order_date_time, a.amount as order_total,
                   b.order_item_number, b.product_id, b.quantity, b.amount as item_amount,
                   c.product_name, c.price
            FROM `order` a, order_item b, product c
            WHERE a.order_number = b.order_number
              AND c.id = b.product_id
            ORDER BY a.order_number DESC, b.order_item_number ASC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $previousOrderNumber = 0;
      $firstTime = true;

      while ($row = $result->fetch_assoc()) {
        if ($row["order_number"] != $previousOrderNumber) {
          if (!$firstTime) {
            echo '</table>';
            echo '</div>'; // Close previous order-container
          }

          echo '<div class="order-container">';
          echo '<div class="order-header">';
          echo 'Order Number: ' . $row["order_number"] . '     Date: ' . substr($row["order_date_time"], 0, 10)
               . '     Time: ' . substr($row["order_date_time"], 11, 8) . '     Total Amount: ' . $currency . number_format($row["order_total"], 2);
          echo '</div>';

          echo '<table class="order-table">';
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
        echo '<td>' . $currency . $row["price"] . '</td>';
        echo '<td>' . $row["quantity"] . '</td>';
        echo '<td>' . $currency . number_format($row["item_amount"], 2) . '</td>';
        echo '</tr>';
      }

      // Close the last table and container
      echo '</table>';
      echo '</div>';
    } else {
      echo '<p class="no-orders">You have no orders at this time.</p>';
    }

    // Close the connection
    $conn->close();
    ?>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <h5>© 2020, Amazon Web Services, Inc. or its Affiliates. All rights reserved.</h5>
  </footer>

</body>
</html>
