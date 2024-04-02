<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
</head>
<style>
    img {
        width: 80%;
        height: 90%;
    }

    .form-control.event-name,
    .form-control.event-type,
    .form-control.event-date,
    .form-control.event-location,
    .form-control.event-host {
        height: 50px;
        width: 300px;
    }

    .form-control.event-desc {
        height: 250px;
        width: 450px;
    }

    .form-control.start-time,
    .form-control.end-time,
    .form-control.max-user {
        height: 50px;
        width: 150px;
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


        <section class="inner-page">
            <div class="container">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-3">
                        <div class="text-center">
                            <img src="../Image/images.jpg" class="avatar img-circle" alt="avatar">
                            <h6><br>Change photo?</h6>
                            <input type="file" class="form-control">
                        </div>
                    </div>
                    <!-- edit form column -->
                    <div class="col-md-9 personal-info">
                        <h3>Event Details</h3>
                        <form action="../Process/edit-event-process.php" method="POST" class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-lg-3 control-label" name="Event_name">Event name:</label>
                                <div class="col-lg-8">
                                    <input class="form-control event-name" name="Event_name" type="text"
                                        value="The Dark Knight">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label" name="Event_type">Event Type:</label>
                                <div class="col-lg-8">
                                    <div class="ui-select">
                                        <select id="user_time_zone" name="Event_type" class="form-control event-type">
                                            <option value="actor-meeting">Actor Meeting</option>
                                            <option value="sharing-session">Sharing Session</option>
                                            <option value="movie-premiere">Movie Premiere</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label" name="Event_date">Event Date:</label>
                                <div class="col-lg-8">
                                    <input class="form-control event-date" name="Event_date" type="date"
                                        value="2024-04-02">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label" name="Event_location_id">Event Location:</label>
                                <div class="col-lg-8">
                                    <div class="ui-select">
                                        <select name="Event_location_id" class="form-control event-location">
                                            <option value="1">DK Z, TARUMT</option>
                                            <option value="2">DK X, TARUMT</option>
                                            <option value="3">DTAR, TARUMT</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label" name="Event_desc">Event Description</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control event-desc" name="Event_desc"
                                        rows="5">Directed by Christopher Nolan, "The Dark Knight" is the second installment in Nolan's Batman trilogy. It portrays the iconic DC Comics character, Batman, facing off against his arch-nemesis, the Joker, played by Heath Ledger in an Oscar-winning performance. Set in the gritty streets of Gotham City, the film delves into themes of chaos, morality, and the thin line between heroism and vigilantism.</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label" name="Event_hoster">Event Host:</label>
                                <div class="col-lg-8">
                                    <input class="form-control event-host" name="Event_hoster" type="text"
                                        value="Jeremy">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" name="Start_time">Start Time:</label>
                                <div class="col-md-8">
                                    <input class="form-control start-time" name="Start_time" type="time" value="15:00">
                                </div>
                                <label class="col-md-3 control-label" name="End_time">End Time:</label>
                                <div class="col-md-8">
                                    <input class="form-control end-time" name="End_time" type="time" value="17:00">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" name="Max_user">Max User:</label>
                                <div class="col-md-8">
                                    <input class="form-control max-user" type="number" name="Max_user" value="32">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-8">
                                    <input type="button" class="btn btn-primary" value="Save Changes">
                                    <span></span>
                                    <input type="reset" class="btn btn-danger" value="Cancel">
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
            </div>
            <hr>
        </section>
    </main>

<?php include ('footer.php'); ?>
</body>

</html>