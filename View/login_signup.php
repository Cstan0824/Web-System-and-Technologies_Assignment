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
							<a href="../View/password_recovery.php" class="forgot-password">Forgot Password?</a>
						</div>
						<div class="group">
							<input type="submit" class="button" value="Sign In">
						</div>
			</form>
			<div class="hr"></div>
			<div class="foot-lnk">
				<label style="color: white;" for="tab-2">Not a member?</a>
			</div>
		</div>
		<div class="sign-up-htm">
			<form action="../Process/signupprocess.php" method="post">
				<div id="sign-up-form">
					<div class="group">
						<label for="signUpUser" class="label">Member ID</label>
						<input id="signUpUser" name="user" type="text" class="input" placeholder="7 to 20 characters">
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
						<input type="button" class="button" onclick="memberIDValidate();" value="Sign Up" />
					</div>
					<div class="hr"></div>
					<div class="foot-lnk">
						<label style="color: white;" for="tab-1">Already member?</a>
					</div>
				</div>
				<div id="otp-form" hidden>
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
		var signUpForm = document.getElementById('sign-up-form');

		function generateOTP() {

			//if the input form is empty, the otp will not be generated
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

		function memberIDValidate() {

			

			if (document.getElementById('email').value == "" || document.getElementById('signUpName').value == "" || document
				.getElementById('signUpUser').value == "" || document.getElementById('signUpPass').value == "") {
				alert(" Please fill in the required fields.");
				return;
			}

			var memberID = document.getElementById("signUpUser").value.trim();
			var name = document.getElementById("signUpName").value.trim();
			var password = document.getElementById("signUpPass").value.trim();

			// Member ID validation
			if (memberID.length < 7 || memberID.length > 20 || /\s/.test(memberID)) {
				alert("Member ID must be 7 to 20 characters long without spaces.");
				return;
			}

			// Name validation
			if (name.length < 3 || name.length > 50) {
				alert("Name must be between 3 and 50 characters long.");
				return;
			}

			// Password validation
			if (password.length < 8 || password.length > 16 || /\s/.test(password)) {
				alert("Password must be 8 to 16 characters long without spaces.");
				return;
			}


			
			var formData = new FormData();
			formData.append('email',
				document.getElementById('email').value);
			formData.append('user',
				document.getElementById('signUpUser').value);
			fetch('../Process/validateMemberID.php', {
					method: 'POST',
					body: formData
				}).then(response => response.text())
				.then(data => {
					console.log(data);
					if (data.includes("Failed")) {
						alert(data);
					} else {
						generateOTP();
						alert("The OTP will be sent to your email. Please check your email.");
					}
				})
				.catch((error) => {
					console.error('Error:', error);
				});
		}

		function backToPrev() {
			signUpForm.hidden = false;
			otpForm.hidden = true;
		}

		

	</script>
</body>

</html>