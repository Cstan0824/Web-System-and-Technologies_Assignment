<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Profile</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../Css/assets/css/profile-style.css" rel="stylesheet" />
    <?php
    include('../Root/link.php');
    include('../Root/connect-db.php');

    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] == null || $_SESSION['role'] != "Member" &&   $_SESSION['role'] != "Staff") {
        session_destroy();
        header("Location: login_signup.php");
    }

    $sql = "SELECT E.Event_id, E.Event_name,E.Event_desc, E.Event_date, E.Start_time, E.Event_upl_path, E.Event_upl_file_name
    FROM T_EVENT E 
    JOIN T_BOOKING B ON E.Event_id = B.Event_id 
    WHERE B.Member_id = '".$_SESSION['Member_id']."';";

    $upcoming_event = array();
    $result = $connect_db->query($sql);
    while($row = $result->fetch_assoc()) {
        $upcoming_event[] = array(
            "Event_id" => $row["Event_id"],
            "Event_name" => $row["Event_name"],
            "Event_desc" => $row["Event_desc"],
            "Event_date" => $row["Event_date"],
            "Start_time" => $row["Start_time"],
            "Event_upl_path" => $row["Event_upl_path"],
            "Event_upl_file_name" => $row["Event_upl_file_name"],
            "DateCountDown" => date_diff(date_create(date("Y-m-d")), date_create($row["Event_date"]))->format("%a")
        );
    }
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
                        <div class="profile-nav col-md-3">
                            <div class="panel panel-default">
                                <div class="user-heading round">
                                    <a href="#">
                                        <img src=" <?php echo $_SESSION['user_pic_path'] ?? "../Css/assets/img/team/team-1.jpg" ?>"
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
                                        <a href="record.php" class="list-group-item list-group-item-action px-2"><i
                                                class="fa fa-ticket ps-2 pe-3" style="color:#898B9B;"></i> Booking
                                            History</a>
                                        <a href="edit_profile.php"
                                            class="list-group-item list-group-item-action px-2"><i
                                                class="fa fa-edit ps-2 pe-3" style="color:#898B9B;"></i> Edit
                                            Profile</a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="profile-info col-md-9">
                            <div class="panel mb-5">
                                <form>
                                    <textarea placeholder="Whats in your mind today?" rows="2"
                                        class="form-control input-lg p-text-area"
                                        style="resize:none;height:115px;"></textarea>
                                </form>
                                <footer class="panel-footer" style="text-align: right;">
                                    <button class="btn btn-info">Post</button>
                                </footer>
                            </div>
                            <div class="panel bg-light">
                                <div class="bio-graph-heading">
                                    Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel
                                    ispum.
                                    Aliquam ac magna metus.
                                </div>
                                <div class="panel-body bio-graph-info row ms-2">
                                    <h1 class="mt-2" style="font-weight:bold;">Member Profile</h1>
                                    <div class="ms-3">
                                        <div class="bio-row">
                                            <p><span>ID </span>:
                                                <?php echo $_SESSION[''.$_SESSION['role'].'_id'];?>
                                            </p>
                                        </div>
                                        <div class="bio-row">
                                            <p><span>Name </span>:
                                                <?php echo $_SESSION['user_name'];?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="bio-row">
                                            <p><span>Email </span>:
                                                <?php echo $_SESSION['user_email'];?>
                                            </p>
                                        </div>
                                        <div class="bio-row">
                                            <p><span>Joined Date </span>:
                                                <?php echo $_SESSION['user_date'];?>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div>
                                <br>
                                <h4>Upcoming Events</h4>
                                <br>

                                <div class="row justify-content-center">
                                    <?php for($i = 0;$i < 4 && $i < count($upcoming_event);$i++): ?>
                                    <?php
                                        $imgName = $upcoming_event[$i]["Event_upl_file_name"] ?? "default";
                                        $imgPath = $upcoming_event[$i]["Event_upl_path"] ?? "../Image/AI Aware.jpg";
                                        ?>
                                    <div class="panel col-md-5 col-sm-12 p-2 m-2 border bg-light text-left rounded event_id"
                                        data-event-id="<?php echo $upcoming_event[$i]["Event_id"]; ?>"
                                        data-bs-trigger="hover"
                                        data-bs-content="<?php echo $upcoming_event[$i]["Event_desc"]; ?>"
                                        data-bs-placement="top" data-bs-toggle="popover" title="Click to see more!">
                                        <div class="panel-body d-flex flex-warp">
                                            <div class="bio-chart d-flex align-items-center justify-content-center">
                                                <div style="width:100px;height:100px;" class="d-block">
                                                    <img class="upcoming-event-img img-thumbnail"
                                                        <?php echo "src='$imgPath' alt='$imgName'"?>/>
                                                </div>
                                            </div>
                                            <div class="bio-desk">
                                                <h4 class="text-primary">
                                                    <?php echo $upcoming_event[$i]["Event_name"] ?>
                                                </h4>
                                                <p><i class="fas fa-calendar" style="color:#898B9B;"></i>
                                                    <?php echo $upcoming_event[$i]["Event_date"] ?>
                                                </p>
                                                <p><i class="fas fa-hourglass-start"
                                                        style="color:#898B9B;"></i><?php echo $upcoming_event[$i]["DateCountDown"]; ?>
                                                    days left</p>
                                                </p>
                                                <p><i class="far fa-clock" style="color:#898B9B;"></i>
                                                    <?php echo $upcoming_event[$i]["Start_time"]; ?>
                                                </p>
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