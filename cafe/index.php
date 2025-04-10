<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Rooman Restaurant</title>

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

    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
      margin: 2rem 0;
    }

    .gallery-grid img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease;
    }

    .gallery-grid img:hover {
      transform: scale(1.05);
    }

    .feature-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
      margin: 2rem 0;
    }

    .feature-item {
      background: rgba(255, 255, 255, 0.9);
      padding: 1rem;
      border-radius: 10px;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .feature-item:hover {
      transform: translateY(-10px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .feature-item img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
    }

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
    }

    .about-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      align-items: center;
    }

    .about-grid img {
      width: 100%;
      max-width: 400px;
      border-radius: 15px;
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
      .about-grid { grid-template-columns: 1fr; }
      .gallery-grid, .feature-grid { grid-template-columns: 1fr; }
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
    <div class="gallery-grid">
      <img src="https://static.vecteezy.com/system/resources/thumbnails/053/315/407/small_2x/sizzling-tandoori-chicken-indian-clay-oven-roast-spices-cilantro-lemons-onions-photo.jpeg" alt="Tandoori Chicken">
      <img src="https://www.allaboutsikhs.com/wp-content/uploads/2021/02/authentic-chicken-biryani.jpg" alt="Chicken Biryani">
    </div>

    <div class="feature-grid">
      <div class="feature-item">
        <img src="https://lifeloveandgoodfood.com/wp-content/uploads/2020/04/Chicken-Shawarma_09_1200x1200.jpg" alt="Shawarma">
      </div>
      <div class="feature-item">
        <img src="https://i.ytimg.com/vi/naf0rfUjr_A/maxresdefault.jpg" alt="Butter Chicken">
      </div>
      <div class="feature-item">
        <img src="https://www.whiskaffair.com/wp-content/uploads/2023/02/Shrimp-Masala-2-3-500x500.jpg" alt="Shrimp Masala">
      </div>
      <div class="feature-item">
        <img src="https://1.bp.blogspot.com/-dmr7TvaMJ7c/WRyLh1RZjlI/AAAAAAAAIF4/uPHo3WFtctE8ZS34-s0mkRyNRkU-2-SzgCLcB/s1600/0000000000000000000000A%2B%25281%2529.jpg" alt="Tikka">
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
      <img src="https://wikibio.in/wp-content/uploads/2017/12/Allu-Arjun-having-chicken-biryani.jpg">
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
      Any Town, INDIA<br><br>
      Tel: +1-800-555-0193
    </p>
    <h3>Hours</h3>
    <p>
      Weekdays: 11:00am - 10:00pm<br>
      Weekend: 11:00am - 12:00pm<br>
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
