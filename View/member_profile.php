<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Member Profile</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<link href="../Css/assets/css/profile-style.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
	<?php
    include('../Root/link.php');
	include('../Root/connect-db.php');

	$memberID = $_GET["Member_id"];

	session_start();
	if (!isset($_SESSION['role']) || $_SESSION['role'] == null || $_SESSION['role'] != "Member" &&   $_SESSION['role'] != "Staff") {
	    session_destroy();
	    header("Location: login_signup.php");
	}

	//get user details
	$sql = "SELECT * FROM T_Member WHERE Member_id = '$memberID';";
	$result = $connect_db->query($sql);
	$member_details = array();
	while($row = $result->fetch_assoc()) {
		$member_details = array(
	        "Member_id" => $row["Member_id"],
	        "Member_name" => $row["Member_name"],
	        "Member_email" => $row["Member_email"],
	        "Member_regisdate" => $row["Member_regisdate"],
	        "Member_upl_file_name" => $row["Member_upl_file_name"],
	        "Member_upl_path" => $row["Member_upl_path"],
	        "Member_comment" => $row["Member_comment"]
	    );
	}

    //get user upcoming event
	$sql1 = "";
	$sql1 = "SELECT M.Member_id, M.Member_name, M.Member_email, M.Member_password, M.Member_regisdate, M.Member_upl_file_name, M.Member_upl_path, M.Member_comment, B.Booking_id, E.Event_id, E.Event_name,E.Event_desc, E.Event_date, E.Start_time, E.Event_upl_path, E.Event_upl_file_name
    FROM T_Member M
    JOIN T_BOOKING B ON M.Member_id = B.Member_id
    JOIN T_EVENT E ON E.Event_id = B.Event_id
    LEFT JOIN T_BOOKING_CANCELLATION BC ON B.Booking_id = BC.Booking_id 
    WHERE M.Member_id = '$memberID' AND BC.Booking_id IS NULL AND E.Event_date >= CURDATE()
    ORDER BY Event_date DESC;";

	$upcoming_event = array();
	$result1 = $connect_db->query($sql1);
	while($row = $result1->fetch_assoc()) {
	    $upcoming_event[] = array(
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

	$pageForUpcoming = $_POST['pageForUpcoming'] ?? 1;
	$pageCountForUpcoming = ceil(count($upcoming_event) / 4);

	//get user past events
	$sql2 = "";
	$sql2 = "SELECT B.Booking_id, E.Event_id, E.Event_name, E.Event_desc, E.Event_date, E.Start_time, E.Event_upl_path, E.Event_upl_file_name
    FROM T_EVENT E  
    JOIN T_BOOKING B ON E.Event_id = B.Event_id 
    LEFT JOIN T_BOOKING_CANCELLATION BC ON B.Booking_id = BC.Booking_id 
    WHERE B.Member_id = '$memberID' AND BC.Booking_id IS NULL AND E.Event_date < CURDATE()
    ORDER BY Event_date DESC;";

	$past_event = array();
	$result2 = $connect_db->query($sql2);
	while($row = $result2->fetch_assoc()) {
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


	$pageForPast = $_POST['page'] ?? 1;
	$pageCountForPast = ceil(count($past_event) / 4);


	$sql3 = "SELECT COUNT(*) as TotalBooking 
	FROM T_BOOKING B
	JOIN T_MEMBER M ON M.Member_id = B.Member_id
	LEFT JOIN T_BOOKING_CANCELLATION BC ON B.Booking_id = BC.Booking_id
	WHERE M.Member_id = '$memberID' AND BC.Booking_id IS NULL;";
	$result3 = $connect_db->query($sql3);
	$row = $result3->fetch_assoc();
	$totalBooking = $row["TotalBooking"];

	$sql4 = "SELECT COUNT(*) as TotalEvent 
	FROM T_EVENT E 
	LEFT JOIN T_EVENT_CANCELLATION EC ON E.Event_id = EC.Event_id 
	WHERE EC.Event_id IS NULL;";
	$result4 = $connect_db->query($sql4);
	$row = $result4->fetch_assoc();
	$totalEvent = $row["TotalEvent"];

	$bookingPercentage = ($totalBooking / $totalEvent) * 100;
	$eventPercentage = 100 - $bookingPercentage;

	$connect_db->close();

	?>
</head>

<body style="background-color:#F1F2F7;">
	<?php

	include('header.php');
	?>


	<main id="main">

		<!-- ======= Breadcrumbs Section ======= -->
		<section class="breadcrumbs">
			<div class="container">

				<div class="d-flex justify-content-between align-items-center">
					<h2>Profile</h2>
					<ol>
						<li><a href="Home.php">Home</a></li>
						<li>Profile</li>
					</ol>
				</div>

			</div>
		</section><!-- End Breadcrumbs Section -->

		<section class="inner-page">
			<div class="container">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div style="background-color: white;">
							<h2>Statistics</h2>
							<canvas id="myPieChart"></canvas>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="profile-nav col-md-3">
							<div class="panel panel-default">
								<div class="user-heading round">
									<a href="#" class="position-relative" onclick="openImageUploader();"
										data-bs-content="Click to change Profile Picture." title="Profile Picture"
										data-bs-placement="right" data-bs-toggle="popover" data-bs-trigger="hover">
										<img src="<?php echo $member_details['Member_upl_path'] ?? "../Image/profile_picture/Default-ProfilePicture.jpg" ?>"
											alt="<?php echo $member_details['Member_upl_file_name'] ?? "default"; ?>" />
									</a>



									<h1><?php echo $member_details['Member_name'];?>
									</h1>
									<p><?php echo $_SESSION['user_email']; ?>
									</p>
								</div>
								<div class="panel-body">
									<ul class="profilenav list-group rounded-0"
										style="list-style-type: none; padding-left: 0px;">
										
										<a href="staff_edit_memberProfile.php?member_id=<?php echo $member_details['Member_id']; ?>"
											class="list-group-item list-group-item-action px-2"><i
												class="fa fa-edit ps-2 pe-3" style="color:#898B9B;"></i> Edit
											Member Profile</a>
									</ul>
								</div>
							</div>
						</div>
						<div class="profile-info col-md-9">
							
							<div class="panel bg-light">
								<div class="bio-graph-heading">
									<?php echo $member_details['Member_comment']; ?>
								</div>
							</div>
							<div class="panel bg-light">
								<div class="panel-body bio-graph-info row ms-2">
									<h1 class="mt-2" style="font-weight:bold;">
										Member Profile
									</h1>
									<div class="ms-3">
										<div class="bio-row">
											<p><span>ID </span>:
												<?php echo $member_details['Member_id'];?>
											</p>
										</div>
										<div class="bio-row">
											<p><span>Name </span>:
												<?php echo $member_details['Member_name'];?>
											</p>
										</div>
									</div>
									<div class="ms-3">
										<div class="bio-row">
											<p><span>Email </span>:
												<?php echo $member_details['Member_email'];?>
											</p>
										</div>
										<div class="bio-row">
											<p><span>Joined Date </span>:
												<?php echo $member_details['Member_regisdate'];?>
											</p>
										</div>
									</div>

								</div>
							</div>
							<div>
								<br>
								<h4>
									Member's Upcoming Events
								</h4>
								<br>
								<?php if(count($upcoming_event) != 0) {?>
								<div class="row justify-content-between">
									<?php for($i = ($pageForUpcoming - 1) * 4; $i < $pageForUpcoming * 4 && $i < count($upcoming_event);$i++): ?>
									<?php
	                                $submitValue = $_SESSION['role'] == "Member"
	                                ?
	                                $upcoming_event[$i]["Booking_id"]
	                                :
	                                $upcoming_event[$i]["Event_id"];

									    $imgName = $upcoming_event[$i]["Event_upl_file_name"] ?? "default";
									    $imgPath = $upcoming_event[$i]["Event_upl_path"] ?? "../Image/event_picture/Default=EventPicture.jpg";
									    $dayPastOrFuture = $upcoming_event[$i]["DateCountDown"] < 0 ? "ago" : "left";
									    $color = $upcoming_event[$i]["DateCountDown"] > 0 ? "text-success" : "text-danger";
									    ?>
									<div class="panel col-md-5 col-sm-12 p-2 m-2 border bg-light text-left rounded ">
										<div class="panel-body d-flex flex-warp">
											<div class="bio-chart d-flex align-items-center justify-content-center">
												<div style="width:150px;height:150px;" class="d-block">
													<img class="upcoming-event-img img-thumbnail event_id"
														<?php echo "src='$imgPath' alt='$imgName'"?>
													data-bs-trigger="hover"
													data-bs-content="<?php echo $upcoming_event[$i]["Event_desc"]; ?>"
													data-bs-placement="top" data-bs-toggle="popover" title="Click to see
													more!"
													data-event-id="<?php echo $upcoming_event[$i]["Event_id"]; ?>"/>
												</div>
											</div>
											<div class="bio-desk ps-3">
												<h4 class="text-info" style="font-size:1.2em;">
													<strong>
														<?php echo $upcoming_event[$i]["Event_name"] ?>
													</strong>

												</h4>
												<p><i class="fas fa-calendar" style="color:#898B9B;"></i>
													<?php echo $upcoming_event[$i]["Event_date"] ?>
												</p>
												<p><i class="fas fa-hourglass-start <?php echo $color; ?>"
														style="color:#898B9B;"></i>
													<?php echo abs($upcoming_event[$i]["DateCountDown"]).
									                "days $dayPastOrFuture"; ?>
												</p>
												</p>
												<p><i class="far fa-clock" style="color:#898B9B;"></i>
													<?php echo $upcoming_event[$i]["Start_time"]; ?>
												</p>
												<form
													action="<?php echo $submitPath; ?>"
													method="post">

													<button type="submit" class="btn btn-danger"
														style="float:right;clear:right;"
														value="<?php echo $submitValue; ?>"
														name="delete">Cancel
													</button>
												</form>
											</div>

										</div>
									</div>
									<?php endfor; ?>
								</div>
								<form
									action="<?php echo $_SERVER["PHP_SELF"]; ?>"
									method="post">

									<ul class="pagination">
										<li class="page-item">
											<button id="prevPageForUpcoming" class="page-link disabled" type="submit"
												<?php echo "name='page' value='" .max($pageForUpcoming - 1, 1). "'" ?>>
												Previous
											</button>
										</li>
										<?php for ($i = 1; $i <= $pageCountForUpcoming; $i++): ?>
										<li class="page-item">
											<button
												class="page-link <?php echo ($pageForUpcoming == $i) ? "disabled bg-muted" : ""; ?>"
												type="submit"
												<?php echo "name='page' value='$i'" ?>><?php echo $i ?></button>
										</li>
										<?php endfor ?>
										<li class="page-item">
											<button id="nextPageForUpcoming" class="page-link disabled" type="submit"
												<?php echo "name='page' value='".min($pageForUpcoming + 1, $pageCountForUpcoming). "'" ?>>
												Next
											</button>
										</li>
									</ul>
								</form>
								<?php } else {
							    echo "<h5>No upcoming events found.</h5>";
							}?>
							</div>
							<div>
								<br>
								<h4>Member's Past Events</h4>
								<br>

								<?php if(count($past_event) != 0) {?>
								<div class="row justify-content-between">
									<?php for($i = ($pageForPast - 1) * 4; $i < $pageForPast * 4 && $i < count($past_event);$i++): ?>
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
												<button id="prevPageForPast" class="page-link disabled" type="submit"
													<?php echo "name='pageForPast' value='" .max($pageForPast - 1, 1). "'" ?>>
													Previous
												</button>
											</li>
											<?php for ($i = 1; $i <= $pageCountForPast; $i++): ?>
											<li class="page-item">
												<button
													class="page-link <?php echo ($pageForPast == $i) ? "disabled bg-muted" : ""; ?>"
													type="submit"
													<?php echo "name='pageForPast' value='$i'" ?>><?php echo $i ?></button>
											</li>
											<?php endfor ?>
											<li class="page-item">
												<button id="nextPageForPast" class="page-link disabled" type="submit"
													<?php echo "name='pageForPast' value='".min($pageForPast + 1, $pageCountForPast). "'" ?>>
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
<script>
	document.addEventListener("DOMContentLoaded", function() {
		var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
		var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
			return new bootstrap.Popover(popoverTriggerEl);
		});

		//pagination disabled
		var prevPageForUpcoming = document.getElementById("prevPageForUpcoming");
		var nextPageForUpcoming = document.getElementById("nextPageForUpcoming");

		var pageForUpcoming = <?php echo $pageForUpcoming ?> ;
		var totalPageForUpcoming = <?php echo $pageCountForUpcoming ?> ;
		//console.log(page, totalPage);
		prevPageForUpcoming.classList.remove("disabled");
		nextPageForUpcoming.classList.remove("disabled");
		if (pageForUpcoming === totalPageForUpcoming) {
			nextPageForUpcoming.classList.add("disabled");

		}
		if (pageForUpcoming === 1) {
			prevPageForUpcoming.classList.add("disabled");
		}

		//pagination disabled
		var prevPageForPast = document.getElementById("prevPageForPast");
		var nextPageForPast = document.getElementById("nextPageForPast");

		var pageForPast = <?php echo $pageForPast ?> ;
		var totalPageForPast = <?php echo $pageCountForPast ?> ;
		//console.log(page, totalPage);
		prevPageForPast.classList.remove("disabled");
		nextPageForPast.classList.remove("disabled");
		if (pageForPast === totalPageForPast) {
			nextPageForPast.classList.add("disabled");

		}
		if (pageForPast === 1) {
			prevPageForPast.classList.add("disabled");
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

	function openImageUploader() {
		var input = document.createElement('input');
		input.type = 'file';
		input.accept = 'image/*';
		input.onchange = function(event) {
			var file = event.target.files[0];
			uploadProfilePicture(file);
		};
		input.click();
	}

	function uploadProfilePicture(file) {
		var formData = new FormData();
		formData.append('profile_picture', file);

		fetch('../Process/profile_upl_file.php', {
				method: 'POST',
				body: formData
			})
			.then(response => response.text())
			.then(data => {
				console.log(data);
				location.reload();
			})
			.catch(error => {
				console.error(error);
			});
	}

	var ctx = document.getElementById('myPieChart').getContext('2d');
	var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['<?php echo $member_details['Member_name'];?> Bookings', 'Remaining Events'],
        datasets: [{
            data: [<?php echo $bookingPercentage; ?>, <?php echo $eventPercentage; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)', // Red for Bookings
                'rgba(54, 162, 235, 0.6)'   // Blue for Remaining Events
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'Booking Percentage compared to Total Events',
            fontSize: 15 // Adjust the font size as needed
        },
        legend: {
            display: true,
            position: 'bottom'
        },
        tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {
                    var dataset = data.datasets[tooltipItem.datasetIndex];
                    var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                        return previousValue + currentValue;
                    });
                    var currentValue = dataset.data[tooltipItem.index];
                    var percentage = Math.floor(((currentValue / total) * 100) + 0.5);  
                    return percentage + '%'; // Add percentage symbol
                }
            }
        }
    }
});
</script>

</html>