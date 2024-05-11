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
		<div class="login-html">
			<form action="../Process/loginprocess.php" method="POST">
				<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Member
					Login</label>
				<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign
					Up</label>
				<div class="login-form">
					<div class="sign-in-htm">
						<div class="group">
							<label for="signInUser" name="user" class="label">Member ID</label>
							<input id="signInUser" name="user" type="text" class="input"
								placeholder="Type your member id here">
						</div>
						<div class="group">
							<label for="signInPass" name="pass" class="label">Password</label>
							<input id="signInPass" name="pass" type="password" class="input" data-type="password"
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
		<div class="sign-up-htm">
			<form action="../Process/signupprocess.php" method="post">
				<div id="sign-up-form">
					<div class="group">
						<label for="signUpUser" class="label">Member ID</label>
						<input id="signUpUser" name="user" type="text" class="input" placeholder="12 to 20 characters">
					</div>
					<div class="group">
						<label for="signUpName" class="label">Name</label>
						<input id="signUpName" name="name" type="text" class="input" placeholder="Type your name here">
					</div>
					<div class="group">
						<label for="signUpPass" class="label">Password</label>
						<input id="signUpPass" name="pass" type="password" class="input" data-type="password"
							placeholder="8 to 16 characters">
					</div>
					<div class="group">
						<label for="email" class="label">Email Address</label>
						<input id="email" name="email" type="email" class="input" placeholder="example@mail.com">
					</div>

					<div class="group">
						<input type="button" class="button" onclick="generateOTP();" value="Sign Up" />
					</div>
					<div class="hr"></div>
					<div class="foot-lnk">
						<label for="tab-1">Already member?</a>
					</div>
				</div>
				<div id="otp-form" hidden>
					<div class="group">
						<label for="otp" class="label">OTP</label>
						<input id="otp" name="otp" type="text" class="input" placeholder="XXXXXX">
					</div>
					<div class="group">
						<input type="submit" class="button" value="Verify" />
					</div>
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
	<script defer>
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

		function generateOTP() {
			var otpForm = document.getElementById('otp-form');
			var signUpForm = document.getElementById('sign-up-form');
			//if the input form is empty, the otp will not be generated
			if (document.getElementById('email').value == "" || document.getElementById('signUpName').value == "" || document
				.getElementById('signUpUser').value == "" || document.getElementById('signUpPass').value == "") {
				alert(" Please fill in the required fields.");
				return;
			}
			signUpForm.hidden = true;
			otpForm.hidden = false;
			console.log("Generating OTP");
			var formData = new FormData();
			formData.append('email',
				document.getElementById('email').value);
			formData.append('name',
				document.getElementById('signUpName').value);
			fetch('../Process/generateOTP.php', {
					method: 'POST',
					body: formData
				}).then(response => response.text())
				.then(data => {
					console.log(data);
					alert("The OTP will be sent to your email. Please check your email.");
				})
				.catch((error) => {
					console.error('Error:', error);
				});

		}
	</script>
</body>

</html>