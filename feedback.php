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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $setting_r['site_title'] ?> | Feedback</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
     * { box-sizing: border-box; margin: 0; padding: 0; }
     body { font-family: 'Montserrat', sans-serif; background: #f4f7f9; color: #333; }
     a { text-decoration: none; color: inherit; }

     header { background: #004080; color: #fff; padding: 15px 20px; box-shadow: 0 3px 6px rgba(0,0,0,0.1); }
     .header-content { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; flex-wrap: wrap; }
     .header-content h1 { flex: 1; text-align: center; font-size: 1.8rem; }
     .logo { height: 60px; }

     nav ul { display: flex; justify-content: center; list-style: none; margin-top: 10px; flex-wrap: wrap; gap: 10px; }
     nav ul li a { color: #fff; font-weight: 600; padding: 8px 12px; border-radius: 4px; transition: background 0.3s; }
     nav ul li a:hover, nav ul li a.active { background: #fff; color: #004080; }
     .dropdown { position: relative; }
     .dropdown:hover .dropdown-menu { display: block; }
     .dropdown-menu { display: none; position: absolute; top: 100%; left: 0; background: #004080; border-radius: 6px; overflow: hidden; min-width: 160px; }
     .dropdown-menu li a { display: block; padding: 10px; color: #fff; }
     .dropdown-menu li a:hover { background: #0066cc; }

     main { max-width: 900px; margin: 40px auto; padding: 0 20px; }
     h2.section-title { text-align: center; color: #004080; font-size: 2rem; margin-bottom: 25px; }

     .feedback-section {
       background: #fff; padding: 25px; border-radius: 15px;
       box-shadow: 0 8px 25px rgba(0,0,0,0.1); margin-bottom: 30px;
     }

     .feedback-info { text-align: center; margin-bottom: 20px; font-size: 1rem; line-height: 1.6; }

     .form-group { margin-bottom: 20px; }
     label { display: block; font-weight: 600; margin-bottom: 6px; }
     select, textarea {
       width: 100%; padding: 12px 15px; border-radius: 8px;
       border: 1px solid #ccc; font-size: 1rem; transition: border-color 0.3s, box-shadow 0.3s;
     }

     select:focus, textarea:focus {
       border-color: #004080; box-shadow: 0 0 8px rgba(0,64,128,0.2); outline: none;
     }

     textarea { min-height: 120px; resize: vertical; }

     .submit-btn {
       background-color: #004080; color: #fff; font-weight: 600;
       padding: 12px 25px; border: none; border-radius: 10px;
       cursor: pointer; font-size: 1rem; transition: background 0.3s, transform 0.2s;
       display: block; margin: 0 auto;
     }

     .submit-btn:hover { background-color: #2b3a67; transform: translateY(-2px); }

     .anonymous-note { text-align: center; margin-top: 10px; font-size: 0.9rem; color: #666; }

     footer { background-color: #004080; color: #fff; text-align: center; padding: 15px 0; margin-top: 40px; }

     @media(max-width:768px) {
       .header-content { flex-direction: column; gap: 10px; }
       nav ul { flex-direction: column; align-items: center; }
       .feedback-section { padding: 15px; }
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
        <a href="event.php">Events ▾</a>
        <ul class="dropdown-menu">
          <li><a href="#upcoming" onclick="showSection('upcoming')">Upcoming</a></li>
          <li><a href="#past" onclick="showSection('past')">Past</a></li>
        </ul>
      </li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="help_desk.php">Help Desk</a></li>
      <li><a href="feedback.php" class="active">Feedback</a></li>
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

<!-- SUCCESS ALERT -->
<div id="successAlert" 
     style="display:none; opacity:0; background:#4CAF50; color:white; padding:15px; 
            border-radius:8px; margin-bottom:15px; text-align:center; position:relative;">
    Feedback submitted successfully!
    <button onclick="document.getElementById('successAlert').style.display='none';" 
            style="position:absolute; right:10px; top:8px; background:none; border:none; color:white; font-size:18px; cursor:pointer;">×</button>
</div>

<!-- ERROR ALERT -->
<div id="errorAlert" 
     style="display:none; opacity:0; background:#f44336; color:white; padding:15px; 
            border-radius:8px; margin-bottom:15px; text-align:center; position:relative;">
    Something went wrong! Try again later.
    <button onclick="document.getElementById('errorAlert').style.display='none';" 
            style="position:absolute; right:10px; top:8px; background:none; border:none; color:white; font-size:18px; cursor:pointer;">×</button>
</div>

<h2 class="section-title">Anonymous Club Feedback</h2>

<div class="feedback-section">
  <div class="feedback-info">
    <p>Your feedback helps us improve our clubs and events. All submissions are anonymous.</p>
  </div>

  <!-- Feedback Form -->
  <form id="feedbackForm" method="POST" action="">
    <div class="form-group">
      <label for="clubSelect">Choose Your Club</label>
      <select id="clubSelect" name="club" required>
        <option value="">-- Select a Club --</option>
        <option value="literary">Literary Society</option>
        <option value="red-cross">Bhutan Red Cross Society</option>
        <option value="tarayana">Tarayana</option>
        <option value="y-peer">Y-Peer</option>
        <option value="carpentry">Carpentry</option>
        <option value="electrical">Electrical</option>
        <option value="beautification">Campus Beautification</option>
        <option value="other">Other</option>
      </select>
    </div>

    <div class="form-group">
      <label for="feedbackText">Your Feedback</label>
      <textarea id="feedbackText" name="feedback" placeholder="Type your feedback here..." required></textarea>
    </div>

    <button type="submit" name="send" class="submit-btn">Submit Feedback</button>
    <p class="anonymous-note">Your identity is not required</p>
  </form>
</div>

</main>


<?php
/* ---------- HANDLE FORM SUBMISSION ---------- */
if (isset($_POST['send'])) {

    $frm_data = filteration($_POST);

    $q = "INSERT INTO `feedback`(`club`, `feedback`) VALUES (?,?)";
    $values = [$frm_data['club'], $frm_data['feedback']];
    $res = insert($q, $values, 'ss');

    if ($res == 1) {
        // SUCCESS ALERT SCRIPT
        echo "<script>
            window.addEventListener('DOMContentLoaded', function(){
                const box = document.getElementById('successAlert');
                box.style.display = 'block';
                setTimeout(() => { box.style.opacity = 1; }, 50);

                setTimeout(() => {
                    box.style.opacity = 0;
                    setTimeout(() => box.style.display = 'none', 600);
                }, 3000);

                document.getElementById('feedbackForm').reset();
            });
        </script>";
    } else {
        // ERROR ALERT SCRIPT
        echo "<script>
            window.addEventListener('DOMContentLoaded', function(){
                const box = document.getElementById('errorAlert');
                box.style.display = 'block';
                setTimeout(() => { box.style.opacity = 1; }, 50);

                setTimeout(() => {
                    box.style.opacity = 0;
                    setTimeout(() => box.style.display = 'none', 600);
                }, 3000);
            });
        </script>";
    }
}
?>

<footer>
  <p>©2025 Samtse College - <?php echo $setting_r['site_title'] ?></p>
</footer>
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
