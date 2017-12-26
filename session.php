<?php
session_start();

if(isset($_SESSION['u_id'])){
    echo "<h><b> you are logged in!!</b></h>";
}
