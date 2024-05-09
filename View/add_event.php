<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Event</title>
	<?php
    session_start();
	if (!isset($_SESSION['role']) || $_SESSION['role'] == null || $_SESSION['role'] != "Staff") {
	    session_destroy();
	    header("Location: login_signup.php");
	}
	?>
</head>
<style>
	#event-pic,
	#imagePreview {
		width: 500px;
		height: 700px;
	}
</style>

<body>
	<?php include("../Root/link.php");
	include("../Root/connect-db.php");
	include("header.php");
	date_default_timezone_set('Asia/Kuala_Lumpur');

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

	?>
	<main id="main">

		<!-- ======= Breadcrumbs Section ======= -->
		<section class="breadcrumbs">
			<div class="container">

				<div class="d-flex justify-content-between align-items-center">
					<h2>Add Event</h2>
					<ol>
						<li><a href="Home.php">Home</a></li>
						<li><a href="Event.php">Event</a></li>
						<li>Add Event</li>
					</ol>
				</div>
			</div>
		</section><!-- End Breadcrumbs Section -->

		<!-- ======= Portfolio Details Section ======= -->
		<section id="portfolio-details" class="portfolio-details">
			<div class="container">
				<div class="row gy-4">
					<div class="col-lg-8">
						<div class="portfolio-details-slider swiper">
							<div class="swiper-wrapper align-items-center">

								<div class="swiper-slide">
									<img class="rounded" id="event-pic"
										src="..\Image\HD-wallpaper-film-making-film-making.jpg" alt="photo">
									<!-- Add an empty <img> tag to display the uploaded image preview -->
									<img class="rounded" id="imagePreview" src="#" alt="Uploaded Image"
										style="display: none;">
								</div>

							</div>
							<div class="swiper-pagination"></div>
						</div>
					</div>

					<div class="col-lg-4">

						<div class="portfolio-info rounded-sm">
							<h3>New Event Details</h3>
							<form id="editEvent" action="../Process/add_edit_event.php" method="POST"
								class="form-horizontal" role="form" enctype="multipart/form-data">
								<!-- Name -->
								<div class="input-group my-4">
									<span class="input-group-text">Name</span>
									<input type="text" id="eventName" class="form-control" placeholder="Event Name"
										name="eventName" value="" type="text">
								</div>
								<!-- Category -->
								<div class="input-group my-4">

									<span class="input-group-text">Event Type</span>
									<select class="form-select" id="eventType" name="eventType" required>
										<option value="" selected disabled>Select Event Type</option>
										<?php
	                                    for ($i = 1; $i < count($event_type_ID); $i++) {
	                                        echo "<option value='".$event_type_ID[$i]."'>".$event_type_db[$i]."</option>";
	                                    }?>
									</select>

								</div>
								<!-- Date -->
								<div class="input-group my-4">
									<span class="input-group-text">Date</span>
									<input class="form-control" name="eventDate" type="date"
										value="<?php echo date('Y-m-d'); ?>" />
								</div>
								<!-- Location -->
								<div class="input-group my-4">

									<span class="input-group-text">Location</span>
									<select class="form-select" id="location" name="location" required>
										<option value="" selected disabled>Select Location</option>
										<?php
											for ($i = 1; $i < count($event_location_ID); $i++){
	                                        	echo "<option value='".$event_location_ID[$i]."'>".$address_db[$i]." (".$OI[$i].") </option>";
											}	?>
									</select>

								</div>
								<!-- Hoster -->
								<div class="input-group my-4">
									<span class="input-group-text">Hoster</span>
									<input type="text" class="form-control" placeholder="Hoster" name="eventHoster"
										type="text">
								</div>

								<!-- Start Time -->
								<div class="input-group my-4">
									<span class="input-group-text">Start Time</span>
									<input class="form-control" name="startTime" type="time"/>
								</div>

								<!-- End Time -->
								<div class="input-group my-4">
									<span class="input-group-text">End Time &nbsp;</span>
									<input class="form-control" name="endTime" type="time"/>
								</div>

								<!-- Max User -->
								<div class="input-group my-4">
									<span class="input-group-text">Max User</span>
									<input class="form-control" type="number" name="maxUser"
										value="30" />
								</div>
								<div class="input-group my-4">
									<span class="input-group-text">Photo</span>
									<input type="file" name="eventPic" id="eventPic" onchange="previewImage(event)"
										class="form-control">
								</div>
								<input type="hidden" name="eventUplFileName"
									value="HD-wallpaper-film-making-film-making.jpg">
									<!-- default image -->
								<input type="hidden" name="eventUplPath"
									value="../Image/HD-wallpaper-film-making-film-making.jpg">
								<input type="hidden" name="actionType" value="addEvent">
						</div>
					</div>
				</div>
				<div class="row my-4">
					<!-- Desc -->
					<div class="col-sm-12">
						<div class="portfolio-info rounded-sm">

							<div class="form-group my-2">
								<label class="col-lg-12 control-label" for="eventDesc">Event Description</label>
								<div class="col-lg-12">
									<textarea style="resize:none;" class="form-control" name="eventDesc" id="eventDesc"
										rows="5" placeholder="Write event description here"></textarea>
								</div>
							</div>
							<!-- Save -->
							<div class="form-group my-2">
								<label class="col-md-3 control-label"></label>
								<div class="col-md-8">
									<button class="btn btn-primary" name="editEvent" type="submit"
										value="<?php echo $eventID; ?>"
										onclick="confirmAdd();">Add Event</button>
									</form>
									<span></span>
									<a
										href="event_details.php?event_id=<?php echo $eventID; ?>">
										<button class="btn btn-danger" name="back">Cancel</button></a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4"></div>
				</div>
			</div>
		</section>
		<!-- End Portfolio Details Section -->
	</main>

	<?php include('footer.php'); ?>
</body>
<script>
	function previewImage(event) {
		// Get references to old and new image elements
		const oldImage = document.getElementById('event-pic');
		const newImagePreview = document.getElementById('imagePreview');
		// Hide the old image 
		oldImage.style.display = 'none';
		const input = event.target;
		const reader = new FileReader();
		reader.onload = function() {
			// Set the src attribute of the new image preview 
			newImagePreview.src = reader.result;
			// Display the new image preview 
			newImagePreview.style.display = 'block';
		};
		reader.readAsDataURL(input.files[0]);
	}

	function confirmAdd() {
		// Get the selected member 's name 
		var eventName = document.getElementById("eventName").options[document.getElementById("eventName").selectedIndex]
			.text;
		// Display a confirmation dialog with the member's name 
		var result = confirm("Are you sure you want to add " + eventName + "as new event?");
		// If user confirms, submit the form 
		if (result == 1) {
			document.getElementById("addEvent").submit();
		} else {
			event.preventDefault();
		}
	}
</script>


</html>