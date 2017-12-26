<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>LOGIN SYSYTEM</title>
	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="top">
			<h1 id="title" class="hidden"><span id="logo">Daily <span>UI</span></span></h1>
		</div>
		<div class="login-box animated fadeInUp">
			<div class="box-header">

			<?php
				if(isset($_SESSION['u_id'])){
					echo '
						<form action="includes/logout.inc.php" method="POST">
						<button type="submit" name="logout">Log out</button>
						</form>';
				}else{
					echo '
						<form action="includes/login.inc.php" method="POST">
						<h2>Log In</h2>
						</div>
						<label for="username">Username</label>
						<br/>
						<input type="text" id="username" name="username">
						<br/>
						<label for="password">Password</label>
						<br/>
						<input type="password" id="password" name="password">
						<br/>
						<button type="submit" name="submit">Log In</button>
						<button type="button" onclick="location.href=\'signup.php\'">Register</button>
						<a href="#"><p class="small">Forgot your password?</p></a>
						</form>';
				}
			?>
	
		</div>
	</div>
</body>

<script>
	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
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