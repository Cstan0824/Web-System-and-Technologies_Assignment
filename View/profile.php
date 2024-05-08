<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Profile</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../Css/assets/css/profile-style.css" rel="stylesheet" />
<?php session_start(); ?>
</head>

<body>
    <?php
    include('../Root/link.php');
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
                        <div class="profile-nav col-md-3">
                            <div class="panel panel-default">
                                <div class="user-heading round">
                                    <h1><?php echo $_SESSION['user_name'];?></h1>
                                </div>
                                <div class="panel-body">
                                    <ul class="profilenav list-group" style="list-style-type: none; padding-left: 0px;">
                                        <a href="record.php" class="list-group-item list-group-item-action"><i
                                                class="fa fa-ticket" style="color:#898B9B;"></i>&nbsp;&nbsp;Booking History</a>
                                        <a href="edit_profile.php" class="list-group-item list-group-item-action"><i class="fa fa-edit"
                                                style="color:#898B9B;"></i>&nbsp;&nbsp;Edit Profile</a>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="profile-info col-md-9">
                            <div class="panel">
                            <form>
                                <textarea placeholder="Whats in your mind today?" rows="2" class="form-control input-lg p-text-area"></textarea>
                            </form>
                            <footer class="panel-footer">
                                <button class="btn btn-warning pull-right">Post</button>
                            </footer>
                                </div>
                                <div class="panel-body bio-graph-info">
                                    <h1>Member Profile</h1>
                                    <div class="">
                                        <div class="bio-row">
                                            <p><i class="fas fa-id-card"></i> <?php echo $_SESSION[''.$_SESSION['role'].'_id'];?></p>
                                        </div>
                                        <div class="bio-row">
                                            <p><i class="fas fa-signature"></i> <?php echo $_SESSION['user_name'];?></p>
                                        </div>
                                        <div class="bio-row">
                                            <p><i class="fas fa-inbox"></i> <?php echo $_SESSION['user_email'];?></p>
                                        </div>
                                        <div class="bio-row">
                                            <p><i class="fas fa-calendar-check"></i> <?php echo $_SESSION['user_date'];?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <br>
                                <h4>Upcoming Events</h4>
                                <br>


                                <div class="row justify-content-center">
                                    <?php for($i = 0;$i < 6;$i++): ?>
                                    <div
                                        class="panel col-md-5 border border-light col-sm-12 p-2 m-2 border bg-light border-light text-left rounded">
                                        <div class="panel-body ">
                                            <div class="bio-chart">
                                                <div style="display:inline;width:100px;height:100px;">
                                                    <img class="upcoming-event-img" src="../Image/AI Aware.jpg"
                                                        alt="pic">
                                                </div>
                                            </div>
                                            <div class="bio-desk">
                                                <h4 class="purple">my AI Rakyat</h4>
                                                <p><i class="fas fa-calendar" style="color:#898B9B;"></i> 15 July 2024
                                                </p>
                                                <p><i class="fas fa-hourglass-start" style="color:#898B9B;"></i> 3 Day
                                                </p>
                                                <p><i class="far fa-clock" style="color:#898B9B;"></i> 15:00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endfor; ?>
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

</html>