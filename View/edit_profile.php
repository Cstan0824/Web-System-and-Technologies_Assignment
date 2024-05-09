<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit Profile</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../Css/assets/css/profile-style.css" rel="stylesheet" />
    <?php 
    if (!isset($_SESSION['role']) ||$_SESSION['role'] == NULL || $_SESSION['role'] != "Member" &&   $_SESSION['role'] != "Staff"){
        session_destroy();
        header("Location: login_signup.php");
    }
?>
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
                        <li>Edit Profile</li>
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
                                    <h1>Tan Choon Shen</h1>
                                </div>
                                <div class="panel-body">
                                    <ul class="profilenav list-group" style="list-style-type: none; padding-left: 0px;">
                                        <a href="record.php" class="list-group-item list-group-item-action"><i
                                                class="fa fa-ticket" style="color:#898B9B;"></i>&nbsp;&nbsp;Booking
                                            History</a>
                                        <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-edit"
                                                style="color:#898B9B;"></i>&nbsp;&nbsp;Edit Profile</a>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="profile-info col-md-9">
                            <div class="panel">
                                <div class="bio-graph-heading">
                                    Welcome, Tan Choon Shen.
                                </div>
                                <div class="panel-body bio-graph-info">
                                    <div class="col-md-9 personal-info">
                                        <h3>Member Details</h3>
                                        <form action="../Process/edit-profile.php" method="POST" class="form-horizontal"
                                            role="form">
                                            <div class="bio-row">
                                                <label class="col-lg-9 control-label" name="Member_ID">Member
                                                    ID:</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control member-id" name="Member_ID" type="text"
                                                        value="Cstan_0000" readonly>
                                                </div>
                                            </div>
                                            <div class="bio-row">
                                                <label class="col-lg-9 control-label" name="Member_name">Member
                                                    name:</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control member-name" name="Member_name"
                                                        type="text" value="Tan Choon Shen">
                                                </div>
                                            </div>
                                            <div class="bio-row">
                                                <label class="col-lg-9 control-label" name="Member_email">Member
                                                    email:</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control member-email" name="Member_email"
                                                        type="text" value="cstan@mail.com">
                                                </div>
                                            </div>
                                            <div class="bio-row">
                                                <label class="col-lg-9 control-label"
                                                    name="Member_password">Password:</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control member-password" name="Member_password"
                                                        type="password" value="0000Cstan" readonly>
                                                </div>
                                            </div>
                                            <div class="bio-row">
                                                <label class="col-lg-9 control-label" name="Member_regisdate">Joined
                                                    Date:</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control member-regisdate" name="Member_regisdate"
                                                        type="text" value="2024-03-31" readonly>
                                                </div>
                                            </div>
                                            <div class="bio-row">
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