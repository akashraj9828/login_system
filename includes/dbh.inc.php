<?php 
/***** DATABASE HANDLER CONFIGURATION *****/


/*** USERNAME PASSWORD DATABASE ***/
/** wamp config **/

$dbServerName="localhost";
$dbUserName="root";
$dbPassword="";
$dbName="loginsystem";



$conn=mysqli_connect($dbServerName,$dbUserName,$dbPassword,$dbName);

$stories_dbServerName="localhost";
$stories_dbUserName="root";
$stories_dbPassword="";
$stories_dbName="stories";


$stories_conn=mysqli_connect($stories_dbServerName,$stories_dbUserName,$stories_dbPassword,$stories_dbName);
