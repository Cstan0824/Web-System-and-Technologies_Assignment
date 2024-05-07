<!-- ======= Header ======= -->
<header id="header"
  class="fixed-top <?php echo (strpos($_SERVER["REQUEST_URI"], "Home.php")) ? "header-transparent" : "";?>">
  <div class="container d-flex align-items-center justify-content-between position-relative">

    <div class="logo">
      <h1 class="text-light"><a href="Home.php"><span>TARUMT MOVIE SOCIETY</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html"><img src="../Css/assets/img/logo.png" alt="" class="img-fluid"></a>-->
    </div>

    <nav id="navbar" class="navbar">
      <ul>
        <li class="nav-item"><a class="nav-link scrollto" href="Home.php#">Home</a></li>
        <li class="nav-item"><a class="nav-link scrollto" href="Home.php#activities">Activities</a></li>
        <li class="nav-item"><a class="nav-link scrollto" href="Home.php#portfolio">Join Us</a></li>
        <li class="nav-item"><a class="nav-link scrollto" href="Home.php#team">About Us</a></li>
        <li class="nav-item"><a class="nav-link scrollto" href="Home.php#contact">Contact</a></li>
        <li class="nav-item"><a class="nav-link scrollto" href="Event.php">Events</a></li>
        <li class="nav-item dropdown">
          <a class="nav-text scrollto dropdown-toggle" href="#" data-bs-toggle="dropdown">Profiles</a>
          <ul class="dropdown-menu dropdown-menu-end ">
            <li><a class="dropdown-item" href="profile.php">Account</a></li>
            <li><a class="dropdown-item" href="..\Process\signOut.php">Sign Out</a></li>
          </ul>
        </li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header>
<!-- End Header -->
