<?php 
/***** DATABASE HANDLER CONFIGURATION *****/


/*** USERNAME PASSWORD DATABASE ***/
/** wamp config **/

$dbServerName="localhost";
$dbUserName="root";
$dbPassword="";
$dbName="loginsystem";



/** https://mysql8.db4free.net/phpMyAdmin config **/

// $dbServerName="db4free.net:3307";
// $dbUserName="akashraj9828";
// $dbPassword="idkmypassword";
// $dbName="akashraj9828";

$conn=mysqli_connect($dbServerName,$dbUserName,$dbPassword,$dbName);



/*** STORIES DATABASE ***/
/** wamp config **/

$stories_dbServerName="localhost";
$stories_dbUserName="root";
$stories_dbPassword="";
$stories_dbName="stories";

/** https://mysql8.db4free.net/phpMyAdmin config **/
// $stories_conn=mysqli_connect($dbServerName,$dbUserName,$dbPassword,$dbName);

$stories_conn=mysqli_connect($stories_dbServerName,$stories_dbUserName,$stories_dbPassword,$stories_dbName);
