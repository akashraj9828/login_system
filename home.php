<?php
session_start();


if(isset($_GET['delete'])){
	if(isset($_GET['story_id'])){
		if($_GET['delete']){
			include_once 'includes/dbh.inc.php';
			$username=$_SESSION[ 'u_uid' ];
			$story_id=$_GET['story_id'];
			echo $story_id;
			$sql="DELETE FROM $username WHERE story_id =$story_id";
		
			if(mysqli_query($stories_conn, $sql)){
				header("Location: home.php?delete=success");
				exit();
			}
			else{
            //print any error if connection fails
            echo "Error: " . $sql . "<br>" . mysqli_error($conn). '<br>';
			}
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>LOGIN SYSYTEM</title>
	<!-- stylesheets -->
	<!-- Google Fonts -->
	<link href='css/fonts.css' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/animate.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="css/home_style.css">	
	<!-- javascripts -->
	<script src="js/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="top">
			<h1 id="title" class="hidden"><span id="logo" class="animated fadeInDown">Home</span></h1>
		</div>
		<div class="home-box animated fadeInRight">
			<div class="box-header">
				

			<?php 
			if(isset($_SESSION['u_first'])){
				echo '	<img id="profile-pic" src=includes/fetch_profile_pic.inc.php ></img>
						<br>
						<h2 id="name">' . $_SESSION['u_first'] . ' ' . $_SESSION['u_last'] . '</h2>
						<br>
						<a onclick="toggle(\'uploader\',\'flex\')">Change profile pic</a>
						<form id="uploader" method="POST" action="includes/upload.inc.php" enctype="multipart/form-data" style="display: none;" >
						<br/>
						
						<input class ="hidden" type="file" accept="image/*" name="image_input" id="image_input" required="required" accept="image/*" >
						<button type="submit" name="upload_image_button" id="upload_image_button" > <i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
						<button type="button" name="cancel" id="cancel" onclick="toggle(\'uploader\',\'flex\')">Cancel</button>
						</form>
						</div>
						<label >Welcome <solid>' . $_SESSION['u_first'] . ' ' . $_SESSION['u_last'] . '</solid></label>
						<br>
						<br>
						<br>';
			
				echo '  
						<div class="story-box animated zoomIn">
						<h>Your stories:</h>
						<br>  
						';

				//stories from database
				include_once 'includes/fetch_stories.inc.php';
				//stories form database
	
				echo '	</div>
						<button onClick="toggle_new_story_input_form()" id="new_story_form_toggle">Add New story</button>';

				//new story input box here
				echo ' 
						<form id="story-input" action="includes/upload.inc.php?new_story" method="POST" style="display: none">
						<textarea name="story" rows="6" placeholder="Your story...." form="story-input" required="required" autofocus ></textarea>
						<br>
						<button type="submit" name="post_story">Post story</button>
						<button type="button" name="cancel" onClick="toggle_new_story_input_form()">cancel</button>
						</form>';
				
				echo'	<form action="includes/logout.inc.php" method="POST">
						<button type="submit" name="logout">Log out</button>
						</form>';
			}else{
				
				echo '	
						<h2> ⚠ Not logged in ! ⚠</h2>
						</div>
						<label>You are not logged in.</label>
						<br>
						<label>Login to continue</label>
						<br>
						<button type="submit" onClick="location.href=\'login.php?redirect_from-home\'" name="login">Login</button>';
			}
		
			?>

              
		</div>
	</div>
</body>

<script>
	var uploadField = document.getElementById("image_input");
	uploadField.onchange = function() {
		
		// if(this.files[0].size > 1000000){
			// alert("Upload image under 1mb!");
				// this.value = "";
	};

	function toggle_new_story_input_form(){
		 var form = document.getElementById("story-input");
		 var button = document.getElementById("new_story_form_toggle");
    if (form.style.display == "none") {
        form.style.display = "block";
		button.style.display = "none";
    } else {
        form.style.display = "none";
		button.style.display = "initial";
    }
	}

	
	function toggle(y,display){

	if(!display){ display="block" ;}
	var x = document.getElementById(y);
    if (x.style.display == "none") {
        x.style.display = display;
    } else {
        x.style.display = "none";
    }
	}


	//php of delete written after closing of html tag
	function confirmDelete(id){
		confirmation=confirm("Delete this story");
		if(confirmation){
			window.location = "home.php?story_id=" + id + "&delete=true";
		}else{

		}
	}


	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInLeft');
    	$("input:text:visible:first").focus();
	});
</script>


</html>


