<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>event details</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<?php include("../Root/link.php") ?>
	<?php include("../Root/connect-db.php") ?>

</head>

<body>
	<?php 
	
	include("header.php");
	$eventID = $_GET['event_id'];
	
	$sql_event = "SELECT * FROM t_event WHERE Event_id='$eventID'";
    $result_event = mysqli_query($connect_db, $sql_event);

	$sql_event_type = "SELECT * FROM t_event_type";
	$result_event_type = mysqli_query($connect_db, $sql_event_type);
	if (mysqli_num_rows($result_event_type) > 0) {
		$event_type_ID = array("");
		$event_type_db = array("");
		for($i = 1; $row_event_type = mysqli_fetch_assoc($result_event_type); $i++){
			$event_type_ID[$i] = $row_event_type['Event_type_id'];
			$event_type_db[$i] = $row_event_type['Event_type'];
			
		}

	}

	$sql_event_location = "SELECT * FROM t_event_location";
	$result_event_location = mysqli_query($connect_db, $sql_event_location);
	if (mysqli_num_rows($result_event_location) > 0) {
		$event_location_ID = array("");
		$address = array("");
		$OI = array("");
		for($i = 1; $row_event_location = mysqli_fetch_assoc($result_event_location); $i++){
			$event_location_ID[$i] = $row_event_location['Event_location_id'];
			$address_db[$i] = $row_event_location['Address'];
			$OI[$i] = $row_event_location['Location'];
		}

	}
	$sql_staff = "SELECT * FROM t_staff";
	$result_staff = mysqli_query($connect_db, $sql_staff);
	if (mysqli_num_rows($result_staff) > 0) {
		
		$staff_ID = array("");
		$staff_name = array("");
		for($i = 1; $row_staff = mysqli_fetch_assoc($result_staff); $i++){
			$staff_ID[$i] = $row_staff['Staff_id'];
			$staff_name[$i] = $row_staff['Staff_name'];
		}

	}
	


	if (mysqli_num_rows($result_event) === 1) {
		$row_event = mysqli_fetch_assoc($result_event);
		$event_name = $row_event['Event_name'];
		for ($i = 1; $i < count($event_type_ID); $i++) {
			if ($row_event['Event_type_id'] == $event_type_ID[$i]) {
				$event_type = $event_type_db[$i];
			}
		}
		for ($i = 1; $i < count($staff_ID); $i++) {
			if ($row_event['Staff_id'] == $staff_ID[$i]) {
				$hoster = $staff_name[$i];
			}
		}
		for ($i = 1; $i < count($event_location_ID); $i++) {
			if ($row_event['Event_location_id'] == $event_location_ID[$i]) {
				$location = $address_db[$i]." (".$OI[$i].") ";
			}
		}
		$event_date = $row_event['Event_date'];
		$start_time = $row_event['Start_time'];
		$end_time = $row_event['End_time'];
		$movie_details = $row_event['Event_desc'];
		$event_upl_path = $row_event['Event_upl_path'];
	}
	
	?>
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
										<img class="rounded" src="<?php echo $event_upl_path; ?>" alt="photo">
									</div>

								</div>
								<div class="swiper-pagination"></div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="portfolio-info rounded-sm">
								<h3>Movie information</h3>
								<ul>
									<li><strong>Event Name</strong>: <?php echo $event_name;?></li>
									<li><strong>Event Type</strong>: <?php echo $event_type;?></li>
									<li><strong>Event date</strong>: <?php echo $event_date;?></li>
									<li><strong>Hoster</strong>: <?php echo $hoster;?></li>
									<li><strong>Location</strong>: <?php echo $location;?></li>
									<li><strong>Start Time</strong>: <?php echo $start_time;?></li>
									<li><strong>End Time</strong>: <?php echo $end_time;?></li>
									<li><strong>Movie Details</strong>: <br /><?php echo $movie_details;?>
									</li>
								</ul>
								<button onclick="myFunction()" class="button-19">Booking The Ticket Now</button>
							</div>

						</div>

					</div>
			</section><!-- End Portfolio Details Section -->
			
			<!-- ======= Booking Details Section ======= -->
			<?php 

			$sql_booking = "SELECT * FROM t_booking WHERE Event_id='$eventID'";
			$result_booking = mysqli_query($connect_db, $sql_booking);

			?>
			<!-- ======= End Booking Details Section ======= -->


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