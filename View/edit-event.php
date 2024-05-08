<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <?php 
    session_start();
    if (!isset($_SESSION['role']) ||$_SESSION['role'] == NULL || $_SESSION['role'] != "Staff"){
        session_destroy();
        header("Location: login_signup.php");
    }
    ?>
</head>
<style>
    img {
        width: 80%;
        height: 90%;
    }
</style>

<body>
    <?php include("../Root/link.php");
    include("header.php"); ?>
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
                <form action="../Process/edit-event-process.php" method="POST" class="form-horizontal" role="form">

                    <div class="row gy-4">
                        <div class="col-lg-8">
                            <div class="portfolio-details-slider swiper">
                                <div class="swiper-wrapper align-items-center">

                                    <div class="swiper-slide">
                                        <img class="rounded" src="../Css/assets/img/portfolio/test1.png" alt="">
                                    </div>

                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>

                        <div class="col-lg-4">

                            <div class="portfolio-info rounded-sm">
                                <h3>Event Details</h3>

                                <!-- Name -->
                                <div class="input-group my-4">
                                    <span class="input-group-text">Name</span>
                                    <input type="text" class="form-control" placeholder="Event Name" name="Event_name"
                                        type="text">
                                </div>
                                <!-- Category -->
                                <div class="input-group my-4">


                                    <select id="user_time_zone" name="Event_type" class="form-select">
                                        <option value="actor-meeting">Actor Meeting</option>
                                        <option value="sharing-session">Sharing Session</option>
                                        <option value="movie-premiere">Movie Premiere</option>
                                    </select>

                                </div>
                                <!-- Date -->
                                <div class="input-group my-4">
                                    <span class="input-group-text">Date</span>
                                    <input class="form-control" name="Event_date" type="date" />
                                </div>
                                <!-- Location -->
                                <div class="input-group my-4">

                                    <select name="Event_location_id" class="form-select">
                                        <option value="1">DK Z, TARUMT</option>
                                        <option value="2">DK X, TARUMT</option>
                                        <option value="3">DTAR, TARUMT</option>
                                    </select>

                                </div>
                                <!-- Hoster -->
                                <div class="input-group my-4">
                                    <span class="input-group-text">Hoster</span>
                                    <input class="form-control" name="Event_hoster" type="text">
                                </div>

                                <!-- Start Time -->
                                <div class="input-group my-4">
                                    <span class="input-group-text">Start Time</span>
                                    <input class="form-control" name="Start_time" type="time" />
                                </div>

                                <!-- End Time -->
                                <div class="input-group my-4">
                                    <span class="input-group-text">End Time</span>
                                    <input class="form-control" name="End_time" type="time" />
                                </div>

                                <!-- Max User -->
                                <div class="input-group my-4">
                                    <span class="input-group-text">Max User</span>
                                    <input class="form-control" type="number" name="Max_user" />
                                </div>
                                <div class="input-group my-4">
                                    <span class="input-group-text">Photo</span>
                                    <input type="file" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row my-4">
                        <!-- Desc -->
                        <div class="col-sm-12">
                            <div class="portfolio-info rounded-sm">

                                <div class="form-group my-2">
                                    <label class="col-lg-12 control-label" name="Event_desc">Event Description</label>
                                    <div class="col-lg-12">
                                        <textarea style="resize:none;" class="form-control event-desc" name="Event_desc"
                                            rows="5">Directed by Christopher Nolan, "The Dark Knight" is the second installment in Nolan's Batman trilogy. It portrays the iconic DC Comics character, Batman, facing off against his arch-nemesis, the Joker, played by Heath Ledger in an Oscar-winning performance. Set in the gritty streets of Gotham City, the film delves into themes of chaos, morality, and the thin line between heroism and vigilantism.</textarea>
                                    </div>
                                </div>
                                <!-- Save -->
                                <div class="form-group my-2">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-8">
                                        <input type="button" class="btn btn-primary" value="Save Changes">
                                        <span></span>
                                        <input type="reset" class="btn btn-danger" value="Cancel">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                    </div>
                </form>
            </div>
        </section>
        <!-- End Portfolio Details Section -->
    </main>

    <?php include('footer.php'); ?>
</body>

</html>