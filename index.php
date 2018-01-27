<?php
if(isset($_SESSION['u_id'])){
    echo "<span> you are logged in!!</span>";
}
include_once 'login.php';
