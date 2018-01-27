<?php
session_start();
if ( isset( $_POST[ 'login' ] ) ) {

    include_once 'dbh.inc.php';
    
    $username = mysqli_real_escape_string( $conn, $_POST[ 'username' ] );
    $password = mysqli_real_escape_string( $conn, $_POST[ 'password' ] );
    
    //ERROR HANDLERS
    //EMPTY FIELD CHECK
    if ( empty( $username ) || empty( $password ) ) {
        header("Location: ../login.php?login=empty_fields");
        exit();
    } 
    else {
            //username check (if alredy exists or not)
            $sql = "SELECT * FROM users
                     WHERE user_email='$username' OR user_uid='$username'";

            $result = mysqli_query( $conn, $sql );      //query if username is alredy present or not
            $resultCheck = mysqli_num_rows( $result );       //check if query returned any row
            if ( $resultCheck < 1 ) {
                header("Location: ../login.php?login=fail");
                exit();
            } 
            else {
                    $row= mysqli_fetch_assoc( $result );  //fetch data of the selected row

                    //De-hashing(match the hashes of passwords)
                    $hashedPwdCheck = password_verify( $password, $row[ 'hashed_pwd' ] );


                if ( $hashedPwdCheck == false ) {
                    header("Location: ../login.php?login=fail");
                    exit();

                } 
                elseif ( $hashedPwdCheck == true ) {

                    //user logged in :)
                    $_SESSION[ 'u_id' ]    = $row[ 'user_id' ];
                    $_SESSION[ 'u_first' ] = $row[ 'user_first' ];
                    $_SESSION[ 'u_last' ]  = $row[ 'user_last' ];
                    $_SESSION[ 'u_email' ] = $row[ 'user_email' ];
                    $_SESSION[ 'u_uid' ]   = $row[ 'user_uid' ];
                    header( "Location: ../home.php?login=success" );
                    exit( );
            }
        }
    }
} else {
    header( "Location: ../login.php?illegal_access" );
    exit( );
}
