<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Member List</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<link href="../Css/assets/css/profile-style.css" rel="stylesheet" />
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

		#myPieChart,
		#myBarChart {
			width: 500px;
			height: 500px;
		}
	</style>
	<?php
    include('../Root/link.php');
	include('../Root/connect-db.php');

	session_start();
	if (!isset($_SESSION['role']) || $_SESSION['role'] == null || $_SESSION['role'] != "Member" &&   $_SESSION['role'] != "Staff") {
	    session_destroy();
	    header("Location: login_signup.php");
	}

	?>
</head>

<body style="background-color:#F1F2F7;">
	<?php
	include('header.php');


	$FilterSearch = $_POST["FilterSearch"] ?? "";

	$searchSql = !empty($FilterSearch) ? "WHERE Member_name LIKE '%$FilterSearch%'" : "";
	$sqlMember = "SELECT * FROM T_Member $searchSql;";

	$result = $connect_db->query($sqlMember);
	$memberDB = array();
	while($row = $result->fetch_assoc()) {
	    $memberDB[] = array(
	        'memberPicName' => $row['Member_upl_file_name'],
	        'memberPicPath' => $row['Member_upl_path'],
	        'Member_id' => $row['Member_id'],
	        'Member_name' => $row['Member_name'],
	        'Member_email' => $row['Member_email'],
	        'Member_comment' => $row['Member_comment'],
	        'Member_joindate' => $row['Member_regisdate']
	    );
	}

	$page = $_POST['page'] ?? 1;
	$numberOfResults = isset($memberDB) ? count($memberDB) : 0;
	$pageCount = (int)$numberOfResults != 0 ? ceil(((int)$numberOfResults / 6)) : 1;
	?>


	<main id="main">

		<!-- ======= Breadcrumbs Section ======= -->
		<section class="breadcrumbs">
			<div class="container">

				<div class="d-flex justify-content-between align-items-center">
					<h2>Member List</h2>
					<ol>
						<li><a href="Home.php">Home</a></li>
						<li>Member List</li>
					</ol>
				</div>

			</div>
		</section><!-- End Breadcrumbs Section -->

		<section class="inner-page">
			<div class="container">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="grid search">
								<div class="grid-body">
									<div class="row">
										<!-- BEGIN RESULT -->
										<div class="col-md">
											<div class="d-flex justify-content-between align-items-center">
												<h2><i class="fa-solid fa-book"></i> Member List</h2>
												<?php if($_SESSION['role'] == "Staff") {?>
												<a data-bs-trigger="hover" data-bs-content="Click me to add Member"
													data-bs-placement="top" data-bs-toggle="popover" title="Add Events"
													href="add_member.php">
													<i class="fa-solid fa-user-plus"
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


											<br />
											<?php if($numberOfResults != 0 || !isset($FilterSearch)): ?>

											<!-- BEGIN TABLE RESULT -->
											<div class="table-responsive" data-aos="fade-up">
												<table class="table table-hover">
													<tbody>
														<?php for($i = ($page - 1) * 6; $i < ($page * 6) && $i < $numberOfResults; $i++): ?>
														<?php
	                                                        $imgPath = $memberDB[$i]["memberPicPath"] ?? "../Image/profile_picture/Default-ProfilePicture.jpg";
														    $imgName = $memberDB[$i]["memberPicName"] ?? "default";
														    ?>
														<tr title="Click for more!" data-bs-toggle="popover"
															data-bs-trigger="hover"
															data-bs-content="<?php echo $memberDB[$i]["Member_comment"]; ?> ..."
															data-bs-placement="top" data-member-id=<?php echo $memberDB[$i]["Member_id"];?>
															class="member_id">
															<td class="number text-center">
																<?php echo $i + 1 ?>
															</td>
															<td class="image">
																<?php echo "<img src='$imgPath' alt='$imgName' />"; ?>
															</td>
															<td class="event" id="event_name">
																<strong><?php echo $memberDB[$i]["Member_id"]; ?></strong><br>
															</td>
															<td class="name text-right">
																<span>
																	<?php echo $memberDB[$i]["Member_name"]; ?>
																</span>
															</td>
															<td><?php echo $memberDB[$i]["Member_email"]; ?>
															</td>
															<td><?php echo $memberDB[$i]["Member_joindate"]; ?>
															</td>
															<?php
														        if(isset($_SESSION['role']) && $_SESSION['role'] == "Staff") {
														            ?>
															<td id="edit">
																<a class='edit-button'
																	href='edit-member.php?Member_id=<?php echo $memberDB[$i]["Member_id"]; ?>'><i
																		class=' fa-regular fa-pen-to-square'></i></a>
															</td>
															<form id='delete_member'
																action='../Process/delete_member.php' method='POST'>
																<td id="delete">
																	<button class='delete-button' type='submit'
																		name='delete'
																		value='<?php echo $memberDB[$i]["Member_id"];?>'
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
															<th class="event text-info">Member ID</th>
															<th class="rate text-right text-info">Name</th>
															<th class="text-info">Email</th>
															<th class="text-info">Join Date</th>
															<th class='number'></th>
															<th class='number'></th>
														</tr>
													</thead>
												</table>
											</div>

											<?php else: ?>
											<div class="alert alert-warning" role="alert">
												No result found!
											</div>
											<?php endif ?>
											<!-- BEGIN PAGINATION -->

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

											<!-- END PAGINATION -->
										</div>
										<!-- END RESULT -->
									</div>
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
		var prevPage = document.getElementById("prevPage");
		var nextPage = document.getElementById("nextPage");

		var page = <?php echo $page ?> ;
		var totalPage = <?php echo $pageCount ?> ;
		console.log(page, totalPage);
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
	Req_SearchResult("../Process/searchMember_process.php?searchBarList=1")
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

	// Path: Process/searchMember_process.js
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


	//pagination
	Array.from(document.getElementsByClassName("member_id"))
		.forEach(element => element.addEventListener("click", (
			event) => {
			const memberID = event.currentTarget.getAttribute('data-member-id');
			if (memberID) {
				window.location.href = "member_profile.php?Member_id=" + memberID;
			}
			console.log(memberID);
		}));
</script>

</html>