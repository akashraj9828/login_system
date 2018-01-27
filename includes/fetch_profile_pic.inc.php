<?php
session_start();
// header("content-type:image/png");
if(isset($_SESSION['u_uid'])){
    // echo "logged in as user : " . $_SESSION['u_uid']; 
    include_once 'dbh.inc.php';
    
    $username = $_SESSION['u_uid'];
    $firstname =$_SESSION[ 'u_first'] ;
    $lastname=$_SESSION[ 'u_last' ];
    
    $sql= "SELECT user_profile_pic,user_email
            FROM users
            WHERE user_uid='$username'";
    
    $result=mysqli_query( $conn, $sql );

    if($result){
        $row=mysqli_fetch_assoc( $result );
        $image=$row['user_profile_pic'];
        if($image){
        header ("Content-type: image");      
        echo $image;
        }
        else {
            $image=file_get_contents('..\images\default_profile.jpg');
             header ("Content-type: image");      
        echo $image;
        }

    
}else{
     echo "Error: " . $sql . "<br>" . mysqli_error($conn). '<br>';
}
}else {
    echo "You are not logged in .. :(";
}