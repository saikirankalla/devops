<?php
// Start a session to track user data
session_start();

// Database connection (update with your credentials)
$servername = "localhost";
$username = "your_username"; // Replace with your database username
$password = "your_password"; // Replace with your database password
$dbname = "rooman_restaurant"; // Replace with your database name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Initialize message variable for feedback
$message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
unset($_SESSION['message']); // Clear the message after displaying

// Fetch all orders
try {
    $stmt = $conn->prepare("
        SELECT o.order_id, o.order_date, o.total,
               oi.product_id, oi.product_name, oi.price, oi.quantity, oi.subtotal
        FROM orders o
        LEFT JOIN order_items oi ON o.order_id = oi.order_id
        ORDER BY o.order_date DESC, oi.id ASC
    ");
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = "Error fetching orders: " . $e->getMessage();
    $orders = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Rooman Restaurant | Order History</title>

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

    .message {
      text-align: center;
      margin: 1rem 0;
      font-size: 1.1em;
      color: #d43f3a;
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
    Rooman Restaurant
  </header>

  <!-- Navigation -->
  <nav class="topnav">
    <a href="index.php"><i class="fas fa-home"></i> Home</a>
    <a href="#about"><i class="fas fa-info-circle"></i> About Us</a>
    <a href="#contact"><i class="fas fa-phone-alt"></i> Contact</a>
    <a href="menu.php"><i class="fas fa-utensils"></i> Menu</a>
    <a href="orderHistory.php" class="active"><i class="fas fa-history"></i> Order History</a>
  </nav>

  <!-- Main Content -->
  <main class="main-content">
    <div class="cursive-text">
      <p>Order History</p>
    </div>

    <?php if (!empty($message)): ?>
      <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <?php
    if (!empty($orders)) {
      $current_order_id = null;
      foreach ($orders as $row) {
        if ($row['order_id'] !== $current_order_id) {
          // Close previous table if not the first order
          if ($current_order_id !== null) {
            echo '</table>';
            echo '</div>'; // Close previous order-container
          }

          // Start new order container
          echo '<div class="order-container">';
          echo '<div class="order-header">';
          echo 'Order ID: ' . htmlspecialchars($row['order_id']) . '     Date: ' . htmlspecialchars(substr($row['order_date'], 0, 10)) 
               . '     Time: ' . htmlspecialchars(substr($row['order_date'], 11, 8)) . '     Total Amount: $' . number_format($row['total'], 2);
          echo '</div>';

          echo '<table class="order-table">';
          echo '<tr>';
          echo '<th>Item</th>';
          echo '<th>Price</th>';
          echo '<th>Quantity</th>';
          echo '<th>Amount</th>';
          echo '</tr>';

          $current_order_id = $row['order_id'];
        }

        // Only display items if they exist (non-null product_id)
        if ($row['product_id']) {
          echo '<tr>';
          echo '<td>' . htmlspecialchars($row['product_name']) . '</td>';
          echo '<td>$' . number_format($row['price'], 2) . '</td>';
          echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
          echo '<td>$' . number_format($row['subtotal'], 2) . '</td>';
          echo '</tr>';
        }
      }

      // Close the last table and container
      if ($current_order_id !== null) {
        echo '</table>';
        echo '</div>';
      }
    } else {
      echo '<p class="no-orders">You have no orders at this time.</p>';
    }
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

</body>
</html>
