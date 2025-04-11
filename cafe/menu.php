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
}
?>

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

    .message {
      text-align: center;
      margin: 1rem 0;
      font-size: 1.1em;
      color: #d43f3a;
    }

    .center {
      text-align: center;
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
    <a href="menu.php"><i class="fas fa-utensils"></i> Menu</a>
    <a href="orderHistory.php"><i class="fas fa-history"></i> Order History</a>
  </nav>

  <!-- Main Content with Menu -->
  <main class="main-content">
    <!-- Display message if set -->
    <?php if (!empty($message)): ?>
      <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form id="orderForm" action="menu.php" method="post" onsubmit="return validateOrder()">
      <!-- Non-Veg Specialties Section -->
      <div class="menu-section">
        <h2>Non-Veg Specialties</h2>
        <div class="menu-grid">
          <!-- Mutton Boneless Biryani -->
          <div class="menu-item">
            <img src="https://vismaifood.com/storage/app/uploads/public/63a/cb5/158/thumb__1200_0_0_0_auto.jpg" alt="Mutton Boneless Biryani">
            <h3>Mutton Boneless Biryani</h3>
            <p>Tender boneless mutton cooked with aromatic basmati rice and spices</p>
            <p class="price">$18.99</p>
            <input type="hidden" name="productId[]" value="1">
            <input type="hidden" name="productName[]" value="Mutton Boneless Biryani">
            <input type="hidden" name="price[]" value="18.99">
            <div>Quantity: <input name="quantity[]" type="number" min="0" max="15" value="0" onchange="updateTotal(1, this.value, 18.99)"></div>
          </div>

          <!-- Chicken Fry Biryani -->
          <div class="menu-item">
            <img src="https://i.ytimg.com/vi/hFuG4wlztMo/maxresdefault.jpg" alt="Chicken Fry Biryani">
            <h3>Chicken Fry Biryani</h3>
            <p>Crispy fried chicken layered with spiced basmati rice</p>
            <p class="price">$15.99</p>
            <input type="hidden" name="productId[]" value="2">
            <input type="hidden" name="productName[]" value="Chicken Fry Biryani">
            <input type="hidden" name="price[]" value="15.99">
            <div>Quantity: <input name="quantity[]" type="number" min="0" max="15" value="0" onchange="updateTotal(2, this.value, 15.99)"></div>
          </div>

          <!-- Chicken Dum Biryani -->
          <div class="menu-item">
            <img src="http://3.bp.blogspot.com/-pSdOq7eDIdA/Vmc3HZ7aUJI/AAAAAAAAIaM/KGUMw9NDH3M/s1600/CBF11.jpg" alt="Chicken Dum Biryani">
            <h3>Chicken Dum Biryani</h3>
            <p>Slow-cooked chicken with fragrant basmati rice and spices</p>
            <p class="price">$14.99</p>
            <input type="hidden" name="productId[]" value="3">
            <input type="hidden" name="productName[]" value="Chicken Dum Biryani">
            <input type="hidden" name="price[]" value="14.99">
            <div>Quantity: <input name="quantity[]" type="number" min="0" max="15" value="0" onchange="updateTotal(3, this.value, 14.99)"></div>
          </div>

          <!-- Fish Biryani -->
          <div class="menu-item">
            <img src="https://c.ndtvimg.com/2022-02/ceg29dsg_fish-biryani_625x300_16_February_22.jpg?im=FaceCrop,algorithm=dnn,width=1200,height=675" alt="Fish Biryani">
            <h3>Fish Biryani</h3>
            <p>Succulent fish layered with aromatic rice and coastal spices</p>
            <p class="price">$16.99</p>
            <input type="hidden" name="productId[]" value="4">
            <input type="hidden" name="productName[]" value="Fish Biryani">
            <input type="hidden" name="price[]" value="16.99">
            <div>Quantity: <input name="quantity[]" type="number" min="0" max="15" value="0" onchange="updateTotal(4, this.value, 16.99)"></div>
          </div>

          <!-- Prawns Biryani -->
          <div class="menu-item">
            <img src="https://vismaifood.com/storage/app/uploads/public/0ae/185/cba/thumb__700_0_0_0_auto.jpg" alt="Prawns Biryani">
            <h3>Prawns Biryani</h3>
            <p>Juicy prawns blended with spiced rice and herbs</p>
            <p class="price">$17.99</p>
            <input type="hidden" name="productId[]" value="5">
            <input type="hidden" name="productName[]" value="Prawns Biryani">
            <input type="hidden" name="price[]" value="17.99">
            <div>Quantity: <input name="quantity[]" type="number" min="0" max="15" value="0" onchange="updateTotal(5, this.value, 17.99)"></div>
          </div>

          <!-- Crabs Biryani -->
          <div class="menu-item">
            <img src="https://i.ytimg.com/vi/Y-eDaY9sMps/hqdefault.jpg" alt="Crabs Biryani">
            <h3>Crabs Biryani</h3>
            <p>Flavorful crab meat mixed with spiced basmati rice</p>
            <p class="price">$19.99</p>
            <input type="hidden" name="productId[]" value="6">
            <input type="hidden" name="productName[]" value="Crabs Biryani">
            <input type="hidden" name="price[]" value="19.99">
            <div>Quantity: <input name="quantity[]" type="number" min="0" max="15" value="0" onchange="updateTotal(6, this.value, 19.99)"></div>
          </div>
        </div>
      </div>

      <!-- Veg Specialties Section -->
      <div class="menu-section">
        <h2>Veg Specialties</h2>
        <div class="menu-grid">
          <!-- Mushroom Biryani -->
          <div class="menu-item">
            <img src="https://tse4.mm.bing.net/th?id=OIP.CV4dgf6pCiupeftMqEXUMwHaEK&pid=Api&P=0&h=180" alt="Mushroom Biryani">
            <h3>Mushroom Biryani</h3>
            <p>Savory mushrooms cooked with spiced basmati rice</p>
            <p class="price">$13.99</p>
            <input type="hidden" name="productId[]" value="7">
            <input type="hidden" name="productName[]" value="Mushroom Biryani">
            <input type="hidden" name="price[]" value="13.99">
            <div>Quantity: <input name="quantity[]" type="number" min="0" max="15" value="0" onchange="updateTotal(7, this.value, 13.99)"></div>
          </div>

          <!-- Paneer Biryani -->
          <div class="menu-item">
            <img src="https://spicecravings.com/wp-content/uploads/2017/09/IMG_3134-copy-e1579798948176.jpg" alt="Paneer Biryani">
            <h3>Paneer Biryani</h3>
            <p>Soft paneer cubes layered with aromatic basmati rice and spices</p>
            <p class="price">$14.49</p>
            <input type="hidden" name="productId[]" value="8">
            <input type="hidden" name="productName[]" value="Paneer Biryani">
            <input type="hidden" name="price[]" value="14.49">
            <div>Quantity: <input name="quantity[]" type="number" min="0" max="15" value="0" onchange="updateTotal(8, this.value, 14.49)"></div>
          </div>

          <!-- Egg Biryani -->
          <div class="menu-item">
            <img src="https://spicecravings.com/wp-content/uploads/2020/10/Egg-Biryani-Featured-1.jpg" alt="Egg Biryani">
            <h3>Egg Biryani</h3>
            <p>Boiled eggs cooked with fragrant basmati rice and spices</p>
            <p class="price">$12.99</p>
            <input type="hidden" name="productId[]" value="9">
            <input type="hidden" name="productName[]" value="Egg Biryani">
            <input type="hidden" name="price[]" value="12.99">
            <div>Quantity: <input name="quantity[]" type="number" min="0" max="15" value="0" onchange="updateTotal(9, this.value, 12.99)"></div>
          </div>
        </div>
      </div>

      <!-- Order Total and Buttons -->
      <div class="order-total">
        Order Total: $<span id="orderTotal">0.00</span>
      </div>
      <div class="center">
        <input type="submit" value="Submit Order" class="button">
        <input type="reset" value="Reset Order" class="button" onclick="resetForm()">
      </div>
    </form>
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
    var itemTotals = new Array(10); // Size 10 for indices 1-9
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
