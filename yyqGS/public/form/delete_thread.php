<?php

/**
 * Delete users' threads.
 */

require_once "../../private/initialize.php";
session_start();
$tid = isset($_SESSION['tid'])?$_SESSION['tid']:null;
$country = isset($_SESSION['country'])?$_SESSION['country']:null;
//$id = $_SESSION['id'];
$id = isset($_SESSION['ID'])?$_SESSION['ID']:null;

$logIn = isset($_SESSION['loggedIn'])?$_SESSION['loggedIn']:null;


if($tid!=null && $country!=null && $id!=null && $logIn!=null ){

    $req = "DELETE FROM new_thread WHERE country='" .$country. "' AND t_id='" .$tid. "'";
    $result = mysqli_query($db,$req);

    $req_delete_noti = "DELETE FROM notification WHERE country='" .$country."' AND t_id='".$tid."'";
    mysqli_query($db,$req_delete_noti);

    $req2 = "DELETE FROM comments WHERE country='" .$country. "' AND t_id='" .$tid. "'";
    mysqli_query($db,$req2);


    $req3 = "DELETE FROM liked WHERE country='" .$country. "' AND t_id='" .$tid. "'";
    mysqli_query($db,$req3);



    if ( !$req ) {
        printf("Error: %s\n", mysqli_error($db));
    }
    else{
        echo $id.",".$country;
    }

}
else{
    printf("Error: %s\n", mysqli_error($db));
}



//$array = [];
//
//$req_f = "SELECT * FROM new_thread WHERE country=" .$_SESSION['country']. "'";
//$result_f = mysqli_query($db,$req_f);
//$row = mysqli_num_rows($result_f);
//while($subject_f = mysqli_fetch_assoc($result_f)){
//    array_push($array,$subject_f);
//}
//
//
//
//for($i=$tid;$i<=$row ;$i++){
//    $new_tid = $array[$i-1]['t_id']-1;
//    $old_tid = $i+1;
//    $req_update = "UPDATE new_thread SET t_id='" .$new_tid. "' WHERE country='" .$_SESSION['country']. "' AND t_id='" .$old_tid. "'";
//    $result_update = mysqli_query($db,$req_update);
//}






?>