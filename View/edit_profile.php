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
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] == null || $_SESSION['role'] != "Member" &&   $_SESSION['role'] != "Staff") {
        session_destroy();
        header("Location: login_signup.php");
    }
    ?>
</head>

<body style="background-color:#F1F2F7;">
    <?php
    include('../Root/link.php');
    include('header.php');
    include('../Root/connect-db.php');
    ?>


    <main id="main">

        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Profile</h2>
                    <ol>
                        <li><a href="Home.php">Home</a></li>
                        <li><a href="profile.php">Profile</a></li>
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
                                    <a href="#" class="position-relative" onclick="openImageUploader();"
                                        data-bs-content="Click to change Profile Picture." title="Profile Picture"
                                        data-bs-placement="right" data-bs-toggle="popover" data-bs-trigger="hover">
                                        <img id="old-profilepic"
                                            src="<?php echo $_SESSION['user_pic_path'] ?? "../Image/profile_picture/Default-ProfilePicture.jpg" ?>"
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
                                        <a href='profile.php' class='list-group-item list-group-item-action px-2'>
                                            <i class='fa-regular fa-address-card ps-2 pe-3' style='color:#898B9B;'></i>
                                            Profile</a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="profile-info col-md-9">
                            <?php if ($_SESSION['role'] == "Member") { ?>
                            <div class="panel bg-light">
                                <div class="bio-graph-heading">
                                    <?php echo $_SESSION['user_comment']; ?>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="panel bg-light">
                                <div class="panel-body bio-graph-info row ms-2">
                                    <h1 class="mt-2" style="font-weight:bold;">Edit Profile</h1>
                                    <form id="editProfile" action="../Process/edit_profile_process.php" method="POST"
                                        class="form-horizontal" role="form">
                                        <div class="bio-row">
                                            <label class="col-lg-9 control-label"
                                                name="user_ID"><?php echo $_SESSION['role'];?>
                                                ID:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control user-id" name="user_ID" type="text"
                                                    value="<?php echo $_SESSION['user_id'];?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="bio-row">
                                            <label class="col-lg-9 control-label"
                                                name="user_name"><?php echo $_SESSION['role'];?>
                                                name:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control user-name" name="user_name" type="text"
                                                    value="<?php echo $_SESSION['user_name'];?>">
                                            </div>
                                        </div>
                                        <div class="bio-row">
                                            <label class="col-lg-9 control-label"
                                                name="user_email"><?php echo $_SESSION['role'];?>
                                                email:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control user-email" name="user_email" type="text"
                                                    value="<?php echo $_SESSION['user_email'];?>">
                                            </div>
                                        </div>
                                        <div class="bio-row">
                                            <label class="col-lg-9 control-label"
                                                name="Member_password">Password:</label>
                                            <div class="col-lg-8">
                                                <!-- haven't implement password change because of OTP -->
                                                <input class="form-control user-password" name="user_password"
                                                    type="password"
                                                    value="<?php echo $_SESSION['user_pass'];?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="bio-row">
                                            <label class="col-lg-9 control-label" name="user_regisdate">Joined
                                                Date:</label>
                                            <div class="col-lg-8">
                                                <input class="form-control user-regisdate" name="user_regisdate"
                                                    type="date"
                                                    value="<?php echo $_SESSION['user_date'];?>"
                                                    readonly>
                                                <?php if ($_SESSION['role'] == "Member") { ?>
                                                <input type="hidden" name="actionType" value="editMember">
                                                <?php } elseif ($_SESSION['role'] == "Staff") { ?>
                                                <input type="hidden" name="actionType" value="editStaff">
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="bio-row">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-8">
                                                <button class="btn btn-primary"
                                                    value='<?php echo $_SESSION['user_id']; ?>'
                                                    name="editProfile" type="submit"
                                                    onclick="confirmEditProfile();">Save Changes</button>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    });

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

    function confirmEditProfile() {
        // Display a confirmation dialog with the member's name
        var result = confirm("Are you sure the entered details are correct?");

        // If user confirms, submit the form
        if (result == 1) {
            document.getElementById("editProfile").submit();
        } else {
            event.preventDefault();
        }
    }
</script>

</html>