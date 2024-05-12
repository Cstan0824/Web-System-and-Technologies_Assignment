<!DOCTYPE html>
<html lang="en">
<?php $addHeaderClass = "header-transparent"; ?>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>TARUMT Movie Society </title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<?php
    include('../Root/link.php');

include("../Root/connect-db.php");

include('../Process/save_User_details.php');
if (!isset($_SESSION['role']) || $_SESSION['role'] == null || $_SESSION['role'] != "Member" && $_SESSION['role'] != "Staff") {
    session_destroy();
    header("Location: login_signup.php");
}

//Get Event Details
$sql = "SELECT Event_id, Event_upl_path, Event_upl_file_name
			FROM T_Event E
			WHERE Event_id < 7";

$result = $connect_db->query($sql);
$data = array();
$count  = 0;
while($row = $result->fetch_assoc()) {
    $data[] = array(
        "Event_id" => $row["Event_id"],
        "Event_upl_path" => $row["Event_upl_path"],
        "Event_upl_file_name" => $row["Event_upl_file_name"]
    );
}

//Get Member Details
$sql = "SELECT Member_name, Member_comment,Member_upl_path, Member_upl_file_name
			FROM T_Member M
			WHERE Member_id < 6";
$memberData = array();
$result = $connect_db->query($sql);
while($row = $result->fetch_assoc()) {
    $memberData[] = array(
        "Member_name" => $row["Member_name"],
        "Member_comment" => $row["Member_comment"],
        "Member_upl_path" => $row["Member_upl_path"],
        "Member_upl_file_name" => $row["Member_upl_file_name"]
    );
}
//close connection
$connect_db->close();
?>
	<style>
		.image-adjustment {
			width: 100%;
			height: 400px;
		}
	</style>
</head>

<body>
	<?php include('header.php');
?>



	<!-- ======= Hero Section ======= -->
	<section id="hero">
		<div class="hero-container" data-aos="fade-up">
			<h1>Welcome to TARUMT Movie Society</h1>
			<h2>We are movie society from TARUMT</h2>
			<a href="#activities" class="btn-get-started scrollto"><i class="bx bx-chevrons-down"></i></a>
		</div>
	</section><!-- End Hero -->

	<main id="main">

		<!-- ======= activities Section ======= -->
		<section id="activities" class="services">
			<div class="container">

				<div class="section-title" data-aos="fade-in" data-aos-delay="100">
					<h2> Introduction of activities</h2>
					<p>
						Movie societies are a haven for film enthusiasts. They offer a variety of activities that go
						beyond just watching movies. Here's a glimpse into what you can expect:</p>
				</div>

				<div class="row">
					<div class="col-md-4 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
						<div class="icon-box" data-aos="fade-up">
							<div class="icon"><i class="bx bxl-dribbble"></i></div>
							<h4 class="title"><a href="">Famous Actor Meeting</a></h4>
							<p class="description">You will have the opportunity to interact with renowned actors and
								actresses</p>
						</div>
					</div>

					<div class="col-md-4 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
						<div class="icon-box" data-aos="fade-up" data-aos-delay="100">
							<div class="icon"><i class="bx bx-file"></i></div>
							<h4 class="title"><a href="">Movie Review Sharing Session</a></h4>
							<p class="description">The club will irregularly hold after-viewing sessions to share the
								contents of the films with the members of the club</p>
						</div>
					</div>

					<div class="col-md-4 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
						<div class="icon-box" data-aos="fade-up" data-aos-delay="200">
							<div class="icon"><i class="bx bx-tachometer"></i></div>
							<h4 class="title"><a href="">Movie Premiere</a></h4>
							<p class="description">The club oftenly organises trips to film premieres.</p>
						</div>
					</div>
				</div>

			</div>
		</section><!-- End activities Section -->
		<?php





?>

		<!-- ======= Portfolio Section ======= -->
		<section id="portfolio" class="portfolio">
			<div class="container">

				<div class="section-title" data-aos="fade-in" data-aos-delay="100">
					<h2>Coming Activities</h2>
					<p>You can join us in coming activities</p>
				</div>

				<div class="row" data-aos="fade-in">
					<div class="col-lg-12 text-center my-3">
						<a class="btn button-18" role="button" href="Event.php">See More</a>
					</div>
				</div>

				<div class="row portfolio-container" data-aos="fade-up">

					<?php for($i = 0; $i < 6 && $i < count($memberData); $i++): ?>
					<?php
                        $imgPath =  $data[$i]["Event_upl_path"] ?? "../Image/event_picture/Default-EventPicture.jpg";
					    $imgName = $data[$i]["Event_upl_file_name"] ?? "default";
					    ?>
					<div class="col-lg-4 col-md-6 portfolio-item filter-app">
						<div class="portfolio-wrap">
							<img src="<?php echo $imgPath; ?>"
								class="img-fluid image-adjustment"
								alt="<?php echo $imgName; ?>">
							<div class="portfolio-links">
								<a href="event_details.php?event_id=<?php echo $data[$i]["Event_id"]?>"
									title="More Details" class="d-block"><i class="bx bx-link"></i></a>
							</div>
						</div>
					</div>
					<?php endfor ?>
				</div>

			</div>
		</section><!-- End Portfolio Section -->

		<!-- ======= Testimonials Section ======= -->
		<section id="testimonials" class="testimonials section-bg">
			<div class="container">

				<div class="section-title" data-aos="fade-in" data-aos-delay="100">
					<h2>Testimonials</h2>
					<p>Member's estimation about the TARUMT Movie Society </p>
				</div>

				<div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
					<div class="swiper-wrapper">
						<?php for($i = 0; $i < 5 && $i < count($data); $i++): ?>
						<?php
					            $imgPath =  $memberData[$i]["Member_upl_path"] ?? "../Image/profile_picture/Default-ProfilePicture.jpg";
						    $imgName = $memberData[$i]["Member_upl_file_name"] ?? "default";
						    ?>
						<div class="swiper-slide">
							<div class="testimonial-item">
								<p>
									<i class="bx bxs-quote-alt-left quote-icon-left"></i>
									<?php echo $memberData[$i]["Member_comment"] ?? "what an excellent Society!!"; ?>
									<i class="bx bxs-quote-alt-right quote-icon-right"></i>
								</p>
								<?php
						            echo "<img src='$imgPath' class='testimonial-img' alt='$imgName' />";
						    echo "<h3>".$memberData[$i]["Member_name"]."</h3>";
						    ?>
								<h4></h4>
							</div>
						</div><!-- End testimonial item -->
						<?php endfor ?>
					</div>
					<div class="swiper-pagination"></div>
				</div>

			</div>
		</section><!-- End Testimonials Section -->

		<!-- ======= Team Section ======= -->
		<section id="team" class="team">
			<div class="container">

				<div class="section-title" data-aos="fade-in" data-aos-delay="100">
					<h2>Team Member</h2>
					<p>This is our team member in TARUMT Movie Society</p>
				</div>

				<div class="row">

					<div class="col-lg-4 col-md-6">
						<div class="member" data-aos="fade-up">
							<div class="pic"><img src="../Css/assets/img/team/team-1.jpg" class="img-fluid" alt="">
							</div>
							<div class="member-info">
								<h4>Jeremy Chin Jun Chen</h4>
								<span>Member</span>
								<div class="social">
									<a href=""><i class="bi bi-twitter"></i></a>
									<a href=""><i class="bi bi-facebook"></i></a>
									<a href=""><i class="bi bi-instagram"></i></a>
									<a href=""><i class="bi bi-linkedin"></i></a>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-6">
						<div class="member" data-aos="fade-up" data-aos-delay="150">
							<div class="pic"><img src="../Css/assets/img/team/team-2.jpg" class="img-fluid" alt="">
							</div>
							<div class="member-info">
								<h4>Tan Choon Shen</h4>
								<span>Member</span>
								<div class="social">
									<a href=""><i class="bi bi-twitter"></i></a>
									<a href=""><i class="bi bi-facebook"></i></a>
									<a href=""><i class="bi bi-instagram"></i></a>
									<a href=""><i class="bi bi-linkedin"></i></a>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-6">
						<div class="member" data-aos="fade-up" data-aos-delay="300">
							<div class="pic"><img src="../Css/assets/img/team/team-3.jpg" class="img-fluid" alt="">
							</div>
							<div class="member-info">
								<h4>Harrison Tiu Shao Hang</h4>
								<span>Member</span>
								<div class="social">
									<a href=""><i class="bi bi-twitter"></i></a>
									<a href=""><i class="bi bi-facebook"></i></a>
									<a href=""><i class="bi bi-instagram"></i></a>
									<a href=""><i class="bi bi-linkedin"></i></a>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
		</section><!-- End Team Section -->

		<!-- ======= Contact Section ======= -->
		<section id="contact" class="contact section-bg">
			<div class="container" data-aos="fade-up">

				<div class="section-title">
					<h2>Contact</h2>
					<p>If you need more help, please contact us at above</p>
				</div>

				<div class="row">
					<div class="col-lg-6">
						<div class="info-box mb-4">
							<i class="bx bx-map"></i>
							<h3>Our Address</h3>
							<p>1st Floor, Bangunan Tan Sri Khaw Kai Boh (Block A), Jalan Genting Kelang, Setapak, 53300
								Kuala Lumpur, Federal Territory of Kuala Lumpur</p>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="info-box  mb-4">
							<i class="bx bx-envelope"></i>
							<h3>Email Us</h3>
							<p>tarumtmoviesociety@gmail.com</p>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="info-box  mb-4">
							<i class="bx bx-phone-call"></i>
							<h3>Call Us</h3>
							<p>+60 123-546789</p>
						</div>
					</div>

				</div>

				<div class="row">

				</div>
		</section><!-- End Contact Section -->

	</main><!-- End #main -->

	<?php include('footer.php'); ?>

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
			class="bi bi-arrow-up-short"></i></a>


</body>

</html>