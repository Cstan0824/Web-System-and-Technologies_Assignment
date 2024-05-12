<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Events</title>
	<?php include("../Root/link.php") ?>
	<?php include("../Root/connect-db.php"); ?>

	<!-- <script scr="../Process/event.js" defer></script> -->
	<style>
		body {
			margin-top: 20px;
			background: #eee;
		}

		.btn {
			margin-bottom: 5px;
		}

		.grid {
			position: relative;
			width: 100%;
			background: #fff;
			color: #666666;
			border-radius: 2px;
			margin-bottom: 25px;
			box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
		}

		.grid .grid-body {
			padding: 15px 20px 15px 20px;
			font-size: 0.9em;
			line-height: 1.9em;
		}

		.search table tr td.rate {
			color: #f39c12;
			line-height: 50px;
		}

		.search table tr:hover {
			cursor: pointer;
		}

		.search table tr td.image {
			width: 50px;
		}

		.search table tr td img {
			width: 50px;
			height: 50px;
		}

		td {
			vertical-align: middle;

		}

		input[type="search"]:focus {
			box-shadow: none;
			border: 1px solid #DEE2E6;
		}

		.searchBox {
			position: relative;
			width: 100%;
		}

		.searchBox .searchResult {
			position: sticky;
			top: 0;
			left: 0;
		}

		.edit-button,
		.delete-button {
			text-decoration: none;
			background-color: transparent;
			border: none;
			font-size: 20px;
			color: #67b0d1;
		}

		.delete-button:hover {
			color: red;
		}

		.edit-button:hover {
			color: rgba(18, 237, 0, 1);
		}

		.image-adjustment {
			width: 100%;
			height: 330px;
		}

		#myPieChart, #myBarChart{
		width: 700px;
		height: 700px;
		}

	</style>

</head>
<script>

</script>


<body>
	<?php
    $reviewStar = array("<i class='fa fa-star'></i>","<i class='fa fa-star-half-o'></i>","<i class='fa fa-star-o'></i>");

	$FilterSearch = $_POST["FilterSearch"] ?? "";
	$filterByCategory = $_POST["filterByCategory"] ?? "";
	$filterByDate = $_POST["filterByDate"] ?? "";
	$filterByOther = $_POST["filterByOther"] ?? "trend";

	echo "<script>console.log('filter: $filterByCategory, filterByOther: $filterByOther,filterByDate: $filterByDate')</script>";
	$filterWithCategory = "";
	$filterWithOrdering = "";
	$filterWithDate = "";

	switch($filterByCategory) {
	    case "Famous Actor Meeting":
	    case "Movie Sharing Session":
	    case "Movie Premiere":
	        $filterWithCategory = "AND ET.Event_type = upper('$filterByCategory')";
	        break;
	    default:
	        break;
	}

	switch($filterByOther) {
	    case "trend":
	        $filterWithOrdering = "ORDER BY NumOfBooking DESC";
	        break;
	    case "recent":
	        $filterWithOrdering = "ORDER BY Event_date DESC";
	        break;
	    default:
	        break;
	}
	if($filterByDate == "date") {
	    $startDate = $_POST["startDate"];
	    $endDate = $_POST["endDate"];
	    $filterWithDate = "AND E.Event_date BETWEEN '$startDate' AND '$endDate'";

	}


	$sql = "SELECT COUNT(*) NumOfMember FROM T_Member;";
	$result = $connect_db->query($sql);
	$numOfMember = 0;

	if($row = $result->fetch_assoc()) {
	    $numOfMember = $row["NumOfMember"];
	}
	$searchSql = !empty($FilterSearch) ? "AND Event_name LIKE '%$FilterSearch%'" : "";
	$sql =
	"SELECT E.Event_id, E.Event_name, E.Event_desc, E.Event_date, ET.Event_type, E.Event_upl_path, E.Event_upl_file_name, COUNT(B.Event_id) AS NumOfBooking
		FROM T_Event E
		JOIN T_Event_Type ET ON E.Event_type_id = ET.Event_type_id
		LEFT JOIN T_Booking B ON E.Event_id = B.Event_id
		LEFT JOIN T_Event_cancellation EC ON E.Event_id = EC.Event_id
		WHERE 1=1 $searchSql $filterWithCategory $filterWithDate AND EC.Event_id IS NULL
		GROUP BY E.Event_id
		$filterWithOrdering;";

	$result = $connect_db->query($sql);
	$data = array();
	while($row = $result->fetch_assoc()) {
	    $data[] = array(
	        "Event_id" => $row["Event_id"],
	        "Event_name" => $row["Event_name"],
	        "Event_desc" => $row["Event_desc"],
	        "Event_date" => $row["Event_date"],
	        "Event_type" => $row["Event_type"],
	        "Event_upl_path" => $row["Event_upl_path"],
	        "Event_upl_file_name" => $row["Event_upl_file_name"],
	        "Reviews" => ($row["NumOfBooking"] / $numOfMember) * 5.0
	    );
	}


	$display = isset($_POST['display']) ? $_POST['display'] : "table";
	$page = isset($_POST['page']) ? $_POST['page'] : 1;
	$numberOfResults = isset($data) ? count($data) : 0;

	$pageCount = (int)$numberOfResults != 0 ? ceil(((int)$numberOfResults / 6)) : 1;
	session_start();
	if (!isset($_SESSION['role']) || $_SESSION['role'] == null || $_SESSION['role'] != "Member" && $_SESSION['role'] != "Staff") {
	    session_destroy();
	    header("Location: login_signup.php");
	}

	//count data for pie chart
	$sql_count_event =
	"SELECT COUNT(*) AS NumOfBooking, ET.Event_type AS 'EventType' 
	FROM T_Booking B 
	JOIN T_Event E ON B.Event_id = E.Event_id 
	JOIN T_Event_Type ET ON E.Event_type_id = ET.Event_type_id 
	LEFT JOIN T_Event_Cancellation EC ON E.Event_id = EC.Event_id 
	LEFT JOIN T_Booking_Cancellation BC ON B.Booking_id = BC.Booking_id
	WHERE EC.Event_id IS NULL AND BC.Booking_id IS NULL
	GROUP BY ET.Event_type;";

	$labelForPieChart = array("Movie Sharing Session", "Movie Premiere", "Famous Actor Meeting");
	$event_type_data = array(0, 0, 0);

	$result_count_event = $connect_db->query($sql_count_event);
	while($row = $result_count_event->fetch_assoc()) {
	    if ($row["EventType"] == "MOVIE SHARING SESSION") {
	        $event_type_data[0] = $row["NumOfBooking"];
	    } elseif ($row["EventType"] == "MOVIE PREMIERE") {
	        $event_type_data[1] = $row["NumOfBooking"];
	    } elseif ($row["EventType"] == "FAMOUS ACTOR MEETING") {
	        $event_type_data[2] = $row["NumOfBooking"];
	    }
	}

	$sql_sum_event_booking = "SELECT COUNT(*) AS NumOfBooking 
	FROM T_Booking B
	JOIN T_Event E ON B.Event_id = E.Event_id 
	LEFT JOIN T_Event_Cancellation EC ON E.Event_id = EC.Event_id 
	LEFT JOIN T_Booking_Cancellation BC ON B.Booking_id = BC.Booking_id
	WHERE EC.Event_id IS NULL AND BC.Booking_id IS NULL;
	";

	$result_sum_event_booking = $connect_db->query($sql_sum_event_booking);
	if(!$result_sum_event_booking) {
	    echo $connect_db->error;
	}else{
	$row = $result_sum_event_booking->fetch_assoc();
	$sum_event_booking = $row["NumOfBooking"];
	}

	$percentage_data = array();
	foreach ($event_type_data as $count) {
		$percentage = ($count / $sum_event_booking) * 100;
		$percentage_data[] = number_format($percentage, 2); // Round to 2 decimal places
	}

	//check data
	echo "<script>console.log('movieSharringSession: ".$event_type_data[0].", moviePremiere: ".$event_type_data[1].", famousActorMeeting: ".$event_type_data[2].", total:".$sum_event_booking."')</script>";

	//data for bar chart
	$sql_get_numOfBookingPerMonth = "SELECT IFNULL(COUNT(B.Booking_id), 0) AS NumOfBooking, all_months.Month
	FROM (
		SELECT 1 AS Month UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL
		SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12
	) AS all_months
	LEFT JOIN T_Booking B ON MONTH(B.Booking_date) = all_months.Month
	LEFT JOIN T_Event E ON B.Event_id = E.Event_id
	LEFT JOIN T_Event_Cancellation EC ON E.Event_id = EC.Event_id
	LEFT JOIN T_Booking_Cancellation BC ON B.Booking_id = BC.Booking_id
	WHERE EC.Event_id IS NULL AND BC.Booking_id IS NULL
	GROUP BY all_months.Month;
	";

	$result_get_numOfBookingPerMonth = $connect_db->query($sql_get_numOfBookingPerMonth);
	$labelForBarChart = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	$numOfBookingPerMonth = array_fill(0, 12, 0);
	while($row = $result_get_numOfBookingPerMonth->fetch_assoc()) {
	    $numOfBookingPerMonth[$row["Month"] - 1] = $row["NumOfBooking"];
	}


	?>
	<?php include("header.php") ?>
	<main id="main">
		<!-- ======= Breadcrumbs Section ======= -->
		<section class="breadcrumbs">
			<div class="container">

				<div class="d-flex justify-content-between align-items-center">
					<h2>Events</h2>
					<ol>
						<li><a href="Home.php">Home</a></li>
						<li>Events</li>
					</ol>
				</div>

			</div>
		</section><!-- End Breadcrumbs Section -->

		<form
			action="<?php echo $_SERVER["PHP_SELF"]; ?>"
			method="POST">
			<section class="inner-page">
				<div class="container">
					<?php if($_SESSION['role'] == "Staff") { ?>
						<!-- BEGIN STATISTICS -->
							<div class="row">
								<div class="grid search">
								<h2><strong><i class="fa-solid fa-square-poll-vertical"></i> STATISTICS</strong></h2>
								<div class="col-md-9">
									<canvas id="myBarChart"></canvas>
								</div>
								<div class="col-md-3">
									<canvas id="myPieChart"></canvas>
								</div>
								</div>
							</div>
						<!-- END STATISTICS -->
					<?php } ?>
					<div class="row">

						<!-- BEGIN SEARCH FILTER -->
						<div class="col-md-3">
							<div class="grid search">
								<div class="grid-body">
									<div class="row">
										<!-- BEGIN FILTERS -->
										<input type="hidden" name="FilterSearch"
											value="<?php echo $FilterSearch; ?>">
										<input type="hidden" name="display"
											value="<?php echo $display; ?>">
										<input type="hidden" name="filterByCategory"
											value="<?php echo $filterByCategory; ?>">
										<input type="hidden" name="filterByDate"
											value="<?php echo $filterByDate; ?>">
										<input type="hidden" name="startDate"
											value="<?php echo $startDate; ?>">
										<input type="hidden" name="endDate"
											value="<?php echo $endDate; ?>">
										<input type="hidden" name="filterByOther"
											value="<?php echo $filterByOther; ?>">

										<div class="col-md">
											<h2 class="grid-title d-flex justify-content-between">
												<div>
													<i class="fa fa-filter"></i> Filters
												</div>

												<a data-bs-trigger="hover" data-bs-content="Click me to clear filter"
													data-bs-placement="top" data-bs-toggle="popover"
													title="Clear Filters"
													href="<?php echo $_SERVER["PHP_SELF"]; ?>"><i
														class="fa-solid fa-filter-circle-xmark"
														style="color: #74C0FC;"></i></a>
											</h2>

											<hr />
											<!-- BEGIN FILTER BY CATEGORY -->
											<h4><strong>Category</strong></h4>
											<div class="d-flex flex-wrap">
												<button type="submit" name="filterByCategory"
													class="btn btn-outline-light text-dark p-2 filter-category <?php echo ($filterByCategory == 'Famous Actor Meeting') ? 'active' : ''; ?>"
													value="Famous Actor Meeting">Actor Meeting</button>
												<button type="submit" name="filterByCategory"
													class="btn btn-outline-light text-dark p-2 filter-category <?php echo ($filterByCategory == 'Movie Sharing Session') ? 'active' : ''; ?>"
													value="Movie Sharing Session">Sharing Session</button>
												<button type="submit" name="filterByCategory"
													class="btn btn-outline-light text-dark p-2 filter-category <?php echo ($filterByCategory == 'Movie Premiere') ? 'active' : ''; ?>"
													value="Movie Premiere">Movie Premiere</button>
											</div>
											<!-- END FILTER BY CATEGORY -->

											<br />

											<!-- BEGIN FILTER BY DATE -->
											<h4><strong>Date</strong></h4>
											<div class="input-group mt-3">
												<span class="input-group-text">From</span>
												<input type="date" class="form-control" name="startDate"
													value="<?php echo $startDate ?? ""; ?>">
											</div>
											<div class="input-group mt-3">
												<span class="input-group-text">To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
												<input type="date" class="form-control" name="endDate"
													value="<?php echo $endDate ?? ""; ?>">
											</div>
											<button class="btn btn-light text-dark p-2 mt-3" name="filterByDate"
												value="date" style="border:solid #E5E5E5 1px;"
												onclick="inputValidation();">Filter
												Date</button>
											<!-- END FILTER BY DATE -->

											<br />
											<br />
											<!-- BEGIN FILTER BY OTHERS -->
											<h4><strong>OTHERS</strong></h4>
											<div class="btn-group ">
												<button
													class="btn btn-outline-light text-dark p-2 filter-others <?php echo ($filterByOther == 'trend') ? 'active' : ''; ?>"
													name="filterByOther" value="trend"
													style="border:solid #E5E5E5 1px;">Most
													Trending</button>
												<button
													class="btn btn-outline-light text-dark p-2 filter-others <?php echo ($filterByOther == 'recent') ? 'active' : ''; ?>"
													name="filterByOther" value="recent"
													style="border:solid #E5E5E5 1px;">Most
													Recently</button>
											</div>
											<br />
											<!-- END FILTER BY OTHERS -->
											<br />
											
										</div>

										<!-- END FILTERS -->

									</div>
								</div>
							</div>
						</div>
						<!-- END SEARCH FILTER -->

						<!-- BEGIN SEARCH RESULT -->
						<div class="col-md-9">
							<div class="grid search">
								<div class="grid-body">
									<div class="row">
										<!-- BEGIN RESULT -->

										<div class="col-md">
											<div class="d-flex justify-content-between align-items-center">
												<h2><i class="fa-solid fa-book"></i> Result</h2>
												<?php if($_SESSION['role'] == "Staff") {?>
												<a data-bs-trigger="hover" data-bs-content="Click me to add Event"
													data-bs-placement="top" data-bs-toggle="popover" title="Add Events"
													href="add_event.php">
													<i class="fa-solid fa-calendar-plus"
														style="color: #74C0FC;font-size:2.3em;"></i>
												</a>
												<?php } ?>

											</div>

											<hr>
											<!-- BEGIN SEARCH INPUT -->
											<form
												action="<?php echo $_SERVER["PHP_SELF"]; ?>"
												method="POST" class="searchBox">
												<div class="input-group">
													<span class="input-group-btn">
														<button class="btn btn-lg"
															style="border:1px solid #DEE2E6; border-right:none; border-bottom:none; border-top-right-radius:0px; border-bottom-left-radius:0px;  border-bottom-right-radius:0px; height: 100%;"
															type="submit"><i class="fa fa-search"></i></button>
													</span>
													<input type="search" class="form-control input-lg"
														style="border-left:none; border-bottom:none; border-bottom-right-radius:0px;"
														placeholder="Search Here..." minlength="1" maxlength="100"
														id="FilterSearch" name="FilterSearch">
												</div>
												<div id="search-result" class="search-result">
													<div id="search-list" class="list-group w-100"
														style="border:1px solid #DEE2E6; border-top:none; border-top-right-radius:0px; border-top-left-radius:0px;">
													</div>
												</div>
											</form>
											<!-- END SEARCH INPUT -->

											<p style="text-align:right;" id="searchContent">
												<span id="searchInput"></span>
												< <span id="searchCount">0</span> result
											</p>

											<!-- BEGIN DISPLAY MODE -->


											<div class="row">
												<div class="col-md text-left">
													<div class="btn-group">
														<button type="submit" name="display" value="table"
															id="tableMode"
															class="btn btn-outline-info display-mode active"><i
																class="fa fa-list"></i></button>
														<button type="submit" name="display" value="card"
															class="btn btn-outline-info display-mode active"
															id="cardMode"><i class="fa fa-th"></i></button>
													</div>
												</div>
											</div>


											<!--END DISPLAY MODE -->

											<br />
											<?php if($numberOfResults != 0 || !isset($FilterSearch)): ?>
											<?php if($display == "table"): ?>

											<!-- BEGIN TABLE RESULT -->
											<div class="table-responsive" data-aos="fade-up">
												<table class="table table-hover">
													<tbody>
														<?php for($i = ($page - 1) * 6; $i < ($page * 6) && $i < $numberOfResults; $i++): ?>
														<?php
	                                                    $imgPath = $data[$i]["Event_upl_path"] ?? "https://www.bootdey.com/image/400x300/FF8C00";
														    $imgName = $data[$i]["Event_upl_path"] ?? "default";
														    ?>
														<tr title="Click for more!" data-bs-toggle="popover"
															data-bs-trigger="hover"
															data-bs-content="<?php echo $data[$i]["Event_desc"]; ?>..."
															data-bs-placement="top" data-event-id=<?php echo $data[$i]["Event_id"];?>
															class="event_id">
															<td class="number text-center">
																<?php echo $i + 1 ?>
															</td>
															<td class="image">
																<?php echo "<img src='$imgPath' alt='$imgName' />"; ?>
															</td>
															<td class="event" id="event_name">
																<strong><?php echo $data[$i]["Event_name"]; ?></strong><br>
															</td>
															<td class="rate text-right">
																<span>
																	<?php
														                    $star = 5;
														    $reviews_intergralPart = (int)floor($data[$i]["Reviews"]);
														    $reviews_decimalPart = (int)$data[$i]["Reviews"] % 5.0;

														    for($j = 0; $star > 0 && $j < $reviews_intergralPart; $j++) {
														        $star--;
														        echo $reviewStar[0];
														    }
														    if($star > 0 && $reviews_decimalPart > 0) {
														        $star--;
														        echo $reviewStar[1];
														    }
														    for($n = 0; $star > 0 && $n < (5 - $reviews_intergralPart); $n++) {
														        $star--;
														        echo $reviewStar[2];
														    }
														    ?>
																</span>
															</td>
															<td><?php echo $data[$i]["Event_type"]; ?>
															</td>
															<td><?php echo $data[$i]["Event_date"]; ?>
															</td>
															<?php
														        if(isset($_SESSION['role']) && $_SESSION['role'] == "Staff") {
														            ?>
															<td>
																<a class='edit-button'
																	href='edit-event.php?event_id=<?php echo $data[$i]["Event_id"]; ?>'><i
																		class=' fa-regular fa-pen-to-square'></i></a>
															</td>
															<form id='delete_booking'
																action='../Process/delete_event.php' method='POST'>
																<td>
																	<button class='delete-button' type='submit'
																		name='delete'
																		value='<?php echo $data[$i]["Event_id"];?>'
																		onclick='confirmDelete();'>
																		<i class='fa-regular fa-trash-can'></i></button>
																</td>
															</form>
															<?php }; ?>

														</tr>
														<?php endfor ?>
													</tbody>
													<thead>
														<tr>
															<th class="number text-center text-info-50"></th>
															<th class="image"></th>
															<th class="event text-info">Events</th>
															<th class="rate text-right text-info">Trending</th>
															<th class="text-info">Category</th>
															<th class="text-info">Date</th>
															<?php if(isset($_SESSION['role']) && $_SESSION['role'] == "Staff") {
															    echo "<th class='number'></th>";
															    echo "<th class='number'></th>";
															} ?>
														</tr>
													</thead>
												</table>
											</div>
											<!-- END TABLE RESULT -->
											<?php else: ?>
											<!-- BEGIN PORTFOLIO RESULT -->
											<div class="row portfolio" data-aos="fade-up">
												<?php for($i = ($page - 1) * 6; $i < ($page * 6) && $i < $numberOfResults; $i++): ?>
												<?php
															$imgPath = $data[$i]["Event_upl_path"] ?? "https://www.bootdey.com/image/400x300/FF8C00";
												    $imgName = $data[$i]["Event_upl_path"] ?? "default";
												    ?>
												<div class="col-sm-6 portfolio-item filter-web mb-3">
													<div class="portfolio-wrap">
														<?php echo "<img class='img-fluid image-adjustment' src='$imgPath' alt='$imgName' />"; ?>
														<div class="portfolio-links">
															<a href="event_details.php?event_id=<?php echo $data[$i]["Event_id"]; ?>"
																title="More Details" class="d-block"><i
																	class="bx bx-link"></i></a>
														</div>
													</div>
												</div>
												<?php endfor ?>
											</div>
											<!-- END PORTFOLIO RESULT -->
											<?php endif ?>

											<?php else: ?>
											<div class="alert alert-warning" role="alert">
												No result found!
											</div>
											<?php endif ?>
											<!-- BEGIN PAGINATION -->


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


											<!-- END PAGINATION -->
										</div>
										<!-- END RESULT -->
									</div>
								</div>
							</div>
						</div>
						<!-- END SEARCH RESULT -->

					</div>
				</div>
			</section>
		</form>
	</main>
	<?php include("footer.php") ?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script defer>
	document.addEventListener("DOMContentLoaded", function() {
		var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
		var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
			return new bootstrap.Popover(popoverTriggerEl);
		});

		//display mode active
		var tableMode = document.getElementById("tableMode");
		var cardMode = document.getElementById("cardMode");
		var displayMode = "<?php echo $display; ?>";

		tableMode.classList.remove("active");
		cardMode.classList.remove("active");

		switch (displayMode) {
			case "card":
				cardMode.classList.add("active");
				break;
			case "table":
			default:
				tableMode.classList.add("active");
				break;

		}

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

	//search filter
	//get from database
	var list = document.getElementById("search-list");
	Req_SearchResult("../Process/event_process.php?searchBarList=1")
		.then(dataset => {
			document.getElementById("FilterSearch")
				.addEventListener("input", (element) => {
					list.innerHTML = "";
					dataset
						.forEach(listData => {
							if (listData.toLowerCase().includes(element.target.value.toLowerCase()) &&
								element.target.value.length >= 2) {
								var listItem = document.createElement("a");
								listItem.href = "#";
								listItem.classList.add("list-group-item", "list-group-item-action",
									"dataList");
								listItem.style.border = "none";
								listItem.value = listData;
								listItem.innerText = listData;
								list.appendChild(listItem);
							}
						});
					displayInput();
					displayCount();
					Array.from(document.getElementsByClassName("dataList")).forEach(child => {
						child.addEventListener("click", () => {
							document.getElementById("FilterSearch").value = child.textContent;
							displayInput();
							displayCount();
							list.innerHTML = "";
						});
					});
				});
		});





	function displayInput() {
		var searchInput = document.getElementById("searchInput");
		searchInput.innerText = `${document.getElementById("FilterSearch").value}`;
	}

	function displayCount() {
		var searchCount = document.getElementById("searchCount");
		searchCount.innerText = document.getElementById("search-list").children.length;
	}

	// Path: Process/event_process.js
	function Req_SearchResult(path) {
		return fetch(path)
			.then((res) => {
				return res.json();
			})
			.then((data) => {
				console.log(data);
				return data;
			});
	}

	//date filter validation
	function inputValidation() {
		const startDate = document.querySelector('input[name="startDate"]')[1].value;
		const endDate = document.querySelector('input[name="endDate"]')[1].value;
		if (!startDate || !endDate) {
			event.preventDefault();
			alert('Please select both start and end dates.');
			return;
		}
		if (endDate < startDate) {
			event.preventDefault();
			alert('End date must be later than start date.');
			return;
		}
	}

	//pagination
	Array.from(document.getElementsByClassName("event_id"))
		.forEach(element => element.addEventListener("click", (
			event) => {
			const eventId = event.currentTarget.getAttribute('data-event-id');
			if (eventId) {
				window.location.href = "event_details.php?event_id=" + eventId;
			}
			console.log(eventId);
		}));

	//confirm Delete
	function confirmDelete() {
		// Get the selected member's name
		var eventName = document.getElementById("event_name").options[document.getElementById("event_name").selectedIndex]
			.text;

		// Display a confirmation dialog with the member's name
		var result = confirm("Are you sure you want to delete " + eventName + "?");

		// If user confirms, submit the form
		if (result) {
			document.getElementById("delete_booking").submit();
		} else {
			event.preventDefault();
		}
	}

	//statistics pie chart (chart.js)
	var percentageData = <?php echo json_encode($percentage_data); ?>;
    var ctx = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($labelForPieChart); ?>,
            datasets: [{
                data: <?php echo json_encode($event_type_data); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Booking Percentage by Event Type',
                fontSize: 13,
                fontColor: '#333',
                fontStyle: 'bold',
                padding: 20
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = parseFloat(((currentValue / total) * 100).toFixed(2));
                        return data.labels[tooltipItem.index] + ' (' +  percentageData[tooltipItem.index] + '%)';
                    }
                }
            }
        }
    });

	//statistics bar chart (chart.js)
	var labelForBarChart = <?php echo json_encode($labelForBarChart); ?>;
        var numOfBookingPerMonth = <?php echo json_encode($numOfBookingPerMonth); ?>;

        // Define colors for each month
        var backgroundColors = [
            'rgba(54, 162, 235, 0.6)', // January
            'rgba(255, 99, 132, 0.6)', // February
            'rgba(255, 206, 86, 0.6)', // March
            'rgba(75, 192, 192, 0.6)', // April
            'rgba(153, 102, 255, 0.6)', // May
            'rgba(255, 159, 64, 0.6)', // June
            'rgba(54, 235, 166, 0.6)', // July
            'rgba(235, 54, 116, 0.6)', // August
            'rgba(54, 235, 121, 0.6)', // September
            'rgba(162, 54, 235, 0.6)', // October
            'rgba(235, 158, 54, 0.6)', // November
            'rgba(235, 54, 196, 0.6)' // December
        ];

        var borderColors = [
            'rgba(54, 162, 235, 1)', // January
            'rgba(255, 99, 132, 1)', // February
            'rgba(255, 206, 86, 1)', // March
            'rgba(75, 192, 192, 1)', // April
            'rgba(153, 102, 255, 1)', // May
            'rgba(255, 159, 64, 1)', // June
            'rgba(54, 235, 166, 1)', // July
            'rgba(235, 54, 116, 1)', // August
            'rgba(54, 235, 121, 1)', // September
            'rgba(162, 54, 235, 1)', // October
            'rgba(235, 158, 54, 1)', // November
            'rgba(235, 54, 196, 1)' // December
        ];

        var ctx = document.getElementById('myBarChart').getContext('2d');
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelForBarChart,
                datasets: [{
                    label: 'Number of Bookings',
                    data: numOfBookingPerMonth,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Number of Bookings Per Month',
                    fontSize: 16
                }
            }
        });
</script>


</html>