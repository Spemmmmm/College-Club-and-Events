<?php
session_start();




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
<title><?php echo $setting_r['site_title'] ?></title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
<style>
/* Reset & Base */
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

/* Slideshow */
.slideshow {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 40px;
    height: 450px; /* fixed height */
}

.slider img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute; /* stack images */
    top: 0;
    left: 0;
    opacity: 0;
    transition: opacity 1s ease-in-out;
    border-radius: 12px;
}

.slider img.active {
    opacity: 1;
}

.side-quote {
    position: absolute;
    bottom: 20px;
    left: 20px;
    background: rgba(0, 64, 128, 0.85);
    color: #fff;
    padding: 15px 20px;
    border-radius: 8px;
    font-style: italic;
    font-size: 1.1rem;
    z-index: 10; /* ensure it is on top of images */
}


/* Dashboard Stats */
.stats { display: flex; justify-content: space-around; gap: 20px; margin-bottom: 40px; flex-wrap: wrap; }
.stat-card { background: #fff; flex: 1; min-width: 200px; text-align: center; padding: 30px 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s; }
.stat-card:hover { transform: translateY(-5px); box-shadow: 0 6px 20px rgba(0,0,0,0.15); }
.stat-card h2 { font-size: 2.5rem; color: #004080; margin-bottom: 5px; }
.stat-card p { font-size: 1rem; font-weight: 600; color: #666; }

/* Event Cards */
.events-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px; }
.event-card { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s; position: relative; overflow: hidden; }
.event-card:hover { transform: translateY(-5px); box-shadow: 0 6px 20px rgba(0,0,0,0.15); }
.event-card img { width: 100%; height: 150px; object-fit: cover; border-radius: 10px; margin-bottom: 10px; transition: transform 0.3s ease, filter 0.3s ease; }
.event-card:hover img { transform: scale(1.05); filter: brightness(1.1); }
.event-card h3 { font-size: 1.2rem; margin-bottom: 10px; color: #004080; }
.event-card p { font-size: 0.95rem; color: #555; margin-bottom: 10px; }
.countdown { font-weight: bold; font-size: 1.1rem; display: inline-block; transition: transform 0.3s ease, opacity 0.3s ease; }
.countdown.update { transform: translateY(-10px); opacity: 0.3; }
.countdown.update.done { transform: translateY(0); opacity: 1; }
.progress-container { background: #e0e0e0; border-radius: 10px; height: 8px; width: 100%; overflow: hidden; margin-top: 10px; }
.progress-bar { height: 100%; background: #0066cc; width: 0%; border-radius: 10px; transition: width 1s linear; }

/* Past Events Carousel */
.past-events { margin-bottom: 50px; }
.carousel-container { overflow-x: auto; display: flex; gap: 20px; scroll-behavior: smooth; padding-bottom: 10px; -webkit-overflow-scrolling: touch; cursor: grab; }
.carousel-container:active { cursor: grabbing; }
.past-event-card { min-width: 250px; flex: 0 0 auto; border-radius: 12px; cursor: grab; overflow: hidden; position: relative; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s; }
.past-event-card:hover { transform: translateY(-5px); box-shadow: 0 6px 20px rgba(0,0,0,0.15); }
.past-event-card img { width: 100%; height: 150px; object-fit: cover; display: block; }
.overlay { position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,64,128,0.85); color: #fff; padding: 15px; transform: translateY(100%); transition: transform 0.3s ease; font-size: 0.9rem; }
.past-event-card:hover .overlay { transform: translateY(0); }
.overlay h4 { margin-bottom: 5px; font-size: 1.1rem; }
.overlay .countdown { font-weight: bold; font-size: 0.95rem; color: #ffcc00; }
.overlay p { margin-bottom: 5px; }

/* Feedback CTA */
.feedback-cta { text-align: center; margin: 50px 0; }
.feedback-cta a { display: inline-block; background: #004080; color: #fff; padding: 20px 30px; font-size: 1.2rem; border-radius: 8px; transition: background 0.3s; }
.feedback-cta a:hover { background: #0066cc; }

/* Footer */
.footer { background: #004080; color: #fff; text-align: center; padding: 20px 0; font-size: 0.9rem; margin-top: 40px; }

/* Responsive */
@media (max-width: 768px) { .header-content { flex-direction: column; gap: 10px; } nav ul { flex-direction: column; } .side-quote { font-size: 1rem; padding: 10px 15px; } }
</style>
</head>
<body>

<header>
  <div class="header-content">
    <img src="assets/images/Logos/cropped_circle_image.png" style="height: 120px;" class="logo" />
    <h1><?php echo $setting_r['site_title'] ?></h1>
    <img src="assets/images/Logos/SCE Final LogoEdited.png" style="height: 120px; class="logo" />
    <div class="hamburger" id="hamburger">&#9776;</div>
  </div>
  
  <nav id="nav-menu">
    <ul>
      <li><a href="index.php" class="active">Home</a></li>
      <li><a href="about.php">About Us</a></li>
      <li><a href="clubs.php">Clubs</a></li>
      <li class="dropdown">
        <a href="event.php">Events ▾</a>
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
  <!-- Slideshow -->
<div class="slideshow">
    <div class="slider">
        <?php
        $res = selectAll('carousel');
        $first = true;
        while ($row = mysqli_fetch_assoc($res)) {
            $path = CAROUSEL_IMG_PATH;
            $active = $first ? "active" : "";
            echo "<img src='$path$row[image]' alt='Campus Image' class='$active'>";
            $first = false;
        }
        ?>
    </div>
    <aside class="side-quote">"Explore Clubs, Engage in Events, Enrich College Life."</aside>
</div>


  <!-- Dashboard Stats -->
 <div class="stats">

    <!-- Total Clubs -->
    <div class="stat-card">
        <h2>
            <?php
                $clubs = mysqli_query($con, "SELECT COUNT(*) AS total FROM rooms");
                $clubCount = mysqli_fetch_assoc($clubs)['total'];
                echo $clubCount;
            ?>
        </h2>
        <p>Total Clubs</p>
    </div>

    <!-- Upcoming Events -->
    <div class="stat-card">
        <h2>
            <?php
                $today = date("Y-m-d");
                $upcoming = mysqli_query($con, "SELECT COUNT(*) AS total FROM event WHERE dateofevent > '$today'");
                $upcomingCount = mysqli_fetch_assoc($upcoming)['total'];
                echo $upcomingCount;
            ?>
        </h2>
        <p>Upcoming Events</p>
    </div>

    <!-- Past Events -->
    <div class="stat-card">
        <h2>
            <?php
                $past = mysqli_query($con, "SELECT COUNT(*) AS total FROM event WHERE dateofevent < '$today'");
                $pastCount = mysqli_fetch_assoc($past)['total'];
                echo $pastCount;
            ?>
        </h2>
        <p>Past Events</p>
    </div>

    <!-- Total Participants (optional) -->
    <div class="stat-card">
        <h2>
          <?php
          $student_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM student"))['total'];
          echo $student_count;
          ?>
        </h2>
        <p>Student Participants</p>
    </div>

</div>


  <!-- Upcoming Events with images -->
  <h2 class="section-title">Upcoming Events</h2>
<div class="events-grid">
  <?php
  // Get today's date in the format YYYY-MM-DD
   $sql = "SELECT * FROM event WHERE dateofevent > NOW() ORDER BY dateofevent DESC LIMIT 2";
      $res = mysqli_query($con, $sql);
  $path = EVENT_IMG_PATH;

  while ($row = mysqli_fetch_assoc($res)) {
    echo <<<HTML
    <div class="event-card" data-date="$row[dateofevent]">
      <img src="$path$row[picture]" alt="$row[name]">
      <h3>$row[name]</h3>
      <p>$row[desc]</p>
      <div class="countdown"></div>
      <div class="progress-container"><div class="progress-bar"></div></div>
    </div>
    HTML;
  }
  ?>
</div>



  <!-- Past Events Carousel -->
  <h2 class="section-title">Past Events</h2>
<div class="past-events">
  <div class="carousel-container">
    <?php
      $path = EVENT_IMG_PATH;

      // Direct SQL — ensures only past events are selected
      $sql = "SELECT * FROM event WHERE dateofevent < NOW() ORDER BY dateofevent DESC LIMIT 2";
      $res = mysqli_query($con, $sql);

      while ($row = mysqli_fetch_assoc($res)) {
        echo <<<HTML
        <div class="past-event-card">
          <img src="{$path}{$row['picture']}" alt="{$row['name']}">
          <div class="overlay">
            <h4>{$row['name']}</h4>
            <p>{$row['desc']}</p>
            <div class="countdown"></div>
            <div class="progress-container">
              <div class="progress-bar"></div>
            </div>
          </div>
        </div>
HTML;
      }
    ?>
  </div>
</div>
    </div>
  </div>

  <!-- Feedback CTA -->
  <div class="feedback-cta">
    <a href="feedback.php" role="button">Feedback: <small>Leave your suggestion here.</small></a>
  </div>
</main>

<footer class="footer">
  <p>©2025 Samtse College - <?php echo $setting_r['site_title'] ?></p>
</footer>

<script>
// Slideshow
// Slideshow
const slides = document.querySelectorAll('.slider img');
let current = 0;

setInterval(() => {
    slides[current].classList.remove('active');
    current = (current + 1) % slides.length;
    slides[current].classList.add('active');
}, 4000);

// Animated countdown
const animateCountdown = (element, text) => {
  element.classList.add('update');
  setTimeout(() => {
    element.textContent = text;
    element.classList.remove('update');
    element.classList.add('done');
    setTimeout(() => element.classList.remove('done'), 300);
  }, 200);
};

const updateCountdowns = () => {
  const now = new Date();
  document.querySelectorAll('.event-card, .past-event-card').forEach(card => {
    const eventDate = new Date(card.dataset.date);
    const countdownDiv = card.querySelector('.countdown');
    const progressBar = card.querySelector('.progress-bar');

    const diff = eventDate - now;

    if(diff > 0){
      const days = Math.floor(diff / (1000*60*60*24));
      const hours = Math.floor((diff/(1000*60*60)) % 24);
      const mins = Math.floor((diff/(1000*60)) % 60);
      animateCountdown(countdownDiv, `${days}d ${hours}h ${mins}m left`);
      countdownDiv.style.color = '#ffcc00';

      if(progressBar){
        const totalDuration = eventDate - (card.dataset.start ? new Date(card.dataset.start) : now - 1000*60*60*24*7);
        const elapsed = now - (card.dataset.start ? new Date(card.dataset.start) : now - 1000*60*60*24*7);
        const percent = Math.min((elapsed / totalDuration) * 100, 100);
        progressBar.style.width = `${percent}%`;
      }

    } else {
      animateCountdown(countdownDiv, "Completed");
      countdownDiv.style.color = '#ccc';
      if(progressBar){
        progressBar.style.width = '100%';
        progressBar.style.background = '#999';
      }
    }
  });
};
setInterval(updateCountdowns, 1000);
updateCountdowns();

// Past Events Carousel - Drag & Touch with Inertia
const carousel = document.querySelector('.carousel-container');
let isDown = false, startX, scrollLeft, velocity = 0, momentumID;

const startDrag = (x) => {
  isDown = true;
  startX = x - carousel.offsetLeft;
  scrollLeft = carousel.scrollLeft;
  cancelMomentumTracking();
};

const stopDrag = () => {
  isDown = false;
  beginMomentumTracking();
};

const onDrag = (x) => {
  if(!isDown) return;
  const dx = x - startX;
  const prevScroll = carousel.scrollLeft;
  carousel.scrollLeft = scrollLeft - dx;
  velocity = carousel.scrollLeft - prevScroll;
};

// Momentum
const beginMomentumTracking = () => {
  cancelMomentumTracking();
  momentumID = requestAnimationFrame(momentumLoop);
};
const cancelMomentumTracking = () => {
  cancelAnimationFrame(momentumID);
};

const momentumLoop = () => {
  carousel.scrollLeft += velocity;
  velocity *= 0.95; // friction
  if(Math.abs(velocity) > 0.5){
    momentumID = requestAnimationFrame(momentumLoop);
  }
};

// Mouse Events
carousel.addEventListener('mousedown', e => startDrag(e.pageX));
carousel.addEventListener('mouseup', stopDrag);
carousel.addEventListener('mouseleave', stopDrag);
carousel.addEventListener('mousemove', e => onDrag(e.pageX));

// Touch Events
carousel.addEventListener('touchstart', e => startDrag(e.touches[0].pageX));
carousel.addEventListener('touchend', stopDrag);
carousel.addEventListener('touchmove', e => onDrag(e.touches[0].pageX));
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
