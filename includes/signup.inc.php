<?php
session_start();
if(isset($_POST['signup'])){        //RUN THIS CODE ONLY IF ACCESS REQUEsT COMES FROM BUTTON
    include_once 'dbh.inc.php';     //ELSE RETURN TO ../signup.php 

    $firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
    $lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);


    //ERROR HANDLERS
    //EMPTY FIELD CHECKs
    if (empty($firstname)||empty($lastname)||empty($email)||empty($username)||empty($password)) {
        header("Location: ../signup.php?signup=empty_fields");
        exit();
      
    }else {
    //DATA TYPE CHECKER
        //name check
        if (!preg_match("/^[a-zA-Z]*$/",$firstname) || !preg_match("/^[a-zA-Z]*$/",$lastname)) {
           header("Location: ../signup.php?signup=invalid_charachter_in_name");
           exit();
        }else{
            //email check
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
           header("Location: ../signup.php?signup=invalid_email");
           exit();
            }else{
                //username check (if alredy taken or not)
                $sql="SELECT * FROM users 
                     WHERE user_uid='$username' OR user_uid='$email'";


                $result=mysqli_query($conn,$sql);       //query if username or email is alredy registered or not
                $resultCheck=mysqli_num_rows($result);  //check if query returned any row
                
                if($resultCheck>0){
                    header("Location: ../signup.php?signup=username_email_taken");
                    exit();
                }else{
                    //password hashing
                    $hashedPassword=password_hash($password,PASSWORD_DEFAULT);
                    //sql command to push user into database
                    $sql="INSERT INTO users (user_first,user_last,user_email,user_uid,user_pwd,hashed_pwd,private_table) VALUES ('$firstname','$lastname','$email','$username','$password','$hashedPassword',0)";
                  
                  
                    //       | | | | | | | | | |   
                   //pushing vvvvvvvvvvvvvvvvvvvv into database 
                   
                        if (mysqli_query($conn, $sql)) {
                            
                            //sql querry to create a table for each user as they sign up
                             $sql2="CREATE TABLE " . $username . " (
                                    story_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE COMMENT 'story id',
                                    user_uid VARCHAR(256) NOT NULL COMMENT 'username',
                                    user_first VARCHAR(256) NOT NULL COMMENT 'first name',
                                    user_last VARCHAR(256) NOT NULL COMMENT 'last name',
                                    reg_date  TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                    user_story MEDIUMBLOB NOT NULL COMMENT 'user story'
                                    )";
                                        //        | | | | | | | | | |   
//creating private table for each user in stories database vvvvvvvvvvvvvvvvvvvv
                                    if(mysqli_query($stories_conn, $sql2)){

                                        $sql3=" UPDATE users
                                                SET private_table = 1
                                                WHERE user_uid = '$username';";
                                                
                                    // update private_table=1 if private table for user is generated
                                        if(mysqli_query($conn, $sql3)){
                                             header("Location: ../signup.php?signup=success");
                                            exit();
                                        }
                                        else{
                                            //print any error if connection fails
                                            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn). '<br>';
                                    }
                                                
                                }else{
                                    //print any error if connection fails
                                    echo "Error: " . $sql2 . "<br>" . mysqli_error($stories_conn). '<br>';
                            }      
                        } else {
                                //print any error if connection fails
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn). '<br>';
                    }

                    
                   
                }
            }
    }
}
}
else{
    header("Location: ../signup.php?illegal_access");    
    exit();
}
