<?php

session_start();
if ( isset( $_POST[ 'post_story' ] ) ) {
    if(isset($_SESSION['u_uid'])){
    include_once 'dbh.inc.php';
    
    $username = $_SESSION['u_uid'];
    $firstname =$_SESSION[ 'u_first'] ;
    $lastname=$_SESSION[ 'u_last' ];
    $story = mysqli_real_escape_string( $conn, $_POST[ 'story' ] );
    // $story = $_POST[ 'story' ];
    
     $sql="INSERT INTO " . $username . " (user_uid,user_first,user_last,user_story) VALUES ('$username','$firstname','$lastname','$story')";



    if(mysqli_query($stories_conn, $sql)){
        header("Location: ../home.php?story_upload=success");
        exit();
     }
     else{
            //print any error if connection fails
            echo "Error: " . $sql . "<br>" . mysqli_error($stories_conn). '<br>';
        }

   echo '<br>' . $story;
    }else {
        echo '<h2> You are not logged in.. :( </h2>';
    }
}



if(isset($_POST['upload_image_button'])){
if(isset($_SESSION['u_uid'])){
    include_once 'dbh.inc.php';
    
    $username = $_SESSION['u_uid'];
    $firstname =$_SESSION[ 'u_first'] ;
    $lastname=$_SESSION[ 'u_last' ];
    $charlist="'";
    $imagename=$_FILES['image_input']['name'];
     
    //Get the content of the image and then add slashes to it 
    $imagetmp=mysqli_real_escape_string($conn,file_get_contents($_FILES['image_input']['tmp_name']));
    
    //actual binary data
    $image_data=file_get_contents($_FILES['image_input']['tmp_name']);
    
    //location of tmp file stored on server
    // $post_data=$_FILES['image_input']['tmp_name'];

    $sql="UPDATE users
         SET user_profile_pic='$imagetmp'
          WHERE user_uid='$username'";
    
        if(mysqli_query($conn, $sql)){
        header("Location: ../home.php?image_upload=success");
        exit();
     }
     else{
            //print any error if connection fails
            echo "Error: " . $sql . "<br>" . mysqli_error($conn). '<br>';
        }
}
}

 else {
    header( "Location: ../home.php?illegal_access" );
    exit( );
}
