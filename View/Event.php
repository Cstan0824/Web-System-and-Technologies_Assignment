<!DOCTYPE html>
<html lang="en">

<hea       	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Events</title>
	<?php include("../Root/link.php") ?>
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
		}

		.delete-button:hover {
			color: red;
		}

		.edit-button:hover {
			color: rgba(18, 237, 0, 1);
		}
	</style>

</head>
<script>

</script>

<body>
	<?php
    $display = isset($_GET['display']) ? $_GET['display'] : "table";
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$numberOfResults = 12;
	$pageCount = $numberOfResults / 6;
	?>
	<?php include("header.php") ?>
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
			<div class="row">
				<!-- BEGIN SEARCH FILTER -->
				<div class="col-md-3">
					<div class="grid search">
						<div class="grid-body">
							<div class="row">
								<!-- BEGIN FILTERS -->
								<div class="col-md">
									<h2 class="grid-title"><i class="fa fa-filter"></i> Filters</h2>
									<hr />

									<!-- BEGIN FILTER BY CATEGORY -->
									<h4><strong>Category</strong></h4>
									<div class="checkbox">
										<label><input type="checkbox" class="icheck" checked> Actor
											Meeting</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" class="icheck" checked> Sharing
											Session</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" class="icheck" checked> Movie Premiere</label>
									</div>
									<!-- END FILTER BY CATEGORY -->
									<br />
									<br />
									<!-- BEGIN FILTER BY DATE -->
									<h4><strong>Date</strong></h4>
									<div class="input-group mt-3">
										<span class="input-group-text">From</span>
										<input type="date" class="form-control">
									</div>

									<div class="input-group mt-3">
										<span class="input-group-text">To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										<input type="date" class="form-control">
									</div>
									<!-- END FILTER BY DATE -->
									<br />
									<br />
									<!-- BEGIN FILTER BY OTHERS -->
									<h4><strong>OTHERS</strong></h4>
									<div class="form-check">
										<input type="radio" class="form-check-input" id="radio1" name="optradio"
											value="option1" checked>Most Recent
										<label class="form-check-label" for="radio1"></label>
									</div>
									<div class="form-check">
										<input type="radio" class="form-check-input" id="radio2" name="optradio"
											value="option2">Most Liked
										<label class="form-check-label" for="radio2"></label>
									</div>
									<!-- END FILTER BY OTHERS -->
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
									<h2><i class="fa-solid fa-book"></i> Result</h2>
									<hr>
									<!-- BEGIN SEARCH INPUT -->
									<form action="" method="post" class="searchBox">
										<div class="input-group">

											<span class="input-group-btn">
												<button class="btn btn-lg"
													style="border:1px solid #DEE2E6; border-right:none; border-bottom:none; border-top-right-radius:0px; border-bottom-left-radius:0px;  border-bottom-right-radius:0px; height: 100%;"
													type="submit"><i class="fa fa-search"></i></button>
											</span>
											<input type="search" class="form-control input-lg"
												style="border-left:none; border-bottom:none; border-bottom-right-radius:0px;"
												placeholder="Search Here..." minlength="1" maxlength="100"
												id="FilterSearch">
										</div>
										<div id="search-result" class="search-result">
											<ul id="search-list" class="list-group w-100"
												style="border:1px solid #DEE2E6; border-top:none; border-top-right-radius:0px; border-top-left-radius:0px;">
											</ul>
										</div>
									</form>

									<!-- END SEARCH INPUT -->

									<p style="text-align:right;" id="searchContent">
										Showing <span id="searchCount">0</span> result > <span id="searchInput"></span>
									</p>

									<!-- BEGIN DISPLAY MODE -->
									<div class="row">
										<div class="col-md text-left">
											<div class="btn-group">
												<a id="tableMode"
													href="?display=table&page=<?php echo $page ?>"
													class="btn btn-outline-info display-mode active"><i
														class="fa fa-list"></i></a>
												<a id="cardMode"
													href="?display=card&page=<?php echo $page ?>"
													class="btn btn-outline-info display-mode active"><i
														class="fa fa-th"></i></a>
											</div>
										</div>
									</div>
									<!--END DISPLAY MODE -->

									<br />

									<?php if($display == "table"): ?>
									<!-- BEGIN TABLE RESULT -->
									<div class="table-responsive" data-aos="fade-up">
										<table class="table table-hover">
											<tbody>
												<?php for($i = 1;$i <= 6;$i++): ?>
												<tr title="Click for more!" data-bs-toggle="popover"
													data-bs-trigger="hover"
													data-bs-content="This is the event description."
													data-bs-placement="top">
													<td class="number text-center">
														<?php echo $i ?>
													</td>
													<td class="image"><img
															src="https://www.bootdey.com/image/400x300/FF8C00" alt="">
													</td>
													<td class="event"><strong>Event</strong><br></td>
													<td class="rate text-right">
														<span><i class="fa fa-star"></i><i class="fa fa-star"></i><i
																class="fa fa-star"></i><i class="fa fa-star"></i><i
																class="fa fa-star-half-o"></i></span>
													</td>
													<td>Movie Premiere</td>
													<td><?php echo date("Y/m/d"); ?>
													</td>
													<td>
														<a class="edit-button" href="edit-event.php"><i
																class=" fa-regular fa-pen-to-square"></i></a>
													</td>
													<td><a class="delete-button" href="../Process/delete-event.php"><i
																class="fa-regular fa-trash-can"></i></a>
													</td>


												</tr>
												<?php endfor ?>
											</tbody>
											<thead>
												<tr>
													<th class="number text-center"></th>
													<th class="image"></th>
													<th class="event"><a href="?OrderBy=event">Event</a></th>
													<th class="rate text-right"><a href="?OrderBy=rating">Rating</a>
													</th>
													<th><a href="?orderBy=category">Category</a></th>
													<th><a href="?orderBy=date">Date</a></th>
                                                    <th class="number"></th>
                                                    <th class="number"></th>
												</tr>
											</thead>
										</table>
									</div>
									<!-- END TABLE RESULT -->
									<?php else: ?>
									<!-- BEGIN PORTFOLIO RESULT -->
									<div class="row portfolio" data-aos="fade-up">
										<?php for($i = 1;$i <= 6;$i++): ?>
										<div class="col-sm-6 portfolio-item filter-web mb-3">
											<div class="portfolio-wrap">
												<img src="../Css/assets/img/portfolio/portfolio-2.jpg" class="img-fluid"
													alt="">
												<div class="portfolio-links">
													<a href="../Css/assets/img/portfolio/portfolio-2.jpg"
														data-gallery="portfolioGallery" class="portfolio-lightbox"
														title="Scent OF A Woman"><i class="bx bx-plus"></i></a>
													<a href="event_details.php" title="More Details"><i
															class="bx bx-link"></i></a>
												</div>
											</div>
										</div>
										<?php endfor ?>
									</div>
									<!-- END PORTFOLIO RESULT -->
									<?php endif ?>

									<!-- BEGIN PAGINATION -->
									<ul class="pagination">
										<li class="page-item">
											<a id="prevPage" class="page-link disabled"
												<?php echo "href='?display=$display&page=" . (($page - 1) > 0 ? ($page - 1) : 1) . "'" ?>>
												Previous
											</a>
										</li>

										<?php for ($i = 1; $i <= $pageCount; $i++): ?>
										<li class="page-item">
											<a class="page-link"
												<?php echo "href='?display=$display&page=$i'" ?>>
												<?php echo $i ?>
											</a>
										</li>
										<?php endfor ?>

										<li class="page-item">
											<a id="nextPage" class="page-link disabled"
												<?php echo "href='?display=$display&page=" . (($page + 1) <= $pageCount ? ($page + 1) : $pageCount) . "'" ?>>
												Next
											</a>
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
	</main>
	<script defer>
		document.addEventListener("DOMContentLoaded", function() {
			var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
			var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
				return new bootstrap.Popover(popoverTriggerEl);
			});

			var tableMode = document.getElementById("tableMode");
			var cardMode = document.getElementById("cardMode");
			var urlParams = new URLSearchParams(window.location.search);
			var displayMode = urlParams.get('display');

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


			var prevPage = document.getElementById("prevPage");
			var nextPage = document.getElementById("nextPage");
			var urlParams = new URLSearchParams(window.location.search);
			var page = parseInt(urlParams.get('page')) ?? 1;
			var totalPage = <?php echo $pageCount; ?> ;


			prevPage.classList.remove("disabled");
			nextPage.classList.remove("disabled");

			switch (page) {
				case totalPage:
					nextPage.classList.add("disabled");
					break;
				case 1:
					prevPage.classList.add("disabled");
					break;
				default:
					break;
			}
		});

		document.getElementById("FilterSearch").addEventListener("input", (element) => {
			var list = document.getElementById("search-list");
			//sample data
			const dataset = [
				"Event_name1",
				"Event_name2",
				"The Dark Knight",
				"Interstellar"
			];
			list.innerHTML = "";
			dataset.forEach(data => {
				console.log(data);
				if (data.toLowerCase().indexOf(element.target.value.toLowerCase()) != -1 && document
					.getElementById("FilterSearch").value != "") {
					list.innerHTML += `<li class='list-group-item' style='border:none;'>${data}</li>`;
				}
			});
			displayInput();
			displayCount();
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
			fetch(path)
				.then((res) => {
					return res.json();
				})
				.then((data) => {
					console.log(data);
					return data;
				});
		}
	</script>
