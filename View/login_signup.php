<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link href="../Css/assets/css/login.css" rel="stylesheet">
</head>

<body>
	<?php include('../Root/connect-db.php'); ?>

	<?php 
	session_start();
	date_default_timezone_set('Asia/Kuala_Lumpur'); 
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
</form>
<form action="../Process/signupprocess.php" method="POST">
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
								<input id="pass" name="pass" type="password" class="input" data-type="password" placeholder="8 to 16 characters">
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
					</div>
					</form>
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

</body>

</html>