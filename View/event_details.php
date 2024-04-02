<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>event details</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<?php include("../Root/link.php") ?>

</head>

<body>
	<?php include("header.php") ?>
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
										<img class="rounded" src="../Css/assets/img/portfolio/test1.png" alt="">
									</div>

								</div>
								<div class="swiper-pagination"></div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="portfolio-info rounded-sm">
								<h3>Movie information</h3>
								<ul>
									<li><strong>Movie Name</strong>: Scent OF A Woman</li>
									<li><strong>Starring</strong>: Al Pacino, Chris O'Donnell</li>
									<li><strong>Release date</strong>: December 23, 1992</li>
									<li><strong>Language</strong>: English</li>
									<li><strong>Location</strong>: West Campus . DK4</li>
									<li><strong>Movie Details</strong>Scent of a Woman is a 1992 American drama film
										produced and directed by Martin Brest that tells the story of a preparatory
										school student who takes a job as an assistant to an irritable, blind, medically
										retired Army lieutenant colonel. The film is a remake of Dino Risi's 1974
										Italian film Profumo di donna, adapted by Bo Goldman from the novel Il buio e il
										miele (Italian: Darkness and Honey) by Giovanni Arpino. The film stars Al Pacino
										and Chris O'Donnell, with James Rebhorn, Philip Seymour Hoffman (credited as
										Philip S. Hoffman), Gabrielle Anwar, and Bradley Whitford in supporting roles.
									</li>
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

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
			class="bi bi-arrow-up-short"></i></a>

	<!-- Template Main JS File -->
	<script src="../Css/assets/js/main.js"></script>
	<script>
		function myFunction() {
			var txt;
			if (confirm("You have successfully booked the ticket.")) {
				//eprint("You pressed OK!");
				window.location.href = "Home.php";
			}
		}
	</script>

</body>

</html>