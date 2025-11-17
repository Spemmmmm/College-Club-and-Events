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
<title><?php echo $setting_r['site_title']; ?> | About Us</title>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

<style>
* { box-sizing: border-box; margin: 0; padding: 0; } body { font-family: 'Montserrat', sans-serif; background: #f4f7f9; color: #333; } a { text-decoration: none; color: inherit; } /* Header */ header { background: #004080; color: #fff; padding: 15px 20px; box-shadow: 0 3px 6px rgba(0,0,0,0.1); } .header-content { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; flex-wrap: wrap; } .header-content h1 { flex: 1; text-align: center; font-size: 1.8rem; } .logo { height: 60px; } /* Navigation */ nav ul { display: flex; justify-content: center; list-style: none; margin-top: 10px; flex-wrap: wrap; gap: 10px; } nav ul li a { color: #fff; font-weight: 600; padding: 8px 12px; border-radius: 4px; transition: background 0.3s; } nav ul li a:hover, nav ul li a.active { background: #fff; color: #004080; } .dropdown { position: relative; } .dropdown:hover .dropdown-menu { display: block; } .dropdown-menu { display: none; position: absolute; top: 100%; left: 0; background: #004080; border-radius: 6px; overflow: hidden; min-width: 160px; } .dropdown-menu li a { display: block; padding: 10px; color: #fff; } .dropdown-menu li a:hover { background: #0066cc; } /* Container */ .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; } .section-title { font-size: 1.8rem; color: #004080; margin-bottom: 20px; text-align: center; } .about-columns { display: flex; gap: 20px; flex-wrap: wrap; align-items: flex-start; margin-bottom: 50px; } .about-columns > div { flex: 2; min-width: 300px; background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); opacity: 0; transform: translateY(30px); transition: all 0.6s ease-out; } .about-columns p { transition: transform 0.3s ease, box-shadow 0.3s ease; } .about-columns p:hover { transform: translateY(-3px); box-shadow: 0 4px 10px rgba(0,0,0,0.08); } .about-columns ul li { transition: color 0.3s, transform 0.3s; } .about-columns ul li:hover { color: #004080; transform: translateX(5px); } .about-columns aside { flex: 1; min-width: 250px; background: #fff; padding: 0; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); overflow: hidden; position: relative; opacity: 0; transform: translateY(30px); transition: all 0.6s ease-out; } /* About Image Overlay & Zoom */ .about-columns aside img { width: 100%; height: 350px; object-fit: cover; display: block; transition: transform 0.4s ease; } .about-columns aside:hover img { transform: scale(1.05); } .about-columns aside .overlay { position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,64,128,0.8); color: #fff; padding: 15px; text-align: center; transform: translateY(100%); transition: transform 0.3s ease; font-weight: 600; } .about-columns aside:hover .overlay { transform: translateY(0); } /* Team members */ .team-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); gap: 20px; margin-top: 30px; } .team-member { background: #fff; border-radius: 12px; padding: 20px; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: transform 0.3s, box-shadow 0.3s, opacity 0.6s ease, transform 0.6s ease; position: relative; overflow: hidden; opacity: 0; transform: translateY(30px); } .team-member:hover { transform: translateY(-5px); box-shadow: 0 6px 20px rgba(0,0,0,0.12); } /* Team member overlay & zoom */ .team-member img { width: 120px; height: 120px; object-fit: cover; border-radius: 50%; margin-bottom: 12px; border: 3px solid #004080; transition: transform 0.4s ease; } .team-member:hover img { transform: scale(1.1); } .team-member .overlay { position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,64,128,0.85); color: #fff; padding: 10px; transform: translateY(100%); transition: transform 0.3s ease; font-weight: 500; font-size: 0.9rem; border-radius: 0 0 12px 12px; } .team-member:hover .overlay { transform: translateY(0); } .member-name { font-weight: 600; color: #004080; margin-bottom: 8px; } .member-contact p { font-size: 0.9rem; margin: 3px 0; color: #555; } .footer { background: #004080; color: #fff; text-align: center; padding: 20px 0; font-size: 0.9rem; margin-top: 40px; } .reveal { opacity: 0; transform: translateY(30px); transition: all 0.6s ease-out; } .reveal.active { opacity: 1; transform: translateY(0); } @media(max-width: 768px){ .about-columns { flex-direction: column; } .header-content h1 { text-align: center; margin: 10px 0; } nav ul { flex-direction: column; } }
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
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php" class="active">About Us</a></li>
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

  <h2 class="section-title reveal">About Us</h2>

  <div class="about-columns">
   <div class="reveal">
      <p><strong>Welcome to the College Clubs and Events portal</strong>. A one-stop platform to explore the vibrant life beyond the classroom. Our college is home to diverse clubs and societies that bring together students with shared passions, talents, and aspirations.</p>

      <p style="margin-top:8px;">This website is designed to showcase club activities, upcoming events, workshops, and competitions while providing students the opportunity to participate and engage.</p>

      <p>Through this initiative, we aspire to:</p>
      <ul>
        <li>Apply classroom knowledge in a practical and collaborative way.</li>
        <li>Showcase opportunities and activities available to every student.</li>
        <li>Contribute to building a stronger sense of community on campus.</li>
      </ul>

      <p>This project is not just an academic requirement but also a step toward preparing ourselves as future ICT educators who can integrate creativity, technology, and innovation into meaningful teaching and learning.</p>
    </div>

    <aside class="reveal">
      <img src="assets/images/image.jpg" alt="College Activity">
      <div class="overlay">College Activity Snapshot</div>
    </aside>
  </div>

  <h3 class="section-title reveal">Meet our Team</h3>

  <div class="team-grid">

    <?php
      $res = selectAll('member');
      $path = MEMBER_IMG_PATH;

      while($row = mysqli_fetch_assoc($res))
      {
        echo <<<HTML
        <div class="team-member reveal">
          <img src="$path{$row['picture']}" alt="{$row['name']}">
          <div class="member-name">{$row['name']}</div>
          <div class="member-contact">
            <p>{$row['email']}</p>
            <p>+975 {$row['phoneno']}</p>
          </div>
          <div class="overlay">{$row['class']}</div>
        </div>
HTML;
      }
    ?>

    
  </div>
</main>

<footer class="footer">
  <div class="container">©2025 Samtse College - Clubs and Events Platform</div>
</footer>

<script>
// Scroll reveal animation
const revealElements = document.querySelectorAll('.reveal');

function revealOnScroll() {
  const windowHeight = window.innerHeight;
  revealElements.forEach(el => {
    const pos = el.getBoundingClientRect().top;
    if (pos < windowHeight - 120) {
      el.classList.add('active');
    }
  });
}

window.addEventListener('scroll', revealOnScroll);
window.addEventListener('load', revealOnScroll);
</script>

</body>
</html>
