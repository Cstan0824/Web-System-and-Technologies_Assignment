<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Event Details</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
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

		#add-bookingbutton:hover {
			color: rgba(0, 147, 0, 1);
		}

		#delete-event:hover,
		#delete-booking:hover {
			color: red;
		}

		#event-pic {
			width: 500px;
			height: 700px;
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

	$page = $_GET['page'] ?? 1;

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
										<?php 
										if ($leftover == 0) {
											echo "Fully Booked";
										} else {
											echo $event_availability;
										}
										?>
									</li>
									<li><strong>Movie Details</strong>:
										<br /><?php echo $movie_details;?>...
									</li>
								</ul>
								<?php 
									if($_SESSION['role'] == 'Member' && $leftover > 0) {
								    echo '
									<form id="memberAddBooking" action="../Process/add_booking_process.php" method="post">
									<button id="member-booking" name="member-booking" type="submit" onclick="confirmBooking();" class="button-19" value="'.$eventID.'">Book Ticket</button>
									</form>
									';
									}
								?>
								<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'Staff') { ?>
								<a
									href="../View/edit-event.php?event_id=<?php echo $eventID; ?>">
									<button id="edit-event" class="button-19 my-3" name="editEvent">Edit
										Event</button></a>

								<?php if ($leftover > 0) { ?>
								<form id="addBooking" action="staff_add_booking.php" method="POST">
									<button id="add-bookingbutton" class="button-19 my-3" type="submit"
										name="addBooking"
										value="<?php echo $eventID; ?>">Add
										Member Booking</button>
								</form>
								<?php } ?>
								<form id="deleteEvent" action="../Process/delete_event.php" method="POST">
									<button id="delete-event" class="button-19 my-3" type="submit" name="delete"
										value="<?php echo $eventID; ?>"
										onclick="deleteEvent();">Delete Event</button>
								</form>

								<?php }?>
							</div>

						</div>

					</div>
			</section><!-- End Portfolio Details Section -->
			<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'Staff') { ?>
			<!-- ======= Booking Details Section ======= -->
			<section id="booking-details" class="portfolio-details">
				<div class="container portfolio-info">
					<div class="section-title">
						<h2>Booking Details</h2>
					</div>
					<div class="table-responsive" data-aos="fade-up">
						<?php
	                        $sql_booking = "SELECT M.Member_id, M.Member_name, M.Member_email, B.Booking_date, B.Booking_id 
							FROM t_booking B 
							JOIN t_member M ON M.Member_id = B.Member_id
							LEFT JOIN t_booking_cancellation BC ON BC.Booking_id = B.Booking_id
							WHERE B.Event_id='$eventID' AND BC.Booking_id IS NULL
							ORDER BY B.Booking_date ASC;";

			    $result_booking = mysqli_query($connect_db, $sql_booking);
			    $pageCount = ceil(mysqli_num_rows($result_booking) / 5);
			    $memberDetails = array();
			    if (mysqli_num_rows($result_booking) > 0) {
			        while($row_booking = mysqli_fetch_assoc($result_booking)) {
			            //store the data to nested array
			            $memberDetails[] = array(
			                "Member_id" => $row_booking["Member_id"],
			                "Member_name" => $row_booking["Member_name"],
			                "Member_email" => $row_booking["Member_email"],
			                "Booking_date" => $row_booking["Booking_date"],
			                "Booking_id" => $row_booking["Booking_id"]
			            );

			        }
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
								<th class='text-info'>";
								if ($leftover > 0){
									echo "<button id='add-booking' type='submit' name='addBooking' value='".$eventID."'<i class='fa-solid fa-user-plus'></i></button>";
								};
								echo "
								</th>
								</tr>
								</form>
								</thead>
								<tbody>
								<form id='deleteBooking' action='../Process/delete_booking.php' method='POST'>
								";

			        for ($i = ($page - 1) * 5; $i < count($memberDetails) && $i <= $page * 5; $i++) {
			            echo "
							<tr data-bs-trigger='hover'>
								<td>".($i + 1)."</td>
								<td>".$memberDetails[$i]['Member_id']."</td>
								<td id='member'>".$memberDetails[$i]['Member_name']."</td>
								<td>".$memberDetails[$i]['Member_email']."</td>
								<td>".$memberDetails[$i]['Booking_date']."</td>
								<td><button id='delete-booking' type='submit' name='delete' value='".$memberDetails[$i]['Booking_id']."' onclick='deleteBooking();'><i class='fa-regular fa-trash-can'></i></button></td>
							</tr>";
			        }
			        echo "</form></tbody></table>";
			    }
			    ?>

					</div>
					<form
						action="<?php echo $_SERVER["PHP_SELF"]; ?>"
						method="get">
						<input type="hidden"
							value="<?php echo $eventID ?>"
							name="event_id" />
						<ul class="pagination">
							<li class="page-item" hidden></li>
							<li class="page-item">
								<button id="prevPage" class="page-link disabled" type="submit"
									<?php echo "name='page' value='" .max($page - 1, 1). "'" ?>>
									Previous
								</button>
							</li>
							<?php for ($i = 1; $i <= $pageCount; $i++): ?>
							<li class="page-item">
								<button
									class="page-link <?php echo ($page == $i) ? "disabled bg-muted" : ""; ?>"
									type="submit"
									<?php echo "name='page' value='$i'" ?>><?php echo $i ?></button>
							</li>
							<?php endfor ?>
							<li class="page-item">
								<button id="nextPage" class="page-link disabled" type="submit"
									<?php echo "name='page' value='".min($page + 1, $pageCount). "'" ?>>
									Next
								</button>
							</li>
						</ul>
					</form>
				</div>
				<?php } ?>
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
		document.addEventListener("DOMContentLoaded", function() {

			//pagination disabled
			var prevPage = document.getElementById("prevPage");
			var nextPage = document.getElementById("nextPage");

			var page = <?php echo $page ?> ;
			var totalPage = <?php echo $pageCount ?> ;
			//console.log(page, totalPage);
			prevPage.classList.remove("disabled");
			nextPage.classList.remove("disabled");
			if (page === totalPage) {
				nextPage.classList.add("disabled");

			}
			if (page === 1) {
				prevPage.classList.add("disabled");
			}
		});

		function confirmBooking() {
			// Display a confirmation dialog with the member's name
			var result = confirm("Are you sure you want to book for this event?");
			// If user confirms, submit the form
			if (result == 1) {
				document.getElementById("memberAddBooking").submit();
			} else {
				event.preventDefault();
			}
		}

		function deleteEvent() {
			var result = confirm("Are you sure you want to delete this event?");

			// If user confirms, submit the form
			if (result == 1) {
				document.getElementById("deleteEvent").submit();
			} else {
				event.preventDefault();
			}
		}

		function deleteBooking() {
			// Get the selected member's name
			var memberName = document.getElementById("member").options[document.getElementById("member").selectedIndex].text;

			// Display a confirmation dialog with the member's name
			var result = confirm("Are you sure you want to delete booking for " + memberName + "?");

			// If user confirms, submit the form
			if (result == 1) {
				document.getElementById("deleteBooking").submit();
			} else {
				event.preventDefault();
			}
		}
	</script>


</body>

</html>