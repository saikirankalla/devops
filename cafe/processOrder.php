<?php
// Start a session to track user data if needed
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
$message = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total = 0;
    $order_details = [];
    
    // Loop through submitted items
    for ($i = 0; $i < count($_POST['productId']); $i++) {
        $product_id = $_POST['productId'][$i];
        $product_name = $_POST['productName'][$i];
        $price = $_POST['price'][$i];
        $quantity = $_POST['quantity'][$i];
        
        if ($quantity > 0) {
            $subtotal = $price * $quantity;
            $total += $subtotal;
            $order_details[] = [
                'product_id' => $product_id,
                'product_name' => $product_name,
                'price' => $price,
                'quantity' => $quantity,
                'subtotal' => $subtotal
            ];
        }
    }
    
    if ($total > 0) {
        // Insert order into database
        try {
            // Generate a unique order ID
            $order_id = uniqid('order_');
            $order_date = date('Y-m-d H:i:s');
            
            // Insert into orders table
            $stmt = $conn->prepare("INSERT INTO orders (order_id, order_date, total) VALUES (:order_id, :order_date, :total)");
            $stmt->execute([
                ':order_id' => $order_id,
                ':order_date' => $order_date,
                ':total' => $total
            ]);
            
            // Insert order items
            $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, price, quantity, subtotal) 
                                  VALUES (:order_id, :product_id, :product_name, :price, :quantity, :subtotal)");
            foreach ($order_details as $item) {
                $stmt->execute([
                    ':order_id' => $order_id,
                    ':product_id' => $item['product_id'],
                    ':product_name' => $item['product_name'],
                    ':price' => $item['price'],
                    ':quantity' => $item['quantity'],
                    ':subtotal' => $item['subtotal']
                ]);
            }
            
            $message = "Order placed successfully! Order ID: $order_id";
        } catch (PDOException $e) {
            $message = "Error placing order: " . $e->getMessage();
        }
    } else {
        $message = "Please select at least one item.";
    }
} else {
    $message = "No order submitted.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Rooman Restaurant | Order Confirmation</title>

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

    .main-content {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 0 1rem;
    }

    .message {
      text-align: center;
      margin: 1rem 0;
      font-size: 1.1em;
      color: #d43f3a;
    }

    .confirmation {
      background: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      padding: 2rem;
      margin: 2rem 0;
      text-align: center;
    }

    .confirmation h2 {
      color: #d43f3a;
      font-family: 'Pacifico', cursive;
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .confirmation p {
      font-size: 1.1em;
      margin: 0.5rem 0;
    }

    .confirmation table {
      width: 80%;
      margin: 1rem auto;
      border-collapse: collapse;
    }

    .confirmation th, .confirmation td {
      padding: 0.8rem;
      border: 1px solid #ccc;
      text-align: center;
    }

    .confirmation th {
      background: #ff8c00;
      color: white;
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
      .confirmation table { width: 100%; }
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
    <a href="orderHistory.php"><i class="fas fa-history"></i> Order History</a>
  </nav>

  <!-- Main Content -->
  <main class="main-content">
    <div class="confirmation">
      <h2>Order Confirmation</h2>
      <?php if (!empty($message) && strpos($message, "successfully") !== false): ?>
        <p>Thank you for your order! It will be available for pickup within 15 minutes. Your order details are shown below.</p>
        <p>
          <strong>Order ID:</strong> <?php echo htmlspecialchars($order_id); ?><br>
          <strong>Date:</strong> <?php echo htmlspecialchars(substr($order_date, 0, 10)); ?><br>
          <strong>Time:</strong> <?php echo htmlspecialchars(substr($order_date, 11, 8)); ?><br>
          <strong>Total Amount:</strong> $<?php echo number_format($total, 2); ?>
        </p>
        <?php if (!empty($order_details)): ?>
          <table>
            <tr>
              <th>Item</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Amount</th>
            </tr>
            <?php foreach ($order_details as $item): ?>
              <tr>
                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                <td>$<?php echo number_format($item['price'], 2); ?></td>
                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                <td>$<?php echo number_format($item['subtotal'], 2); ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        <?php endif; ?>
      <?php else: ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
      <?php endif; ?>
    </div>
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
