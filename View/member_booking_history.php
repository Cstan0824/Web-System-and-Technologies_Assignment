<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Profile</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<link href="../Css/assets/css/profile-style.css" rel="stylesheet" />

	<?php session_start();
	if (!isset($_SESSION['role']) || $_SESSION['role'] == null || $_SESSION['role'] != "Member" &&   $_SESSION['role'] != "Staff") {
	    session_destroy();
	    header("Location: login_signup.php");
	}?>

</head>

<body>
	<?php
	include('../Root/link.php');
	include('header.php');
	include('../Root/connect-db.php');
	?>

	<?php

	$sql = "";

	$sql = "SELECT B.Booking_id, E.Event_id, E.Event_name, E.Event_desc, E.Event_date, E.Start_time, E.Event_upl_path, E.Event_upl_file_name
    FROM T_EVENT E  
    JOIN T_BOOKING B ON E.Event_id = B.Event_id 
    LEFT JOIN T_BOOKING_CANCELLATION BC ON B.Booking_id = BC.Booking_id 
    WHERE B.Member_id = '".$_SESSION['Member_id']."' AND BC.Booking_id IS NULL AND E.Event_date < CURDATE()
    ORDER BY Event_date DESC;";

	$past_event = array();
	$result = $connect_db->query($sql);
	while($row = $result->fetch_assoc()) {
	    $past_event[] = array(
	        "Booking_id" => $row["Booking_id"] ?? 0,
	        "Event_id" => $row["Event_id"],
	        "Event_name" => $row["Event_name"],
	        "Event_desc" => $row["Event_desc"],
	        "Event_date" => $row["Event_date"],
	        "Start_time" => $row["Start_time"],
	        "Event_upl_path" => $row["Event_upl_path"],
	        "Event_upl_file_name" => $row["Event_upl_file_name"],
	        "DateCountDown" => date_diff(date_create(date("Y-m-d")), date_create($row["Event_date"]))->format("%R%a")
	    );
	}
	$connect_db->close();

	$page = $_POST['page'] ?? 1;
	$pageCount = ceil(count($past_event) / 4);
	?>

	<main id="main">

		<!-- ======= Breadcrumbs Section ======= -->
		<section class="breadcrumbs">
			<div class="container">

				<div class="d-flex justify-content-between align-items-center">
					<h2>Booking History</h2>
					<ol>
						<li><a href="Home.php">Home</a></li>
						<li><a href="profile.php">Profile</a></li>
						<li>Booking History</li>
					</ol>
				</div>

			</div>
		</section><!-- End Breadcrumbs Section -->

		<section class="inner-page">
			<div class="container">
				<div class="container">
					<div class="row">
						<div class="profile-nav col-md-3">
							<div class="panel panel-default">
								<div class="user-heading round">
									<a href="#" class="position-relative" onclick="openImageUploader();"
										data-bs-content="Click to change Profile Picture." title="Profile Picture"
										data-bs-placement="right" data-bs-toggle="popover" data-bs-trigger="hover">
										<img id="old-profilepic"
											src="<?php echo $_SESSION['user_pic_path'] ?? "../Image/profile_picture/Default-ProfilePicture.jpg" ?>"
											alt="<?php echo $_SESSION['user_pic_file_name'] ?? "default"; ?>" />
									</a>

									<h1><?php echo $_SESSION['user_name'];?>
									</h1>
									<p><?php echo $_SESSION['user_email']; ?>
									</p>
								</div>
								<div class="panel-body">
									<ul class="profilenav list-group rounded-0"
										style="list-style-type: none; padding-left: 0px;">
										<?php
	                                        if($_SESSION['role'] == "Member") {
	                                            echo "<a href='profile.php' class='list-group-item
                                                 list-group-item-action px-2'><i <i class='fa-regular fa-address-card ps-2 pe-3'
                                            style='color:#898B9B;'></i> Profile</a>";
	                                        }
	?>
										<a href="edit_profile.php"
											class="list-group-item list-group-item-action px-2"><i
												class="fa fa-edit ps-2 pe-3" style="color:#898B9B;"></i> Edit
											Profile</a>
									</ul>
								</div>
							</div>
						</div>
						<div class="profile-info col-md-9">
							<div>
								<br>
								<h4>Past Events</h4>
								<br>
								<?php if(count($past_event) != 0) {?>
								<div class="row justify-content-between">
									<?php for($i = ($page - 1) * 4; $i < $page * 4 && $i < count($past_event);$i++): ?>
									<?php
									$imgName = $past_event[$i]["Event_upl_file_name"] ?? "default";
									$imgPath = $past_event[$i]["Event_upl_path"] ?? "../Image/AI Aware.jpg";
									$dayPastOrFuture = $past_event[$i]["DateCountDown"] < 0 ? "ago" : "left";
									$color = $past_event[$i]["DateCountDown"] > 0 ? "text-success" : "text-danger";
									    ?>
									<div class="panel col-md-5 col-sm-12 p-2 m-2 border bg-light text-left rounded ">
										<div class="panel-body d-flex flex-warp">
											<div class="bio-chart d-flex align-items-center justify-content-center">
												<div style="width:150px;height:150px;" class="d-block">
													<img class="upcoming-event-img img-thumbnail event_id"
														<?php echo "src='$imgPath' alt='$imgName'"?>
													data-bs-trigger="hover"
													data-bs-content="<?php echo $past_event[$i]["Event_desc"]; ?>"
													data-bs-placement="top" data-bs-toggle="popover" title="Click to see
													more!"
													data-event-id="<?php echo $past_event[$i]["Event_id"]; ?>"/>
												</div>
											</div>
											<div class="bio-desk ps-3">
												<h4 class="text-info" style="font-size:1.2em;">
													<strong>
														<?php echo $past_event[$i]["Event_name"] ?>
													</strong>

												</h4>
												<p><i class="fas fa-calendar" style="color:#898B9B;"></i>
													<?php echo $past_event[$i]["Event_date"] ?>
												</p>
												<p><i class="fas fa-hourglass-start <?php echo $color; ?>"
														style="color:#898B9B;"></i>
													<?php echo abs($past_event[$i]["DateCountDown"]).
									                "days $dayPastOrFuture"; ?>
												</p>
												</p>
												<p><i class="far fa-clock" style="color:#898B9B;"></i>
													<?php echo $past_event[$i]["Start_time"]; ?>
												</p>
											</div>

										</div>
									</div>
									<?php endfor; ?>
									<form
										action="<?php echo $_SERVER["PHP_SELF"]; ?>"
										method="post">
										<ul class="pagination">
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
									<?php } else {
							    echo "<h5>No past events found.</h5>";
							}?>
								</div>
							</div>
							
					</div>
				</div>
			</div>
			</div>
		</section>

	</main><!-- End #main -->

	<?php include('footer.php'); ?>

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
			class="bi bi-arrow-up-short"></i></a>
	<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


</body>
<script defer>
	document.addEventListener("DOMContentLoaded", function() {
		var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
		var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
			return new bootstrap.Popover(popoverTriggerEl);
		});

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
	Array.from(document.getElementsByClassName("event_id"))
		.forEach(element => element.addEventListener("click", (
			event) => {
			const eventId = event.currentTarget.getAttribute('data-event-id');
			if (eventId) {
				window.location.href = "event_details.php?event_id=" + eventId;
			}
			console.log(eventId);
		}));
</script>

</html>