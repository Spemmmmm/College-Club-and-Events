<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="icon" type="image/png" href="../../assets/images/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="../../assets/images/favicon.svg" />
<link rel="shortcut icon" href="../../assets/images/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="../../assets/images/apple-touch-icon.png" />
<meta name="apple-mobile-web-app-title" content="Tamudhee Homestay" />
<link rel="manifest" href="../../assets/images/site.webmanifest" />
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <style>
    .custom-alert {
    position: fixed;
    top: 120px;
    right: 25px;
}
  </style> 
    
  </head>
  <body class="with-welcome-text">
    <div class="container-scroller">
    <?php
          $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
          $values = [1];
          $contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
          ?>
      
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
              <span class="icon-menu"></span>
            </button>
          </div>
          <div>
            <a class="navbar-brand brand-logo" href="index.html">
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.html">
            </a>
          </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
          <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
              
              <h1 class="welcome-text">    <?php
    /* This sets the $time variable to the current hour in the 24 hour clock format */
    $time = date("H");
    /* Set the $timezone variable to become the current timezone */
    $timezone = date("e");
    /* If the time is less than 1200 hours, show good morning */
    if ($time < "12") {
        echo "Good morning";
    } else
    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
    if ($time >= "12" && $time < "17") {
        echo "Good afternoon";
    } else
    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
    if ($time >= "17" && $time < "19") {
        echo "Good evening";
    } else
    /* Finally, show good night if the time is greater than or equal to 1900 hours */
    if ($time >= "19") {
        echo "Good night";
    }
    ?>, <span class="text-black fw-bold">Admin</span></h1>
              
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
          
          <li class="nav-item dropdown user-dropdown">
              <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="../../assets/images/Logos/SCE Final LogoEdited.png" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-xs rounded-circle" src="../../assets/images/Logos/SCE Final LogoEdited.png" alt="Profile image">
                </div>
                
                <a class="dropdown-item" href="logout.php"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Log Out</a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>

      