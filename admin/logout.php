<?php
require('partials/essentials.php');
require('partials/db_config.php');
$setting_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$setting_r = mysqli_fetch_assoc(select($setting_q, $values, 'i'));
session_start();
session_destroy();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="3;url=index.php"> <!-- Redirect after 3 seconds -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logging Out | <?php echo $setting_r['site_title'] ?></title>

  <!-- Bootstrap & AOS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(to right, #e0eafc, #cfdef3);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .logout-card {
      background-color: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      text-align: center;
      animation: fadeIn 1s ease-in-out;
    }

    .spinner-border {
      width: 3rem;
      height: 3rem;
      margin: 20px auto;
      color: #00c476;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .logo {
      width: 60px;
      height: 60px;
      margin-bottom: 10px;
    }

    .hotel-name {
      font-weight: bold;
      font-size: 1.4rem;
      color: #00c476;
    }
  </style>
</head>
<body>

  <div class="logout-card" data-aos="zoom-in">
    <!-- Optional hotel logo -->
    <img src="../assets/images/Logos/SCE Final LogoEdited.png" alt="website Logo" class="logo">

    <div class="website-name"><?php echo $setting_r['site_title'] ?></div>
    
    <div class="spinner-border" role="status">
      <span class="visually-hidden">Logging out...</span>
    </div>

    <h5 class="mt-3 text-muted">Logging you out...</h5>
    <p class="text-secondary">Please wait while we redirect you to the homepage.</p>
  </div>

  <!-- AOS Script -->
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>
