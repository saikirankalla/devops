<<<<<<< HEAD
<<<<<<< HEAD
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Caf&eacute; Menu</title>
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/menu.css">
</head>

<body class="bodyStyle">

	<div id="header" class="mainHeader">
		<hr>
		<div class="center">Caf&eacute;</div>
	</div>
	<br>
	<?php
		// Get the application environment parameters from the Parameter Store.
		include ('getAppParameters.php');

		// Display the server metadata information if the showServerInfo parameter is true.
		include('serverInfo.php');
	?>
	<hr>
	<div class="topnav">
		<a href="index.php">Home</a>
		<a href="menu.php" class="active">Menu</a>
		<a href="orderHistory.php">Order History</a>
	</div>

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

    // Display each returned item in a form.

	echo '<form id="orderForm" action="processOrder.php" method="post" onsubmit="return validateOrder()">';

	$previousProductGroupNumber = 0;

	// output data of each row
	while($row = $result->fetch_assoc()) {

	    if ($row["product_group_number"] != $previousProductGroupNumber) {

            echo '<hr>';
            echo '<div class="cursiveText">';
            echo '<p>' . $row["product_group_name"] . '</p>';
            echo '</div>';

	        $previousProductGroupNumber = $row["product_group_number"];
	    }

	    $price = number_format($row["price"], 2);

	    echo '	<div class="column">';
	    echo '			<div class="card">';
	    echo '				<img src="' . $row["image_url"] . '" style="width: 100%">';
	    echo '				<div class="container">';
	    echo '					<h2 class="productTitle">' . $row["product_name"] . '</h2>';
	    echo '					<p class="center">' . $currency . $price . '</p>';
	    echo '					<p class="center">' . $row["description"] . '</p>';
	    echo '					<input type="hidden" name="productId[]" value="' . $row["id"] . '">';
	    echo '					<input type="hidden" name="productName[]" value="' . $row["product_name"] . '">';
	    echo '					<input type="hidden" name="price[]" value=' . $price . '>';
	    echo '					<div class="center">';
	    echo '						Quantity: <input name="quantity[]" type="number" min="0" max="15" value="0" maxlength="2" onchange="updateTotal(' . $row["id"] . ', this.value, ' . $price . ')">';
	    echo '					</div>';
	    echo '					<br>';
	    echo '				</div>';
	    echo '			</div>';
	    echo '		</div>';

	}

	echo '<div>';
	echo '	<p class="center">';
	echo '		Order Total: ' . $currency . '<span id="orderTotal"></span>';
	echo '	</p>';
	echo '</div>';
	echo '<br> <input type="Submit" value="Submit Order" class="button">';
	echo '<br> <br> <input type="Reset" value="Reset Order" class="button" onclick="resetForm()">';
	echo '</form>';

} else {
    echo '<br><p class="center">There are no items on the menu.</p>';
}

// Close the connection.

$conn->close();
?>

	<div id="Copyright" class="center">
		<h5>&copy; 2020, Amazon Web Services, Inc. or its Affiliates. All rights reserved.</h5>
	</div>

	<script>

		/* Initialize order total. */

		document.getElementById("orderTotal").innerHTML = "0.00";
<?php
    echo 'var itemTotals = new Array(' . $numOfItems . ');'
?>

		var i;
		for (i = 0; i < itemTotals.length; i++) {
			itemTotals[i]=0.00;
		}

		/* Function to calculate order total */

		function calculateOrderTotal() {

			var orderTotal = 0.00;

			var i;
			for (i = 0; i < itemTotals.length; i++) {
				orderTotal += itemTotals[i];
			}
			return orderTotal;
		}

		/* Function to reset form */

		function resetForm() {

			document.getElementById("orderForm").reset();
			document.getElementById("orderTotal").innerHTML = "0.00";
			var i;
			for (i = 0; i < itemTotals.length; i++) {
			  itemTotals[i] = 0.00;
			}
		}

		/* Function to update order total when quantities change */

		function updateTotal(itemNo, quantity, price) {

			var amount = quantity * price;
			itemTotals[itemNo] = amount;

			var totalAmount = calculateOrderTotal().toFixed(2);
			document.getElementById("orderTotal").innerHTML = totalAmount;

		}

		/* Function to validate the order amount */

		function validateOrder() {

			if (calculateOrderTotal() <= 0.0) {
				alert('Please select at least one item to buy.');
				return false;
			}
		}
	</script>

</body>
</html>
=======
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Caf&eacute; Menu</title>
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/menu.css">
</head>

<body class="bodyStyle">

	<div id="header" class="mainHeader">
		<hr>
		<div class="center">Caf&eacute;</div>
	</div>
	<br>
	<?php
		// Get the application environment parameters from the Parameter Store.
		include ('getAppParameters.php');

		// Display the server metadata information if the showServerInfo parameter is true.
		include('serverInfo.php');
	?>
	<hr>
	<div class="topnav">
		<a href="index.php">Home</a>
		<a href="menu.php" class="active">Menu</a>
		<a href="orderHistory.php">Order History</a>
	</div>

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

    // Display each returned item in a form.

	echo '<form id="orderForm" action="processOrder.php" method="post" onsubmit="return validateOrder()">';

	$previousProductGroupNumber = 0;

	// output data of each row
	while($row = $result->fetch_assoc()) {

	    if ($row["product_group_number"] != $previousProductGroupNumber) {

            echo '<hr>';
            echo '<div class="cursiveText">';
            echo '<p>' . $row["product_group_name"] . '</p>';
            echo '</div>';

	        $previousProductGroupNumber = $row["product_group_number"];
	    }

	    $price = number_format($row["price"], 2);

	    echo '	<div class="column">';
	    echo '			<div class="card">';
	    echo '				<img src="' . $row["image_url"] . '" style="width: 100%">';
	    echo '				<div class="container">';
	    echo '					<h2 class="productTitle">' . $row["product_name"] . '</h2>';
	    echo '					<p class="center">' . $currency . $price . '</p>';
	    echo '					<p class="center">' . $row["description"] . '</p>';
	    echo '					<input type="hidden" name="productId[]" value="' . $row["id"] . '">';
	    echo '					<input type="hidden" name="productName[]" value="' . $row["product_name"] . '">';
	    echo '					<input type="hidden" name="price[]" value=' . $price . '>';
	    echo '					<div class="center">';
	    echo '						Quantity: <input name="quantity[]" type="number" min="0" max="15" value="0" maxlength="2" onchange="updateTotal(' . $row["id"] . ', this.value, ' . $price . ')">';
	    echo '					</div>';
	    echo '					<br>';
	    echo '				</div>';
	    echo '			</div>';
	    echo '		</div>';

	}

	echo '<div>';
	echo '	<p class="center">';
	echo '		Order Total: ' . $currency . '<span id="orderTotal"></span>';
	echo '	</p>';
	echo '</div>';
	echo '<br> <input type="Submit" value="Submit Order" class="button">';
	echo '<br> <br> <input type="Reset" value="Reset Order" class="button" onclick="resetForm()">';
	echo '</form>';

} else {
    echo '<br><p class="center">There are no items on the menu.</p>';
}

// Close the connection.

$conn->close();
?>

	<div id="Copyright" class="center">
		<h5>&copy; 2020, Amazon Web Services, Inc. or its Affiliates. All rights reserved.</h5>
	</div>

	<script>

		/* Initialize order total. */

		document.getElementById("orderTotal").innerHTML = "0.00";
<?php
    echo 'var itemTotals = new Array(' . $numOfItems . ');'
?>

		var i;
		for (i = 0; i < itemTotals.length; i++) {
			itemTotals[i]=0.00;
		}

		/* Function to calculate order total */

		function calculateOrderTotal() {

			var orderTotal = 0.00;

			var i;
			for (i = 0; i < itemTotals.length; i++) {
				orderTotal += itemTotals[i];
			}
			return orderTotal;
		}

		/* Function to reset form */

		function resetForm() {

			document.getElementById("orderForm").reset();
			document.getElementById("orderTotal").innerHTML = "0.00";
			var i;
			for (i = 0; i < itemTotals.length; i++) {
			  itemTotals[i] = 0.00;
			}
		}

		/* Function to update order total when quantities change */

		function updateTotal(itemNo, quantity, price) {

			var amount = quantity * price;
			itemTotals[itemNo] = amount;

			var totalAmount = calculateOrderTotal().toFixed(2);
			document.getElementById("orderTotal").innerHTML = totalAmount;

		}

		/* Function to validate the order amount */

		function validateOrder() {

			if (calculateOrderTotal() <= 0.0) {
				alert('Please select at least one item to buy.');
				return false;
			}
		}
	</script>

</body>
</html>
>>>>>>> 9be27d2d9823b57fd9fe6282fd8f7e418e97a8fc
=======
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
       grid-template-columns: repeat(3, 1fr); /* 3 items per row */
       gap: 1.5rem;
     }
 
     .menu-item {
       background: rgba(255, 255, 255, 0.9);
       border-radius: 10px;
       box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
       padding: 1rem;
       text-align: center;
       height: 450px; /* Fixed height for uniformity */
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
       height: 200px; /* Fixed image height */
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
     <form id="orderForm" action="#" method="post" onsubmit="return validateOrder()">
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
>>>>>>> e21b1fd12a5e0b02d5091f27b236d0aaceb579fe
