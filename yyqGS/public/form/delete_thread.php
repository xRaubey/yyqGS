<?php
require_once "../../private/initialize.php";
session_start();
$tid = $_SESSION['tid'];
$country = $_SESSION['country'];
$id = $_SESSION['id'];


$req = "DELETE FROM new_thread WHERE country='" .$_SESSION['country']. "' AND t_id='" .$tid. "'";
$result = mysqli_query($db,$req);

$req_delete_noti = "DELETE FROM notification WHERE country='" .$country."' AND t_id='".$tid."'";
mysqli_query($db,$req_delete_noti);

$req2 = "DELETE FROM comments WHERE country='" .$_SESSION['country']. "' AND t_id='" .$tid. "'";
mysqli_query($db,$req2);


$array = [];

$req_f = "SELECT * FROM new_thread WHERE country=" .$_SESSION['country']. "'";
$result_f = mysqli_query($db,$req_f);
$row = mysqli_num_rows($result_f);
while($subject_f = mysqli_fetch_assoc($result_f)){
    array_push($array,$subject_f);
}



for($i=$tid;$i<=$row ;$i++){
    $new_tid = $array[$i-1]['t_id']-1;
    $old_tid = $i+1;
    $req_update = "UPDATE new_thread SET t_id='" .$new_tid. "' WHERE country='" .$_SESSION['country']. "' AND t_id='" .$old_tid. "'";
    $result_update = mysqli_query($db,$req_update);
}





if ( !$req ) {
    printf("Error: %s\n", $mysqli_error($db));
}
else{
    echo $id.",".$country;
}
?>