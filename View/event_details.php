<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Event Details</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<link href="../Css/assets/css/event_booking_ticket.css" rel="stylesheet">
	<style>
		#add-booking,
		#delete-booking {
			background-color: transparent;
			border: none;
			font-size: 20px;
		}

		#add-booking:hover {
			color: rgba(0, 255, 0);
		}

		#delete-booking:hover {
			color: red;
		}

		#event-pic {
			width: 80%;
			height: 90%
		}

		#movie-info {
			font-size: 20px !important;
		}
			
		
	</style>

	<?php include("../Root/link.php") ?>
	<?php include("../Root/connect-db.php") ?>
	<?php include("../Root/getEventDetails.php") ?>


</head>

<body>
	<?php
    session_start();
	include("header.php");
	date_default_timezone_set('Asia/Kuala_Lumpur');
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
						<li><?php echo $event_name; ?></li>
					</ol>
				</div>

			</div>
			<!-- ======= Portfolio Details Section ======= -->
			<section id="portfolio-details" class="portfolio-details">
				<div class="container">

					<div class="row gy-4">

						<div class="col-lg-5">
							<div class="portfolio-details-slider swiper">
								<div class="swiper-wrapper align-items-center">

									<div class="swiper-slide">
										<img id="event-pic" class="rounded"
											src="<?php echo $event_upl_path; ?>"
											alt="photo">
									</div>

								</div>
								<div class="swiper-pagination"></div>
							</div>
						</div>

						<div class="col-lg-7">
							<div class="portfolio-info rounded-sm">
								<h3>Event information</h3>
								<ul id="movie-info">
									<li><strong>Movie Name</strong>:
										<?php echo $event_name;?>
									</li>
									<li><strong>Event Type</strong>:
										<?php echo $event_type;?>
									</li>
									<li><strong>Event date</strong>:
										<?php echo $event_date;?>
									</li>
									<li><strong>Hoster</strong>:
										<?php echo $event_hoster;?>
									</li>
									<li><strong>Location</strong>:
										<?php echo $location;?>
									</li>
									<li><strong>Start Time</strong>:
										<?php echo $start_time;?>
									</li>
									<li><strong>End Time</strong>:
										<?php echo $end_time;?>
									</li>
									<li><strong>Event Availability</strong>:
										<?php echo $event_availability;?>
									</li>
									<li><strong>Movie Details</strong>:
										<br /><?php echo $movie_details;?>
									</li>
								</ul>
								<?php if($_SESSION['role'] == 'Member') {
								    echo '
									<form id="memberAddBooking" action="../Process/add_booking_process.php" method="post">
									<button id="member-booking" name="member-booking" type="submit" onclick="confirmBooking();" class="button-19" value="'.$eventID.'">Book Ticket</button>
									
										</div>
									</div>
									</form>
									';
								}
	?>
								<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'Staff') { ?>
									<a href="../View/edit-event.php?event_id=<?php echo $eventID; ?>"><button id="edit-event" class="button-19 my-3" name="editEvent">Edit Event</button></a>

								<form id="addEvent" action="../View/staff_add_booking.php" method="POST">
									<button id="edit-event" class="button-19" type="submit" name="addBooking" value="<?php echo $eventID; ?>">Add Member Booking</button></form>
								<?php }?>
							</div>

						</div>

					</div>
			</section><!-- End Portfolio Details Section -->
			<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'Staff') { ?>
			<!-- ======= Booking Details Section ======= -->
			<section id="booking-details" class="booking-details">
				<div class="container">
					<div class="table-responsive" data-aos="fade-up">
						<?php

	                        $sql_booking = "SELECT M.Member_id, M.Member_name, M.Member_email, B.Booking_date, B.Booking_id 
							FROM t_booking B 
							JOIN t_member M ON M.Member_id = B.Member_id
							LEFT JOIN t_booking_cancellation BC ON BC.Booking_id = B.Booking_id
							WHERE B.Event_id='$eventID' AND BC.Booking_id IS NULL
							ORDER BY B.Booking_date ASC;";

			    			$result_booking = mysqli_query($connect_db, $sql_booking);

							if (mysqli_num_rows($result_booking) > 0) {
								echo "
						
								<table class='table table-hover'>
								<thead>
								<form action='../View/staff_add_booking.php' method='POST'>
								<tr>
								<th class='text-info'>No.</th>
								<th class='text-info'>Member ID</th>
								<th class='text-info'>Member Name</th>
								<th class='text-info'>Member Email</th>
								<th class='text-info'>Booking Date</th>
								<th class='text-info'><button id='add-booking' type='submit' name='addBooking' value='".$eventID."'<i class='fa-solid fa-user-plus'></i></button</th>
								</tr>
								</thead>
								</form>
								<form id='deleteBooking' action='../Process/delete_booking.php' method='POST'>
								<tbody>";
								
								for ($i = 1; $row_booking = mysqli_fetch_assoc($result_booking); $i++) {
									echo"
											<tr data-bs-trigger='hover'>
											<td>".$i."</td>
											<td>".$row_booking['Member_id']."</td>
											<td id='member'>".$row_booking['Member_name']."</td>
											<td>".$row_booking['Member_email']."</td>
											<td>".$row_booking['Booking_date']."</td>
											<td><button id='delete-booking' type='submit' name='delete' value='".$row_booking['Booking_id']."'<i class='fa-regular fa-trash-can'></i></button></td>
											</tr>
											";
								}
								echo "</tbody></form></table>";
			    			}
						}?>
					</div>
			</section>
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
			}
		}
			const showTicketBtn = document.getElementById("member-booking");
			const ticketPopup = document.getElementById("ticketPopup");
			const closeTicketBtn = document.getElementById("closeTicketBtn");

			closeTicketBtn.addEventListener("click", function () {
				ticketPopup.style.display = "none";
				document.getElementById("memberAddBooking").submit();

			});

		function confirmBooking() {
			// Display a confirmation dialog with the member's name
			var result = confirm("Are you sure you want to book for this event?");
			const ticketPopup = document.getElementById("ticketPopup"); // Define ticketPopup here

			// If user confirms, submit the form
			if (result == true) {
				ticketPopup.style.display = "block";
			} else {
				event.preventDefault(); // Prevent form submission if user cancels
			}
		}
	</script>


</body>

</html>