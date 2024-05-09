<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Booking</title>
	<?php
    session_start();
	date_default_timezone_set('Asia/Kuala_Lumpur');
	if (!isset($_SESSION['role']) || $_SESSION['role'] == null || $_SESSION['role'] != "Staff") {
	    session_destroy();
	    header("Location: login_signup.php");
	}
	include("../Root/link.php");
	include("../Root/connect-db.php");
	?>
</head>
<style>
	#event-pic {
		width: 80%;
		height: 90%
	}

	#movie-info {
		font-size: 20px !important;
	}
</style>

<body>
	<?php
	include("header.php");
	$eventID = $_POST['addBooking'];

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
						<li><?php echo $event_name; ?></li>
						<li>Add Booking</li>
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
							</div>

						</div>

					</div>
			</section><!-- End Portfolio Details Section -->


			</div>
		</section>

		<!-- ======= Add Booking Section ======= -->
		<section id="add-booking" class="add-booking">
			<div class="container">
				<form id="addBooking" class="needs-validation" action="../Process/add_booking_process.php" method="post">
					<div class="row g-3">

						<!-- ======= select member ======= -->
						<div class="col-md-5">
							<?php
							
							//get member id and name from db
	                        $sql_member = "SELECT * FROM t_member";
							$result_member = mysqli_query($connect_db, $sql_member);
							if (mysqli_num_rows($result_member) > 0) {
							    $member_ID = array("");
							    $member_name = array("");
							    for($i = 1; $row_member = mysqli_fetch_assoc($result_member); $i++) {
							        $member_ID[$i] = $row_member['Member_id'];
							        $member_name[$i] = $row_member['Member_name'];
							    }

							}?>

							
							<label for="member" class="form-label">Member</label>
							<div class="input-group has-validation">
								<select class="form-select" id="member" name="member" required>
									<option value="">--Select One--</option>
									<?php
									for ($i = 1; $i < count($member_ID); $i++) {
									    echo "<option value='".$member_ID[$i]."'>".$member_name[$i]."</option>";
									}
									?>
								</select>
							
							</div>
						</div>
						
						<!-- ======= display current date ======= -->
						<div class="col-md-4">
							<label for="date" class="form-label">Booking Date</label>
							<div class="input-group has-validation">
								<input type="date" class="form-control" id="date" name="date"
									<?php echo 'value="' . date('Y-m-d') . '"'; ?>
								readonly>
							</div>
						</div>

						<div class="col-md-3">
							<label for="addBooking" class="form-label"></label>
							<button class="w-100 btn btn-primary btn-lg"  value='<?php echo $eventID; ?>' name="addBooking" type="submit" onclick="confirmBooking();">Add Booking</button>
						</div>
					</div>
				</form>
			</div>
		</section>


		<!-- ======= End Add Booking Section ======= -->
	</main><!-- End #main -->

	<!-- ======= Footer ======= -->
	<?php include('footer.php'); ?>
	</footer><!-- End Footer -->

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
			class="bi bi-arrow-up-short"></i></a>

	<!-- Template Main JS File -->
	<script src="../Css/assets/js/main.js"></script>
	<script>
		 function confirmBooking() {
            // Get the selected member's name
            var memberName = document.getElementById("member").options[document.getElementById("member").selectedIndex].text;

            // Display a confirmation dialog with the member's name
            var result = confirm("Are you sure you want to add booking for " + memberName + "?");
            
            // If user confirms, submit the form
            if (result == 1) {
                document.getElementById("addBooking").submit();
            }else{
				event.preventDefault();
			}
        }
	</script>

</body>

</html>