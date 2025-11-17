<?php
session_start();
date_default_timezone_set("Asia/Kolkata");



require('admin/partials/db_config.php');
require('admin/partials/essentials.php');


$setting_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$setting_r = mysqli_fetch_assoc(select($setting_q, $values, 'i'));

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $setting_r['site_title'] ?> | Events</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Montserrat', sans-serif; background: #f4f7f9; color: #333; }
a { text-decoration: none; color: inherit; }

/* Header */
header { background: #004080; color: #fff; padding: 15px 20px; box-shadow: 0 3px 6px rgba(0,0,0,0.1); }
.header-content { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; flex-wrap: wrap; }
.header-content h1 { flex: 1; text-align: center; font-size: 1.8rem; }
.logo { height: 60px; }

/* Navigation */
nav ul { display: flex; justify-content: center; list-style: none; margin-top: 10px; flex-wrap: wrap; gap: 10px; }
nav ul li a { color: #fff; font-weight: 600; padding: 8px 12px; border-radius: 4px; transition: background 0.3s; }
nav ul li a:hover, nav ul li a.active { background: #fff; color: #004080; }
.dropdown { position: relative; }
.dropdown:hover .dropdown-menu { display: block; }
.dropdown-menu { display: none; position: absolute; top: 100%; left: 0; background: #004080; border-radius: 6px; overflow: hidden; min-width: 160px; }
.dropdown-menu li a { display: block; padding: 10px; color: #fff; }
.dropdown-menu li a:hover { background: #0066cc; }


/* Container */
.container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }

.section-title {
  font-size: 2rem;
  color: #004080;
  text-align: center;
  margin-bottom: 20px;
}

.events-nav {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-bottom: 20px;
}

.events-nav-btn {
  padding: 10px 20px;
  border: none;
  border-radius: 25px;
  background-color: #2b3a67;
  color: #fff;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s;
}

.events-nav-btn:hover {
  background-color: #4a5aa1;
}

.events-nav-btn.active {
  background-color: #4a5aa1;
}

/* Carousel Styles */
.carousel-container {
  position: relative;
  overflow: hidden;
  width: 100%;
  margin-bottom: 40px;
}

.carousel-track {
  display: flex;
  transition: transform 0.5s ease;
  gap: 20px;
}

.carousel-item {
  min-width: 260px;
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  cursor: pointer;
  overflow: hidden;
  transition: transform 0.3s, box-shadow 0.3s;
}

.carousel-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.carousel-item img {
  width: 100%;
  height: 160px;
  object-fit: cover;
}

.carousel-item-content {
  padding: 12px 16px;
}

.carousel-item-content h3 {
  font-size: 18px;
  color: #2b3a67;
  margin: 5px 0;
}

.carousel-item-content p {
  font-size: 14px;
  margin: 3px 0;
}

.date-badge {
  display: inline-block;
  padding: 5px 10px;
  background: #004080;
  color: #fff;
  border-radius: 20px;
  font-weight: 600;
  margin-bottom: 5px;
  font-size: 13px;
}

/* Carousel Buttons */
.carousel-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: #004080;
  color: #fff;
  border: none;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  font-size: 20px;
  cursor: pointer;
  z-index: 10;
}

.carousel-btn:hover {
  background: #2b3a67;
}

#prevBtn { left: 0; }
#nextBtn { right: 0; }

/* Past Events Grid */
.events-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
}

.event-card {
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  width: 260px;
  cursor: pointer;
  overflow: hidden;
  transition: transform 0.3s, box-shadow 0.3s;
}

.event-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
  footer {
      background-color: #004080;
      color: #fff;
      text-align: center;
      padding: 15px 0;
      margin-top: 40px;
    }
.event-card img {
  width: 100%;
  height: 150px;
  object-fit: cover;
}

.event-card-content {
  padding: 12px 16px;
}

.register-btn {
  display: inline-block;
  margin-top: 10px;
  padding: 6px 14px;
  background: #004080;
  color: #fff;
  font-weight: 600;
  border-radius: 25px;
  text-decoration: none;
  transition: 0.3s;
}

.register-btn:hover {
  background: #2b3a67;
}

/* Section visibility */
.events-section { display: none; }
.events-section.active { display: block; }

/* Responsive */
@media(max-width:768px){
  .carousel-item { min-width: 200px; }
  .events-grid { justify-content: center; }
}
</style>
</head>
<body>
<header>
  <div class="header-content">
    <img src="assets/images/Logos/cropped_circle_image.png" style="height: 120px;" class="logo" />
    <h1><?php echo $setting_r['site_title'] ?></h1>
    <img src="assets/images/Logos/SCE Final LogoEdited.png" style="height: 120px;" class="logo" />
    <div class="hamburger" id="hamburger">&#9776;</div>
  </div>
  
  <nav id="nav-menu">
    <ul>
      <li><a href="index.php" class="active">Home</a></li>
      <li><a href="about.php">About Us</a></li>
      <li><a href="clubs.php">Clubs</a></li>
      <li class="dropdown">
        <a href="event.php" class="active">Events ▾</a>
        <ul class="dropdown-menu">
          <li><a href="#upcoming" onclick="showSection('upcoming')">Upcoming</a></li>
          <li><a href="#past" onclick="showSection('past')">Past</a></li>
        </ul>
      </li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="help_desk.php">Help Desk</a></li>
      <li><a href="feedback.php">Feedback</a></li>
      <li><a href="register.php">Club Registration</a></li>
      <li><a href="admin/index.php">Login</a></li>
    </ul>
  </nav>
</header>

<style>


/* Hamburger for mobile */
.hamburger {
  display: none;
  font-size: 2rem;
  cursor: pointer;
}

/* Mobile responsive */
@media (max-width: 992px) {
  h1 {
    text-align: center;
    font-size: 1.2rem;
    order: 2;
    flex-basis: 100%;
  }

  .header-content {
    justify-content: space-between;
  }

  nav ul {
    flex-direction: column;
    display: none;
    width: 100%;
  }

  nav ul li {
    text-align: center;
  }

  nav ul li .dropdown-menu {
    position: static;
    box-shadow: none;
  }

  .hamburger {
    display: block;
  }

  nav ul.show {
    display: flex;
  }
}
</style>

<main class="container">
<h2 class="section-title">College Events</h2>

<div class="events-nav">
<button class="events-nav-btn active" onclick="showSection('upcoming')">Upcoming Events</button>
<button class="events-nav-btn" onclick="showSection('past')">Past Events</button>
</div>

<!-- Upcoming Events Carousel -->
<div id="upcoming-section" class="events-section active">
  <div class="carousel-container">
    <button class="carousel-btn" id="prevBtn">&#10094;</button>

    <div class="carousel-track" id="upcoming-events">

      <?php
        // Fetch upcoming events (date > today)
        $sql = "SELECT * FROM event WHERE dateofevent > NOW() ORDER BY dateofevent ASC LIMIT 2";
        $res = mysqli_query($con, $sql);

        $path = EVENT_IMG_PATH;

        while ($row = mysqli_fetch_assoc($res)) {

          echo <<<HTML
          <div class="carousel-item">
            <img src="{$path}{$row['picture']}" alt="{$row['name']}">

            <div class="carousel-item-content">
              <span class="date-badge">Date of Event: {$row['dateofevent']}</span>
              <h3>{$row['name']}</h3>
              <p>{$row['desc']}</p>
            </div>
          </div>
HTML;
        }
      ?>

    </div>

    <button class="carousel-btn" id="nextBtn">&#10095;</button>
  </div>
</div>



<div id="past-section" class="events-section">
  <div class="carousel-container">
    <button class="carousel-btn" id="prevBtn">&#10094;</button>

    <div class="carousel-track" id="upcoming-events">

      <?php
        // Fetch upcoming events (date > today)
        $sql = "SELECT * FROM event WHERE dateofevent < NOW() ORDER BY dateofevent ASC LIMIT 2";
        $res = mysqli_query($con, $sql);

        $path = EVENT_IMG_PATH;

        while ($row = mysqli_fetch_assoc($res)) {

          echo <<<HTML
          <div class="carousel-item">
            <img src="{$path}{$row['picture']}" alt="{$row['name']}">

            <div class="carousel-item-content">
              <span class="date-badge">Date of Event: {$row['dateofevent']}</span>
              <h3>{$row['name']}</h3>
              <p>{$row['desc']}</p>
            </div>
          </div>
HTML;
        }
      ?>

    </div>

    <button class="carousel-btn" id="nextBtn">&#10095;</button>
  </div>
</div>
</main>
<br>
<br>
<footer class="footer">
  <p>©2025 Samtse College - <?php echo $setting_r['site_title'] ?></p>
</footer>

<script>


const today = new Date();
const upcomingContainer = document.getElementById('upcoming-events');
const pastContainer = document.getElementById('past-events');

// Separate upcoming and past events
const upcomingEvents = events.filter(e => new Date(e.date) >= today);
const pastEvents = events.filter(e => new Date(e.date) < today);


// Carousel functionality
let carouselIndex = 0;
const track = document.querySelector('.carousel-track');
const items = document.querySelectorAll('.carousel-item');
const totalItems = items.length;

document.getElementById('nextBtn').addEventListener('click', ()=>{
  carouselIndex = (carouselIndex + 1) % totalItems;
  track.style.transform = `translateX(-${carouselIndex * 280}px)`;
});

document.getElementById('prevBtn').addEventListener('click', ()=>{
  carouselIndex = (carouselIndex - 1 + totalItems) % totalItems;
  track.style.transform = `translateX(-${carouselIndex * 280}px)`;
});

// Section toggle
function showSection(section){
  const upcoming = document.getElementById('upcoming-section');
  const past = document.getElementById('past-section');
  const buttons = document.querySelectorAll('.events-nav-btn');

  if(section==='upcoming'){
    upcoming.classList.add('active'); past.classList.remove('active');
    buttons[0].classList.add('active'); buttons[1].classList.remove('active');
  }else{
    past.classList.add('active'); upcoming.classList.remove('active');
    buttons[1].classList.add('active'); buttons[0].classList.remove('active');
  }
}
</script>
<script>
// Toggle mobile menu
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('nav-menu').querySelector('ul');

hamburger.addEventListener('click', () => {
  navMenu.classList.toggle('show');
});
</script>
</body>
</html>
