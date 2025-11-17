<?php
require('partials/db_config.php');
require('partials/essentials.php');
session_start();

if (isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] === true) {
    redirect('dashboard.php');
}

$setting_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$setting_r = mysqli_fetch_assoc(select($setting_q, [1], 'i'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | <?php echo $setting_r['site_title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
   <link rel="icon" type="image/png" href="../assets/images/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="../assets/images/favicon.svg" />
<link rel="shortcut icon" href="../assets/images/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="../assets/images/apple-touch-icon.png" />
<meta name="apple-mobile-web-app-title" content="Tamudhee Homestay" />
<link rel="manifest" href="../assets/images/site.webmanifest" />

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body, html {
            height: 100%;
            margin: 0;
        }

        body::before {
            content: "";
            background: url('https://images.unsplash.com/photo-1597658333270-8c0d8f0eb845?ixid=M3wxNTQ4MjR8MHwxfGFsbHx8fHx8fHx8fDE2OTE2MzE4OTV8&ixlib=rb-4.0.3&fm=jpg&q=85&fit=crop&w=2560&h=1707') no-repeat center center/cover;
            position: fixed;
            top: 0; left: 0;
            height: 100%; width: 100%;
            z-index: -2;
            filter: blur(5px);
        }

        .login-box {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
            border-radius: 20px;
            padding: 40px 30px;
            max-width: 400px;
            width: 100%;
            color: white;
        }

        .login-title {
            font-family: 'Dancing Script', cursive;
            font-size: 3rem;
            text-align: center;
            margin-bottom: 30px;
            animation: fadeInDown 1s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            border-radius: 30px;
            color: white;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid #fff;
            box-shadow: none;
        }

        .form-control::placeholder {
            color: #eee;
        }

        .input-group-text {
            background: transparent;
            border: none;
            color: white;
        }

        .btn-login {
            background: #fff;
            color: #000;
            border-radius: 30px;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #e0e0e0;
        }

        .user-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            padding: 10px;
            color: white;
            border: 1px solid white;
            border-radius: 30px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .user-link:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 768px) {
            .login-box {
                margin: 20px;
            }
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">

    <div class="login-box">
        <form method="POST">
            <div class="login-title"><?php echo $setting_r['site_title']; ?></div>

            <div class="mb-4 input-group">
                <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                <input type="text" class="form-control" name="admin_name" placeholder="Admin Name" required>
            </div>

            <div class="mb-4 input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" class="form-control" name="admin_password" placeholder="Admin Password" required>
            </div>

            <button type="submit" name="login" class="btn btn-login w-100">Login</button>
            <a href="../index.php" class="user-link">Back to Website</a>
        </form>
    </div>

    <!-- PHP Login Script -->
    <?php
    if (isset($_POST['login'])) {
        $frm_data = filteration($_POST);
        $res = select("SELECT * FROM `admin` WHERE `admin_name`=? AND `admin_pass`=?", [$frm_data['admin_name'], $frm_data['admin_password']], "ss");

        if ($res->num_rows === 1) {
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminId'] = mysqli_fetch_assoc($res)['sr_no'];
            echo "<script>window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Credentials',
                    text: 'Please check your name or password!',
                    confirmButtonColor: '#3085d6'
                });
            </script>";
        }
    }
    ?>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
