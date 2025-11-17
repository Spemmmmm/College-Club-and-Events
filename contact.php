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
  <title><?php echo $setting_r['site_title'] ?> | Contact</title>
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
    main {
      max-width: 1200px;
      margin: 40px auto;
      padding: 0 20px;
    }

    h2 {
      text-align: center;
      color: #004080;
      margin-bottom: 30px;
      font-size: 2rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      border-radius: 10px;
      overflow: hidden;
    }

    thead {
      background-color: #2b3a67;
      color: #fff;
    }

    thead th {
      padding: 12px;
      text-align: left;
      font-weight: 600;
    }

    tbody tr {
      transition: all 0.3s ease;
      cursor: pointer;
    }

    tbody tr:hover {
      background-color: #f1f5fb;
      transform: translateX(5px);
    }

    tbody td {
      padding: 12px;
      border-bottom: 1px solid #e0e0e0;
      vertical-align: middle;
    }

    tbody tr:last-child td {
      border-bottom: none;
    }

    /* Club badges */
    .club-badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 12px;
      color: #fff;
      font-weight: 600;
      font-size: 0.9rem;
    }

    .red-cross { background-color: #d32f2f; }
    .literary { background-color: #1976d2; }
    .tarayana { background-color: #388e3c; }
    .y-peer { background-color: #fbc02d; color:#000; }
    .carpentry { background-color: #6d4c41; }
    .electrical { background-color: #f57c00; }
    .campus-beaut { background-color: #7b1fa2; }

    footer {
      background-color: #004080;
      color: #fff;
      text-align: center;
      padding: 15px 0;
      margin-top: 40px;
    }

    /* Responsive table */
    @media(max-width: 768px){
      table, thead, tbody, th, td, tr {
        display: block;
      }

      thead tr {
        display: none;
      }

      tbody tr {
        margin-bottom: 20px;
        border-bottom: 2px solid #ddd;
        padding-bottom: 10px;
      }

      tbody td {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
      }

      tbody td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #004080;
      }
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
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About Us</a></li>
      <li><a href="clubs.php">Clubs</a></li>
      <li class="dropdown">
        <a href="event.php">Events ▾</a>
        <ul class="dropdown-menu">
          <li><a href="#upcoming" onclick="showSection('upcoming')">Upcoming</a></li>
          <li><a href="#past" onclick="showSection('past')">Past</a></li>
        </ul>
      </li>
      <li><a href="contact.php" class="active">Contact</a></li>
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

  <main>
    <section class="contact-table-section">
      <h2>Contact Information</h2>
      <table>
        <thead>
          <tr>
            <th>SL No</th>
            <th>Clubs</th>
            <th>Advisor & Coordinator</th>
            <th>Email</th>
            <th>Contact No</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td data-label="SL No">1</td>
            <td data-label="Clubs"><span class="club-badge red-cross">Red-Cross</span></td>
            <td data-label="Advisor & Coordinator">Miss Tandin Wangmo (Coordinator)</td>
            <td data-label="Email">08230308@sce.rub.edu.bt</td>
            <td data-label="Contact No">17568589</td>
          </tr>
          <tr>
            <td data-label="SL No">2</td>
            <td data-label="Clubs"><span class="club-badge literary">Literary</span></td>
            <td data-label="Advisor & Coordinator">Miss Tshering Om Tamang (Advisor)<br>Miss Dechen (Coordinator)</td>
            <td data-label="Email">tsheringot.sce@rub.edu.bt</td>
            <td data-label="Contact No">77471462</td>
          </tr>
          <tr>
            <td data-label="SL No">3</td>
            <td data-label="Clubs"><span class="club-badge tarayana">Tarayana</span></td>
            <td data-label="Advisor & Coordinator">Mr. Sangay Phuntsho (Advisor)<br>Miss Dechen Tshomo (Coordinator)</td>
            <td data-label="Email">sangayp.sce@rub.edu.bt</td>
            <td data-label="Contact No">17734877</td>
          </tr>
          <tr>
            <td data-label="SL No">4</td>
            <td data-label="Clubs"><span class="club-badge y-peer">Y-Peer</span></td>
            <td data-label="Advisor & Coordinator">Mr. Chencho Gyeltshen (Advisor)<br>Mr. Tandin Penjor (Coordinator)</td>
            <td data-label="Email">Cjencho.sce@edu.bt</td>
            <td data-label="Contact No">17460744</td>
          </tr>
          <tr>
            <td data-label="SL No">5</td>
            <td data-label="Clubs"><span class="club-badge carpentry">Carpentry</span></td>
            <td data-label="Advisor & Coordinator">Mr. Lhapchu and Staff (Advisor)</td>
            <td data-label="Email">lhapchu.sce@edu.bt</td>
            <td data-label="Contact No">17651234</td>
          </tr>
          <tr>
            <td data-label="SL No">6</td>
            <td data-label="Clubs"><span class="club-badge electrical">Electrical</span></td>
            <td data-label="Advisor & Coordinator">Mr. Bhupen Gurung (Advisor)</td>
            <td data-label="Email">bgurung.sce@rub.edu.bt</td>
            <td data-label="Contact No">17659876</td>
          </tr>
          <tr>
            <td data-label="SL No">7</td>
            <td data-label="Clubs"><span class="club-badge campus-beaut">Campus Beautification</span></td>
            <td data-label="Advisor & Coordinator">DSA, Estate and ASSO</td>
            <td data-label="Email">ramesh.sce@rub.edu.bt</td>
            <td data-label="Contact No">+975-05-365397</td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>

  <footer>
    <p>©2025 Samtse College - <?php echo $setting_r['site_title'] ?></p>
  </footer>

  <script src="assets/js/Java.js"></script>
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
