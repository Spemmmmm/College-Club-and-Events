<?php
require 'partials/db_config.php';
require 'partials/essentials.php';
adminLogin();

// FETCH TOTAL COUNTS
$student_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM student"))['total'];
$club_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM rooms"))['total'];

// EVENTS
$event_total = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM event"))['total'];
$event_active = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM event WHERE dateofevent >= CURDATE()"))['total']; // ongoing/upcoming
$event_past = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM event WHERE dateofevent < CURDATE()"))['total'];

// FEEDBACK COUNTS
$feedback_total = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM feedback"))['total'];
$feedback_unread = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM feedback WHERE seen=0"))['total'];
$feedback_read = $feedback_total - $feedback_unread;

// HELPDESK COUNTS
$helpdesk_total = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM helpdesk"))['total'];
$helpdesk_unread = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM helpdesk WHERE seen=0"))['total'];
$helpdesk_read = $helpdesk_total - $helpdesk_unread;
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ADMIN DASHBOARD</title>
<?php require('partials/header.php'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
body { background: #f5f6fa; }

.dashboard-card {
    padding: 25px;
    border-radius: 20px;
    transition: 0.25s ease;
    color: #fff;
    height: 160px;
}

.dashboard-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.18);
}

.dashboard-icon { font-size: 40px; opacity: 0.9; }
.dashboard-number { font-size: 2.2rem; font-weight: 700; }
.dashboard-title { font-size: 1rem; font-weight: 600; margin-top: 8px; }

/* Gradient backgrounds */
.bg-student { background: linear-gradient(135deg, #9b59b6, #8e44ad); }
.bg-club { background: linear-gradient(135deg, #2ecc71, #1abc9c); }
.bg-event { background: linear-gradient(135deg, #5a8dee, #4776e6); }
.bg-event-active { background: linear-gradient(135deg, #00b894, #00cec9); }
.bg-event-past { background: linear-gradient(135deg, #636e72, #2d3436); }
.bg-feedback { background: linear-gradient(135deg, #f7b731, #f39c12); }
.bg-feedback-unread { background: linear-gradient(135deg, #e67e22, #d35400); }
.bg-feedback-read { background: linear-gradient(135deg, #f1c40f, #f39c12); }
.bg-helpdesk { background: linear-gradient(135deg, #e74c3c, #c0392b); }
.bg-helpdesk-unread { background: linear-gradient(135deg, #c0392b, #96281b); }
.bg-helpdesk-read { background: linear-gradient(135deg, #e74c3c, #e67e22); }
</style>
</head>

<body>
<?php require('partials/sidebar.php'); ?>

<div class="container-fluid" id="main-content">
<h3 class="mt-4 mb-4" style="font-weight:600;">Dashboard Overview</h3>

<div class="row g-4">

    <!-- Students -->
    <div class="col-md-3">
        <div class="dashboard-card bg-student shadow">
            <i class="bi bi-mortarboard dashboard-icon"></i>
            <div class="dashboard-number"><?php echo $student_count; ?></div>
            <div class="dashboard-title">Total Students</div>
        </div>
    </div>

    <!-- Clubs -->
    <div class="col-md-3">
        <div class="dashboard-card bg-club shadow">
            <i class="bi bi-people-fill dashboard-icon"></i>
            <div class="dashboard-number"><?php echo $club_count; ?></div>
            <div class="dashboard-title">Total Clubs</div>
        </div>
    </div>

    <!-- Events -->
    <div class="col-md-3">
        <div class="dashboard-card bg-event shadow">
            <i class="bi bi-calendar-event dashboard-icon"></i>
            <div class="dashboard-number"><?php echo $event_total; ?></div>
            <div class="dashboard-title">Total Events</div>
        </div>
    </div>

    <!-- Active Events -->
    <div class="col-md-3">
        <div class="dashboard-card bg-event-active shadow">
            <i class="bi bi-calendar-check-fill dashboard-icon"></i>
            <div class="dashboard-number"><?php echo $event_active; ?></div>
            <div class="dashboard-title">Active Events</div>
        </div>
    </div>

    <!-- Past Events -->
    <div class="col-md-3">
        <div class="dashboard-card bg-event-past shadow">
            <i class="bi bi-calendar-x-fill dashboard-icon"></i>
            <div class="dashboard-number"><?php echo $event_past; ?></div>
            <div class="dashboard-title">Past Events</div>
        </div>
    </div>

    <!-- Feedback total -->
    <div class="col-md-3">
        <div class="dashboard-card bg-feedback shadow">
            <i class="bi bi-chat-square-text dashboard-icon"></i>
            <div class="dashboard-number"><?php echo $feedback_total; ?></div>
            <div class="dashboard-title">Total Feedback</div>
        </div>
    </div>

    <!-- Feedback unread -->
    <div class="col-md-3">
        <div class="dashboard-card bg-feedback-unread shadow">
            <i class="bi bi-envelope-fill dashboard-icon"></i>
            <div class="dashboard-number"><?php echo $feedback_unread; ?></div>
            <div class="dashboard-title">Unread Feedback</div>
        </div>
    </div>

    <!-- Feedback read -->
    <div class="col-md-3">
        <div class="dashboard-card bg-feedback-read shadow">
            <i class="bi bi-envelope-open-fill dashboard-icon"></i>
            <div class="dashboard-number"><?php echo $feedback_read; ?></div>
            <div class="dashboard-title">Read Feedback</div>
        </div>
    </div>

    <!-- Helpdesk total -->
    <div class="col-md-3">
        <div class="dashboard-card bg-helpdesk shadow">
            <i class="bi bi-headset dashboard-icon"></i>
            <div class="dashboard-number"><?php echo $helpdesk_total; ?></div>
            <div class="dashboard-title">Total Helpdesk</div>
        </div>
    </div>

    <!-- Helpdesk unread -->
    <div class="col-md-3">
        <div class="dashboard-card bg-helpdesk-unread shadow">
            <i class="bi bi-bell-fill dashboard-icon"></i>
            <div class="dashboard-number"><?php echo $helpdesk_unread; ?></div>
            <div class="dashboard-title">Unread Helpdesk</div>
        </div>
    </div>

    <!-- Helpdesk read -->
    <div class="col-md-3">
        <div class="dashboard-card bg-helpdesk-read shadow">
            <i class="bi bi-bell-check-fill dashboard-icon"></i>
            <div class="dashboard-number"><?php echo $helpdesk_read; ?></div>
            <div class="dashboard-title">Read Helpdesk</div>
        </div>
    </div>

</div>
</div>

<?php require('partials/footer.php'); ?>
</body>
</html>
