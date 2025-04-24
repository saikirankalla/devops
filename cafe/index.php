<<<<<<< HEAD
<<<<<<< HEAD
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Caf&eacute;!</title>
	<link rel="stylesheet" href="css/styles.css">
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
		<a href="#aboutUs">About Us</a>
		<a href="#contactUs">Contact Us</a>
		<a href="menu.php">Menu</a>
		<a href="orderHistory.php">Order History</a>
	</div>
	<hr>
	<div id="mainContent">

		<div id="mainPictures" class="center">
			<table>
				<tr>
					<td><img src="images/Coffee-and-Pastries.jpg" height=auto width="490"></td>
					<td><img src="images/Cake-Vitrine.jpg" height=auto width="450"></td>
				</tr>
			</table>
			<hr>
			<p>Our caf&eacute; offers an assortment of delicious and delectable pastries and coffees that will put a smile on your face. From cookies to croissants, tarts and cakes, each treat is especially prepared to excite your tastebuds and brighten your day!</p>
			<br>
			<table>
				<tr>
					<td bgcolor="aquamarine">
						<div class="cursiveText">Frank bakes a rich variety of cookies. Try them all!</div>
						<table>
							<tr>
								<td><img src="images/Cookies.jpg" height=auto width="300"></td>
							</tr>
						</table>
					</td>
					<td bgcolor="orange">
						<table>
							<tr>
								<td><img src="images/Cup-of-Hot-Chocolate.jpg" height=auto width="200"></td>
								<td class="cursiveText">Tea,<br>Coffee,<br>Lattes,<br> and Hot Chocolate.<br>Yes, we have it!</td>
							</tr>
						</table>
					</td>
					<td bgcolor="aquamarine">
						<div class="cursiveText">Our tarts are always <br/> a customer favorite!<br><br>
					  </div>
						<table>
							<tr>
								<td><img src="images/Strawberry-Tarts.jpg" height=auto width="170"></td>
								<td><img src="images/Strawberry-Blueberry-Tarts.jpg" height=auto width="170"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<hr>
		</div>
	</div>

	<div id="aboutUs" class="center">
		<hr>
		<div>
			<h2>About Us</h2>
		</div>
			<table>
				<tr>
					<td><img src="images/Frank-Martha.jpg" height=auto width="400"></td>
					<td><p>Frank and Martha have been adding sweetness to their customers' lives since 2020.  Frank's recipes have been passed down from his mother and use simple and fresh ingredients to produce delightful flavors.  Both of them will personally greet you with a welcoming smile when you visit!</p></td>
				</tr>
			</table>
			<hr>
		</div>

	<div id="contactUs" align="center">
		<hr>
		<div>
			<h2>Contact Us</h2>
		</div>
		<table>
			<tr>
				<td><img src="images/Coffee-Shop.jpg" height=auto width="120"></td>
			</tr>
		</table>
		<div><p>123 Any Street<br>Any Town, USA<br><br>Tel: +1-800-555-0193</p></div>
		<div>
			<h3>Hours</h3>
		</div>
		<div>Weekdays: 6:00am - 6:00pm<br>Saturday: 7:00am - 7:00pm<br>Closed on Sundays</div>
	</div>

	<div id="Copyright" class="center">
		<h5>&copy; 2020, Amazon Web Services, Inc. or its Affiliates. All rights reserved.</h5>
	</div>
</body>
</html>
=======
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Caf&eacute;!</title>
	<link rel="stylesheet" href="css/styles.css">
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
		<a href="#aboutUs">About Us</a>
		<a href="#contactUs">Contact Us</a>
		<a href="menu.php">Menu</a>
		<a href="orderHistory.php">Order History</a>
	</div>
	<hr>
	<div id="mainContent">

		<div id="mainPictures" class="center">
			<table>
				<tr>
					<td><img src="images/Coffee-and-Pastries.jpg" height=auto width="490"></td>
					<td><img src="images/Cake-Vitrine.jpg" height=auto width="450"></td>
				</tr>
			</table>
			<hr>
			<p>Our caf&eacute; offers an assortment of delicious and delectable pastries and coffees that will put a smile on your face. From cookies to croissants, tarts and cakes, each treat is especially prepared to excite your tastebuds and brighten your day!</p>
			<br>
			<table>
				<tr>
					<td bgcolor="aquamarine">
						<div class="cursiveText">Frank bakes a rich variety of cookies. Try them all!</div>
						<table>
							<tr>
								<td><img src="images/Cookies.jpg" height=auto width="300"></td>
							</tr>
						</table>
					</td>
					<td bgcolor="orange">
						<table>
							<tr>
								<td><img src="images/Cup-of-Hot-Chocolate.jpg" height=auto width="200"></td>
								<td class="cursiveText">Tea,<br>Coffee,<br>Lattes,<br> and Hot Chocolate.<br>Yes, we have it!</td>
							</tr>
						</table>
					</td>
					<td bgcolor="aquamarine">
						<div class="cursiveText">Our tarts are always <br/> a customer favorite!<br><br>
					  </div>
						<table>
							<tr>
								<td><img src="images/Strawberry-Tarts.jpg" height=auto width="170"></td>
								<td><img src="images/Strawberry-Blueberry-Tarts.jpg" height=auto width="170"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<hr>
		</div>
	</div>

	<div id="aboutUs" class="center">
		<hr>
		<div>
			<h2>About Us</h2>
		</div>
			<table>
				<tr>
					<td><img src="images/Frank-Martha.jpg" height=auto width="400"></td>
					<td><p>Frank and Martha have been adding sweetness to their customers' lives since 2020.  Frank's recipes have been passed down from his mother and use simple and fresh ingredients to produce delightful flavors.  Both of them will personally greet you with a welcoming smile when you visit!</p></td>
				</tr>
			</table>
			<hr>
		</div>

	<div id="contactUs" align="center">
		<hr>
		<div>
			<h2>Contact Us</h2>
		</div>
		<table>
			<tr>
				<td><img src="images/Coffee-Shop.jpg" height=auto width="120"></td>
			</tr>
		</table>
		<div><p>123 Any Street<br>Any Town, USA<br><br>Tel: +1-800-555-0193</p></div>
		<div>
			<h3>Hours</h3>
		</div>
		<div>Weekdays: 6:00am - 6:00pm<br>Saturday: 7:00am - 7:00pm<br>Closed on Sundays</div>
	</div>

	<div id="Copyright" class="center">
		<h5>&copy; 2020, Amazon Web Services, Inc. or its Affiliates. All rights reserved.</h5>
	</div>
</body>
</html>
>>>>>>> 9be27d2d9823b57fd9fe6282fd8f7e418e97a8fc
=======
<?php
// Default parameter to control server info display
$showServerInfo = false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooman Restaurant</title>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Pacifico&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
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
            padding: 1rem;
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
            position: relative;
        }

        .topnav a:hover {
            background: #ff8c00;
            transform: scale(1.05) translateY(-3px);
            color: #fff5e1;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .topnav a i {
            margin-right: 0.5rem;
            transition: transform 0.3s ease;
        }

        .topnav a:hover i {
            transform: scale(1.2);
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .gallery-grid img {
            width: 100%;
            height: 287.5px; /* 15% larger than 250px */
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .gallery-grid img:hover {
            transform: scale(1.05);
        }

        .intro-text {
            text-align: center;
            padding: 2rem;
            font-size: 1.2rem;
            animation: fadeIn 1.5s ease-in;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 images per row */
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .feature-item {
            text-align: center;
            transition: transform 0.3s ease;
        }

        .feature-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .feature-item img {
            width: 100%;
            height: 250px; /* Increased to match gallery and fill grid */
            object-fit: cover;
            border-radius: 10px;
        }

        /* About Us & Contact */
        .section {
            padding: 3rem 1rem;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .section h2 {
            color: #d43f3a;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            animation: fadeInUp 1s ease-out;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            align-items: center;
        }

        .about-grid img {
            width: 100%;
            max-width: 320px; /* Decreased by 20% from 400px */
            border-radius: 15px;
        }

        /* Footer */
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

        /* Animations */
        @keyframes slideIn {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-header { font-size: 2rem; padding: 1rem; }
            .topnav { flex-direction: column; padding: 0.5rem; }
            .about-grid { grid-template-columns: 1fr; }
            .gallery-grid { grid-template-columns: 1fr; }
            .feature-grid { grid-template-columns: repeat(2, 1fr); } /* 2 images per row */
        }

        @media (max-width: 480px) {
            .main-header { font-size: 1.5rem; }
            .intro-text { font-size: 1rem; }
            .section h2 { font-size: 1.5rem; }
            .feature-grid { grid-template-columns: 1fr; } /* 1 image per row */
        }
    </style>
</head>
<body>
    <!-- Home Section -->
    <div id="home">
        <!-- Header -->
        <header class="main-header">
            <h1>Rooman Restaurant</h1>
        </header>

        <!-- Navigation -->
        <nav class="topnav">
            <a href="#home"><i class="fas fa-home"></i> Home</a>
            <a href="#about"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="#contact"><i class="fas fa-phone-alt"></i> Contact</a>
            <a href="menu.php"><i class="fas fa-utensils"></i> Menu</a>
            <a href="orderHistory.php"><i class="fas fa-history"></i> Order History</a>
        </nav>
    </div>

    <!-- PHP Includes -->
    <?php
        // Include application parameters
        include('getAppParameters.php');

        // Display server metadata if enabled
        if ($showServerInfo) {
            include('serverInfo.php');
        }
    ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="gallery-grid">
            <img src="https://static.vecteezy.com/system/resources/thumbnails/053/315/407/small_2x/sizzling-tandoori-chicken-indian-clay-oven-roast-spices-cilantro-lemons-onions-photo.jpeg" alt="Tandoori Chicken">
            <img src="https://www.allaboutsikhs.com/wp-content/uploads/2021/02/authentic-chicken-biryani.jpg" alt="Chicken Biryani">
        </div>

        <p class="intro-text">
            Welcome to Rooman Restaurant – where every bite is a celebration of bold spices, rich traditions, and unforgettable flavors. Indulge in our signature non-vegetarian dishes, from sizzling tandoori chicken to fragrant, slow-cooked biryanis. Whether you're craving the heat of our spices or the warmth of our hospitality, Rooman promises a dining experience that delights the senses and leaves you coming back for more.


        </hp>

        <div class="feature-grid">
            <div class="feature-item">
                <img src="https://lifeloveandgoodfood.com/wp-content/uploads/2020/04/Chicken-Shawarma_09_1200x1200.jpg" alt="Chicken Shawarma">
            </div>
            <div class="feature-item">
                <img src="https://i.ytimg.com/vi/naf0rfUjr_A/maxresdefault.jpg" alt="Butter Chicken">
            </div>
            <div class="feature-item">
                <img src="https://www.whiskaffair.com/wp-content/uploads/2023/02/Shrimp-Masala-2-3-500x500.jpg" alt="Shrimp Masala">
            </div>
            <div class="feature-item">
                <img src="https://1.bp.blogspot.com/-dmr7TvaMJ7c/WRyLh1RZjlI/AAAAAAAAIF4/uPHo3WFtctE8ZS34-s0mkRyNRkU-2-SzgCLcB/s1600/0000000000000000000000A%2B%25281%2529.jpg" alt="Chicken Tikka">
            </div>
            <div class="feature-item">
                <img src="https://tse1.mm.bing.net/th?id=OIP.9u7G7tUjXLrSx8n4ZMdcLQHaE8&pid=Api&P=0&h=180" alt="Kebab">
            </div>
            <div class="feature-item">
                <img src="https://cf-img-a-in.tosshub.com/sites/visualstory/wp/2023/11/egg-curry.jpg?size=*:900" alt="Egg Curry">
            </div>
        </div>
    </main>

    <!-- About Us -->
    <section id="about" class="section">
        <h2>About Us</h2>
        <div class="about-grid">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSh5Op4dtTEomIv2T2H6vsB4XToS3J7znkQQw&s" alt="Restaurant Interior">
            <p>
                At Rooman Restaurant, we’ve been serving comfort and flavor since 2020. Frank’s cherished recipes, handed down from his mother, are made with fresh ingredients to bring out nostalgic tastes. Stop by for a warm welcome from Frank and Martha—you’re family here!
            </p>
        </div>
    </section>

    <!-- Contact Us -->
    <section id="contact" class="section">
        <h2>Contact Us</h2>
        <img src="https://rooman.com/wp-content/uploads/2024/03/Rooman-Logo-2.png" alt="Rooman Logo" width="120">
        <p>
            123 Any Street<br>
            Any Town, India<br><br>
            Tel: +91 9143143143
        </p>
        <h3>Hours</h3>
        <p>
            Weekdays: 11:00am - 10:00pm<br>
            Weekends: 11:00am - 11:00pm<br>
            
        </p>
    </section>

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
>>>>>>> e21b1fd12a5e0b02d5091f27b236d0aaceb579fe
