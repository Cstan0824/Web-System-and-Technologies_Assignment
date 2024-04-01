<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>event details</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../Css/assets/img/favicon.png" rel="icon">
  <link href="../Css/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../Css/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../Css/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../Css/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../Css/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../Css/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../Css/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../Css/assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between position-relative">

      <div class="logo">
        <h1 class="text-light"><a href="Home.php"><span>TARUMT Movie Society</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="../Css/assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="#about">Activities</a></li>
          <li><a class="nav-link scrollto" href="#services">Ticket</a></li>
          <li><a class="nav-link scrollto" href="#portfolio">Join Us</a></li>
          <li><a class="nav-link scrollto" href="#team">About Us</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Event Details</h2>
          <ol>
            <li><a href="Home.php">Home</a></li>
            <li><a href="Event.php">Event</a></li>
            <li>Event Details</li>
          </ol>
        </div>

      </div>
    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="../Css/assets/img/portfolio/test1.png" alt="">
                </div>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Movie information</h3>
              <ul>
                <li><strong>Movie Name</strong>: Scent OF A Woman</li>
                <li><strong>Starring</strong>: 	Al Pacino，Chris O'Donnell</li>
                <li><strong>Release date</strong>: December 23, 1992</li>
                <li><strong>Language</strong>: English</li>
                <li><strong>Location</strong>: West Campus . DK4</li>
                <li><strong>Movie Details</strong>Scent of a Woman is a 1992 American drama film produced and directed by Martin Brest that tells the story of a preparatory school student who takes a job as an assistant to an irritable, blind, medically retired Army lieutenant colonel. The film is a remake of Dino Risi's 1974 Italian film Profumo di donna, adapted by Bo Goldman from the novel Il buio e il miele (Italian: Darkness and Honey) by Giovanni Arpino. The film stars Al Pacino and Chris O'Donnell, with James Rebhorn, Philip Seymour Hoffman (credited as Philip S. Hoffman), Gabrielle Anwar, and Bradley Whitford in supporting roles.</li>
              </ul>
              <button onclick="myFunction()" class="button-19">Booking The Ticket Now</button>
            </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
	<?php include('footer.php'); ?>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../Css/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../Css/assets/vendor/aos/aos.js"></script>
  <script src="../Css/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../Css/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../Css/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../Css/assets/vendor/swiper/swiper-bundle.min.js"></script>


  <!-- Template Main JS File -->
  <script src="../Css/assets/js/main.js"></script>
  <script>
    function myFunction() {
    var txt;
      if (confirm("You are successfully booking the ticket.")) {
        txt = "You pressed OK!";
      }  else {
        txt = "You pressed Cancel!";
      }
    document.getElementById("demo").innerHTML = txt;
  }
</script>

</body>

</html>