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
	if (!isset($_SESSION['role']) ||$_SESSION['role'] == NULL || $_SESSION['role'] != "Member" && $_SESSION['role'] != "Staff"){
		session_destroy();
                header("Location: login_signup.php");
	}


</head>

<body>
	<?php
    session_start();
	include("header.php");
	date_default_timezone_set('Asia/Kuala_Lumpur');
	$eventID = $_GET['event_id'];

	$sql_event = "SELECT * FROM t_event WHERE Event_id='$eventID'";
	$result_event = mysqli_query($connect_db, $sql_event);

	$sql_event_type = "SELECT * FROM t_event_type";
	$result_event_type = mysqli_query($connect_db, $sql_event_type);
	if (mysqli_num_rows($result_event_type) > 0) {
	    $event_type_ID = array("");
	    $event_type_db = array("");
	    for($i = 1; $row_event_type = mysqli_fetch_assoc($result_event_type); $i++) {
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
	    for($i = 1; $row_event_location = mysqli_fetch_assoc($result_event_location); $i++) {
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
	    for($i = 1; $row_staff = mysqli_fetch_assoc($result_staff); $i++) {
	        $staff_ID[$i] = $row_staff['Staff_id'];
	        $staff_name[$i] = $row_staff['Staff_name'];
	    }

	}

	$sql_availability = "SELECT COUNT(*) AS num_bookings 
	FROM t_booking B
	LEFT JOIN t_booking_cancellation BC ON BC.Booking_id = B.Booking_id
	WHERE Event_id='$eventID' AND BC.Booking_id IS NULL;";
	$execute_availability = mysqli_query($connect_db, $sql_availability);
	$row_availability = mysqli_fetch_assoc($execute_availability);


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
	    $event_availability = $row_event['Max_User'] - $row_availability['num_bookings'] . " / " . $row_event['Max_User'] ;
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
										<?php echo $hoster;?>
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
									</form>
									';
								}
	?>
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
									<th class='text-info'><button id='add-booking' type='submit' name='add' value='".$eventID."'<i class='fa-solid fa-user-plus'></i></button</th>
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

		function confirmBooking() {
            // Display a confirmation dialog with the member's name
            var result = confirm("Are you sure you want to book for this event?");
            
            // If user confirms, submit the form
            if (result == 1) {
                document.getElementById("memberAddBooking").submit();
            }else{
				event.preventDefault();
			}
        }
	
	</script>

</body>

</html>