<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Event</title>
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
		height: 500px;
	}
</style>

<body>
	<?php include("../Root/link.php");
	include("../Root/connect-db.php");
	include("../Process/getEventDetails.php");
	include("header.php");
	date_default_timezone_set('Asia/Kuala_Lumpur');
	?>
	<main id="main">

		<!-- ======= Breadcrumbs Section ======= -->
		<section class="breadcrumbs">
			<div class="container">

				<div class="d-flex justify-content-between align-items-center">
					<h2>Edit Event</h2>
					<ol>
						<li><a href="Home.php">Home</a></li>
						<li><a href="Event.php">Event</a></li>
						<li>Edit Event</li>
					</ol>
				</div>
			</div>
		</section><!-- End Breadcrumbs Section -->

		<!-- ======= Portfolio Details Section ======= -->
		<section id="portfolio-details" class="portfolio-details">
			<div class="container">
				<div class="row gy-4">
					<div class="col-lg-5">
						<div class="portfolio-details-slider swiper">
							<div class="swiper-wrapper align-items-center">

								<div class="swiper-slide">
									<img class="rounded" id="event-pic"
										src="<?php echo $event_upl_path; ?>"
										alt="photo">
									<!-- Add an empty <img> tag to display the uploaded image preview -->
									<img class="rounded" id="imagePreview" src="#" alt="Uploaded Image"
										style="display: none;">
								</div>

							</div>
							<div class="swiper-pagination"></div>
						</div>
					</div>

					<div class="col-lg-7">

						<div class="portfolio-info rounded-sm">
							<h3>Event Details</h3>
							<form id="editEvent" action="../Process/add_edit_event.php" method="POST"
								class="form-horizontal" role="form" enctype="multipart/form-data">
								<!-- Name -->
								<div class="input-group my-4">
									<span class="input-group-text">Name</span>
									<input type="text" id="eventName" class="form-control" placeholder="Event Name"
										name="eventName"
										value="<?php echo $event_name; ?>"
										type="text" require minlength="3" maxlength="50">
								</div>
								<!-- Category -->
								<div class="input-group my-4">
									<span class="input-group-text">Event Type</span>
									<select class="form-select" id="eventType" name="eventType" required>
										<?php
	                                    for ($i = 1; $i < count($event_type_ID); $i++) {
	                                        if ($event_type_ID[$i] == $eventID) {
	                                            echo "<option value='".$event_type_ID[$i]."' selected>".$event_type_db[$i]."</option>";
	                                        } else {
	                                            echo "<option value='".$event_type_ID[$i]."'>".$event_type_db[$i]."</option>";
	                                        }
	                                    }
	?>
									</select>

								</div>
								<!-- Date -->
								<div class="input-group my-4">
									<span class="input-group-text">Date</span>
									<input class="form-control" name="eventDate" type="date"
										value="<?php echo $event_date;?>"
										require />
								</div>
								<!-- Location -->
								<div class="input-group my-4">
									<span class="input-group-text">Location</span>
									<select class="form-select" id="location" name="location" required>
										<option value="" disabled selected>Select Location</option>
										<?php
	                                        for ($i = 1; $i < count($event_location_ID); $i++) {
	                                            if ($event_location_ID[$i] == $event_location_ID_cmp) {
	                                                echo "<option value='".$event_location_ID[$i]."' selected>".$address_db[$i]." (".$OI[$i].") </option>";
	                                            } else {
	                                                echo "<option value='".$event_location_ID[$i]."'>".$address_db[$i]." (".$OI[$i].") </option>";
	                                            }
	                                        }
	?>
									</select>

								</div>
								<!-- Hoster -->
								<div class="input-group my-4">
									<span class="input-group-text">Hoster</span>
									<input type="text" class="form-control" placeholder="Hoster" name="eventHoster" id="eventHoster"
										value="<?php echo $event_hoster; ?>"
										type="text" require maxlength="50">
								</div>

								<!-- Start Time -->
								<div class=" input-group my-4">
									<span class="input-group-text">Start Time</span>
									<input class="form-control" name="startTime" type="time"
										value="<?php echo $start_time;?>"
										require />
								</div>

								<!-- End Time -->
								<div class="input-group my-4">
									<span class="input-group-text">End Time &nbsp;</span>
									<input class="form-control" name="endTime" type="time"
										value="<?php echo $end_time;?>"
										require />
								</div>

								<!-- Max User -->
								<div class="input-group my-4">
									<span class="input-group-text">Max User</span>
									<input class="form-control" type="number" name="maxUser" id="maxUser"
										value="<?php echo $max_user;?>"
										require minlength="1" maxlength="60" />
								</div>
								<div class="input-group my-4">
									<span class="input-group-text">Photo</span>
									<input type="file" name="eventPic" id="eventPic" onchange="previewImage(event)"
										class="form-control">
								</div>
								<input type="hidden" name="eventUplFileName"
									value="<?php echo $event_upl_file_name; ?>">
								<input type="hidden" name="eventUplPath"
									value="<?php echo $event_upl_path; ?>">
								<input type="hidden" name="actionType" value="editEvent">
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
										rows="5"
										maxlength="1000"><?php echo $event_desc; ?></textarea>
								</div>
							</div>
							<!-- Save -->
							<div class="form-group my-2">
								<label class="col-md-3 control-label"></label>
								<div class="col-md-8">
									<button class="btn btn-primary" name="editEvent" type="submit"
										value="<?php echo $eventID; ?>"
										onclick="confirmEdit();">Save Changes</button>
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
<script defer>
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

	function confirmEdit() {
		var eventName = document.getElementById("eventName").options[document.getElementById("eventName").selectedIndex]
			.text;
		// Display a confirmation dialog with the member's name 
		var result = confirm("Are you sure the entered details for" + eventName + "are correct?");
		// If user confirms, submit the form 
		if (result == 1) {
			document.getElementById("editEvent").submit();
		} else {
			event.preventDefault();
		}
	}
	document.getElementById('editEvent').addEventListener('submit', function(event) {
		var eventNameInput = document.getElementById('eventName').value;
		var eventHoster = document.getElementById('eventHoster').value;
		var maxUser = document.getElementById('maxUser').value;
		var regex = /^[a-zA-Z0-9\s]*$/; 
		if (eventNameInput.length == 0 || eventNameInput.length > 50) {
			event.preventDefault(); 
			alert('Event name must be between 3 and 50 characters.');
		}
		if (!regex.test(eventNameInput)) {
			event.preventDefault(); 
			alert('Event name can only contain letters, numbers, and spaces.');
		}
		if (eventHoster.length == 3 || eventHoster.length > 50) {
			event.preventDefault(); 
			alert('Hoster name must be between 1 and 50 characters.');
		}
		if (maxUser == 0 || maxUser > 60) {
			event.preventDefault(); 
			alert('Max user must be between 1 and 60.');
		}
		var eventDateInput = document.getElementById('eventDate').value;
		var today = new Date(); 
		if (eventDateInput <= today) {
			event.preventDefault(); 
			alert('Please select a date in the future.');
		}
	});
</script>

</script>

</html>