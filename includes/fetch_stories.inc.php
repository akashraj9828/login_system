<?php
if(isset($_SESSION['u_uid'])){
    include_once 'dbh.inc.php';
    
    $username = $_SESSION['u_uid'];
    $firstname =$_SESSION[ 'u_first'] ;
    $lastname=$_SESSION[ 'u_last' ];
    

    //select all stories from that specific users private table
    $sql2="SELECT story_id,user_story , reg_date
            FROM " . $username . " 
            ORDER BY story_id DESC";
            
    $result=mysqli_query( $stories_conn, $sql2 );
   if($result){
    $resultCheck = mysqli_num_rows( $result );





    if($resultCheck < 1){
        echo '<h2>You have no entries :( </h2>
                <br>';
    }else {
        echo '<h2>Total entries: ' . $resultCheck . '</h2>
                <br>';


        /*** div stories starts here  ***/
        echo '<div class="stories">';
 
                    while($row=mysqli_fetch_assoc( $result )){
                        $story_id=$row['story_id'];
                        $story=$row['user_story'];

                        //if using local server
                        date_default_timezone_set('Asia/Kolkata');
                        $story_time=$row['reg_date'];
                        $time=strtotime("$story_time");
                        $relative_time=time2str($time);

                        //if using mysql4.net server
                        //  date_default_timezone_set('Asia/Kolkata');
                        //  $story_time=$row['reg_date'];
                        //  $time=strtotime("$story_time UTC");
                        //  $time=strtotime("-1 hour ",$time);
                        //  $relative_time=time2str($time);

                        echo '<h3>'. date("F j, Y", $time ) . ' ' . date("g:i a", $time ) . '<br> ' . $relative_time . '</h3>
                            <h4 id="'. $story_id .'">'. $story . 
                            '<i class="fa fa-trash fa-lg" id="'. $story_id .'" onclick="confirmDelete('.$story_id.')" ></i>
                            </h4>  
                            
                            <br>';
                    }

        echo '</div>';
        /*** div stories starts here  ***/

    }


   }
   else{ 
        //print any error if connection fails
            echo "Error: " . $sql2 . "<br>" . mysqli_error($stories_conn). '<br>';
   }

}
else {
    echo '<h2> You are not logged in.. :( </h2>';
}



function time2str($ts)
{
    if(!ctype_digit($ts))
        $ts = strtotime($ts);

    $diff = time() - $ts;
    if($diff == 0)
        return 'now';
    elseif($diff > 0)
    {
        $day_diff = floor($diff / 86400);
        if($day_diff == 0)
        {
            if($diff < 60) return 'just now';
            if($diff < 120) return '1 minute ago';
            if($diff < 3600) return floor($diff / 60) . ' minutes ago';
            if($diff < 7200) return '1 hour ago';
            if($diff < 86400) return floor($diff / 3600) . ' hours ago';
        }
        if($day_diff == 1) return 'Yesterday';
        if($day_diff < 7) return $day_diff . ' days ago';
        if($day_diff < 31) return ceil($day_diff / 7) . ' weeks ago';
        if($day_diff < 60) return 'last month';
        return date('F Y', $ts);
    }
    else
    {
        $diff = abs($diff);
        $day_diff = floor($diff / 86400);
        if($day_diff == 0)
        {
            if($diff < 120) return 'in a minute';
            if($diff < 3600) return 'in ' . floor($diff / 60) . ' minutes';
            if($diff < 7200) return 'in an hour';
            if($diff < 86400) return 'in ' . floor($diff / 3600) . ' hours';
        }
        if($day_diff == 1) return 'Tomorrow';
        if($day_diff < 4) return date('l', $ts);
        if($day_diff < 7 + (7 - date('w'))) return 'next week';
        if(ceil($day_diff / 7) < 4) return 'in ' . ceil($day_diff / 7) . ' weeks';
        if(date('n', $ts) == date('n') + 1) return 'next month';
        return date('F Y', $ts);
    }
}