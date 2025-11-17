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
  <title>College Club and Events | Clubs</title>
  <link rel="stylesheet" href="assets/css/styles.css" />
  <style>
   
  </style>
</head>
<body>

<header>
  <div class="header-content">
    <img src="assets/images/Logos/cropped_circle_image.png" style="height: 120px;" class="logo" />
    <h1><?php echo $setting_r['site_title'] ?></h1>
    <img src="assets/images/Logos/SCE Final LogoEdited.png" style="height: 120px;"v class="logo" />
    <div class="hamburger" id="hamburger">&#9776;</div>
  </div>
  
  <nav id="nav-menu">
    <ul>
      <li><a href="index.php" class="active">Home</a></li>
      <li><a href="about.php">About Us</a></li>
      <li><a href="clubs.php" class="active">Clubs</a></li>
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
  <h2 class="section-title">CLUBS</h2>

  <div class="clubs-list">

    <?php
      $clubs = selectAll('rooms');

      while ($row = mysqli_fetch_assoc($clubs)) {

          // Default thumbnail
          $club_thumb = CLUB_IMG_PATH . "thumbnail.png";

          // Fetch club thumb from database
          $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` 
                                         WHERE `club_id`='{$row['id']}' 
                                         AND `thumb`='1'");

          if (mysqli_num_rows($thumb_q) > 0) {
              $thumb_res = mysqli_fetch_assoc($thumb_q);
              $club_thumb = CLUB_IMG_PATH . $thumb_res['image'];
          }

          echo <<<HTML
          <div class="club-item">

            <div class="club-name">{$row['name']}</div>

            <div class="club-details">

              <div class="club-details-header">
                <img src="$club_thumb" class="club-details-image" alt="{$row['name']}">
                <div class="club-details-info">
                  <h2 class="club-details-name">{$row['name']}</h2>
                  <p class="club-details-description">{$row['desc']}</p>
                </div>
              </div>

              <div class="club-details-section">
                <h3>Purpose and Vision</h3>
                <p>{$row['purpose']}</p>
              </div>

              <div class="club-details-section">
                <h3>Key Activities</h3>
                <ul>
                  <li>{$row['activities']}</li>
                </ul>
              </div>

              <div class="club-details-section">
                <h3>Contribution to College</h3>
                <ul>
                  <li>{$row['contribution']}</li>
                </ul>
              </div>

              <div class="club-details-section">
                <h3>Membership</h3>
                <p>The {$row['name']} welcomes students from all programs. Anyone with interest is welcome to join.</p>
              </div>

              <a href="#" onclick="showMembers('club-{$row['id']}')" class="see-members-link">See Members</a>

            </div>
          </div>

          <div id="club-{$row['id']}-members" class="members-section">
            <a href="#" class="back-link" onclick="hideMembers()">← Back to Club Details</a>
            <h2 class="section-title">{$row['name']} Members</h2>
            <table class="members-table">
              <thead>
                <tr>
                  <th>SL No</th>
                  <th>Name</th>
                  <th>Course</th>
                  <th>Email</th>
                  <th>Contact No</th>
                  <th>Std. ID</th>
                  <th>Section</th>
                </tr>
              </thead>
              <tbody>
HTML;

          $members = select("SELECT * FROM `student` WHERE `club_id`=?", [$row['id']], 'i');
          $sl = 1;
          while ($member = mysqli_fetch_assoc($members)) {
              echo "<tr>
                      <td>{$sl}</td>
                      <td>{$member['name']}</td>
                      <td>{$member['course']}</td>
                      <td>{$member['email']}</td>
                      <td>{$member['contactno']}</td>
                      <td>{$member['std_id']}</td>
                      <td>{$member['section']}</td>
                    </tr>";
              $sl++;
          }

          echo <<<HTML
              </tbody>
            </table>
          </div>
HTML;
      }
    ?>
  </div>
</main>

<script src="assets/js/Java.js"></script>

<footer class="footer">
  <p>©2025 Samtse College - Clubs and Events Platform</p>
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
