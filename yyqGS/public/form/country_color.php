<?php

/**
 * Update the color of "countries" on the map on home page.
 */


require_once "../../private/initialize.php";
session_start();
$country = isset($_POST['country'])?$_POST['country']:'';
$country = htmlspecialchars($country);
$country = mysqli_real_escape_string($db,$country);
//ini_set('max_execution_time', 0);
set_time_limit(5);
//if(is_post_request() && !empty($country)){
//    $req = "SELECT * FROM new_thread WHERE country='".$country."'";
//    $result = mysqli_query($db,$req);
//    if(isset($result))
//    {
//        $row = mysqli_num_rows($result);
//
//        $_SESSION[$country] = $row;
//
//        echo $row;
//    }
//    else{
//        $_SESSION[$country] = 0;
//        echo 0;
//    }
//}
//else{
//    echo 0;
//}


$array = [];

$req = "SELECT country, COUNT(*) FROM new_thread GROUP BY country";
$result = mysqli_query($db,$req);

while($row = mysqli_fetch_assoc($result)){

    array_push($array,['cname' => $row['country'] , 'amount' => $row['COUNT(*)']]);
}

//print_r(json_encode($array));
echo json_encode($array);