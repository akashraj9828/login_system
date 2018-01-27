<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>LOGIN SYSYTEM</title>
	<!-- Google Fonts -->
	<link href='css/fonts.css' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="css/signup_style.css">
	<script src="js/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="top">
			<h1 id="title" class="hidden"><span id="logo">Daily <span>UI</span></span></h1>
		</div>
		<div class="signup-box animated fadeInUp">
			<div class="box-header">

                            <!--START OF SIGN-UP FORM -->
            <form action="includes/signup.inc.php" method="POST"> 
			<h2>Sign Up</h2>
            </div>
            <label for="firstname">First Name</label>
			<br/>
			<input type="text" name="firstname" id="firstname" required="required">
            <br/>
            <label for="lastname">Last Name</label>
			<br/>
			<input type="text" name="lastname" id="lastname" required="required">
            <br/>
            <label for="email">Email</label>
			<br/>
			<input type="email" name="email" id="email" required="required">
			<br/>
			<label for="username">Username</label>
			<br/>
			<input type="text" name="username" id="username" required="required">
			<br/>
			<label for="password">Password</label>
			<br/>
			<input type="password" name="password" id="password" required="required">
			<br/>
			<button type="submit" name="signup">Sign Up</button>
			
			<a href="login.php"><p class="small">Login</p></a>
            
            
            </form>
                            <!-- END OF SIGN-UP FORM -->

		</div>
	</div>
</body>

<script>
	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
	});
	$('#firstname').focus(function() {
		$('label[for="firstname"]').addClass('selected');
	});
	$('#firstname').blur(function() {
		$('label[for="firstname"]').removeClass('selected');
	});
	$('#lastname').focus(function() {
		$('label[for="lastname"]').addClass('selected');
	});
	$('#lastname').blur(function() {
		$('label[for="lastname"]').removeClass('selected');
	});
	$('#email').focus(function() {
		$('label[for="email"]').addClass('selected');
	});
	$('#email').blur(function() {
		$('label[for="email"]').removeClass('selected');
	});

	$('#username').focus(function() {
		$('label[for="username"]').addClass('selected');
	});
	$('#username').blur(function() {
		$('label[for="username"]').removeClass('selected');
	});
	$('#password').focus(function() {
		$('label[for="password"]').addClass('selected');
	});
	$('#password').blur(function() {
		$('label[for="password"]').removeClass('selected');
	});
</script>

</html>