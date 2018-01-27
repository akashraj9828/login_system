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
	<link rel="stylesheet" href="css/home_style.css">
	<script src="js/jquery.min.js"></script>
</head>

<body id='err' >
	<div class="container">
		<div class="top">
			<h1 id="title" class="hidden"><span id="logo"> <span>⚠</span></span></h1>
		</div>
		<div class="home-box animated fadeInDown">
			<div class="box-header">


			<h2>404-Page not found!</h2>
            </div>
			<label>Page not found</label>
            <br/>
            <button type="submit" onClick="location.href='index.php?redirect'" name="index">Go to index</button>
			

              
		</div>
	</div>
</body>

<script>
	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
	});
	
</script>

</html>