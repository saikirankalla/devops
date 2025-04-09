<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Rooman Restaurant</title>
	<link rel="stylesheet" href="css/styles.css">

	<!-- Font Awesome for social icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bodyStyle">

	<!-- Header -->
	<div id="header" class="mainHeader">
		<hr>
		<div class="center">Rooman Restaurant</div>
	</div>
	<br>

	<!-- PHP Scripts (works only on server with PHP) -->
	<?php
		include ('getAppParameters.php');
		include('serverInfo.php');
	?>

	<!-- Navigation -->
	<hr>
	<div class="topnav">
		<a href="index.php">Home</a>
		<a href="#aboutUs">About Us</a>
		<a href="#contactUs">Contact Us</a>
		<a href="menu.php">Menu</a>
		<a href="orderHistory.php">Order History</a>
	</div>
	<hr>

	<!-- Main Content -->
	<div id="mainContent">
		<div id="mainPictures" class="center">
			<table>
				<tr>
					<td>
						<img src="https://static.vecteezy.com/system/resources/thumbnails/053/315/407/small_2x/sizzling-tandoori-chicken-indian-clay-oven-roast-spices-cilantro-lemons-onions-photo.jpeg" 
							 alt="Tandoori Chicken" width="490">
					</td>
					<td>
						<img src="https://content.jdmagicbox.com/comp/kolhapur/j9/0231px231.x231.170705130820.n4j9/catalogue/hotel-balaji-kolhapur-ltkr50h2cf.jpg" 
							 alt="Hotel Balaji Dish" width="450">
					</td>
				</tr>
			</table>

			<hr>

			<p>
				At <strong>ROOMAN RESTAURANT</strong>, we serve an irresistible selection of mouth-watering non-vegetarian delights that are sure to satisfy your cravings. From sizzling tandoori chicken to spicy curries, juicy kebabs, and aromatic biryanis, every dish is crafted with rich spices and authentic flavors to give you a truly unforgettable dining experience!
			</p>

			<br>

			<table>
				<tr>
					<!-- First Column -->
					<td bgcolor="aquamarine">
						<div class="cursiveText">Frank bakes a rich variety of non veg dishes. Try them all!</div>
						<img src="https://media.istockphoto.com/id/995903748/photo/smoked-and-spicy-tandoori-chicken-grilling-with-smoke.jpg?s=612x612&w=0&k=20&c=xq_apF2Osk5HYFOgBS9crRi1puLozxyGWFuCUV0mhYg=" 
							 alt="Spicy Tandoori Chicken" width="300">
					</td>

					<!-- Second Column -->
					<td bgcolor="orange">
						<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQK6S3T1uURFUTOvrf7GpwhZ-OSzyPl8M9riQ&s" 
							 alt="Food Image" width="300">
					</td>

					<!-- Third Column -->
					<td bgcolor="aquamarine">
						<div class="cursiveText">Our NON-VEG soups are always <br/> a customer favorite!<br><br></div>
						<img src="https://cdn.uengage.io/uploads/7057/image-447364-1685524443.jpeg" 
							 alt="Strawberry Tart" width="300">
					</td>
				</tr>
			</table>
			<hr>
		</div>
	</div>

	<!-- About Us -->
	<div id="aboutUs" class="center">
		<hr>
		<h2>About Us</h2>
		<table>
			<tr>
				<td><img src="images/AA.jpg" width="400" alt="About Image"></td>
				<td>
					<p>
						At Rooman Café, bhAAi have been adding a touch of sweetness to every cup since 2020.
						Frank’s cherished recipes—passed down from his mother—are crafted with fresh, simple ingredients that bring out comforting, nostalgic flavors. Whether you're stopping in for your morning coffee or an afternoon treat, you’ll be welcomed by Frank and Martha themselves, always ready with a smile and a warm hello. At Rooman Café, you’re more than a customer—you’re part of the family.
					</p>
				</td>
			</tr>
		</table>
		<hr>
	</div>

	<!-- Contact Us -->
	<div id="contactUs" align="center">
		<hr>
		<h2>Contact Us</h2>
		<img src="https://rooman.com/wp-content/uploads/2024/03/Rooman-Logo-2.png" 
			 alt="Rooman Logo" width="120">
		<p>
			123 Any Street<br>
			Any Town, USA<br><br>
			Tel: +1-800-555-0193
		</p>

		<h3>Hours</h3>
		<p>
			Weekdays: 6:00am - 6:00pm<br>
			Saturday: 7:00am - 7:00pm<br>
			Closed on Sundays
		</p>
	</div>

	<!-- Footer with Social Media -->
	<div id="Copyright" class="center">
		<h5>&copy; 2025, ROOMAN RESTAURANT. All rights reserved.</h5>
		<div style="margin-top: 10px;">
			<a href="https://www.facebook.com" target="_blank" style="margin: 0 10px; color: #3b5998;">
				<i class="fab fa-facebook fa-lg"></i>
			</a>
			<a href="https://www.instagram.com" target="_blank" style="margin: 0 10px; color: #e4405f;">
				<i class="fab fa-instagram fa-lg"></i>
			</a>
			<a href="https://www.twitter.com" target="_blank" style="margin: 0 10px; color: #1da1f2;">
				<i class="fab fa-twitter fa-lg"></i>
			</a>
			<a href="https://www.youtube.com" target="_blank" style="margin: 0 10px; color: #ff0000;">
				<i class="fab fa-youtube fa-lg"></i>
			</a>
		</div>
	</div>

</body>
</html>
