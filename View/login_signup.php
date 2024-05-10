<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
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
			box-shadow: 1px 1.5px 1px 0 #007bff;
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
	<?php include('../Root/connect-db.php');
	include('../Root/link.php'); ?>

	<?php
	    session_start();
	date_default_timezone_set('Asia/Kuala_Lumpur');
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user']) && isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['email'])) {
	    echo "<script>console.log('success');</script>";
	    $user = $_POST['user'] ?? '';
	    $name = $_POST['name'] ?? 'User';
	    $pass = $_POST['pass'] ?? '';
	    $email = $_POST['email'] ?? '';
	    include("../Process/generateOTP.php");
	    echo '<script>document.getElementById("myModal").modal("toggle");</script>';
	}

	?>

	<h1 class="title">TARUMT MOVIE SOCIETY</h1>

	<div class="login-wrap">
		<div class="login-html">
			<form action="../Process/loginprocess.php" method="POST">
				<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Member
					Login</label>
				<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
				<div class="login-form">
					<div class="sign-in-htm">
						<div class="group">
							<label for="user" name="user" class="label">Member ID</label>
							<input id="user" name="user" type="text" class="input"
								placeholder="Type your member id here">
						</div>
						<div class="group">
							<label for="pass" name="pass" class="label">Password</label>
							<input id="pass" name="pass" type="password" class="input" data-type="password"
								placeholder="Password" required>
						</div>
						<div class="group">
							<input id="check" name="signedin" type="checkbox" class="check" checked>
							<label for="check" name="signedin"><span class="icon"></span> Keep me signed in</label>
						</div>
						<div class="group">
							<input type="submit" class="button" value="Sign In">
						</div>
			</form>
			<div class="hr"></div>
			<div class="foot-lnk">
				<label for="tab-2">Not a member?</a>
			</div>
		</div>
		<form
			action="<?php echo $_SERVER["PHP_SELF"]; ?>"
			method="POST">
			<div class="sign-up-htm">
				<div class="group">
					<label for="user" class="label">Member ID</label>
					<input id="user" name="user" type="text" class="input" placeholder="12 to 20 characters">
				</div>
				<div class="group">
					<label for="name" class="label">Name</label>
					<input id="name" name="name" type="text" class="input" placeholder="Type your name here">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" name="pass" type="password" class="input" data-type="password"
						placeholder="8 to 16 characters">
				</div>
				<div class="group">
					<label for="email" class="label">Email Address</label>
					<input id="email" name="email" type="email" class="input" placeholder="example@mail.com">
				</div>

				<div class="group">
					<input type="submit" class="button" value="Sign Up">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already member?</a>
				</div>
			</div>
		</form>
	</div>


	<!-- OTP verification -->
	<div class="modal" id="myModal">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<form action="../Process/signupprocess.php" method="post"> <!-- Modal header -->
					<div class="modal-header d-flex justify-content-between">
						<h4>Verification</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<!-- Modal body -->
					<div class="modal-body d-flex justify-content-center flex-column">
						<h5>The OTP No. has been sent to your email. <span id="countdown"></span></h5>
						<input type="hidden" name="user"
							value="<?php echo $user; ?>" />
						<input type="hidden" name="name"
							value="<?php echo $name; ?>" />
						<input type="hidden" name="pass"
							value="<?php echo $pass; ?>" />
						<input type="hidden" name="email"
							value="<?php echo $email; ?>" />
						<div class="otp-field my-3">
							<input name="otp" type="number" autofocus />
							<input name="otp" type="number" />
							<input name="otp" type="number" />
							<input name="otp" type="number" />
							<input name="otp" type="number" />
						</div>
						<p class="resend">Didn't receive the OTP? <a href="#" onclick="OTPRegenerate();">Resend</a></p>
					</div>
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" onclick="OTPverification();">Verify</button>
					</div>
				</form>
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
		<script>
			startCountdown();
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

			function OTPverification() {
				var userInputOTP = Array.from(inputs).map(input => input.value).join('');

				var
					systemOTP = <?php echo $_SESSION["otp"] ?? null ?> ;
				if (systemOTP == null) {
					event.preventDefault();
					return;
				}
				if (userInputOTP == systemOTP) {
					alert('OTP verification successful');
				} else {
					alert('OTP verification failed');
					event.preventDefault();
				}
			}

			function OTPexpired() {
				unset( <?php echo $_SESSION['otp'] ?> );
			}


			function startCountdown() {
				var countdown = 5 * 60; // 5 minutes
				var timer = setInterval(function() {
					var minutes = Math.floor(countdown / 60);
					var seconds = countdown % 60;

					// Display the countdown
					document.getElementById("countdown").innerHTML = "The OTP will be expired in" + minutes + ":" +
						seconds + " minutes";
					if (countdown <= 0) {
						clearInterval(timer);
						document.getElementById("countdown").innerHTML = "The OTP has been Expired.";
						// Call the function for expired OTP
						OTPexpired();
					}
					countdown--; //Decrement the countdown
				}, 1000); // Update every second
			}

			// Call the function to regenerate OTP
			function OTPRegeneration() {
				OTPexpired();
				<?php include("../Process/generateOTP.php"); ?>
				startCountdown();
			}
		</script>
</body>

</html>