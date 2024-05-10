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
									<div id="ticketPopup" class="popup">
										<div class="popup-content">
														<div class="main-content">
									<div class="ticket">
										<div class="ticket__main">
											<div class="header">Activities Details</div>
											<div class="info passenger">
												<div class="info__item">Mmember Name</div>
												<div class="info__detail">Harrison Tiu Shao Hang</div>
											</div>
											<div class="info platform"> <span>Please </span><span>arrive </span><span>early</span>
												<div class="number">
													<div></div>
													<div> <span></span><span></span></div>
												</div>
											</div>
											<div class="info departure">
												<div class="info__item">Categories</div>
												<div class="info__detail">Movie Sharing</div>
											</div>
											<div class="info arrival">
												<div class="info__item">Movie Name</div>
												<div class="info__detail">Secret of a Women</div>
											</div>
											<div class="info date">
												<div class="info__item">Date</div>
												<div class="info__detail">13 Sep 2024</div>
											</div>
											<div class="info time">
												<div class="info__item">Time</div>
												<div class="info__detail">11:00AM</div>
											</div>
											<div class="info carriage">
												<div class="info__item">Location</div>
												<div class="info__detail">INDOOR</div>
											</div>
											<div class="info seat">
												<div class="info__item">host</div>
												<div class="info__detail">Jeremy</div>
											</div>
											<div class="fineprint">
												<p>Location : TARUMT Red Brick. </p>
												<p>This ticket is Non-refundable • TARUMT Movie Society Authority</p>
											</div>
											<div class="snack"><svg viewBox="0 -11 414.00053 414"><path d="m202.480469 352.128906c0-21.796875-17.671875-39.46875-39.46875-39.46875-21.800781 0-39.472657 17.667969-39.472657 39.46875 0 21.800782 17.671876 39.472656 39.472657 39.472656 21.785156-.023437 39.445312-17.683593 39.46875-39.472656zm0 0"></path><path d="m348.445312 348.242188c2.148438 21.691406-13.695312 41.019531-35.390624 43.167968-21.691407 2.148438-41.015626-13.699218-43.164063-35.390625-2.148437-21.691406 13.695313-41.019531 35.386719-43.167969 21.691406-2.148437 41.019531 13.699219 43.167968 35.390626zm0 0"></path><path d="m412.699219 63.554688c-1.3125-1.84375-3.433594-2.941407-5.699219-2.941407h-311.386719l-3.914062-24.742187c-3.191407-20.703125-21.050781-35.9531252-42-35.871094h-42.699219c-3.867188 0-7 3.132812-7 7s3.132812 7 7 7h42.699219c14.050781-.054688 26.03125 10.175781 28.171875 24.0625l33.800781 213.515625c3.191406 20.703125 21.050781 35.957031 42 35.871094h208.929687c3.863282 0 7-3.132813 7-7 0-3.863281-3.136718-7-7-7h-208.929687c-14.050781.054687-26.03125-10.175781-28.171875-24.0625l-5.746094-36.300781h213.980469c18.117187-.007813 34.242187-11.484376 40.179687-28.597657l39.699219-114.578125c.742188-2.140625.402344-4.511718-.914062-6.355468zm0 0"></path></svg></div>
											<div
												class="barcode">
												<div class="barcode__scan"></div>
												<div class="barcode__id">001256733</div>
										</div>
									</div>
									<div class="ticket__side">
										<div class="logo">
											<p>MOVIE SOCIETY</p>
										</div>
										<div class="info side-arrive">
											<div class="info__item">Hoster</div>
											<div class="info__detail">Jeremy</div>
										</div>
										<div class="info side-depart">
											<div class="info__item">Mmeber Name</div>
											<div class="info__detail">Harrison Tiu</div>
										</div>
										<div class="info side-date">
											<div class="info__item">Date</div>
											<div class="info__detail">13 Sep 2024</div>
										</div>
										<div class="info side-time">
											<div class="info__item">Time</div>
											<div class="info__detail">11:00AM</div>
										</div>
										<div class="barcode">
											<div class="barcode__scan"></div>
											<div class="barcode__id">001256733</div>
										</div>
									</div>
								</div>
								</div>
										</div>
										<button id="closeTicketBtn">Close Ticket</button>
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
									<form id='deleteBooking' action='../Process/staff_delete_booking.php' method='POST'>
									<tbody>
								";
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