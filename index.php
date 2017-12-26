<?php

include_once 'login.php';

if(isset($_SESSION['u_id'])){
    echo "<h> you are logged in!!</h>";
}
