<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../Css/assets/css/login.css" rel="stylesheet">
</head>

<body>
    <?php
include('../Root/connect-db.php');
    include('../Root/link.php');

    session_start();

    ?>

    <?php
    date_default_timezone_set('Asia/Kuala_Lumpur');
    ?>




    <h1 class="title">TARUMT MOVIE SOCIETY</h1>
    <div class="login-wrap">
        <div class="login-html" style="display:block;">
            <form action="" method="POST">
                <input id="tab-1" hidden type="radio" name="tab" class="sign-in" checked><label for="tab-1"
                    class="tab">Password Recovery</label>
                <input id="tab-2" hidden type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
                <div id="recovery-form" class="login-form">
                    <div class="sign-in-htm">
                        <div class="label" onclick="window.history.back();" alt="back to previous page">
                            <i class="fa-solid fa-left-long" style="font-size:2em;cursor:pointer;color:#1161EE;"></i>
                        </div>

                        <div class="group">
                            <label for="user" name="user" class="label">Member ID</label>
                            <input id="user" name="user" type="text" class="input"
                                placeholder="Type your member id here">
                        </div>
                        <div class="group">
                            <label for="email" name="email" class="label">Email</label>
                            <input id="email" name="email" type="email" class="input" placeholder="example@gmail.com"
                                required>
                        </div>
                        <div class="group">
                            <input type="button" class="button" value="Continue" onclick="passwordRecoverValidate();">
                        </div>
                    </div>
                </div>
                <div id="otp-form" class="login-form" hidden>
                    <div class="label" onclick="backToPrev()" alt="back to previous page">
                        <i class="fa-solid fa-left-long" style="font-size:2em;cursor:pointer;color:#1161EE;"></i>
                    </div>
                    <div class="group">
                        <label for="otp" class="label">OTP</label>
                        <input id="otp" name="otp" type="text" class="input" placeholder="XXXXXX">
                    </div>

                    <div class="group">
                        <input type="submit" class="button" value="Verify" />
                    </div>
                </div>
            </form>
            <div class="hr"></div>
        </div>
    </div>

    <?php
    if (isset($_SESSION['error'])) {
        echo "<script>alert('" . $_SESSION['error'] . "');</script>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo "<script>alert('" . $_SESSION['success'] . "');</script>";
        unset($_SESSION['success']);
    }
    ?>
    <script defer>
        var otpForm = document.getElementById('otp-form');
        var recoveryForm = document.getElementById('recovery-form');



        function passwordRecoverValidate() {
            var email = document.getElementById("email").value;
            var user_id = document.getElementById("user").value;

            if (email == "" || user_id == "") {
                alert("Please fill in all the fields.");
                return;
            }

            var formData = new FormData();
            formData.append("email", email);
            formData.append("user_id", user_id);

            fetch("../Process/passwordrecovery_process.php", {
                    method: "POST",
                    body: formData
                }).then(response => response.text())
                .then(data => {

                    if (data.includes("success")) {
                        recoveryForm.hidden = true;
                        otpForm.hidden = false;
                    } else {
                        alert(data);
                    }
                });
        }

        function backToPrev() {
            recoveryForm.hidden = false;
            otpForm.hidden = true;
        }
    </script>
</body>

</html>