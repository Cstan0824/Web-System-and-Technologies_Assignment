<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="../Css/assets/css/login.css" rel="stylesheet">
    <style>
        .otp-field {
            flex-direction: row;
            column-gap: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .otp-field input {
            height: 45px;
            width: 42px;
            border-radius: 6px;
            outline: none;
            font-size: 1.125rem;
            text-align: center;
            border: 1px solid #ddd;
        }

        .otp-field input:focus {
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
        }

        .otp-field input::-webkit-inner-spin-button,
        .otp-field input::-webkit-outer-spin-button {
            display: none;
        }

        .resend {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <?php include('../Root/connect-db.php'); ?>

    <?php
    session_start();
    date_default_timezone_set('Asia/Kuala_Lumpur');
    ?>

    <h1 class="title">TARUMT MOVIE SOCIETY</h1>

    <section class="container-fluid bg-body-tertiary d-block login-wrap">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
                <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
                    <div class="card-body p-5 text-center">
                        <h4>Verify</h4>
                        <p>Your code was sent to you via email</p>

                        <div class="otp-field mb-4">
                            <input type="number" autofocus="" />
                            <input type="number" />
                            <input type="number" />
                            <input type="number" />
                            <input type="number" />
                            <input type="number" />
                        </div>

                        <button class="btn btn-primary mb-3 verify">
                            Verify
                        </button>

                        <p class="resend text-muted mb-0">
                            Didn't receive code? <a href="">Request again</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


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
    <script>
        const inputs = document.querySelectorAll('.otp-field > input');
        Array.from(inputs).forEach((input) => {
            input.addEventListener('input', function(e) {
                const index = Array.from(inputs).indexOf(input);
                if (e.data === null) {
                    if (index !== 0) {
                        inputs[index - 1].focus();
                    }
                } else {
                    if (index + 1 < inputs.length) {
                        inputs[index + 1].focus();
                    }
                }
            });
        });
    </script>
</body>

</html>